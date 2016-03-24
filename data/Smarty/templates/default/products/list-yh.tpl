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
<!--{assign var=meta_description value= ''}-->
<!--{*//当ページの概要分を約110文字で記述する。*}-->
<!--{assign var=link_canonical value= 'http://kainavi.yahoo-net.jp/'}-->
<!--{*//基本的に当ページのURLを記述する*}-->
<!--{assign var=link_alternate value= 'Yahoo!買い物ナビゲーターの格安モバイルルーター価格ランキングなら、お得なモバイルルータが一目で分かる！月額料金、2年総額、月間データ量などの項目から、自分にぴったりのルーターをお探しください。'}-->
<!--{*//基本的に対応するSPサイトのURLを記述する*}-->





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
<script type="text/javascript">//<![CDATA[
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
    // 絞り込をリセット
    function fnFilterDelete(deletefilters,orderby) {
        var searchForm = $("#form1");
        // 検索条件を引き継ぐ
        var hiddenValues = deletefilters;
        $.each(hiddenValues, function(){
            // 商品別のフォームに検索条件の値があれば上書き
            if (searchForm.has('input[name='+this+']').length != 0) {
                searchForm.find('input[name='+this+']').val('');
            }
            // なければ追加
            else {
                searchForm.append($('<input type="hidden" />').attr("name", this).val(''));
            }
        });
        // 商品別のフォームを送信
        searchForm.submit();        
    }
//]]></script>
<!--{include file=products/yhindex.tpl}-->
