<!--{*
 * NakwebProductsClassImageUpload
 * Copyright (C) 2015 NAKWEB CO.,LTD. All Rights Reserved.
 * http://www.nakweb.com/
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*}-->

<!-- start NakwebProductsClassImageUpload -->
<script type="text/javascript">//<![CDATA[
    function fnSetClassCategoriesimaged() {
        var $image_dynamic = $('[id^=plg_change_image_new]');
        var $base_url = $("#products_large_image1").attr('href');
        //初期、変更先の画像は隠しておく。
        $image_dynamic.hide();

        //ここにエラー戻り用に初期処理を
        fnSetClassCategoriesimage_func($image_dynamic, $base_url);
        
        //規格１のセレクトボックスが変更されたら実行
        $('[name=classcategory_id1]').change(function() {
            fnSetClassCategoriesimage_func($image_dynamic, $base_url);
        });

        //規格２のセレクトボックスが変更されたら実行
        $('[name=classcategory_id2]').change(function() {
            fnSetClassCategoriesimage_func($image_dynamic, $base_url);
        });
    }

    //画像変更のファンクション
    function fnSetClassCategoriesimage_func(image_change, base_image_url) {
        // 初期設定
        var product_id = $('input[name=product_id]').val();
        var $sele1 = $('select[name=classcategory_id1]');
        var $sele2 = $('select[name=classcategory_id2]');
        var $image_default = $('[id^=plg_change_image_base]');
        var $image_dynamic = image_change;
        var $change_link1 = $('[id^=products_large_image1]');
        var $change_link2 = $('[id^=products_large_image2]');
        var $base_url = base_image_url;
        var classcat_id1;
        var classcat_id2;
        var classcat999;
        var productsclass_propaty;

        // 選択されているvalue属性値を取り出す
        classcat_id1 = $sele1.val();
        classcat_id2 = $sele2.val();

        // 商品規格のプロパティ情報が取得出来ている場合のみ処理
        if (typeof classCategories != 'undefined') {
            // 商品IDに対応するオブジェクトを格納
            classcat999 = classCategories[classcat_id1];
            // undefinedとなっていないオブジェクトのみ処理
            if(typeof(classcat999) !== 'undefined') {
                // 規格２にて選択された値のプロパティのみ格納
                productsclass_propaty = classcat999["#" + classcat_id2];
                // 選択された規格に関する商品画像データが格納されていた場合のみ処理
                if (productsclass_propaty && typeof productsclass_propaty.product_image_m !== 'undefined' && String(productsclass_propaty.product_image_m).length >= 1) {
                    if(productsclass_propaty.product_image_m) {
                        $image_dynamic.attr('src', '/upload/save_image/' + productsclass_propaty.product_image_m).show();
                        $change_link1.attr('href', '/upload/save_image/' + productsclass_propaty.product_image_l);
                        $change_link2.attr('href', '/upload/save_image/' + productsclass_propaty.product_image_l);
                        $image_default.hide();
                        
                    } else {
                        $image_dynamic.hide();
                        $change_link1.attr('href', $base_url);
                        $change_link2.attr('href', $base_url);
                        $image_default.show();
                    }
                } else {
                    $image_dynamic.hide();
                        $change_link1.attr('href', $base_url);
                        $change_link2.attr('href', $base_url);
                    $image_default.show();
                }
            }
        }
    }
        
//]]></script>
<!-- end   NakwebProductsClassImageUpload -->

