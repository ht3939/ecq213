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
    function fnSetClassCategoriesimage(form) {
        var $form = $(form);
        var $image_dynamic = $form.find('.plg_change_image_new');
        //初期、変更先の画像は隠しておく。
        $image_dynamic.hide();

        //ここにエラー用に初期処理を
        fnSetClassCategoriesimage_func(form, $image_dynamic);
        
        //規格１のセレクトボックスが変更されたら実行
        $('[name=classcategory_id1]').change(function() {
            fnSetClassCategoriesimage_func(form, $image_dynamic);
        });

        //規格２のセレクトボックスが変更されたら実行
        $('[name=classcategory_id2]').change(function() {
            fnSetClassCategoriesimage_func(form, $image_dynamic);
        }); 
    }

    //画像変更のファンクション
    function fnSetClassCategoriesimage_func(form, image_change) {
        // 初期処理
        var $form = $(form);
        var product_id = $form.find('input[name=product_id]').val();
        var $sele1 = $form.find('select[name=classcategory_id1]');
        var $sele2 = $form.find('select[name=classcategory_id2]');
        var $image_default = $form.find('.plg_change_image_base');
        var $image_dynamic = image_change
        var classcat_id1;
        var classcat_id2;
        var classcat999;
        var productsclass_propaty;

        // 選択されているvalue属性値を取り出す
        classcat_id1 = $sele1.val();
        classcat_id2 = $sele2.val();

        // 商品規格のプロパティ情報が取得出来ている場合のみ処理
        if (typeof productsClassCategories != 'undefined') {
            // 商品ID、商品規格に対応するオブジェクトを格納
            classcat999 = productsClassCategories[product_id][classcat_id1];
            // undefinedとなっていないオブジェクトのみ処理をする。
            if(typeof(classcat999) !== 'undefined') {
                // 規格２にて選択された値のプロパティのみ格納
                productsclass_propaty = classcat999["#" + classcat_id2];
                console.log(productsclass_propaty);
                // 選択された規格に関する商品画像データが格納されていた場合のみ処理
                if (productsclass_propaty && typeof productsclass_propaty.product_image_s !== 'undefined' && String(productsclass_propaty.product_image_s).length >= 1) {
                    if(productsclass_propaty.product_image_s) {
                        $image_dynamic.attr('src', '/upload/save_image/' + productsclass_propaty.product_image_s).show();
                        $image_default.hide();
                    } else {
                        $image_dynamic.hide();
                        $image_default.show();
                    }
                } else {
                    $image_dynamic.hide();
                    $image_default.show();
                }
            }
        }
    }
        
//]]></script>
<!-- end   NakwebProductsClassImageUpload -->

