<!--{*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2014 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *}-->
<script type="text/javascript">//<![CDATA[

//]]></script>
<div class="top-data">
  <div class="inner">
    <div class="sns-list">
      <ul class="">

        <li>
          <!-- Twitter -->
          <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja">ツイート</a>
          <script>
              !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </li>

        <li>
          <!-- Facebook -->
          <div class="fb-like" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
          <div id="fb-root"></div>
          <script>
          (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
          </script>
        </li>

        <li>
          <!-- Google plus -->
          <div class="g-plusone" data-size="medium"></div>
          <script type="text/javascript">
              window.___gcfg = {lang: 'ja'};
              (function() {
                  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                  po.src = 'https://apis.google.com/js/plusone.js';
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
              })();
          </script>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="row-container is-reverse">

  <form name="form1" id="form1" method="get" action="?">

    <div class="main-column">
      <main>
        <h1 class="plan-title"><span><!--{$arrProduct.maker_name}--></span><!--{$arrProduct.name}--></h1>

        <!--{include file=products/detail-yh-sec-main.tpl}-->
        <!--{include file=products/detail-yh-sec-mainsub.tpl}-->
        <!--{**}-->
        <!--{include file=frontparts/bloc/yh-detail-other-plan.tpl}-->
        <!--{include file=frontparts/bloc/yh-detail-recommend.tpl}-->
        <!--{include file=frontparts/bloc/yh-detail-note.tpl}-->
        <!--{include file=frontparts/bloc/yh-footer-link.tpl}-->

      <p class="index-link"><a href="/">トップへ戻る</a></p>
      </main>
    </div>


  </form>

</div>

<script src="<!--{$TPL_URLPATH}-->/js/front/common.js"></script>


<script src="<!--{$TPL_URLPATH}-->/js/front/Chart.min.js"></script>
<script src="<!--{$TPL_URLPATH}-->/js/front/jquery.bxslider.min.js"></script>
<script>
//スライダー
$('.bxslider').each(function(){
  if( $(this).children('li').length > 1){
    BXSLIDER($(this));
  }else{
    // $(this).css({margin:"0 -5px 0 5px"});
  }
});
function BXSLIDER(target){
  target.bxSlider({
    pager: false,
    prevText: '',
    nextText: '',
    auto: true,
    onSliderLoad:function(currentIndex){
      $('.bx-wrapper,.bx-prev,.bx-next').click(function(e){
        e.stopPropagation();
      });
    }
  });
}


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
   <!--{$tpl_bestproduct_graph}-->
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
if($('.js-device-tab').find('td').length > 1){
  $('.js-device-tab').find('td').click(function(){
    $(this).closest('.js-device-tab').find('td').removeClass('active');
    $(this).addClass('active');
    $('.js-device-content').children().removeClass('active');
    $('.js-device-content').children().eq($(this).index()).addClass('active');
  });
}else{
  $('.js-device-tab').hide();
  $('.row-container .device-content').css({marginBottom:"40px"});
}
//aタグ 全体リンク
$(".js-all-link").click(function(){
  $(this).find('.js-link-btn')[0].click();
});


</script>
