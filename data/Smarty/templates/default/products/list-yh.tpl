<!--{*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2014 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *}-->

<!--{assign var=meta_title value= 'サイト名'.' - Yahoo!買い物ナビゲーター'}-->
<!--{assign var=meta_keywords value= ' モバイルルーター,Wi-Fi,価格,比較,ランキング'}-->
<!--{*//当ページのキーワードを半角カンマ区切りで3個以上～5個以内で記述する。半角カンマの前後は半角スペースを入れてはいけない。*}-->
<!--{assign var=meta_description value= 'Yahoo!買い物ナビゲーターの格安モバイルルーター価格ランキングなら、お得なモバイルルータが一目で分かる！月額料金、2年総額、月間データ量などの項目から、自分にぴったりのルーターをお探しください。'}-->
<!--{*//当ページの概要分を約110文字で記述する。*}-->
<!--{assign var=link_canonical value= 'http://kainavi.yahoo-net.jp/'}-->
<!--{*//基本的に当ページのURLを記述する*}-->
<!--{assign var=link_alternate value= ''}-->
<!--{*//基本的に対応するSPサイトのURLを記述する*}-->





<script type="text/javascript">//<![CDATA[


//]]></script>
<script type="text/javascript">//<![CDATA[
    var orderby;
    var multiSelNameArr = ['filter_maker_id','filter_device_id'];    // 複数選択セレクトボックスのID
    var notUpdateHiddenArr = ['mode','orderby'];    // submit時に更新しないhiddenのname

    $(function(){
        orderby = $('#search_navi_top input#orderby').val();

        // 遷移時の条件で「比較する条件を変更する」箇所までスクロールし、条件選択を開く
        if($('#form_filter input[name=mode]').val() == 'filter'){
            $("html,body").animate({scrollTop:$('#tabsbox').offset().top});
            if($('#form_filter input').length > 1){
                $('.sort-filter-btn').hide();
                $('.sort-filter').fadeIn();
            }
        }

        // ゴミ箱ボタン押下処理
        $('.clear-sort').on('click',function(){

            fnFilterClear($(this).parent().find('select').attr('id'));
            //$(this).parent().removeClass("on");
        });
        // submit
        $('.arrow-down').on('click',function(){
            formSubmit();
        });
        // ソートタブ切り替え
        $('.sort-tabs li a').on('click',function(){
            tabChange($(this).parent());
        });
    });

    function tabChange(obj){
        $("#search_navi_top").find('#orderby').val(obj.attr('id'));
        formSubmit();
    }

    function formSubmit(){
        var searchNavi = $("#search_navi_top");
        searchNavi.find('input').each(function(){
            if($.inArray($(this).attr('name'), notUpdateHiddenArr) == -1){
                $(this).remove();
            }
        });
        selectArr = $('.sort-filter').find('select');
        selectArr.each(function(){
            if($.inArray($(this).attr('name'), multiSelNameArr) == -1){
                if($(this).val() != 0){
                    searchNavi.append($('<input type="hidden" />').attr("name", $(this).attr('name')).val($(this).val()));
                }
            }else{
                if($(this).val() && ($(this).val().length != $(this).find('option').length)){
                    cName = $(this).attr('name');
                    $.each($(this).val(),function(key,val){
                        searchNavi.append($('<input type="hidden" />').attr("name", cName+'[]').val(val));
                    });
                }
            }
        });
        searchNavi.submit();
    }

    // 絞り込設定をクリア(選択の解除のみ)
    function fnFilterClear(deletefilters) {
        $('#'+deletefilters)
        $('#'+deletefilters).multipleSelect("uncheckAll");
        if($.inArray(deletefilters, multiSelNameArr) == -1){
            $('#'+deletefilters).multipleSelect('setSelects', [0]);
        }
    }


    // 絞り込をリセット
    function fnFilterReset(orderby) {
        var searchForm = $("#form1");
        var cartForm = $("#search_navi_top");
        // 検索条件を引き継ぐ
        var hiddenValues = ['orderby'];
        $.each(hiddenValues, function(){
            // 商品別のフォームに検索条件の値があれば上書き
            cartForm.append($('<input type="hidden" />').attr("name", this).val(orderby));
        });
        // 商品別のフォームを送信
        cartForm.submit();
    }

//]]></script>
<!--{include file=products/yhindex.tpl}-->
