      <section>
        <div class="title-name">
          <p class="logo"><img src="<!--{$TPL_URLPATH}--><!--{$arrProduct.mk_image}-->" alt=""></p>
          <div class="title">
            <p class="condition"><!--{$arrProduct.main_list_comment|h}--></p>
          </div>
        </div>
        <!--{if $arrProduct.sub_comment2|strlen>0 or $arrProduct.sub_comment3|strlen>0}-->
        <div class="detail-data">
          <dl class="ptn1">
            <!--{if $arrProduct.sub_comment2|strlen>0}-->
            <dt>主な特典</dt>
            <dd><!--{$arrProduct.sub_comment2|h}--></dd>
            <!--{/if}-->
          </dl>
          <dl class="ptn2">
            <!--{if $arrProduct.sub_comment3|strlen>0}-->
            <dt>注意事項</dt>
            <dd><!--{$arrProduct.sub_comment3|h}--></dd>
            <!--{/if}-->
          </dl>
        </div>
        <!--{/if}-->
        <div class="data-boxs">
          <ul class="top-data">
            <li class="<!--{$arrProduct.rank1_order|sfGetRankClass}-->">
            <img src="<!--{$TPL_URLPATH}-->img/detail/tag1.png" alt="" class="tag">
              <p class="head">月額料金</p>
              <p class="data"><!--{$arrProduct.y1_price|number_format}--><span>円</span><!--{if $arrProduct.rank1_order>3}--><span class="rank-tag"><!--{$arrProduct.rank1_order}-->位</span><!--{/if}--></p>
            </li>
            <li class="<!--{$arrProduct.rank2_order|sfGetRankClass}-->">
            <img src="<!--{$TPL_URLPATH}-->img/detail/tag2.png" alt="" class="tag">
              <p class="head">お支払い総額</p>
              <p class="data"><!--{$arrProduct.total_price|number_format}--><span>円</span><!--{if $arrProduct.rank2_order>3}--><span class="rank-tag"><!--{$arrProduct.rank2_order}-->位</span><!--{/if}--></p>
            </li>
            <li class="<!--{$arrProduct.rank3_order|sfGetRankClass}-->">
            <img src="<!--{$TPL_URLPATH}-->img/detail/tag3.png" alt="" class="tag">
              <p class="head">月間データ量</p>
              <p class="data">
                <!--{if $arrProduct.datasize==999}-->
                <span>上限なし</span><!--{if $arrProduct.rank3_order>3}--><span class="rank-tag"><!--{$arrProduct.rank3_order}-->位</span><!--{/if}--></p>
                <!--{else}-->
                <!--{$arrProduct.datasize}--><span>GB/月</span><!--{if $arrProduct.rank3_order>3}--><span class="rank-tag"><!--{$arrProduct.rank3_order}-->位</span><!--{/if}--></p>
                <!--{/if}-->
            </li>
            <li class="<!--{$arrProduct.rank4_order|sfGetRankClass}-->">
            <img src="<!--{$TPL_URLPATH}-->img/detail/tag4.png" alt="" class="tag">
              <p class="head">下り最大速度<span>※</span></p>
              <p class="data"><!--{$arrProduct.data_speed_down}--><span>Mbps</span><!--{if $arrProduct.rank4_order>3}--><span class="rank-tag"><!--{$arrProduct.rank4_order}-->位</span><!--{/if}--></p>
            </li>
          </ul>
          <div class="rank-graph">
            <img src="<!--{$TPL_URLPATH}-->img/detail/tag5.png" alt="" class="tag">
            <p class="head">項目別スコア</p>
            <div class="detail">
              <ul class="rank-list">

                <li class="<!--{$arrProduct.rank1_order|sfGetRankClass:true}-->">月額料金<!--{if $arrProduct.rank1_order>3}--><span class="rank-tag"><!--{$arrProduct.rank1_order}-->位</span><!--{/if}--></li>
                <li class="<!--{$arrProduct.rank3_order|sfGetRankClass:true}-->">月間データ量<!--{if $arrProduct.rank3_order>3}--><span class="rank-tag"><!--{$arrProduct.rank3_order}-->位</span><!--{/if}--></li>
                <li class="<!--{$arrProduct.rank5_order|sfGetRankClass:true}-->">上り最大速度<!--{if $arrProduct.rank5_order>3}--><span class="rank-tag"><!--{$arrProduct.rank5_order}-->位</span><!--{/if}--></li>
                <li class="<!--{$arrProduct.rank4_order|sfGetRankClass:true}-->">下り最大速度<!--{if $arrProduct.rank4_order>3}--><span class="rank-tag"><!--{$arrProduct.rank4_order}-->位</span><!--{/if}--></li>
                <li class="<!--{$arrProduct.rank2_order|sfGetRankClass:true}-->">お支払総額<!--{if $arrProduct.rank2_order>3}--><span class="rank-tag"><!--{$arrProduct.rank2_order}-->位</span><!--{/if}--></li>


              </ul>
              <div class="graph">
                <p class="status1">月額料金<br><span class="rank"><!--{$arrProduct.rank1_order}-->位</span><br><span class="data">（<!--{$arrProduct.y1_price|number_format}-->円）</span></p>
                <p class="status2">お支払総額<br><span class="rank"><!--{$arrProduct.rank2_order}-->位</span><br><span class="data">（<!--{$arrProduct.total_price|number_format}-->円）</span></p>
                <p class="status3">月間データ量<br><span class="rank"><!--{$arrProduct.rank3_order}-->位</span><br><span class="data">（<!--{if $arrProduct.datasize==999}-->上限なし<!--{else}--><!--{$arrProduct.datasize}-->GB<!--{/if}-->）</span></p>
                <p class="status4">下り最大速度<br><span class="rank"><!--{$arrProduct.rank4_order}-->位</span><br><span class="data">（<!--{$arrProduct.data_speed_down}-->Mbps）</span></p>
                <p class="status5">上り最大速度<br><span class="rank"><!--{$arrProduct.rank5_order}-->位</span><br><span class="data">（<!--{$arrProduct.data_speed_up}-->Mbps）</span></p>
                <canvas id="canvas" width="185" height="185"></canvas>
                <p class="score"><span><!--{$arrProduct.rankpoint_order}--></span>点</p>
              </div>
            </div>
          </div>
        </div>
        <div class="device-content js-device-content">
          <!--{foreach from=$arrClassCat1 item=arrCC1 name=arrCC1}-->

            <div class="device-data <!--{if $smarty.foreach.arrCC1.first}-->active<!--{/if}-->">
            <img src="<!--{$TPL_URLPATH}-->img/detail/tag6.png" alt="" class="tag">
            <div class="image">
              <p class="head">選べる対応端末</p>
              <p class="pic"><img src="<!--{$TPL_URLPATH}--><!--{$arrCC1.cc_image}-->" alt=""></p>
            </div>
            <div class="detail">
                <p class="date">発売：<!--{$arrCC1.cc_release_date|date_format:"%Y年%m月%d日"}--></p>
              <p class="device-name"><span><!--{$arrCC1.cc_brand}--></span><br><!--{$arrCC1.classcategory_name1}--></p>
              <div class="colors">
                <!--{assign var=arrColor value=$arrCC1.cc_color|sfGetColorClassArray}-->
                <!--{foreach from=$arrColor item=v key=k}-->
                <p class="<!--{$k}-->"><!--{$v}--></p>
                <!--{/foreach}-->
              </div>
              <ul class="data-list">
                <li>
                  <dl class="data js-height">
                    <dt>下り<br>通信速度</dt>
                    <dd>最大<span class="num"><!--{$arrCC1.cc_data_speed_down}--></span>Mbps</dd>
                  </dl>
                </li>
                <li>
                  <dl class="data js-height">
                    <dt>上り<br>通信速度</dt>
                    <dd>最大<span class="num"><!--{$arrCC1.cc_data_speed_up}--></span>Mbps</dd>
                  </dl>
                </li>
              </ul>
              <p class="link-btn"><a href="<!--{$arrCC1.pc_url}-->" target="_blnak">この商品ページへ</a></p>
              <p class="blank-nav">
                <!--{if $arrProduct.maker_id > 1}-->
          (外部サイトへ)
                <!--{else}-->
          (Yahoo! Wi-Fi)
                <!--{/if}-->
              </p>
            </div>
          </div>
          <!--{/foreach}-->

        </div>
        <table class="device-list-tab js-device-tab">
          <tr>
            <!--{foreach from=$arrClassCat1 item=arrCC1 name=arrCC1}-->

            <td <!--{if $smarty.foreach.arrCC1.first}-->class="active"<!--{/if}-->>
              <div class="inner">
                <p class="pic"><img src="<!--{$TPL_URLPATH}--><!--{$arrCC1.cc_image}-->" alt=""></p>
                <div class="name"><!--{$arrCC1.classcategory_name1}--></div>
              </div>
            </td>
            <!--{/foreach}-->

          </tr>
        </table>
      </section>

