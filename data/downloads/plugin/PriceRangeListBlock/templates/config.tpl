<!--{*
 * PriceRangeListBlock
 * Copyright(c) C-Rowl Co., Ltd. All Rights Reserved.
 * http://www.c-rowl.com/
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

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<form name="form1" id="form1" method="post" action="<!--{$smarty.server.REQUEST_URI|h}-->">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="edit" />
    <input type="hidden" name="price_range_id" value="<!--{$tpl_price_range_id}-->" />
    <div id="products" class="contents-main">

        <table class="form">
            <tr>
                <th>名称<span class="attention"> *</span></th>
                <td>
                    <!--{if $arrErr.price_range_id}--><span class="attention"><!--{$arrErr.price_range_id}--></span><br /><!--{/if}-->
                    <!--{if $arrErr.price_range_name}--><span class="attention"><!--{$arrErr.price_range_name}--></span><!--{/if}-->
                    <input type="text" name="price_range_name" value="<!--{$arrForm.price_range_name|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="" size="30" class="box30"/>
                </td>
            </tr>

            <tr>
                <th>価格条件</th>
                <td>
                    <!--{if $arrErr.price_range_lower}--><span class="attention"><!--{$arrErr.price_range_lower}--></span><!--{/if}-->
                    <!--{if $arrErr.price_range_upper}--><span class="attention"><!--{$arrErr.price_range_upper}--></span><!--{/if}-->
                    <input type="text" name="price_range_lower" value="<!--{$arrForm.price_range_lower|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="" size="8"/>&nbsp;円以上&nbsp;
                    <input type="text" name="price_range_upper" value="<!--{$arrForm.price_range_upper|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="" size="8"/>&nbsp;円以下&nbsp;
                    <br />
                    ※空白指定可
                </td>
            </tr>
        </table>

        <div class="btn-area">
            <ul>
                <li><a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('form1', 'edit', '', ''); return false;"><span class="btn-next">この内容で登録する</span></a></li>
            </ul>
        </div>
        <!--{if count($arrPriceRage) > 0}-->
        <table class="list">
            <col width="20%" />
            <col width="30%" />
            <col width="10%" />
            <col width="10%" />
            <col width="20%" />
            <tr>
                <th>名称</th>
                <th>条件</th>
                <th class="edit">編集</th>
                <th class="delete">削除</th>
                <th>移動</th>
            </tr>
            <!--{section name=cnt loop=$arrPriceRage}-->
            <tr style="background:<!--{if $tpl_price_range_id != $arrPriceRage[cnt].price_range_id}-->#ffffff<!--{else}--><!--{$smarty.const.SELECT_RGB}--><!--{/if}-->;">
                <!--{assign var=price_range_id value=$arrPriceRage[cnt].price_range_id}-->
                <td><!--{$arrPriceRage[cnt].price_range_name|h}--></td>
                <td>
                    <!--{if $arrPriceRage[cnt].price_range_lower}--><!--{$arrPriceRage[cnt].price_range_lower|number_format}-->&nbsp;円以上&nbsp;<!--{/if}-->
                    <!--{if $arrPriceRage[cnt].price_range_upper}--><!--{$arrPriceRage[cnt].price_range_upper|number_format}-->&nbsp;円以下&nbsp;<!--{/if}-->
                </td>
                <td class="center">
                    <!--{if $tpl_price_range_id != $arrPriceRage[cnt].price_range_id}-->
                    <a href="?" onclick="fnModeSubmit('pre_edit', 'price_range_id', <!--{$arrPriceRage[cnt].price_range_id}-->); return false;">編集</a>
                    <!--{else}-->
                    編集中
                    <!--{/if}-->
                </td>
                <td class="center">
                    <!--{if $arrClassCatCount[$class_id] > 0}-->
                    -
                    <!--{else}-->
                    <a href="?" onclick="fnModeSubmit('delete', 'price_range_id', <!--{$arrPriceRage[cnt].price_range_id}-->); return false;">削除</a>
                    <!--{/if}-->
                </td>
                <td class="center">
                    <!--{if $smarty.section.cnt.iteration != 1}-->
                    <a href="?" onclick="fnModeSubmit('down', 'price_range_id', <!--{$arrPriceRage[cnt].price_range_id}-->); return false;" />上へ</a>
                    <!--{/if}-->
                    <!--{if $smarty.section.cnt.iteration != $smarty.section.cnt.last}-->
                    <a href="?" onclick="fnModeSubmit('up', 'price_range_id', <!--{$arrPriceRage[cnt].price_range_id}-->); return false;" />下へ</a>
                    <!--{/if}-->
                </td>
            </tr>
            <!--{/section}-->
        </table>
        <!--{/if}-->
    </div>
</form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
