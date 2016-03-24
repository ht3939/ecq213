 <!--{strip}-->
        <section>
          <div class="title-name">
            <p class="logo"><img src="<!--{$TPL_URLPATH}--><!--{$arrProduct.mk_image}-->" alt="<!--{$arrProduct.maker_name}-->"></p>
            <div class="title">
              <p class="name"><!--{$arrProduct.name}--></p>
              <!--{assign var=y2p value=$arrProduct.y2_price|number_format}-->
              <p class="condition"><!--{$arrProduct.main_list_comment|replace:"{*}":$y2p}--></p>
            </div>
          </div>
        <div class="detail-data">
          <dl class="ptn1">
            <dt>主な特典</dt>
            <dd><!--{$arrProduct.sub_comment2|h}--></dd>
          </dl>
          <dl class="ptn2">
            <dt>注意事項</dt>
            <dd><!--{$arrProduct.sub_comment3|h}--></dd>
          </dl>
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
            <img src="<!--{$TPL_URLPATH}-->img/detail/tag5.png" alt="" class="tag">
            <p class="head">項目別スコア</p>
              <div class="detail">
                <ul class="rank-list">
                  <li class="<!--{$arrProduct.rank1_order|sfGetRankClass}-->">月額料金</li>
                  <li class="<!--{$arrProduct.rank3_order|sfGetRankClass}-->">月間データ量</li>
                  <li class="<!--{$arrProduct.rank5_order|sfGetRankClass}-->">上り最大速度</li>
                  <li class="<!--{$arrProduct.rank4_order|sfGetRankClass}-->">下り最大速度</li>
                  <li class="<!--{$arrProduct.rank2_order|sfGetRankClass}-->">お支払総額</li>
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
          <div class="device-content js-device-content">

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
 <!--{/strip}-->
