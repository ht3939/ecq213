<!--{strip}-->
<!--{*
テンプレート共通の定数を宣言する。
*}-->

<!--{assign var=ACWBCONST_SITE_ROOT value=$smarty.const.ROOT_URLPATH}-->

<!--{*
//----------------------------------------------------------------------------------------------------
## 各ページへのリンクを定義する
//----------------------------------------------------------------------------------------------------
*}-->

<!--{assign var=ACWBCONST_TOP_URL value=$ACWBCONST_SITE_ROOT}-->

<!--{*
//▼ ■■■■■
//define(ページの識別子名_URL, SITE_ROOT_DIR.'頭にスラッシュなしのディレクトリ名、または、ファイル名')
define(COMPANY_URL, SITE_ROOT_DIR.'company.php');
define(PRIVACY_POLICY_URL, SITE_ROOT_DIR.'privacypolicy.php');
define(ENTRY_FORM_URL, SITE_ROOT_DIR.'form-entry/');
define(INQUIRY_FORM_URL, SITE_ROOT_DIR.'form-inquiry/');
*}-->

<!--{assign var=ACWBCONST_COMPANY_URL value=$ACWBCONST_SITE_ROOT.'company.php'}-->
<!--{assign var=ACWBCONST_PRIVACY_POLICY_URL value=$ACWBCONST_SITE_ROOT.'privacypolicy.php'}-->
<!--{assign var=ACWBCONST_ENTRY_FORM_URL value=$ACWBCONST_SITE_ROOT.'form-entry/'}-->
<!--{assign var=ACWBCONST_INQUIRY_FORM_URL value=$ACWBCONST_SITE_ROOT.'form-inquiry/'}-->

<!--{*
//▲ ■■■■■
*}-->



<!--{*
//----------------------------------------------------------------------------------------------------
## テストサイトかどうかを定義する
//----------------------------------------------------------------------------------------------------
*}-->

<!--{if $ACWBCONST_SITE_ROOT|strpos:"/t/" === false}-->
	<!--{assign var=ACWBCONST_ABTEST_FLAG value=false}-->
<!--{else}-->
	<!--{assign var=ACWBCONST_ABTEST_FLAG value=true}-->
<!--{/if}-->



<!--{*
//----------------------------------------------------------------------------------------------------
## <meta property="og:foo">を定義する
//----------------------------------------------------------------------------------------------------
*}-->
<!--{assign var=ACWBCONST_SITE_URL value=$smarty.const.HTTP_URL|rtrim:"/"}-->

<!--{if !$ACWBCONST_ABTEST_FLAG}-->
	<!--{*
	//テストサイトでない場合
	*}-->
	<!--{assign var=ACWBCONST_OG_URL_CONTENT value=`$ACWBCONST_SITE_URL`"}-->
	<!--{assign var=ACWBCONST_OG_IMAGE_CONTENT value=`$ACWBCONST_SITE_URL``$TPL_URLPATH`img/og-image.png"}-->

<!--{else}-->

	<!--{*
	//テストサイトである場合
	*}-->
	<!--{assign var=ACWBCONST_OG_URL_CONTENT value=`$ACWBCONST_SITE_URL`"}-->
	<!--{assign var=ACWBCONST_OG_IMAGE_CONTENT value=`$ACWBCONST_SITE_URL``$TPL_URLPATH`img/og-image.png"}-->

	<!--{assign var=ACWBCONST_OG_URL_CONTENT value=$ACWBCONST_OG_URL_CONTENT|replace:"/t/":"/"}-->
	<!--{assign var=ACWBCONST_OG_IMAGE_CONTENT value=$ACWBCONST_OG_IMAGE_CONTENT|replace:"/t/":"/"}-->


<!--{/if}-->


<!--{*
//----------------------------------------------------------------------------------------------------
## <meta name="viewport" content="width=9999">を定義する
//----------------------------------------------------------------------------------------------------
*}-->

<!--{*
//▼ ■■■■■
*}-->
<!--{assign var=ACWBCONST_META_VIEWPORT_WIDTH value=1100}-->
<!--{*
//▲ ■■■■■
*}-->







<!--{if $tpl_page_class_name === "LC_Page_Products_Detail"}-->
<!--{*
Blocとレイアウト設定で定義したほうがよいかも。
*}-->

	<!--{assign var=ACWBCONST_OG_URL_CONTENT value=`$ACWBCONST_OG_URL_CONTENT``$smarty.server.REQUEST_URI`"}-->


<!--{assign var=ACWBCONST_article       value="article"}-->
<!--{assign var=ACWBCONST_meta_keywords       value="`$arrProduct.maker_name`,`$arrProduct.name`,格安モバイルルーター,買い物ナビゲーター"}-->

<!--{assign var=ACWBCONST_meta_description    value="`$arrProduct.maker_name` `$arrProduct.name`の詳細ページです。Yahoo!買い物ナビゲーターの格安モバイルルーター価格ランキングは、月額料金、2年総額、月間データ量などの項目から、自分にぴったりのルーターをお探しいただけます。"}-->
<!--{assign var=ACWBCONST_meta_title         value="`$arrProduct.maker_name` `$arrProduct.name` – Yahoo!買い物ナビゲーター"}-->

<!--{assign var=ACWBCONST_link_canonical      value="`$ACWBCONST_SITE_URL``$smarty.server.REQUEST_URI`"}-->
<!--{assign var=ACWBCONST_link_alternate      value=""}-->
<!--{/if}-->





<!--{if $tpl_page_class_name === "LC_Page_Products_List"}-->
<!--{*
Blocとレイアウト設定で定義したほうがよいかも。
*}-->
	<!--{assign var=ACWBCONST_OG_URL_CONTENT value=`$ACWBCONST_OG_URL_CONTENT``$smarty.const.ROOT_URLPATH`"}-->

<!--{assign var=ACWBCONST_article       value="website"}-->
<!--{assign var=ACWBCONST_meta_keywords       value="モバイルルーター,Wi-Fi,価格,比較,ランキング"}-->

<!--{assign var=ACWBCONST_meta_description    value="Yahoo!買い物ナビゲーターの格安モバイルルーター価格ランキングなら、お得なモバイルルータが一目で分かる！月額料金、2年総額、月間データ量などの項目から、自分にぴったりのルーターをお探しください"}-->
<!--{assign var=ACWBCONST_meta_title         value="格安モバイルルーター比較 – Yahoo!買い物ナビゲーター"}-->

<!--{assign var=ACWBCONST_link_canonical      value="`$ACWBCONST_SITE_URL``$smarty.const.ROOT_URLPATH`"}-->
<!--{assign var=ACWBCONST_link_alternate      value=""}-->

<!--{/if}-->

<!--{include file='./site_frame_acwb.tpl'}-->
<!--{/strip}-->
