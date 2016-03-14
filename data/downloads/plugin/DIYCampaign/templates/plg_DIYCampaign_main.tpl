<!--{* スタイル *}-->
<style type="text/css">
.column{
    float:left;
    box-sizing:border-box;
}

.column .item{
    text-align:center;
    margin-bottom:10px;
}
.column .item .image{
}
.column .item .text{
    padding:5px 10px;
}
.column .item .description{
    padding:5px 10px;
}
.column .item img{
    max-width:100%;
}

<!--{foreach name=row_loop from=$layout item=row}-->
<!--{foreach name=column_loop from=$row item=column}-->
.column<!--{$column.width|h}-->{
    width:<!--{$column.width/$max_width*100}-->%;
}
<!--{/foreach}-->
<!--{/foreach}-->
</style>

<!--{* タグ *}-->
<!--{strip}-->
<!--{foreach name=row_loop from=$layout item=row}-->
<div class="row clearfix">
<!--{foreach name=column_loop from=$row item=column}-->
<div class="column column<!--{$column.width|h}-->">
<!--{foreach name=item_loop from=$column.items item=item}-->
<div class="item item<!--{$smarty.foreach.item_loop.iteration}-->">
<!--{if is_array($item)}-->
<!--{assign var=key value="main_image"}-->
<div class="image"><a href="<!--{$smarty.const.ROOT_URLPATH}-->products/detail.php?product_id=<!--{$item.product_id|h}-->"><img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$item.main_list_image|sfNoImageMainList|h}-->" alt="<!--{$item.name|h}-->" /></a></div>
<p class="description"><a href="<!--{$smarty.const.ROOT_URLPATH}-->products/detail.php?product_id=<!--{$item.product_id|h}-->"><!--{$item.name|h}--></a></p>
<!--{else}-->
<p class="text"><!--{$item}--></p>
<!--{/if}-->
</div>
<!--{/foreach}-->
</div>
<!--{/foreach}-->
</div>
<!--{foreachelse}-->
<p>不完全なレイアウトです。</p>
<!--{/foreach}-->
<!--{/strip}-->
