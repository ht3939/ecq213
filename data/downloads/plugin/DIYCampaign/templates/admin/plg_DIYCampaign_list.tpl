<div id="plg_diycampaign_list">

<div class="contents-main">

<!--{if $campaigns|count}-->
<!--{strip}-->
<form name="listForm">
<input type="hidden" name="campaign_id" value="">
<input type="hidden" name="hidden_flg" value="">
<input type="hidden" name="mode" value="">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->">
</form>

<table class="plg_diycampaign-list">
<tr>
<th class="id">ID</th><th class="name">キャンペーン名</th><th class="image">登録商品</th><th class="public">公開設定</th><th class="edit">編集</th><th class="remove">削除</th>
</tr>
<!--{foreach name=campaign_loop from=$campaigns item=campaign}-->
<tr id="campaign_id<!--{$campaign.campaign_id|h}-->">
<td class="id"><!--{$campaign.campaign_id|h}--></td>
<td class="name">
<h3 class="campaign_name">キャンペーン名:<br /><a href="<!--{$smarty.const.PLUGIN_HTML_URLPATH}-->DIYCampaign/campaign.php?campaign_id=<!--{$campaign.campaign_id|u}-->" target="_display"><strong><!--{$campaign.campaign_name|h|default:"なし"}--></strong></a></h3>

<h4 class="comment_t">コメント:</h4>
<div class="comment"><!--{$campaign.campaign_comment|h|nl2br}--></div>
</td>
<td class="image">
<!--{foreach name=item_image_loop from=$campaign.items key=product_id item=item}-->
<!--{if $smarty.foreach.item_image_loop.first}--><ul class="images"><!--{/if}-->
<li><a href="<!--{$smarty.const.ROOT_URLPATH|h}-->products/detail.php?product_id=<!--{$product_id|u}-->" title="<!--{$item.name|h}-->" target="_blank"><img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$item.main_list_image|sfNoImageMainList|u}-->" alt="<!--{$item.name|h}-->" class="image" /></a></li>
<!--{if $smarty.foreach.item_image_loop.last}--></ul><!--{/if}-->
<!--{foreachelse}-->
商品は登録されていません。
<!--{/foreach}-->
</td>
<td class="public">
<label><input type="radio" name="hidden_flg_<!--{$campaign.campaign_id|h}-->" value="0"<!--{if $campaign.hidden_flg == 0}--> checked="checked"<!--{/if}-->> 公開</label><br />
<label><input type="radio" name="hidden_flg_<!--{$campaign.campaign_id|h}-->" value="1"<!--{if $campaign.hidden_flg == 1}--> checked="checked"<!--{/if}-->> 非公開</label>
</td>
<td class="edit"><a href="./plg_DIYCampaign_Edit.php?campaign_id=<!--{$campaign.campaign_id|h}-->" class="plg_diycampaign-button">編集</a></td>
<td class="remove"><a href="#" name="delete_campaign_<!--{$campaign.campaign_id|h}-->" title="<!--{$campaign.campaign_name|h}-->の削除" class="plg_diycampaign-button">削除</a></td>
</tr>
<!--{/foreach}-->
</table>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script type="text/javascript" src="<!--{$smarty.const.PLUGIN_HTML_URLPATH}-->DIYCampaign/media/diycampaign.js"></script>
<!--{/strip}-->
<!--{else}-->
<p class="empty">キャンペーンは登録されていません。</p>
<!--{/if}-->

<div class="btn-area">
<ul><li><a href="./plg_DIYCampaign_Edit.php" class="btn-action"><span class="btn-next">新規登録する</span></a></li></ul></div>

</div>

</div>
