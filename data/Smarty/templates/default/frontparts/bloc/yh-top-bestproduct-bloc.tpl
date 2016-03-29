<!--{strip}-->
<div class="top-container">
  <section>
  <!--{if $arrBestProducts.dat}-->
  <!--{assign var=bt value=$arrBestProducts.dat}-->
  <!--{assign var=cc value=$arrBestProducts.arrCC[$bt.product_id]}-->

  <!--{/if}-->


    <div id="weekly-top">
      <div class="weekly-top-head">
        <img src="<!--{$TPL_URLPATH}-->/img/index/ribbon.png" class="ribbon">
        <h1>今週の総合TOP</h1>
      </div>
      <div class="weekly-top-in clearfix">
        <div class="title-name">
          <p class="logo"><img src="<!--{$TPL_URLPATH}--><!--{$bt.mk_image}-->" alt="<!--{$bt.maker_name}-->"></p>
          <ul class="topbxslider">
          <!--{foreach from=$cc item=r key=k name=cc}-->
            <li>
              <div class="pic">
                <img src="<!--{$TPL_URLPATH}--><!--{$r.cc_image}-->" alt="">
              </div>
              <div class="title">
                <p><!--{$r.classcategory_name1}--></p>
              </div>
            </li>

          <!--{/foreach}-->
          </ul>
        </div>
        <div class="rank-graph clearfix">
            <div class="detail">

              <div class="rank-list">
                <img src="<!--{$TPL_URLPATH}-->/img/index/crown.png" class="tag">
                <p class="head">項目別ランキング</p>
                <table>
                  <tbody>
                    <tr>
                      <th>月額料金</th>
                      <td class="price-monthly rank<!--{$bt.rank1_order}-->"><span class="f26"><!--{$bt.y1_price|number_format}--></span>円</td>
                    </tr>
                    <tr>
                      <th>お支払総額</th>
                      <td class="price-sum rank<!--{$bt.rank2_order}-->"><span class="f26"><!--{$bt.total_price|number_format}--></span>円</td>
                    </tr>
                    <tr>
                      <th>月間データ量</th>
                      <td class="traffic-monthly rank<!--{$bt.rank3_order}-->"><span class="f20"><!--{$bt.datasize}--></span>GB</td>
                    </tr>
                    <tr>
                      <th>下り最大速度</th>
                      <td class="downspeed rank<!--{$bt.rank4_order}-->"><span class="f20"><!--{$bt.data_speed_down}--></span>Mbps</td>
                    </tr>
                    <tr>
                      <th>上り最大速度</th>
                      <td class="upspeed rank<!--{$bt.rank5_order}-->"><span class="f20"><!--{$bt.data_speed_up}--></span>Mbps<!--{if $bt.rank5_order>3}--><span class="<!--{$bt.rank5_order|sfGetRankClass}-->"><!--{$bt.rank5_order}-->位</span><!--{/if}--></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="graph">
                <p class="status1">月額料金<br><span class="rank"><!--{$bt.rank1_order}-->位</span><br><span class="data">（<!--{$bt.y1_price|number_format}-->円）</span></p>
                <p class="status2">お支払総額<br><span class="rank"><!--{$bt.rank2_order}-->位</span><br><span class="data">（<!--{$bt.total_price|number_format}-->円）</span></p>
                <p class="status3">月間データ量<br><span class="rank"><!--{$bt.rank3_order}-->位</span><br><span class="data">（<!--{$bt.datasize}-->GB）</span></p>
                <p class="status4">下り最大速度<br><span class="rank"><!--{$bt.rank4_order}-->位</span><br><span class="data">（<!--{$bt.data_speed_down}-->Mbps）</span></p>
                <p class="status5">上り最大速度<br><span class="rank"><!--{$bt.rank5_order}-->位</span><br><span class="data">（<!--{$bt.data_speed_up}-->Mbps）</span></p>
                <canvas id="canvas" width="185" height="185"></canvas>
                <p class="score"><span><!--{$bt.rankpoint_order}--></span>点</p>
              </div>
            </div>
        </div>
      </div>
      <ul class="btn">
        <li class="btn-inner"><a href="/products/detail.php?product_id=<!--{$bt.product_id}-->" class="btn-detail">詳細を見る</a></li>
        <li class="btn-inner"><a href="<!--{$bt.mk_site_url}-->" class="btn-site">サイトを見る</a></li>
      </ul>
    </div>
    </section>
</div>
<!--{/strip}-->