<div id="mainv">
  <div class="base-container">
    <img src="<!--{$TPL_URLPATH}-->img/header/mainv.png" alt="一番安い！がすぐ分かる！">
  </div>
</div>

<!--▼ページナビ(本文)-->
<!--{capture name=search_navi_body}-->
    <!--{include file=products/yh-search-bloc.tpl}-->
<!--{/capture}-->
<!--▲ページナビ(本文)-->

<div class="row-container is-reverse">
	<div class="main-column">
	    <form name="form1" id="form1" method="get" action="?">
	        <!--{* ▼検索条件 *}-->
	        <input type="hidden" name="category_id" value="<!--{$arrSearchData.category_id|h}-->" />
	        <input type="hidden" name="name" value="<!--{$arrSearchData.name|h}-->" />

	        <!--{if is_array($arrSearchData.maker_id)}-->
	            <!--{foreach from=$arrSearchData.maker_id item=mkid name=arrProducts_makerid}-->
		            <input type="hidden" name="maker_id[]" value="<!--{$mkid|h}-->" />
	            <!--{/foreach}-->
	        <!--{else}-->
		            <input type="hidden" name="maker_id" value="<!--{$arrSearchData.maker_id|h}-->" />
	        <!--{/if}-->

	        <input type="hidden" name="product_status_id" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="y1_price_min" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="y1_price_max" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="total_price_min" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="total_price_max" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="cp_price_min" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="cp_price_max" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="datasize_min" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="datasize_max" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="data_speed_down_min" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="data_speed_down_max" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="classcategory_id1" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="classcategory_id2" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="product_code" value="<!--{$arrSearchData.name|h}-->" />
	        <input type="hidden" name="cc_type" value="<!--{$arrSearchData.name|h}-->" />
	        <!--{* ▲検索条件 *}-->
	        <!--{* ▼ページナビ関連 *}-->
	        <input type="hidden" name="orderby" value="<!--{$orderby|h}-->" />
	        <input type="hidden" name="disp_number" value="<!--{$disp_number|h}-->" />
	        <!--{* ▲ページナビ関連 *}-->
	        <input type="hidden" name="rnd" value="<!--{$tpl_rnd|h}-->" />
	    </form>	
		<main>

	        <!--{include file=frontparts/bloc/yh-top-bestproduct-bloc.tpl}-->

	        <!--{include file=products/yh-list-bloc.tpl}-->



	        <!--{include file=frontparts/bloc/yh-top-rank-note.tpl}-->

	        <!--{include file=frontparts/bloc/yh-top-rank-abouts.tpl}-->
		</main>
	</div>
<!--	<div class="side-column">
			</div>-->
</div>


<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>window.jQuery || document.write('<script src="<!--{$TPL_URLPATH}-->/js/jquery-1.11.3.min.js"><\/script>');</script>
<script src="<!--{$TPL_URLPATH}-->/js/front/common.js"></script>

<!--[if lt IE 9]>
<script src="/js/front/html5shiv.js"></script>
<![endif]-->
<script src="<!--{$TPL_URLPATH}-->/js/front/index.js"></script>
<script src="<!--{$TPL_URLPATH}-->/js/front/Chart.min.js"></script>
<script src="<!--{$TPL_URLPATH}-->/js/front/jquery.bxslider.min.js"></script>
<script>
//スライダー
(function BXSLIDER(){
  $('.bxslider').bxSlider({
    pager: false,
    prevText: '',
    nextText: '',
    slideWidth:243,
    onSliderLoad:function(currentIndex){
      $('.bx-wrapper,.bx-prev,.bx-next').click(function(e){
        e.stopPropagation();
      });
    }
  });
})();

//ボックスの高さ揃え
$('.js-height').each(function(){
  var maxHeight;
  var dtHeight = $(this).find('dt').height();
  var ddHeight = $(this).find('dd').height();
  if(dtHeight >= ddHeight){
    maxHeight = dtHeight;
  }else{
    maxHeight = ddHeight;
  }
  $(this).find('dt,dd').height(maxHeight);
});
//チャート
$(function() {
// チャートの枠組み
var radarChartData = {
// 項目
  labels: ["", "", "", "", ""],
  datasets: [
  {
   // 透明を使いたいのでRGBAで色を再現→rgba(xxx,xxx,xxx,0.5):透過度50%
   fillColor: "rgba(173,192,225,0.7)",  // チャート内の色
   strokeColor: "#7f9fd5",  // チャートを囲む線の色
   pointColor: "#5f87cb",   // チャートの点の色
   pointStrokeColor: "#5f87cb",    // 点を囲む線の色
   // 各項目の値
   data: [5,3,4,3,4]
   }
             ]
   };
   // レーダーチャートの目盛とかの設定
   var canvas = document.getElementById("canvas");
   var context = canvas.getContext("2d");
   var chart = new Chart(context);
   var rader = chart.Radar(radarChartData, {
   scaleShowLabels: false,  // 目盛を表示（true/false）
   pointLabelFontStyle : "bold",
   pointLabelFontColor : "#333",
   showTooltips: false,//ツールチップoff
   pointLabelFontSize : 12, // ラベルのフォントサイズ
   scaleOverride : true, // 目盛の最大値を手動設定（true/false）
   showScale: true,
   scaleSteps : 5, // 目盛の数
   scaleStartValue : 0, // 目盛の最初の数
   scaleStepWidth : 1, // 目盛の間隔
   // 目盛の最大値の計算：scaleSteps（目盛の数）→5　scaleStepWidth（目盛の間隔）→2 だと5×2で最大値は10
   });
});
//タブ
$('.js-device-tab').children().click(function(){
  $(this).parent().children().removeClass('active');
  $(this).addClass('active');
  $('.js-device-content').children().removeClass('active');
  $('.js-device-content').children().eq($(this).index()).addClass('active');
});
//aタグ 全体リンク
$(".js-all-link").click(function(){
  location.href = $(this).find('.js-link-btn').attr("href");
});

//IE8 グラフ非表示---------------------------------------
if(window.navigator.userAgent.toLowerCase().indexOf("msie") > -1 && window.navigator.appVersion.toLowerCase().indexOf("msie 8")>-1){
$('.graph').hide();
$('.detail .rank-list').css({width:620});
}

</script>