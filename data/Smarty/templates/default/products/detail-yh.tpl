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
    // 規格2に選択肢を割り当てる。
    function fnSetClassCategories(form, classcat_id2_selected) {
        var $form = $(form);
        var product_id = $form.find('input[name=product_id]').val();
        var $sele1 = $form.find('select[name=classcategory_id1]');
        var $sele2 = $form.find('select[name=classcategory_id2]');
        eccube.setClassCategories($form, product_id, $sele1, $sele2, classcat_id2_selected);
    }
//]]></script>
<div class="row-container is-reverse">
  <p class="index-link"><a href="/">トップへ戻る</a></p>

  <form name="form1" id="form1" method="get" action="?">

    <div class="main-column">
      <main>
        <h1 class="plan-title"><span><!--{$arrProduct.maker_name}--></span><!--{$arrProduct.name}--></h1>
        <section>
          <div class="title-name">
            <p class="logo"><img src="<!--{$TPL_URLPATH}--><!--{$arrProduct.mk_image}-->" alt="<!--{$arrProduct.maker_name}-->"></p>
            <div class="title">
              <p class="name"><!--{$arrProduct.name}--></p>
              <!--{assign var=y2p value=$arrProduct.y2_price|number_format}-->
              <p class="condition"><!--{$arrProduct.main_list_comment|replace:"{*}":$y2p}--></p>
            </div>
          </div>
          <div class="data-boxs">
            <ul class="top-data">
              <li class="rank<!--{$arrProduct.rank1_order}-->">
              <img src="<!--{$TPL_URLPATH}-->/img/detail/tag1.png" alt="" class="tag">
                <p class="head">月額料金</p>
                <p class="data"><!--{$arrProduct.y1_price|number_format}--><span>円</span></p>
              </li>
              <li class="rank<!--{$arrProduct.rank2_order}-->">
              <img src="<!--{$TPL_URLPATH}-->/img/detail/tag2.png" alt="" class="tag">
                <p class="head">お支払い総額</p>
                <p class="data"><!--{$arrProduct.total_price|number_format}--><span>円</span></p>
              </li>
              <li class="rank<!--{$arrProduct.rank3_order}-->">
              <img src="<!--{$TPL_URLPATH}-->/img/detail/tag3.png" alt="" class="tag">
                <p class="head">月間データ量</p>
                <p class="data"><!--{$arrProduct.datasize}--><span>GB/月</span></p>
              </li>
              <li class="rank<!--{$arrProduct.rank4_order}-->">
              <img src="<!--{$TPL_URLPATH}-->/img/detail/tag4.png" alt="" class="tag">
                <p class="head">下り最大速度</p>
                <p class="data"><!--{$arrProduct.data_speed_down}--><span>Mbps</span></p>
              </li>
            </ul>
            <div class="rank-graph">
              <img src="<!--{$TPL_URLPATH}-->/img/detail/tag5.png" alt="" class="tag">
              <p class="head">項目別ランキング</p>
              <div class="detail">
                <ul class="rank-list">
                  <li class="rank<!--{$arrProduct.rank1_order}-->">月額料金</li>
                  <li class="rank<!--{$arrProduct.rank3_order}-->">月間データ量</li>
                  <li class="rank<!--{$arrProduct.rank5_order}-->">上り最大速度</li>
                  <li class="rank<!--{$arrProduct.rank4_order}-->">下り最大速度</li>
                  <li class="rank<!--{$arrProduct.rank2_order}-->">お支払総額</li>
                </ul>
                <div class="graph">
                  <p class="status1">月額料金<br><span><!--{$arrProduct.rank1_order}-->位</span></p>
                  <p class="status2">お支払総額<br><span><!--{$arrProduct.rank2_order}-->位</span></p>
                  <p class="status3">月間データ量<br><span><!--{$arrProduct.rank3_order}-->位</span></p>
                  <p class="status4">下り最大速度<br><span><!--{$arrProduct.rank4_order}-->位</span></p>
                  <p class="status5">上り最大速度<br><span><!--{$arrProduct.rank5_order}-->位</span></p>
                  <canvas id="canvas" width="185" height="185"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="js-device-content">

            <!--{foreach from=$arrClassCat1 item=arrCC1 name=arrCC1}-->

            <div class="device-data <!--{if $smarty.foreach.arrCC1.first}-->active<!--{/if}-->">
              <img src="<!--{$TPL_URLPATH}-->/img/detail/tag6.png" alt="<!--{$arrCC1.classcategory_name1}-->" class="tag">
              <div class="image">
                <p class="head">選べる対応端末</p>
                <p class="pic"><img src="<!--{$TPL_URLPATH}--><!--{$arrCC1.cc_img_url1}-->" alt=""></p>
              </div>
              <div class="detail">
                <p class="device-name"><span><!--{$arrCC1.cc_brand}--></span><br><!--{$arrCC1.classcategory_name1}--></p>
                <ul class="data-list">
                  <li>
                    <dl class="data js-height">
                      <dt>下り<br>通信速度</dt>
                      <dd>最大<!--{$arrCC1.cc_data_speed_down}--><span>Mbps</span></dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="data js-height">
                      <dt>上り<br>通信速度</dt>
                      <dd>最大<!--{$arrCC1.cc_data_speed_up}--><span>Mbps</span></dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="data js-height">
                      <dt>カラー</dt>
                      <dd><!--{$arrCC1.cc_color}--></dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="data js-height">
                      <dt>発売日</dt>
                      <dd><!--{$arrCC1.cc_release_date|date_format:"%Y年%m月%d日"}--></dd>
                    </dl>
                  </li>
                </ul>
                <p class="link-btn"><a href="<!--{$arrCC1.pc_url}-->">この商品ページへ</a></p>
              </div>
            </div>
            <!--{/foreach}-->

          </div>
          <ul class="device-list-tab js-device-tab">
            <!--{foreach from=$arrClassCat1 item=arrCC1 name=arrCC1}-->
            <li <!--{if $smarty.foreach.arrCC1.first}-->class="active"<!--{/if}-->>
              <p class="pic"><img src="<!--{$TPL_URLPATH}--><!--{$arrCC1.cc_img_url1}-->" alt="<!--{$arrCC1.classcategory_name1}-->"></p>
              <div><!--{$arrCC1.classcategory_name1}--></div>
            </li>
            <!--{/foreach}-->

          </ul>
        </section>
        <section>
            <h2 class="title">料金プランについて</h2>
            <div class="price">
              <div class="price-content">
                <div class="title">
                  <p class="logo"><img src="<!--{$TPL_URLPATH}--><!--{$arrProduct.mk_image}-->" alt=""></p>
                  <p class="text"><!--{$arrProduct.name}--></p>
                </div>
                <div class="price-data1">
                  <p class="price-data-head">2年間の月額料金について</p>
                  <ul class="data">
                    <li>
                      <p class="head">1年目の月額料金</p>
                      <p class="price"><!--{$arrProduct.y1_price|number_format}-->円</p>
                    </li>
                    <li>
                      <p class="head">2年目の月額料金</p>
                      <p class="price"><!--{$arrProduct.y2_price|number_format}-->円</p>
                    </li>
                  </ul>
                  <div class="graph">
                    <p class="head">お支払イメージ</p>
                    <p class="price-text price-1y">1年目の月額料金<br><span class="price"><!--{$arrProduct.y1_price|number_format}--><span class="yean">円</span></span></p>
                    <p class="price-text price-2y">2年目の月額料金<br><span class="price"><!--{$arrProduct.y2_price|number_format}--><span class="yean">円</span></span></p>
                    <p class="text">12ヶ月目</p>
                    <p></p>
                  </div>
                </div>
                <div class="price-data2">
                  <p class="price-data-head">別途費用</p>
                  <ul class="data">
                    <li>
                      <p class="head">初期費用</p>
                      <p class="price"><!--{$arrProduct.init_price|number_format}-->円</p>
                    </li>
                    <li>
                      <p class="head">事務手数料</p>
                      <p class="price"><!--{$arrProduct.adj_price|number_format}-->円</p>
                    </li>
                  </ul>
                </div>
              </div>
              <dl class="plan">
                <dt><!--{$arrProduct.name}-->について</dt>
                <dd><!--{$arrProduct.main_comment|replace:"{*}":$y2p}--></dd>
              </dl>
              <p class="link-btn"><a href="<!--{$arrProduct.mk_site_url}-->"><!--{$arrProduct.maker_name}-->のサイトへ</a></p>
            </div>
        </section>
        <!--{**}-->
        <!--{include file=frontparts/bloc/yh-detail-other-plan.tpl}-->

        <!--{include file=frontparts/bloc/yh-detail-recommend.tpl}-->
        <!--{include file=frontparts/bloc/yh-detail-note.tpl}-->
        <!--{include file=frontparts/bloc/yh-footer-link.tpl}-->

      </main>
    </div>


  </form>

</div>

<script src="<!--{$TPL_URLPATH}-->/js/front/common.js"></script>


<script src="<!--{$TPL_URLPATH}-->/js/front/Chart.min.js"></script>
<script src="<!--{$TPL_URLPATH}-->/js/front/jquery.bxslider.min.js"></script>
<script>//<![CDATA[
//スライダー
$(document).ready(function(){
  $('.bxslider').bxSlider({
    pager: false,
    prevText: '',
    nextText: '',
    onSliderLoad:function(currentIndex){
      $('.bx-wrapper,.bx-prev,.bx-next').click(function(e){
        e.stopPropagation();
      });
    }
  });
});
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
   data: [5,3,3,2,4]
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


//]]></script>
