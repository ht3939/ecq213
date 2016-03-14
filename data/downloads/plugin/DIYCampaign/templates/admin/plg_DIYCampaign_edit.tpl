<!--{strip}-->
<div id="plg_diycampaign_edit">

    <form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">

        <div class="contents-main">

            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="" />
            <input type="hidden" name="layout_json" value="" />
            <input type="hidden" name="campaign_id" value="<!--{$data.campaign_id|h}-->" />
            <input type="hidden" name="page_id" value="<!--{$data.page_id|h|default:0}-->" />

            <table class="list">
                <tr>
                    <th>キャンペーン名 <span class="attention">*</span></th>
                    <td>
                        <!--{if $arrErr.campaign_name}--><span class="error"><!--{$arrErr.campaign_name}--></span><!--{/if}-->
                        <input type="text" name="campaign_name" value="<!--{$data.campaign_name|h}-->">
                    </td>
                </tr>
                <tr>
                    <th>公開設定 <span class="attention">*</span></th>
                    <td>
                        <!--{if $arrErr.hidden_flg}--><span class="error"><!--{$arrErr.hidden_flg}--></span><!--{/if}-->
                        <label><input type="radio" name="hidden_flg" value="0"<!--{if $data.hidden_flg == "0"}--> checked="checked"<!--{/if}-->> 公開</label>&emsp;
                        <label><input type="radio" name="hidden_flg" value="1"<!--{if $data.hidden_flg == "1" || $data.hidden_flg == null}--> checked="checked"<!--{/if}-->> 非公開</label>
                    </td>
                </tr>
                <tr>
                    <th>会員限定</th>
                    <td>
                        <!--{if $arrErr.member_flg}--><span class="error"><!--{$arrErr.member_flg}--></span><!--{/if}-->
                        <label><input type="checkbox" name="member_flg" value="1"<!--{if $data.member_flg == "1"}--> checked="checked"<!--{/if}-->> 限定する</label>
                    </td>
                </tr>
                <tr>
                    <th>コメント</th>
                    <td>
                        <!--{if $arrErr.campaign_comment}--><span class="error"><!--{$arrErr.campaign_comment}--></span><!--{/if}-->
                        <textarea name="campaign_comment" rows="10" cols="60"><!--{$data.campaign_comment|h}--></textarea>
                    </td>
                </tr>
                <tr>
                    <th>meta</th>
                    <td>
                        <!--{if $arrErr.campaign_keywords}--><span class="error"><!--{$arrErr.campaign_keywords}--></span><!--{/if}-->
                        <div class="m2">keywords (カンマ区切り)<br /><input type="text" name="campaign_keywords" value="<!--{$data.campaign_keywords|h}-->"></div>

                        <!--{if $arrErr.campaign_description}--><span class="error"><!--{$arrErr.campaign_description}--></span><!--{/if}-->
                        <div class="m2">description<br /><input type="text" name="campaign_description" value="<!--{$data.campaign_description|h}-->"></div>
                        <p>※検索エンジンに対して、検索キーワードや説明文を指定する機能です。</p>
                    </td>
                </tr>
            </table>


            <div class="design">
                <!--{if $arrErr.upfile}--><p class="attention"><!--{$arrErr.upfile}--></p><!--{/if}-->

                <p class="m4">右側から商品をドラッグして、左のボックスにドロップしてください。</p>

                <div class="layout">
                    <div id="layout_box"></div>

                    <div class="source">
                        <p>このページのテンプレートです。ご自由に編集可能です。</p>
                        <textarea name="campaign_source" rows="20" cols="100"><!--{$campaign_source|h}--></textarea>
                    </div>
                </div><!-- .layout -->

                <div class="items">
                    <div class="category_select m4">
                        <select name="categories">
                            <option label="カテゴリー:すべて" value="0">カテゴリー:すべて</option>
                            <!--{html_options options=$arrCategories}-->
                        </select><br>
                        <input type="range" name="item_page" value="1" min="1">&nbsp;
                        <input type="number" name="item_page_display" value="1" min="1">&nbsp;
                        <select name="items_per_page"></select>&nbsp;
                        全<span id="max_item_number">0</span>点
                    </div>

                    <div id="items_box"></div>
                </div><!-- .items -->
            </div><!-- .design -->

            <div class="btn-area plg_diycampaign-button-box">
                <ul>
                    <li><a href="./plg_DIYCampaign_Edit.php" class="btn-action quitButton"><span class="btn-prev">リセットしてやめる</span></a></li>
                    <li><a href="./plg_DIYCampaign_Preview.php" class="btn-action previewButton"><span class="btn-prev">プレビュー</span></a></li>
                    <li><a href="./plg_DIYCampaign_Edit.php" class="btn-action saveButton"><span class="btn-next">登録する</span></a></li>
                </ul>
            </div>

        </div><!-- .contents-main -->

    </form>
</div><!-- #plg_diycampaign_edit -->
<!--{/strip}-->
<script type="text/javascript" src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script type="text/javascript" src="<!--{$smarty.const.PLUGIN_HTML_URLPATH}-->DIYCampaign/media/diycampaign.js"></script>
<script type="text/javascript">
$(function() {
    diyc.init(<!--{$default_layout|default:'{}'}-->, "<!--{$data.campaign_id|h}-->");
});
</script>
