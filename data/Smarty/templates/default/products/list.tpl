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

<script type="text/javascript">//<![CDATA[
    function fnSetClassCategories(form, classcat_id2_selected) {
        var $form = $(form);
        var product_id = $form.find('input[name=product_id]').val();
        var $sele1 = $form.find('select[name=classcategory_id1]');
        var $sele2 = $form.find('select[name=classcategory_id2]');
        eccube.setClassCategories($form, product_id, $sele1, $sele2, classcat_id2_selected);
    }
    // 並び順を変更
    function fnChangeOrderby(orderby) {
        eccube.setValue('orderby', orderby);
        eccube.setValue('pageno', 1);
        eccube.submitForm();
    }
    // 表示件数を変更
    function fnChangeDispNumber(dispNumber) {
        eccube.setValue('disp_number', dispNumber);
        eccube.setValue('pageno', 1);
        eccube.submitForm();
    }
    // カゴに入れる
    function fnInCart(productForm) {
        var searchForm = $("#form1");
        var cartForm = $(productForm);
        // 検索条件を引き継ぐ
        var hiddenValues = ['mode','category_id','maker_id','name','orderby','disp_number','pageno','rnd'];
        $.each(hiddenValues, function(){
            // 商品別のフォームに検索条件の値があれば上書き
            if (cartForm.has('input[name='+this+']').length != 0) {
                cartForm.find('input[name='+this+']').val(searchForm.find('input[name='+this+']').val());
            }
            // なければ追加
            else {
                cartForm.append($('<input type="hidden" />').attr("name", this).val(searchForm.find('input[name='+this+']').val()));
            }
        });
        // 商品別のフォームを送信
        cartForm.submit();
    }
//]]></script>

