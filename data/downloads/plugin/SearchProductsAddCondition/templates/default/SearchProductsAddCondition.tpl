<!--{*
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
<!--{if $SearchProductsAddCondition_arrPluginConf.disp_SearchProductsAddCondition_comment === "on"}-->
  <dl class="formlist">
    <dt>キーワードで絞る</dt>
    <dd>
      <input class="box140" type="text" name="SearchProductsAddConditionComment" maxlength="50" value="<!--{$smarty.get.SearchProductsAddConditionComment|h}-->">
    </dd>
  </dl>
<!--{ /if }-->
<!--{if $SearchProductsAddCondition_arrPluginConf.disp_SearchProductsAddCondition_status === "on"}-->
  <!--{if $SearchProductsAddCondition_arrStatus}-->
    <dl class="formlist">
      <dt>商品ステータスで絞る</dt>
      <dd>
      <!--{html_checkboxes name="SearchProductsAddConditionStatusCheckboxes" options=$SearchProductsAddCondition_arrStatus selected=$SearchProductsAddCondition_arrStatusSelected separator='<br />'}-->
      </dd>
    </dl>
  <!--{ /if }-->
<!--{ /if }-->
<!--{if $SearchProductsAddCondition_arrPluginConf.disp_SearchProductsAddCondition_price === "on"}-->
  <dl class="formlist">
    <dt>販売価格(税込)で絞る</dt>
    <dd>
      <input type="number" name="SearchProductsAddConditionPriceFrom" maxlength="9" value="<!--{$smarty.get.SearchProductsAddConditionPriceFrom|h}-->" min="0" style="width: 100px;" />&nbsp;円から<br />
      <input type="number" name="SearchProductsAddConditionPriceTo" maxlength="9" value="<!--{$smarty.get.SearchProductsAddConditionPriceTo|h}-->" min="0" style="width: 100px;" />&nbsp;円まで
    </dd>
  </dl>
<!--{ /if }-->