var diyc    = new (function(w, d, $, undefined) {
    "use strict";

    var _this   = this;

    /*
     *  編集ページ
     */

    // フォーム
    var f   = d.form1 || d.listForm;

    // 列数セレクターの選択肢
    var rowSetting  = [1, 2, 3, 4, 5, 6, 7];

    // 一度に読み込むアイテム数
    var itemLimits  = [10, 20, 30, 40, 50];

    // その他設定
    var editpage_id         = "plg_diycampaign_edit";
    var overlay_id          = "plg_diycampaign_overlay";
    var inputAreaOverlayClass   = "diycInputAreaOverlay";
    var loadOverlayClass    = "diycLoadOverlay";
    var input_selector_id   = "plg_diycampaign_input_selector";
    var input_area_id       = "plg_diycampaign_input_area";
    var item_id_prefix      = "diycLayoutItem";

    // キャンペーンID
    var this_campaign_id    = "";

    // テンプレート側のレイアウトを使ったかどうか
    var defaultLayoutInit   = false;

    // レイアウトが準備完了か否か
    var layoutReady     = false;
    var initProductIDs  = new Array();

    // Sortableの設定
    var sortableSetting = {};

    // 商品IDを検出するための正規表現
    var itemIDRegexp    = /^__(\d+)__$/;

    // 商品ID読み込み待ち用配列
    var itemIntervalID  = new Array();

    // XHRのタイムアウト待ち時間(ミリ秒)
    var timeoutLimit    = 1000*60*5;

    // UserAgent
    var isIE    = navigator.userAgent.indexOf("MSIE") !== -1 || navigator.userAgent.indexOf(".NET") !== -1;

    // jQuery拡張
    $.fn.extend({
        // タイル状に並べるjQuery拡張
        /**
         * Flatten height same as the highest element for each row.
         *
         * Copyright (c) 2011 Hayato Takenaka
         * Dual licensed under the MIT and GPL licenses:
         * http://www.opensource.org/licenses/mit-license.php
         * http://www.gnu.org/licenses/gpl.html
         * @author: Hayato Takenaka (https://github.com/urin/jquery.tile.js)
         * @version: 1.1.1
         **/
        tile: function(columns) {
            var tiles, $tile, max, c, h, remove, s = d.body.style, a = ["height"], last = this.length - 1;
            if(!columns) columns = this.length;
            remove = s.removeProperty ? s.removeProperty : s.removeAttribute;
            return this.each(function() {
                remove.apply(this.style, a);
            }).each(function(i) {
                c = i % columns;
                if(c == 0) tiles = [];
                $tile = tiles[c] = $(this);
                h = ($tile.css("box-sizing") == "border-box") ? $tile.outerHeight() : $tile.innerHeight();
                if(c == 0 || h > max) max = h;
                if(i == last || c == columns - 1) {
                    $.each(tiles, function() { this.css("height", max); });
                }
            });
        },

        // 列巾の再計算と適用
        recalculateColumnWidth: function() {
            var rowBox  = this;
            var divideBoxes = rowBox.children(".divideBox");

            // DOM上のセパレータをdata-leftの順にソート
            var bars = rowBox.children(".separator").toArray();
            bars.sort(function(a, b){
                var n1  = parseInt($(a).data("left"));
                var n2  = parseInt($(b).data("left"));
                switch (true) {
                    case n1 > n2: return  1;
                    case n1 < n2: return -1;
                    default: return  0;
                }
            });

            var widths  = new Array();
            var pos_min, pos_max    = 0;
            for (var i in bars) {
                var bar = $(bars[i]);
                pos_max = parseInt(bar.data("left"));
                pos_min = 0;
                for (var j = 0; j < widths.length; j++) {
                    pos_min+= widths[j];
                }
                var w   = pos_max - pos_min;
                widths.push(w);
            };

            // 最後の1ブロック分を追加
            widths.push(rowBox.width() - pos_max);

            // 巾を再指定
            for (var i in widths) {
                divideBoxes.eq(i).width(widths[i]);
            }
        }
    });

    // 列
    $(d).on("mouseenter mousemove", ".divideBox", function(e) {
        var divideBox   = $(this);
        var inputArea   = divideBox.children(".inputArea");

        if (inputArea.length === 0 && e.type == "mouseenter") {
            // 入力欄トリガーを作成する
            inputArea   = $('<div class="inputArea"></div>').appendTo(divideBox);
        }

        // 入力欄トリガーの巾を指定する(指定しないとリンクエリアがはみ出るため)
        inputArea.width(divideBox.width())

        // ポインターが外に出たら削除
            .one("mouseout", function() {$(this).remove();});
    });

    // 入力欄を開く
    $(d).on("click", ".divideBox .inputArea, ul.item.userInput li.last", function(e) {
        var caller      = $(this);
        var callerParent= caller.parents(".item");
        var divideBox   = caller.parents(".divideBox");

        // 新規作成か再編集か
        var content = undefined;
        if (caller.hasClass("last")) {
            content = caller.html().replace(/<br(:? *\/)?>/, "\n");
        }

        // オーバーレイ
        displayOverlay(inputAreaOverlayClass);

        // 選択肢
        var selector    = $('<div id="' + input_selector_id + '" class="modal-box"><div class="selector addText"><span class="btn-next">文章を追加する</span></div></div>');

        // 文章追加ボタン
        selector.on("click", ".addText", function(e) {

            // セレクターを消す
            $("#" + input_selector_id)
                .find(".selector").off("click")
                .fadeOut(function(){$(this).remove();});

            // 入力欄
            var inputArea   = $('<div id="' + input_area_id + '" class="modal-box"><dl><dt>文章</dt><dd><textarea name="text" rows="5" cols="60" tabindex="1"></textarea><br /><label><input type="checkbox" name="html_escape" value="1" /> HTMLタグを使えないようにする</label></dd></dl><div class="submitButton"><a href="?" class="plg_diycampaign-button-quit" tabindex="3"><span>やめる</span></a>&emsp;&emsp;&emsp;<a href="?" class="plg_diycampaign-button-next" tabindex="2"><span>決定</span></a></div></div>');

            inputArea.find("input[name='html_escape']").get(0).checked  = callerParent.data("escaped");

            // 入力欄：決定ボタン
            inputArea.one("click", ".plg_diycampaign-button-next", function(e) {

                // 二度押しを防ぐ
                this.onclick    = function(){return false;};

                var ia  = $("#" + input_area_id);
                var text= ia.find("textarea").val();
                if (text != "") {

                    var ul  = $('<ul class="item userInput"><li class="last">' + nl2br(text) + '</li></ul>')
                        .append(getXButton())
                        .css({display:"none"});

                    if (typeof content === "undefined") {
                        ul.appendTo(divideBox);
                    } else {
                        callerParent.replaceWith(ul);
                    }
                    ul.slideDown(500, "easeInOutQuart");

                    var checkbox    = ia.find("input[name='html_escape']");
                    ul.data("escaped", (checkbox.is(":checked") ? "true" : "false"));
                }
                closeInputArea(e);

                // ローカルストレージに保存
                storeLayout();
            });

            inputArea.appendTo("body").css({
                 marginTop :-Math.floor(inputArea.height()/2)
                ,marginLeft:-Math.floor(inputArea.width()/2)
            }).animate({opacity:1}).find("textarea").val(content).get(0).focus();
        });

        // 入力選択肢を挿入(透明)
        selector.appendTo("body").css({
             marginTop:-Math.floor(selector.height()/2)
            ,marginLeft:-Math.floor(selector.width()/2)
        });

        if (typeof content === "undefined") {
            selector.animate({opacity:1});
        } else {
            selector.find(".addText").click();
        }
    });

    // 入力欄：やめるボタン
    $(d).on("click", "#" + input_area_id + " .plg_diycampaign-button-quit", closeInputArea);

    // 入力欄：HTMLエスケープのチェックボックス
    $(d).on("change", "#" + input_area_id + " input[name='html_escape']", function(e) {
        var checkbox    = $(this);
        var ta  = checkbox.parent().prevAll("textarea");
        var t   = ta.val();
        if (checkbox.is(":checked")) {
            t   = htmlSpecialChars(t);
        } else {
            t   = htmlSpecialCharsReverse(t);
        }
        ta.val(t);
    });

    // 入力欄：オーバーレイのイベント
    $(d).on("click", "#" + overlay_id, removeOverlayWithConfirm);
    $(d).on("keydown", function(e) {
        if (e.which === 27) {
            removeOverlayWithConfirm(e);
        }
    });

    // アイテムを削除するボタン
    $(d).on("click", ".item .buttonX", function(e) {
        if (confirm("アイテムを削除します。\nよろしいですか？")) {
            $.when(moveToItemsBox($(this).parents(".item"), false)).done(function() {
                // ローカルストレージに保存
                storeLayout();
            });
        }
    });

    // 行コントローラー：上に行を追加する
    $(d).on("click", ".addRowBeforeButton", function(e) {
        getRowBox().css({display:"none"}).insertBefore($(this).parents(".rowBox")).slideDown(500, "easeInOutQuart");
    });

    // 行コントローラー：行の分割
    for (var i = 0; i < rowSetting.length; i++) {
        $(d).on("click", ".divideColumnButton.button" + rowSetting[i], {n:rowSetting[i]}, function(e) {
            var n   = e.data.n;
            var box = $(this).parents(".rowBox");
            var divided_n   = box.data("divided");

            if (divided_n == n || (divided_n != 1 && !confirm("列幅がリセットされます。\nよろしいですか？"))) {
                return false;
            }

            // セパレータを削除する
            box.children(".separator").remove();

            if (divided_n < n) {
                // 列が増える場合
                increaseColumn(box, divided_n, n);
            } else {
                // 列が減る場合
                box.children(".divideBox").each(function(i){
                    var index   = i + 1;
                    if (n >= index) {
                        return true;
                    }

                    var divideBox   = $(this);
                    divideBox.children("ul.item").each(function(){
                        moveToItemsBox($(this));
                    });
                    divideBox.remove();
                });
            }

            box.data("divided", n);

            // 巾を調整する
            adjustColumnSize(box, n);

            // ローカルストレージに保存
            storeLayout();

            e.preventDefault();
        });
    }

    // 行コントローラー：行の削除
    $(d).on("click", ".removeRowButton", function(e) {
        var box = $(this).parents(".rowBox");

        if (box.siblings().length > 0) {
            var divideBoxes = box.children(".divideBox");
            var bgColor = divideBoxes.eq(0).css("background-color");
            divideBoxes.css({backgroundColor:"#FFEAEA"});

            if (confirm("行を削除します。\nよろしいですか？")) {
                var itemsBox    = $("#items_box");
                box.animate({opacity:0, height:0}, 1000, "easeOutBounce", function(){
                    $(this).find("ul.item").each(function(){
                        moveToItemsBox($(this));
                    }).end().remove();

                    // ローカルストレージに保存
                    storeLayout();
                });
            } else {
                divideBoxes.css("background-color", bgColor);
            }
        } else {
            alert("この行は削除できません。");
        }
        e.preventDefault();
    });

    // ページ繰り：ページ数を逐次更新する
    $(d).on("mousemove", "input[name='item_page']", function() {
        f.item_page_display.value   = this.value;
    });

    // ページ繰り：ページ数バーと商品リストを更新する
    $(d).on("change", "input[name='item_page_display']", function() {
        var sb  = f.categories;
        var ipp = f.items_per_page;
        if (!this.value) {
            this.value = 1;
        }
        f.item_page.value   = this.value;
        getItemList(sb.options[sb.selectedIndex].value, this.value, ipp.options[ipp.selectedIndex].value);
    });

    // ページ繰り：選択を変えたときだけ商品リストを更新する
    $(d).on((isIE ? "keyup mouseup" : "change"), "input[name='item_page']", function() {
        var sb  = f.categories;
        var ipp = f.items_per_page;
        if (!this.value) {
            this.value  = 1;
        }
        getItemList(sb.options[sb.selectedIndex].value, this.value, ipp.options[ipp.selectedIndex].value);
    });

    // ページ繰り：表示件数
    $(d).on("change", "select[name='items_per_page']", function() {
        var sb  = f.categories;
        var ipp = this;
        f.item_page.value   = 1;
        getItemList(sb.options[sb.selectedIndex].value, 1, ipp.options[ipp.selectedIndex].value);
    });

    // ボタン
    $(d).on("click", ".quitButton",    function(e) {setModeAndPost("quit");    e.preventDefault();});
    $(d).on("click", ".previewButton", function(e) {setModeAndPost("preview"); e.preventDefault();});
    $(d).on("click", ".saveButton",    function(e) {setModeAndPost("save");    e.preventDefault();});

    // Initialize (called on ready)
    _this.init  = function(defaultLayout, defaultCampaignID) {

        // 復元するレイアウトの決定
        var storedLayout    = getStoredLayout();
        var layout          = storedLayout ? storedLayout : defaultLayout;
        defaultLayoutInit   = $.isArray(layout.rows) || $.isArray(layout.parts);

        if (defaultLayoutInit) {
            // パーツ等がある場合はオーバーレイ起動
            displayOverlay(loadOverlayClass);
        }

        // クラスで使うキャンペーンIDを設定する
        this_campaign_id    = defaultCampaignID;

        // レイアウトボックス 初期化
        var itemsBox    = $("#items_box");
        var layoutBox   = $("#layout_box");

        sortableSetting = {
            connectWith: "#items_box, #layout_box .divideBox, #partsBox",
            receive: function(e, ui) {

                // レイアウトボックスに落としたとき
                if (!ui.item.children().hasClass("buttonX")) {
                    var x   = getXButton();
                    var targetBox   = $(e.target);
                    ui.item.append(x).appendTo(targetBox);
                }

                // 行を増やす
                var parentBox   = $(e.target).parent();
                if (parentBox.is(":last-of-type")) {
                    getRowBox().appendTo(layoutBox);
                }

                parentBox.children(".divideBox").tile();

                // ローカルストレージに保存
                storeLayout();
            },
            start: function(e, ui) {
                $(".ui-sortable").sortable("disable");
            },
            stop: function(e, ui) {
                $(".ui-sortable").sortable("enable");
            },
            over: function(e, ui) {
                $(e.target).addClass("active");
            },
            out: function(e, ui) {
                $(e.target).removeClass("active");
            },
            cancel:".buttonX,.controller,.inputArea",
            revert:"invalid",
            containment:"#" + editpage_id,
            helper:"clone",
            cursor:"move",
            placeholder:"placeholder"
        };

        if (!$.isArray(layout.rows)) {

            // 最初の行を入れる
            getRowBox().appendTo(layoutBox);

        } else {

            // 復元する
            for (var i in layout.rows) {

                var row     = layout.rows[i];
                var rowBox  = getRowBox();
                var column_n= row.length;

                var widths  = new Array();
                var items   = new Array();

                for (var j in row) {

                    var column = row[j];
                    items[j]    = new Array();

                    for (var key in column) {

                        var v  = column[key];

                        switch (key) {
                            case "width":
                                // 列巾
                                widths.push(parseInt(v));
                                break;

                            default:
                                // アイテム
                                items[j].push(v);
                        }
                    }
                }

                // 列数を保存
                rowBox.appendTo(layoutBox).data("divided", column_n);

                // 列を作成し、サイズを調整する
                if (column_n > 1) {
                    increaseColumn(rowBox, 1, column_n, widths);
                }
                adjustColumnSize(rowBox, column_n, widths);

                // 各列に商品データを挿入する
                rowBox.children(".divideBox").each(function(j){
                    for (var k in items[j]) {
                        addItem(this, items[j][k]);
                    }
                });
            }
        }

        // 商品ボックスに落としたとき
        itemsBox.sortable({
            connectWith:"#layout_box .divideBox, #partsBox",
            receive: function(e, ui) {
                ui.item.removeAttr("style").children(".buttonX").remove();

                var senderNexts = ui.sender.nextAll();
                if (senderNexts.length === 1 && senderNexts.eq(0).hasClass("controller")) {
                    senderNexts.remove();
                }

                ui.sender.parent().children(".divideBox").tile();
                removeEmptyRows();

                // ローカルストレージに保存
                storeLayout();
            },
            start: function(e, ui) {
                $(".ui-sortable").sortable("disable");
            },
            stop: function(e, ui) {
                $(".ui-sortable").sortable("enable");
            },
            containment:"#" + editpage_id
        });

        // パーツボックス
        var partsBox    = $(d.createElement("div"));
        partsBox.attr({id:"partsBox"}).css({opacity:0.6, bottom:$("#footer").height()}).hover(
            function(){
                $(this).stop().delay(50).animate({opacity:1}, 250, "easeOutQuint");
            }, function(){
                $(this).stop().delay(50).animate({opacity:0.6}, 250, "easeOutQuint");
            }
        ).sortable({
            connectWith:"#partsBox .partsBoxInner, #layout_box .divideBox, #items_box",
            receive: function(e, ui) {

                ui.item.removeAttr("style");
                if (!ui.item.children().hasClass("buttonX")) {
                    var x   = getXButton();
                    ui.item.append(x).appendTo(ui.item);
                }

                removeEmptyRows();

                $(".plg_diycampaign-button-box").css({marginBottom:partsBox.height()});

                // ローカルストレージに保存
                storeLayout();
            },
            start: function(e, ui) {
                $(".ui-sortable").sortable("disable");
            },
            stop: function(e, ui) {
                $(".ui-sortable").sortable("enable");
            },
            containment:"#" + editpage_id
        }).appendTo("body");

        // パーツデータがあればパーツエリアに追加
        if ($.isArray(layout.parts)) {
            for (var i in layout.parts) {
                addItem(partsBox, layout.parts[i]);
            }
        }

        // 行ボックスを並び替え可能に
        layoutBox.sortable({
            containment:"#layout_box",
            revert:"invalid",
            helper:"clone",
            cursor:"move"
        });

        // １ページあたりの商品表示点数選択肢を初期化
        var ipp = f.items_per_page;
        for (var i in itemLimits) {
            var n   = itemLimits[i];
            var opt = d.createElement("option");
            opt.value       = n;
            opt.label       = n + "件";
            opt.innerHTML   = n + "件";
            ipp.appendChild(opt);
        }

        // すべての商品を表示する。
        var displayAllItemsWait = setInterval(function() {
            if (layoutReady) {
                $("select[name='categories'] > option[value=0]").prop("selected", "selected");
                getItemList(0, f.item_page.value, ipp.options[ipp.selectedIndex].value);
                clearInterval(displayAllItemsWait);
            }
        }, 1);

        // ボタンボックスの下のマージンを調整
        $(".plg_diycampaign-button-box").css({marginBottom:partsBox.height()});

        // 商品ボックスを追尾式にする
        $(w).on("scroll resize orientationchange", function(){
            var designBox   = $(".design");
            var itemBox     = designBox.children(".items");
            var lh  = layoutBox.height();
            var ih  = itemBox.height();
            if (ih < lh) {
                var scTop   = d.body.scrollTop || $("html").scrollTop();
                var lBox    = $(".layout");
                var lBoxPos = lBox.position();
                var topPos  = scTop - lBoxPos.top;
                var maxPos  = lBox.height() - ih;
                itemBox.stop().animate({top:(topPos < 0 ? 0 : (topPos < maxPos ? topPos : maxPos))}, 1000, "easeOutQuint");
            } else if (itemBox.css("top") != "0") {
                itemBox.stop().animate({top:0}, 1000, "easeOutQuint");
            }
        });

        // カテゴリー選択プルダウン
        $(f.categories).on("change", function() {
            f.item_page.value           = 1;
            f.item_page_display.value   = 1;
            var ipp = f.items_per_page;
            getItemList(this.options[this.selectedIndex].value, f.item_page.value, ipp.options[ipp.selectedIndex].value);
        });

        getItemsByIds(initProductIDs);
    }

    // ボタンを押したときの挙動
    function setModeAndPost(mode) {

        // オーバーレイ
        displayOverlay(loadOverlayClass);

        f.mode.value    = mode;

        switch (mode) {
            case "preview":
                f.layout_json.value = getJSONLayoutData();

                var fd  = new FormData(f);
                $.ajax({
                     method: "POST"
                    ,data: fd
                    ,dataType: "json"
                    ,timeout: timeoutLimit
                    ,processData: false
                    ,contentType: false
                    ,success: function(data){
                        if (data.error != true) {
                            // 別タブに開く
                            var url = data.baseurl + "?campaign_id=" + data.campaign_id + "&key=" + data.key;
                            var w   = window.open("about:blank");
                            w.location.href = url;
                        } else {
                            // エラーメッセージ
                            alert(data.message);
                        }
                        return false;
                    }
                    ,error: function() {
                        alert("プレビューの準備中にエラーが発生しました。");
                    }
                })
                .done(function() {
                    f.layout_json.value = "";
                    removeOverlay();
                });
                return false;

            case "quit":
            case "save":
                if (mode == "save") {
                    f.layout_json.value = getJSONLayoutData();
                }
                clearStoredLayout();
                break;

            default:
        }
        f.submit();
    }

    // 商品リストを取得する
    function getItemList(category_id, page, n) {
        var layoutBox   = $("#layout_box");
        var partsBox    = $("#partsBox");
        var itemBox     = $("#items_box");
        itemBox.empty();

        f.mode.value    = "get_items";
        f.categories.disabled           = true;
        f.item_page.disabled            = true;
        f.item_page_display.disabled    = true;
        f.items_per_page.disabled       = true;

        var fd  = new FormData(f);
        fd.append("category_id", category_id);
        fd.append("page"       , page);
        fd.append("n"          , n);
        $.ajax({
             method: "POST"
            ,data: fd
            ,dataType: "json"
            ,timeout: timeoutLimit
            ,processData: false
            ,contentType: false
            ,success: function(data) {
                var items  = data.items;

                // アイテム数表示を更新
                var ipp = f.items_per_page;
                var max_page    = Math.ceil(data.count / ipp.options[ipp.selectedIndex].value);
                f.item_page.max         = max_page;
                f.item_page_display.max = max_page;
                d.getElementById("max_item_number").innerHTML  = data.count;

                // すでに使用されている商品IDを取得する
                var productIDs  = new Array();
                layoutBox.find(".item").not(".userInput").each(function(){
                    productIDs.push($(this).data("productID"));
                });
                partsBox.children(".item").not(".userInput").each(function(){
                    productIDs.push($(this).data("productID"));
                });

                // すでに使用されている商品IDをフィルタリングする
                for (var i in items) {
                    var item    = items[i];
                    if ($.inArray(parseInt(item.id), productIDs) === -1) {
                        addItem(itemBox, item, true);
                    }
                }

                itemBox.sortable({
                    revert:"invalid",
                    containment:"#" + editpage_id,
                    helper:"clone",
                    cursor:"move"
                });
            }
            ,error: function() {
                alert("商品の一覧を取得する際にエラーが発生しました。");
            }
        }).done(function(){
            f.categories.disabled           = false;
            f.item_page.disabled            = false;
            f.item_page_display.disabled    = false;
            f.items_per_page.disabled       = false;

            if (defaultLayoutInit) {
                layoutBox.children(".rowBox").each(function(){
                    $(this).children(".divideBox").tile();
                });
                removeOverlay();
                defaultLayoutInit   = false;
            }
        });
    }

    // 商品IDでデータを取得する *increateItem(__itemID__) が実行済みであること！
    function getItemsByIds(productIDs) {
        if (!$.isArray(productIDs)) {
            return [];
        }

        f.mode.value    = "get_items_by_ids";

        var fd  = new FormData(f);
        fd.append("product_ids", productIDs.join(","));
        $.ajax({
             method: "POST"
            ,data: fd
            ,dataType: "json"
            ,timeout: timeoutLimit
            ,processData: false
            ,contentType: false
            ,success: function(data) {
                for (var i in data.items) {
                    addItem(undefined, data.items[i]);
                }
            }
            ,error: function() {
                alert("レイアウト済み商品のデータ取得に失敗しました。");
            }
        }).done(function() {
            layoutReady = true;
        });
    }

    // 商品を増やす
    function addItem(parentBox, content, add) {

        var item    = {
             id   : 0
            ,name : ""
            ,code : ""
            ,image: undefined
        };
        var escape_flag = "";

        if (itemIDRegexp.test(content)) {
            // 商品ID
            var item_id = parseInt(RegExp.$1);
            if ($.inArray(item_id, initProductIDs) >= 0) {
                // レイアウトやパーツと競合するIDは読み込まない
                return;
            }
            item.id = item_id;
            initProductIDs.push(item_id);
        } else if (typeof content === "object") {
            // 商品データ
            item    = content;
        } else if (typeof content === "string") {
            // 入力データ

            // %% でデータが区切られている
            var inputData   = content.split(/%%/);
            item.name   = inputData[0];
            escape_flag = inputData[1];
        } else {
            alert("不明な商品が検出されました。");
            return false;
        }

        var itemID  = item_id_prefix + item.id;
        var ul      = document.getElementById(itemID);
        var itemIsNull  = ul == null;
        var addInput    = item.id === 0;
        if (add || itemIsNull) {
            if (!parentBox) {
                alert("addItem: 親ボックスを指定してください。");
            }

            ul  = $(d.createElement("ul")).addClass("item").data({
                 "productID": item.id ? parseInt(item.id) : ""
                , escaped   : escape_flag == "true"
            }).appendTo(parentBox);

            if (itemIsNull && !addInput) {
                // 商品の場合
                ul.prop({id:itemID});
            } else if (addInput) {
                // 商品でない場合
                ul.addClass("userInput");
                $(d.createElement("li")).html(item.name).addClass("last").appendTo(ul);
            }
        }

        if (add || !itemIsNull) {
            // 商品画像
            $(d.createElement("li")).append($(d.createElement("img")).prop(item.image)).appendTo(ul);

            // 商品コード
            $(d.createElement("li")).html(item.code).appendTo(ul);

            // 商品名
            $(d.createElement("li")).html(item.name).addClass("last").appendTo(ul);
        }

        if (add || addInput || !itemIsNull) {
            getXButton().appendTo(ul);
        }
    }

    // 行ボックスに入れるものを返す
    function getRowBox() {
        var html_start  = '<div class="rowBox ui-sortable-handle"><div class="controller"><div class="columnBox">';
        var html_finish = '</div><div class="addRowBeforeButton"></div><div class="removeRowButton"></div></div><!-- controller end --><div class="divideBox"></div></div>';

        var html    = ""
        for (var i = 0; i < rowSetting.length; i++) {
            html   += '<a href="?" class="divideColumnButton button' + rowSetting[i] + '">' + rowSetting[i] + '</a>';
        }
        html    = $(html_start + html + html_finish).data("divided", 1);

        // divideBoxをsortableに
        html.find(".divideBox").sortable(sortableSetting);

        return html;
    }

    // xボタンを返す
    function getXButton() {
        return $(d.createElement("li")).addClass("buttonX");
    }

    // レイアウトボックス中の商品が商品リストに戻るときの挙動
    function moveToItemsBox(item) {
        var itemsBox    = $("#items_box");
        var rowBox      = $(this).parents(".rowBox");
        return item.css({display:"block"}).animate({opacity:0, height:0}, 500, "easeOutQuint", function() {
            $(this).appendTo(itemsBox).removeAttr("style").children("li.buttonX").remove();
            rowBox.children(".divideBox").tile();
            removeEmptyRows();
        });
    }

    // 列を追加する
    function increaseColumn(box, divided_n, n, widths) {
        var divideBox   = $('<div class="divideBox"></div>');
        for (var i = 0; i < n - divided_n; i++) {
            var div = divideBox.clone(false);
            div.sortable(sortableSetting);
            div.appendTo(box);
        }
    }

    // 列巾を調整する
    function adjustColumnSize(box, n, widths) {
        var divideBoxes = box.children(".divideBox");
        var separator   = $('<div class="separator"></div>');
        var separatorSetting    = {
            cursor:"col-resize",
            axis:"x",
            containment:".rowBox",
            grid:[10, 0],
            create:function(e, ui){
                var posLeft = $(e.target).position().left
                $(e.target).data("left", posLeft);
            },
            drag:function(e, ui){
                var bar     = $(e.target);
                var posLeft = ui.position.left;
                displaySeparatorDistance(bar, posLeft);
            },
            stop:function(e, ui){
                var bar     = $(e.target);
                var posLeft = ui.position.left;
                var rowBox  = bar.parent();

                // 左のセパレータからの距離を表示
                displaySeparatorDistance(bar, posLeft);

                // 位置を保存
                bar.data("left", posLeft);
                rowBox.recalculateColumnWidth();
            }
        };

        if (!widths) {
            var w   = box.width();
            var w_base  = Math.floor(w/n);
            divideBoxes.filter(":not(:last-of-type)").each(function(i){
                separator.clone(false).css({left:w_base*(i+1)}).insertAfter(this).draggable(separatorSetting);
                $(this).css({width:w_base});
            });
            divideBoxes.filter(":last-of-type").css({width:w_base+w%n});
        } else {
            var w   =   0;
            divideBoxes.each(function(i) {
                w  += widths[i];
                if (!$(this).is(":last-of-type")) {
                    separator.clone(false).css({left:w}).insertAfter(this).draggable(separatorSetting);
                }
                $(this).width(widths[i]);
            });
        }
        divideBoxes.tile();
    }

    // 列セパレータの左からの距離をパーセンテージで表示する
    function displaySeparatorDistance(bar, posLeft) {
        var separators  = bar.siblings(".separator");
        var w       = bar.parent().width();
        var prev_w  = 0;
        if (separators.length > 0) {
            var widths  = new Array();
            separators.each(function(){
                var separator   = $(this);
                var width   = parseInt(separator.data("left"));
                if (width < posLeft) {
                    widths.push(width);
                }
            });

            if (widths.length > 0) {
                widths.sort();
                prev_w  = widths[widths.length-1];
            }
        }
        var distance= (posLeft - prev_w) / w * 100;
        $('<span class="bar-position"></span>').text(Math.round(distance)+"%").appendTo(bar).fadeOut(2500, function(){$(this).remove();});
    }

    // 使われていない行を削除する
    function removeEmptyRows() {
        $("#layout_box > div.rowBox").each(function(){
            var box = $(this);
            if (box.siblings(".rowBox").length > 0 && box.find("ul.item").length === 0) {
                box.remove();
            }
        });
    }

    // オーバーレイ表示
    function displayOverlay(additionalClass) {
        if (typeof additionalClass !== "string") {
            additionalClass = "diycOverlay";
        }
        if (d.getElementById(overlay_id) == null) {
            $(d.createElement("div")).attr({id:overlay_id}).addClass(additionalClass).appendTo("body").animate({opacity:0.6});
        }
    }

    // オーバーレイ削除
    function removeOverlay() {
        if (d.getElementById(overlay_id) != null) {
            $("#" + overlay_id).fadeOut(function(){$(this).remove();});
        }
    }

    // 確認してからオーバーレイ削除
    function removeOverlayWithConfirm(e) {
        var ol  = $("#" + overlay_id);
        if (ol.is(":visible")) {
            if (
                ol.hasClass(inputAreaOverlayClass) && confirm("入力欄を閉じます。\nよろしいですか？")
            ) {
                closeInputArea(e);
            }
            e.preventDefault();
        }
    }

    // 入力欄を消す
    function closeInputArea(e) {
        removeOverlay();
        $("#" + input_area_id).fadeOut(function(){$(this).remove();});
        $("#" + input_selector_id).fadeOut(function(){$(this).remove();});
        e.preventDefault();

        // ローカルストレージに保存
        storeLayout();
    }

    function nl2br(text) {
        return text.replace(/\n/g, "<br />");
    }

    // レイアウトデータを取りまとめて返す
    function getJSONLayoutData() {
        var layoutBox   = $("#layout_box");
        var layoutData  = {rows:[]};

        // 行データ
        layoutBox.find(".rowBox").each(function(i){

            var rowBox  = $(this);
            layoutData.rows[i]  = new Array();

            rowBox.children(".divideBox").each(function(j){

                var columnBox   = $(this);
                var columnData  = {width:columnBox.width()};

                columnBox.children(".item").each(function(k){

                    var item    = $(this);

                    if (!item.hasClass("userInput")) {
                        // 商品データ
                        var product_id  = item.data("productID");
                        product_id      = (product_id ? product_id : "0");
                        columnData[k]   = "__" + product_id + "__";
                    } else {
                        // 入力データ
                        var escaped = item.data("escaped");
                        escaped     = escaped ? escaped : "";
                        columnData[k]   = item.children("li.last").html() + "%%" + escaped;
                    }
                });

                layoutData.rows[i][j]   = columnData;
            });
        });

        // パーツデータ
        layoutData.parts    = new Array();
        $("#partsBox").find(".item").each(function(i){

            var item    = $(this);

            if (!item.hasClass("userInput")) {
                // 商品データ
                var product_id  = item.data("productID");
                product_id      = (product_id ? product_id : "0");
                layoutData.parts[i] = "__" + product_id + "__";
            } else {
                // 入力データ
                var escaped = item.data("escaped");
                escaped     = escaped ? escaped : "";
                layoutData.parts[i] = item.children("li.last").html()+ "%%" + escaped;
            }
        });

        return JSON.stringify(layoutData);
    }

    // ローカルストレージからレイアウト情報を取得する
    function getStoredLayout() {
        return JSON.parse(localStorage.getItem("layout" + this_campaign_id));
    }

    // ローカルストレージにレイアウト情報を保存する
    function storeLayout() {
        return localStorage.setItem("layout" + this_campaign_id, getJSONLayoutData());
    }

    // ローカルストレージのレイアウト情報を削除する
    function clearStoredLayout() {
        return localStorage.removeItem("layout" + this_campaign_id);
    }

    function htmlSpecialChars(t) {
        t  = t.replace(/&/g, "&amp;");
        t  = t.replace(/"/g, "&quot;");//"
        t  = t.replace(/'/g, "&#039;");//'
        t  = t.replace(/</g, "&lt;");
        t  = t.replace(/>/g, "&gt;");
        return t;
    }

    function htmlSpecialCharsReverse(t) {
        t  = t.replace(/&amp;/g, "&");
        t  = t.replace(/&quot;/g, "\"");
        t  = t.replace(/&#039;/g, "'");
        t  = t.replace(/&lt;/g, "<");
        t  = t.replace(/&gt;/g, ">");
        return t;
    }

    /*
     *  一覧ページ
     */

    // 公開設定を編集する。
    $(d).on("change", "input[name^='hidden_flg_']", changeHiddenFlg);
    function changeHiddenFlg(e) {
        var t   = e.target;
        var radios  = $("input[name='" + t.name + "']");
        radios.attr("disabled", "disabled");

        f.campaign_id.value = t.name.replace("hidden_flg_", "");
        f.hidden_flg.value  = t.value;
        f.mode.value        = "hidden_flg";

        var fd  = new FormData(f);
        $.ajax({
             method: "POST"
            ,data: fd
            ,processData: false
            ,contentType: false
            ,dataType: "json"
            ,timeout: timeoutLimit
            ,success: function(data) {
                alert(data.message);
            }
            ,error: function() {
                alert("公開設定を変更する際にエラーが発生しました。");
            }
        }).done(function() {
            radios.removeAttr("disabled");
        });
    }

    // キャンペーンを削除する
    $(d).on("click", "a[name^='delete_campaign_']", deleteCampaign);
    function deleteCampaign(e) {
        var t   = e.target;
        var campaign_id     = t.name.replace("delete_campaign_", "");
        var campaign_name   = t.title.replace("の削除", "");

        if (confirm((campaign_name ? campaign_name : "キャンペーン") + "を削除します。\nよろしいですか？")) {
            // 操作不能にする
            var row = $("#campaign_id" + campaign_id).attr("disabled", "disabled");
            row.find("a").removeAttr("href");
            row.find("input").attr("disabled", "disabled");

            f.campaign_id.value = campaign_id;
            f.hidden_flg.value  = "";
            f.mode.value        = "delete";

            var fd  = new FormData(f);
            $.ajax({
                 method: "POST"
                ,data: fd
                ,processData: false
                ,contentType: false
                ,dataType: "json"
                ,timeout: timeoutLimit
                ,success: function(data) {
                    if (data.error == false) {
                        row.fadeOut(1000, "easeInCubic", function(){$(this).remove();});
                    } else {
                        alert(data.message);
                    }
                }
                ,error: function() {
                    alert("キャンペーンを削除する際にエラーが発生しました。");
                }
            });
        }
        e.preventDefault();
    }

    return _this;

})(window, document, jQuery);