<div id="undercolumn">
    <form name="form1" id="form1" method="get" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="<!--{$mode|h}-->" />
        <!--{* ▼検索条件 *}-->
        <input type="hidden" name="category_id" value="<!--{$arrSearchData.category_id|h}-->" />
        <input type="hidden" name="maker_id" value="<!--{$arrSearchData.maker_id|h}-->" />
        <input type="hidden" name="name" value="<!--{$arrSearchData.name|h}-->" />
        <!--{* ▲検索条件 *}-->
        <!--{* ▼ページナビ関連 *}-->
        <input type="hidden" name="orderby" value="<!--{$orderby|h}-->" />
        <input type="hidden" name="disp_number" value="<!--{$disp_number|h}-->" />
        <input type="hidden" name="pageno" value="<!--{$tpl_pageno|h}-->" />
        <!--{* ▲ページナビ関連 *}-->
        <input type="hidden" name="rnd" value="<!--{$tpl_rnd|h}-->" />
    </form>

    <div id="ranking">
        <div id="tabsbox" class="tabsbox">
            <!-- ソートタブ -->
            <div class="sort">
                <ul class="sort-tabs tabs-top">
                  <li><a href="#tab0" class="selected">月額料金が安い順</a></li>
                  <li><a href="#tab1">2年間のお支払い総額が安い順</a></li>
                  <li class="note-click">← タブをクリックで並び替え</li>
                </ul>
            </div>

            <div class="tabscont sort-contents">
                <div id="tab0">
                    <!-- フィルタータブ -->
                    <div class="filter">
                        <p><span>月間データ量の選択</span></p>
                        <ul class="filter-tabs">
                          <li><a href="#data0" class="selected filter-btn">5GB以上すべて</a></li>
                          <li><a href="#data1" class="filter-btn">5GB以上～8GB未満</a></li>
                          <li><a href="#data2" class="filter-btn">8GB以上～上限ナシ<span>※1</span></a></li>
                        </ul>
                    </div>
                    <div class="filter-contents">
                        <div id="data0" class="filter-tabs-contents">
                            <p class="search_num"><span><!--{$tpl_linemax}--></span>件中<span>1〜5</span>件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">表記の金額はすべて税抜価格となります。</span></p>
                            <table class="ranking_table-caption">
                                <tbody>
                                    <tr class="caption">
                                        <th class="rank-name">製品名</th>
                                        <th class="rank-price current">月額利用料</th>
                                        <th class="rank-data">月額データ量/<br />
                              下り最大速度</th>
                                        <th class="rank-conditions">条件・特記事項</th>
                                        <th class="rank-company">提供サービス元</th>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="ranking_table">
                                <tbody>
                                                                

                                <!--{foreach from=$arrProducts item=arrProduct name=arrProducts}-->

                                    <!--{if $smarty.foreach.arrProducts.first}-->
                                        <!--▼件数-->

                                        <!--▲件数-->

                                        <!--▼ページナビ(上部)-->
                                        <form name="page_navi_top" id="page_navi_top" action="?">
                                            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
                                            <!--{if $tpl_linemax > 0}--><!--{$smarty.capture.page_navi_body|smarty:nodefaults}--><!--{/if}-->
                                        </form>
                                        <!--▲ページナビ(上部)-->
                                    <!--{/if}-->

                                    <!--{assign var=id value=$arrProduct.product_id}-->
                                    <!--{assign var=arrErr value=$arrProduct.arrErr}-->
                                    <!--▼商品-->
                                    <form name="product_form<!--{$id|h}-->" action="?">
                                        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
                                        <input type="hidden" name="product_id" value="<!--{$id|h}-->" />
                                        <input type="hidden" name="product_class_id" id="product_class_id<!--{$id|h}-->" value="<!--{$tpl_product_class_id[$id]}-->" />

                                        <!-- 1位 -->
                                        <tr class="js-ranking-item">
                                            <td class="rank-name">
                                                <div class="td-inner">
                                                    <span class="rank"><!--{$smarty.foreach.arrProducts.index+1|h}--><span>位</span></span>
                                                    <div class="img">
                                                        <img src="/img/item/303hw.png" alt="Pocket Wi-Fi 303HW">
                                                    </div>
                                                    <div class="status">
                                                        <p class="name"><span>Huawei</span><!--{$arrProduct.name|h}--></p>
                                                        <p class="release">発売：<!--{$arrProduct.add_col2|h}--></p>
                                                        <p class="color">カラー：<span><i style="background-color: #333"></i><i style="background-color: #f03"></i></span></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="rank-price"><div class="td-inner w110"><span><!--{$arrProduct.price02_min_inctax|n2s}--></span>円</div></td>
                                            <td class="rank-data"><div class="td-inner w110"><span><span class="num"><!--{$arrProduct.plan_datasize_min|h|nl2br}--></span><span class="gb">GB</span></span>/月    <span class="speed">110Mbps</span></div></td>
                                            <td class="rank-conditions"><div class="td-inner w110"><!--{$arrProduct.main_list_comment|h|nl2br}--></div></td>
                                            <td class="rank-company">
                                            <div class="td-inner w110">
                                                <a href="http://wifi.yahoo.co.jp/" target="_blank"><!--{$arrProduct.maker_name|h|nl2br}--></a>
                                                <p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">商品を見る</a></p>
                                                <p class="note">(Yahoo! Wi-Fi)</p>
                                            </div>
                                            <!--★商品詳細を見る★-->
                                            <div class="detail_btn">
                                                <!--{assign var=name value="detail`$id`"}-->
                                                <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
                                                    <img class="hover_change_image" src="<!--{$TPL_URLPATH}-->img/button/btn_detail.jpg" alt="商品詳細を見る" name="<!--{$name}-->" id="<!--{$name}-->" />
                                                </a>
                                            </div>                
                                            </td>
                                        </tr>

                                    </form>
                                    <!--▲商品-->





                                <!--{foreachelse}-->
                                    <!--{include file="frontparts/search_zero.tpl"}-->
                                <!--{/foreach}-->





                                </tbody>
                            </table>
                            <p class="ranking-more js-ranking-more"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--★タイトル★-->
    <h2 class="title"><!--{$tpl_subtitle|h}--></h2>

    <!--▼検索条件-->
    <!--{if $tpl_subtitle == "検索結果"}-->
        <ul class="pagecond_area">
            <li><strong>商品カテゴリ：</strong><!--{$arrSearch.category|h}--></li>
        <!--{if $arrSearch.maker|strlen >= 1}--><li><strong>メーカー：</strong><!--{$arrSearch.maker|h}--></li><!--{/if}-->
            <li><strong>商品名：</strong><!--{$arrSearch.name|h}--></li>
        </ul>
    <!--{/if}-->
    <!--▲検索条件-->

    <!--▼ページナビ(本文)-->
    <!--{capture name=page_navi_body}-->
        <div class="pagenumber_area clearfix">
            <div class="change">
                <!--{if $orderby != 'price'}-->
                    <a href="javascript:fnChangeOrderby('price');">価格順</a>
                <!--{else}-->
                    <strong>価格順</strong>
                <!--{/if}-->&nbsp;
                <!--{if $orderby != "date"}-->
                        <a href="javascript:fnChangeOrderby('date');">新着順</a>
                <!--{else}-->
                    <strong>新着順</strong>
                <!--{/if}-->
                表示件数
                <select name="disp_number" onchange="javascript:fnChangeDispNumber(this.value);">
                    <!--{foreach from=$arrPRODUCTLISTMAX item="dispnum" key="num"}-->
                        <!--{if $num == $disp_number}-->
                            <option value="<!--{$num}-->" selected="selected" ><!--{$dispnum}--></option>
                        <!--{else}-->
                            <option value="<!--{$num}-->" ><!--{$dispnum}--></option>
                        <!--{/if}-->
                    <!--{/foreach}-->
                </select>
            </div>
            <div class="navi"><!--{$tpl_strnavi}--></div>
        </div>
    <!--{/capture}-->
    <!--▲ページナビ(本文)-->

    <!--{foreach from=$arrProducts item=arrProduct name=arrProducts}-->

        <!--{if $smarty.foreach.arrProducts.first}-->
            <!--▼件数-->
            <div>
                <span class="attention"><!--{$tpl_linemax}-->件</span>の商品がございます。
            </div>
            <!--▲件数-->

            <!--▼ページナビ(上部)-->
            <form name="page_navi_top" id="page_navi_top" action="?">
                <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
                <!--{if $tpl_linemax > 0}--><!--{$smarty.capture.page_navi_body|smarty:nodefaults}--><!--{/if}-->
            </form>
            <!--▲ページナビ(上部)-->
        <!--{/if}-->

        <!--{assign var=id value=$arrProduct.product_id}-->
        <!--{assign var=arrErr value=$arrProduct.arrErr}-->
        <!--▼商品-->
        <form name="product_form<!--{$id|h}-->" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="product_id" value="<!--{$id|h}-->" />
            <input type="hidden" name="product_class_id" id="product_class_id<!--{$id|h}-->" value="<!--{$tpl_product_class_id[$id]}-->" />
            <div class="list_area clearfix">
                <a name="product<!--{$id|h}-->"></a>
                <div class="listphoto">
                    <!--★画像★-->
                    <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
                        <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$arrProduct.main_list_image|sfNoImageMainList|h}-->" alt="<!--{$arrProduct.name|h}-->" class="picture" /></a>
                </div>

                <div class="listrightbloc">
                    <!--▼商品ステータス-->
                    <!--{if count($productStatus[$id]) > 0}-->
                        <ul class="status_icon clearfix">
                            <!--{foreach from=$productStatus[$id] item=status}-->
                                <li>
                                    <img src="<!--{$TPL_URLPATH}--><!--{$arrSTATUS_IMAGE[$status]}-->" width="60" height="17" alt="<!--{$arrSTATUS[$status]}-->"/>
                                </li>
                            <!--{/foreach}-->
                        </ul>
                    <!--{/if}-->
                    <!--▲商品ステータス-->

                    <!--★商品名★-->
                    <h3>
                        <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->"><!--{$arrProduct.name|h}--></a>
                    </h3>
                    <!--★価格★-->
                    <div class="pricebox sale_price">
                        <!--{$smarty.const.SALE_PRICE_TITLE}-->(税込)：
                        <span class="price">
                            <span id="price02_default_<!--{$id}-->"><!--{strip}-->
                                <!--{if $arrProduct.price02_min_inctax == $arrProduct.price02_max_inctax}-->
                                    <!--{$arrProduct.price02_min_inctax|n2s}-->
                                <!--{else}-->
                                    <!--{$arrProduct.price02_min_inctax|n2s}-->～<!--{$arrProduct.price02_max_inctax|n2s}-->
                                <!--{/if}-->
                            </span><span id="price02_dynamic_<!--{$id}-->"></span><!--{/strip}-->
                            円</span>
                    </div>

                    <!--★コメント★-->
                    <div class="listcomment"><!--{$arrProduct.main_list_comment|h|nl2br}--></div>
                    <!--★メーカー名★-->
                    <div class="listcomment"><!--{$arrProduct.maker_name|h|nl2br}--></div>
                    <!--★後払い金額★-->
                    <div class="listcomment"><!--{$arrProduct.next_price_min|h|nl2br}--></div>
                    <!--★データ量★-->
                    <div class="listcomment"><!--{$arrProduct.plan_datasize_min|h|nl2br}--></div>

                    <!--★商品詳細を見る★-->
                    <div class="detail_btn">
                        <!--{assign var=name value="detail`$id`"}-->
                        <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
                            <img class="hover_change_image" src="<!--{$TPL_URLPATH}-->img/button/btn_detail.jpg" alt="商品詳細を見る" name="<!--{$name}-->" id="<!--{$name}-->" />
                        </a>
                    </div>

                    <!--▼買い物カゴ-->
                    <div class="cart_area clearfix">
                        <!--{if $tpl_stock_find[$id]}-->
                            <!--{if $tpl_classcat_find1[$id]}-->
                                <div class="classlist">
                                    <dl class="size01 clearfix">
                                            <!--▼規格1-->
                                            <dt><!--{$tpl_class_name1[$id]|h}-->：</dt>
                                            <dd>
                                                <li name="classcategory_id1" style="<!--{$arrErr.classcategory_id1|sfGetErrorColor}-->">
                                                    <!--{html_radios name=classcategory_id1 options=$arrClassCat1[$id] selected=$arrProduct.classcategory_id1}-->
                                                </li>
                                                <!--{if $arrErr.classcategory_id1 != ""}-->
                                                    <p class="attention">※ <!--{$tpl_class_name1[$id]}-->を入力して下さい。</p>
                                                <!--{/if}-->
                                            </dd>
                                            <!--▲規格1-->
                                    </dl>
                                    <!--{if $tpl_classcat_find2[$id]}-->
                                        <dl class="size02 clearfix">
                                            <!--▼規格2-->
                                            <dt><!--{$tpl_class_name2[$id]|h}-->：</dt>
                                            <dd>
                                                <select name="classcategory_id2" style="<!--{$arrErr.classcategory_id2|sfGetErrorColor}-->">
                                                </select>
                                                <!--{if $arrErr.classcategory_id2 != ""}-->
                                                    <p class="attention">※ <!--{$tpl_class_name2[$id]}-->を入力して下さい。</p>
                                                <!--{/if}-->
                                            </dd>
                                            <!--▲規格2-->
                                        </dl>
                                    <!--{/if}-->
                                </div>
                            <!--{/if}-->
                            <div class="cartin clearfix">
                                <div class="quantity">
                                    数量：<input type="text" name="quantity" class="box" value="<!--{$arrProduct.quantity|default:1|h}-->" maxlength="<!--{$smarty.const.INT_LEN}-->" style="<!--{$arrErr.quantity|sfGetErrorColor}-->" />
                                    <!--{if $arrErr.quantity != ""}-->
                                        <br /><span class="attention"><!--{$arrErr.quantity}--></span>
                                    <!--{/if}-->
                                </div>
                                <div class="cartin_btn">
                                    <!--★カゴに入れる★-->
                                    <div id="cartbtn_default_<!--{$id}-->">
                                        <input type="image" id="cart<!--{$id}-->" src="<!--{$TPL_URLPATH}-->img/button/btn_cartin.jpg" alt="カゴに入れる" onclick="fnInCart(this.form); return false;" class="hover_change_image" />
                                    </div>
                                    <div class="attention" id="cartbtn_dynamic_<!--{$id}-->"></div>
                                </div>
                            </div>
                        <!--{else}-->
                            <div class="cartbtn attention">申し訳ございませんが、只今品切れ中です。</div>
                        <!--{/if}-->
                    </div>
                    <!--▲買い物カゴ-->
                </div>
            </div>
        </form>
        <!--▲商品-->

        <!--{if $smarty.foreach.arrProducts.last}-->
            <!--▼ページナビ(下部)-->
            <form name="page_navi_bottom" id="page_navi_bottom" action="?">
                <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
                <!--{if $tpl_linemax > 0}--><!--{$smarty.capture.page_navi_body|smarty:nodefaults}--><!--{/if}-->
            </form>
            <!--▲ページナビ(下部)-->
        <!--{/if}-->

    <!--{foreachelse}-->
        <!--{include file="frontparts/search_zero.tpl"}-->
    <!--{/foreach}-->


</div>



<div class="row-container is-reverse">
    <div class="main-column">
        <main>        </main>
    </div>
</div>
                              