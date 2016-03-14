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
            <table class="NakwebProductsClassImageUpload">
                <tr>
                    <th>規格1(<!--{$arrClass[$class_id1]|default:"未選択"|h}-->)</th>
                    <th>規格2(<!--{$arrClass[$class_id2]|default:"未選択"|h}-->)</th>
                    <th>商品コード</th>
                    <th>在庫数</th>
                    <th><!--{$smarty.const.NORMAL_PRICE_TITLE}-->(円)</th>
                    <th><!--{$smarty.const.SALE_PRICE_TITLE}-->(円)</th>
                    <!--{if $smarty.const.OPTION_PRODUCT_TAX_RULE}-->
                    <th>消費税率(%)</th>
                    <!--{/if}-->
                    <th>商品種別</th>
                    <th>ダウンロードファイル名</th>
                    <th>ダウンロード商品用ファイルアップロード</th>
                </tr>
                <tr>
                    <th colspan="<!--{if $smarty.const.OPTION_PRODUCT_TAX_RULE}-->4<!--{else}-->3<!--{/if}-->">一覧<br />メイン画像</th>
                    <th colspan="3">詳細<br />メイン画像</th>
                    <th colspan="3">詳細<br />拡大画像</th>
                </tr>
                <!--{section name=cnt loop=$arrForm.total.value}-->
                    <!--{assign var=index value=$smarty.section.cnt.index}-->

                    <!--{if $arrForm.check.value[$index] == 1}-->
                        <tr>
                            <!--{assign var=key value="classcategory_name1"}-->
                            <td><!--{$arrForm[$key].value[$index]|h}--></td>
                            <!--{assign var=key value="classcategory_name2"}-->
                            <td><!--{$arrForm[$key].value[$index]|h}--></td>
                            <!--{assign var=key value="product_code"}-->
                            <td><!--{$arrForm[$key].value[$index]|h}--></td>
                            <!--{assign var=key1 value="stock"}-->
                            <!--{assign var=key2 value="stock_unlimited"}-->
                            <td class="right">
                                <!--{if $arrForm[$key2].value[$index] == 1}-->
                                    無制限
                                <!--{else}-->
                                    <!--{$arrForm[$key1].value[$index]|h}-->
                                <!--{/if}-->
                            </td>
                            <!--{assign var=key value="price01"}-->
                            <td class="right"><!--{$arrForm[$key].value[$index]|h}--></td>
                            <!--{assign var=key value="price02"}-->
                            <td class="right"><!--{$arrForm[$key].value[$index]|h}--></td>
                            <!--{if $smarty.const.OPTION_PRODUCT_TAX_RULE}-->
                            <!--{assign var=key value="tax_rate"}-->
                            <td class="right"><!--{$arrForm[$key].value[$index]|h}--></td>
                            <!--{/if}-->
                            <!--{assign var=key value="product_type_id"}-->
                            <td class="right">
                                <!--{foreach from=$arrForm[$key].value[$index] item=product_type_id}-->
                                    <!--{$arrProductType[$product_type_id]|h}-->
                                <!--{/foreach}-->
                            </td>
                            <!--{assign var=key value="down_filename"}-->
                            <td class="right"><!--{$arrForm[$key].value[$index]}--></td>
                            <!--{assign var=key value="down_realfilename"}-->
                            <td class="right"><!--{$arrForm[$key].value[$index]}--></td>
                        </tr>
                            <!--{assign var=plg_product_id value=$arrForm.product_id.value}-->
                            <!--{assign var=plg_classcategory1 value=$arrForm.classcategory_id1.value[$index]}-->
                            <!--{assign var=plg_classcategory2 value=$arrForm.classcategory_id2.value[$index]}-->
                            <!--{assign var=plg_classcategory_case value=$arrForm.classcategory_id1.value[$index]|cat:"-"|cat:$arrForm.classcategory_id2.value[$index]}-->
                            <!--{assign var=sessiondata value=$smarty.session.plg_NakwebProductsClassImageUpload[$plg_product_id]}-->
                            <!--{assign var=sessionpath value=$sessiondata[$plg_classcategory_case]}-->
                        <tr class="temp_main_list_image<!--{$plg_classcategory_case|h}-->">
                            <td colspan="<!--{if $smarty.const.OPTION_PRODUCT_TAX_RULE}-->4<!--{else}-->3<!--{/if}-->">
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
                        </tr>
                    <!--{/if}-->
                <!--{/section}-->
            </table>
<!-- end   NakwebProductsClassImageUpload -->

