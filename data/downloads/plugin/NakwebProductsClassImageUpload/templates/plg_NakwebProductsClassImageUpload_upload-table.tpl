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
<p><span class="bold"><span class="attention">画像をアップロード、または削除した際、必ず下部の｢確認ページへ｣から登録まで済ませてください。</span></span></p>
        <!--{assign var="version" value="."|explode:$smarty.const.ECCUBE_VERSION}-->
        <table class="NakwebProductsClassImageUpload">
            <col width="5%" />
            <col width="15%" />
            <col width="15%" />
            <col width="9%" />
            <col width="10%" />
            <col width="10%" />
            <col width="10%" />
            <col width="10%" />
            <col width="8%" />
            <col width="8%" />
            <tr>
                <th rowspan="2"><input type="checkbox" onclick="<!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.checkAllBox<!--{else}-->fnAllCheck<!--{/if}-->(this, 'input[name^=check]')" id="allCheck" /> <label for="allCheck"><br />登録</label></th>
                <th>規格1<br />(<!--{$arrClass[$class_id1]|default:"未選択"|h}-->)</th>
                <th>規格2<br />(<!--{$arrClass[$class_id2]|default:"未選択"|h}-->)</th>
                <th>商品コード</th>
                <th>在庫数<span class="attention">*</span></th>
                <th><!--{$smarty.const.NORMAL_PRICE_TITLE}-->(円)</th>
                <th><!--{$smarty.const.SALE_PRICE_TITLE}-->(円)<span class="attention">*</span></th>
                <!--{if $smarty.const.OPTION_PRODUCT_TAX_RULE}-->
                <th>消費税率(%)<span class="attention">*</span></th>
                <!--{/if}-->
                <th>商品種別<span class="attention">*</span></th>
                <th>ダウンロード<br />ファイル名<span class="red"><br />上限<!--{$smarty.const.STEXT_LEN}-->文字</span></th>
                <th>ダウンロード商品用<br />ファイル</th>
            </tr>
            <tr>
                <th colspan="<!--{if $smarty.const.OPTION_PRODUCT_TAX_RULE}-->3<!--{else}-->2<!--{/if}-->">一覧<br />メイン画像</th>
                <th colspan="3">詳細<br />メイン画像</th>
                <th colspan="3">詳細<br />拡大画像</th>
                <th colspan="1">規格商品画像<br />アップロード</th>
            </tr>
            <!--{section name=cnt loop=$arrForm.total.value}-->
                <!--{assign var=index value=$smarty.section.cnt.index}-->
                <tr>
                    <td rowspan="2" class="center">
                        <!--{assign var=key value="classcategory_id1"}-->
                        <input type="hidden" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" />
                        <!--{assign var=key value="classcategory_id2"}-->
                        <input type="hidden" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" />
                        <!--{assign var=key value="product_class_id"}-->
                        <input type="hidden" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" />
                        <!--{assign var=key value="check"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <input type="checkbox" name="<!--{$key}-->[<!--{$index}-->]" value="1" <!--{if $arrForm[$key].value[$index] == 1}-->checked="checked"<!--{/if}--> id="<!--{$key}-->_<!--{$index}-->" />
                    </td>
                    <td class="center">
                        <!--{assign var=key value="classcategory_name1"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <!--{$arrForm[$key].value[$index]|h}-->
                        <input type="hidden" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" />
                    </td>
                    <td class="center">
                        <!--{assign var=key value="classcategory_name2"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <!--{$arrForm[$key].value[$index]|h}-->
                        <input type="hidden" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" />
                    </td>
                    <td class="center">
                        <!--{assign var=key value="product_code"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <input type="text" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" size="6" class="box6" maxlength="<!--{$arrForm[$key].length}-->" <!--{if $arrErr[$key][$index] != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> id="<!--{$key}-->_<!--{$index}-->" />
                    </td>
                    <td class="center">
                        <!--{assign var=key value="stock"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <input type="text" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" size="6" class="box6" maxlength="<!--{$arrForm[$key].length}-->" <!--{if $arrErr[$key][$index] != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> id="<!--{$key}-->_<!--{$index}-->" />
                        <!--{assign var=key value="stock_unlimited"}--><br />
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <input type="checkbox" name="<!--{$key}-->[<!--{$index}-->]" value="1" <!--{if $arrForm[$key].value[$index] == "1"}-->checked="checked"<!--{/if}--> id="chk_<!--{$key}-->_<!--{$index}-->" /><label for="chk_<!--{$key}-->_<!--{$index}-->">無制限</label>
                    </td>
                    <td class="center">
                        <!--{assign var=key value="price01"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <input type="text" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" size="6" class="box6" maxlength="<!--{$arrForm[$key].length}-->" <!--{if $arrErr[$key][$index] != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> id="<!--{$key}-->_<!--{$index}-->" />
                    </td>
                    <td class="center">
                        <!--{assign var=key value="price02"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <input type="text" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" size="6" class="box6" maxlength="<!--{$arrForm[$key].length}-->" <!--{if $arrErr[$key][$index] != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> id="<!--{$key}-->_<!--{$index}-->" />
                    </td>
                    <!--{if $smarty.const.OPTION_PRODUCT_TAX_RULE}-->
                    <td class="center">
                        <!--{assign var=key value="tax_rate"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <input type="text" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" size="6" class="box6" maxlength="<!--{$arrForm[$key].length}-->" <!--{if $arrErr[$key][$index] != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> id="<!--{$key}-->_<!--{$index}-->" />
                    </td>
                    <!--{/if}-->
                    <td class="class-product-type">
                        <!--{assign var=key value="product_type_id"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <!--{foreach from=$arrProductType key=productTypeKey item=productType name=productType}-->
                            <input type="radio" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$productTypeKey}-->" <!--{if $arrForm[$key].value[$index] == $productTypeKey}-->checked="checked"<!--{/if}--> <!--{if $arrErr[$key][$index] != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> id="<!--{$key}-->_<!--{$index}-->_<!--{$smarty.foreach.productType.index}-->"><label for="<!--{$key}-->_<!--{$index}-->_<!--{$smarty.foreach.productType.index}-->"<!--{if $arrErr[$key][$index] != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> ><!--{$productType}--></label><!--{if !$smarty.foreach.productType.last}--><br /><!--{/if}-->
                        <!--{/foreach}-->
                    </td>
                    <td class="center">
                        <!--{assign var=key value="down_filename"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <input type="text" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{if $arrErr[$key][$index] != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}--><!--{/if}-->" size="10" id="<!--{$key}-->_<!--{$index}-->" />
                    </td>
                    <td>
                        <!--{assign var=key value="down_realfilename"}-->
                        <!--{if $arrErr[$key][$index]}-->
                            <span class="attention"><!--{$arrErr[$key][$index]}--></span>
                        <!--{/if}-->
                        <!--{if $arrForm[$key].value[$index] != ""}-->
                            <!--{$arrForm[$key].value[$index]|h}--><br />
                            <input type="hidden" name="<!--{$key}-->[<!--{$index}-->]" value="<!--{$arrForm[$key].value[$index]|h}-->" />
                            <a href="?" onclick="<!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.<!--{/if}-->fnFormModeSubmit('form1', 'file_delete', 'upload_index', '<!--{$index}-->'); return false;">[ファイルの取り消し]</a>
                        <!--{else}-->
                        <input type="file" name="<!--{$key}-->[<!--{$index}-->]" size="10" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" /><br />
                        <a class="btn-normal" href="javascript:;" name="btn" onclick="<!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.<!--{/if}-->fnFormModeSubmit('form1', 'file_upload', 'upload_index', '<!--{$index}-->'); return false;">アップロード</a>
                        <!--{/if}-->
                    </td>
                </tr>
                    <!--{assign var=plg_product_id value=$arrForm.product_id.value}-->
                    <!--{assign var=plg_classcategory1 value=$arrForm.classcategory_id1.value[$index]}-->
                    <!--{assign var=plg_classcategory2 value=$arrForm.classcategory_id2.value[$index]}-->
                    <!--{assign var=plg_classcategory_case value=$arrForm.classcategory_id1.value[$index]|cat:"-"|cat:$arrForm.classcategory_id2.value[$index]}-->
                    <!--{assign var=sessiondata value=$smarty.session.plg_NakwebProductsClassImageUpload[$plg_product_id]}-->
                    <!--{assign var=sessionpath value=$sessiondata[$plg_classcategory_case]}-->
                <tr class="temp_main_list_image<!--{$plg_classcategory_case|h}-->">
                    <td colspan="<!--{if $smarty.const.OPTION_PRODUCT_TAX_RULE}-->3<!--{else}-->2<!--{/if}-->">
                        <!--{if $sessiondata[$plg_classcategory_case].temp_main_list_image != "" && $sessionpath.temp_main_list_image_path == "temp"}-->
                            <img src="<!--{$smarty.const.IMAGE_TEMP_URLPATH}--><!--{$sessiondata[$plg_classcategory_case].temp_main_list_image}-->" alt="temp_main_list_image" class="temp_main_list_image<!--{$plg_classcategory_case|h}-->" />
                        <!--{elseif $sessiondata[$plg_classcategory_case].save_main_list_image != "" && $sessionpath.temp_main_list_image_path == "save"}-->
                            <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$sessiondata[$plg_classcategory_case].save_main_list_image}-->" alt="temp_main_list_image" class="temp_main_list_image<!--{$plg_classcategory_case|h}-->" />
                        <!--{/if}-->
                        <div class="temp_main_list_image<!--{$plg_classcategory_case|h}-->"><img /></div>
                    </td> 
                    <td colspan="3">
                        <!--{if $sessiondata[$plg_classcategory_case].temp_main_image != "" && $sessionpath.temp_main_image_path == "temp"}-->
                            <img src="<!--{$smarty.const.IMAGE_TEMP_URLPATH}--><!--{$sessiondata[$plg_classcategory_case].temp_main_image}-->" alt="temp_main_image" width="<!--{$smarty.const.SMALL_IMAGE_WIDTH}-->" class="temp_main_image<!--{$plg_classcategory_case|h}-->" />
                        <!--{elseif $sessiondata[$plg_classcategory_case].save_main_image != "" && $sessionpath.temp_main_image_path == "save"}-->
                            <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$sessiondata[$plg_classcategory_case].save_main_image}-->" alt="temp_main_image" width="<!--{$smarty.const.SMALL_IMAGE_WIDTH}-->" class="temp_main_image<!--{$plg_classcategory_case|h}-->" />
                        <!--{/if}-->
                        <div class="temp_main_image<!--{$plg_classcategory_case|h}-->"><img /></div>
                    </td>
                    <td colspan="3">
                        <!--{if $sessiondata[$plg_classcategory_case].temp_main_large_image != "" && $sessionpath.temp_main_large_image_path == "temp"}-->
                            <img src="<!--{$smarty.const.IMAGE_TEMP_URLPATH}--><!--{$sessiondata[$plg_classcategory_case].temp_main_large_image}-->" alt="temp_main_large_image" width="<!--{$smarty.const.SMALL_IMAGE_WIDTH}-->" class="temp_main_large_image<!--{$plg_classcategory_case|h}-->" />
                        <!--{elseif $sessiondata[$plg_classcategory_case].save_main_large_image != "" && $sessionpath.temp_main_large_image_path == "save"}-->
                            <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$sessiondata[$plg_classcategory_case].save_main_large_image}-->" alt="temp_main_large_image" width="<!--{$smarty.const.SMALL_IMAGE_WIDTH}-->" class="temp_main_large_image<!--{$plg_classcategory_case|h}-->" />
                        <!--{/if}-->
                        <div class="temp_main_large_image<!--{$plg_classcategory_case|h}-->"><img /></div>
                    </td>
                    <td colspan="1">
                        <a href="?" onclick="<!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.openWindow<!--{else}-->win02<!--{/if}-->('<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->products/plg-nakwebproductsclassimageupload-upload.php?productsclass-state=<!--{$arrForm.product_id.value|h}-->-<!--{$arrForm.classcategory_id1.value[$index]|h}-->-<!--{$arrForm.classcategory_id2.value[$index]|h}-->-<!--{$index|h}-->', 'load', 615, 400);return false;" target="upload_window">アップローダーへ</a>
                    </td>
                </tr>
            <!--{/section}-->
        </table>
<!-- end   NakwebProductsClassImageUpload -->

