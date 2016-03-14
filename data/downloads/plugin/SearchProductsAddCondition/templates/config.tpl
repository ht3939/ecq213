<!--{*
 *
 * SearchProductsAddCondition
 * @Copyright (C) 2014 aratana Inc. All Rights Reserved.
 * @link http://aratana.jp/
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
<style>
select{
	padding : 7px;
}
input{
	padding : 7px;
}
table{
	margin  : 10px 0 0 0;
}
</style>
<form name="form1" id="form1" method="post" action="<!--{$smarty.server.REQUEST_URI|h}-->" enctype="multipart/form-data">
<input type="hidden" name="mode" value="register">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />

<h1><!--{$tpl_subtitle|h}--></h1>
<table>
  <tr>
    <th>キーワード絞込</th>
    <td>
      <select name="disp_SearchProductsAddCondition_comment">
        <option value="on" <!--{if $arrForm.disp_SearchProductsAddCondition_comment|h == "on"}--> selected="selected"<!--{/if}-->>表示する</option>
        <option value="off" <!--{if $arrForm.disp_SearchProductsAddCondition_comment|h == "off"}--> selected="selected"<!--{/if}-->>表示しない</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>商品ステータス絞込</th>
    <td>
    <select name="disp_SearchProductsAddCondition_status">
    <option value="on" <!--{if $arrForm.disp_SearchProductsAddCondition_status|h == "on"}--> selected="selected"<!--{/if}-->>表示する</option>
    <option value="off" <!--{if $arrForm.disp_SearchProductsAddCondition_status|h == "off"}--> selected="selected"<!--{/if}-->>表示しない</option>
    </select>
    </td>
  </tr>
  <tr>
    <th>販売金額（税込）絞込</th>
    <td>
    <select name="disp_SearchProductsAddCondition_price">
    <option value="on" <!--{if $arrForm.disp_SearchProductsAddCondition_price|h == "on"}--> selected="selected"<!--{/if}-->>表示する</option>
    <option value="off" <!--{if $arrForm.disp_SearchProductsAddCondition_price|h == "off"}--> selected="selected"<!--{/if}-->>表示しない</option>
    </select>
    </td>
  </tr>
</table>

<div class="btn-area">
  <ul>
    <li>
      <a class="btn-action" href="javascript:;" onclick="document.form1.submit();return false;"><span class="btn-next">この内容で登録する</span></a>
    </li>
  </ul>
</div>

</form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->