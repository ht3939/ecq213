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
<!--{assign var="version" value="."|explode:$smarty.const.ECCUBE_VERSION}-->
<!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->
<script type="text/javascript">
    // target の子要素を選択状態にする
    function selectAll(target) {
        $('#' + target).children().prop('selected', 'selected');
    }
</script>
<!--{else}-->
<script type="text/javascript">
// target の子要素を選択状態にする
function selectAll(target) {
    $('#' + target).children().attr({selected: true});
}
</script>
<!--{/if}-->
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<div id="order" class="contents-main">
    <form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode"                 value="comp" />
        <input type="hidden" name="image_key"            value="" />
        <input type="hidden" name="product_name"         value="<!--{$arrForm.product_name|h}-->" />
        <input type="hidden" name="product_id"           value="<!--{$arrForm.product_id|h}-->" />
        <input type="hidden" name="productsclass_name1"  value="<!--{$arrForm.productsclass_name1|h}-->" />
        <input type="hidden" name="productsclass_id1"    value="<!--{$arrForm.productsclass_id1|h}-->" />
        <input type="hidden" name="productsclass_name2"  value="<!--{$arrForm.productsclass_name2|h}-->" />
        <input type="hidden" name="productsclass_id2"    value="<!--{$arrForm.productsclass_id2|h}-->" />
        <input type="hidden" name="main_list_image_flg"  value="<!--{$arrForm.main_list_image_flg|h}-->" />
        <input type="hidden" name="main_image_flg"       value="<!--{$arrForm.main_image_flg|h}-->" />
        <input type="hidden" name="main_large_image_flg" value="<!--{$arrForm.main_large_image_flg|h}-->" />
        
        <!--{foreach key=key item=item from=$arrForm.arrHidden}-->
            <input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->" />
        <!--{/foreach}-->
        <h2>画像アップローダー</h2>

        <p>商品名： <!--{$arrForm.product_name|h}--></p>
        <p>規　格： <!--{$arrForm.productsclass_name1|h}--> <!--{$arrForm.productsclass_name2|h}--></p>
        <br /><p><span class="bold">アップロード可能な拡張子：</span>jpg, gif, png</p>
        <br /><p><span class="bold"><span class="attention">※アップロードの際も、画像を削除する際も、必ずアップロードを押してウィンドウを閉じてください。</span></span></p>
        <!--{* 検索条件設定テーブルここから *}-->
        <table>
            <tr>
                <!--{assign var=key value="main_list_image"}-->
                <th>一覧-メイン画像<br />[<!--{$smarty.const.SMALL_IMAGE_WIDTH}-->×<!--{$smarty.const.SMALL_IMAGE_HEIGHT}-->]</th>
                <td>
                    <a name="<!--{$key}-->"></a>
                    <a name="main_image"></a>
                    <a name="main_large_image"></a>
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="selectAll('category_id'); <!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.setModeAndSubmit<!--{else}-->fnModeSubmit<!--{/if}-->('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a><br />
                    <!--{/if}-->
                    <input type="file" name="main_list_image" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                    <a class="btn-normal" href="javascript:;" name="btn" onclick="selectAll('category_id'); <!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.setModeAndSubmit<!--{else}-->fnModeSubmit<!--{/if}-->('upload_image', 'image_key', '<!--{$key}-->'); return false;">アップロード</a>
                </td>
            </tr>
            <tr>
                <!--{assign var=key value="main_image"}-->
                <th>詳細-メイン画像<br />[<!--{$smarty.const.NORMAL_IMAGE_WIDTH}-->×<!--{$smarty.const.NORMAL_IMAGE_HEIGHT}-->]</th>
                <td>
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="selectAll('category_id'); <!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.setModeAndSubmit<!--{else}-->fnModeSubmit<!--{/if}-->('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a><br />
                    <!--{/if}-->
                    <input type="file" name="main_image" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                    <a class="btn-normal" href="javascript:;" name="btn" onclick="selectAll('category_id'); <!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.setModeAndSubmit<!--{else}-->fnModeSubmit<!--{/if}-->('upload_image', 'image_key', '<!--{$key}-->'); return false;">アップロード</a>
                </td>
            </tr>
            <tr>
                <!--{assign var=key value="main_large_image"}-->
                <th>詳細-メイン拡大画像<br />[<!--{$smarty.const.LARGE_IMAGE_WIDTH}-->×<!--{$smarty.const.LARGE_IMAGE_HEIGHT}-->]</th>
                <td>
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="selectAll('category_id'); <!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.setModeAndSubmit<!--{else}-->fnModeSubmit<!--{/if}-->('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a><br />
                    <!--{/if}-->
                    <input type="file" name="<!--{$key}-->" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                    <a class="btn-normal" href="javascript:;" name="btn" onclick="selectAll('category_id'); <!--{if $smarty.const.FORM_COUNTRY_ENABLE && $version.1 == 13}-->eccube.setModeAndSubmit<!--{else}-->fnModeSubmit<!--{/if}-->('upload_image', 'image_key', '<!--{$key}-->'); return false;">アップロード</a>
                </td>
            </tr>
        </table>
        <li><a class="btn-action" href="javascript:;" onclick="selectAll('category_id'); document.form1.submit(); return false;"><span class="btn-next">画像をアップロードする</span></a></li>
    </form>


</div>
<!-- end   NakwebProductsClassImageUpload -->

