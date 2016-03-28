<!--{strip}-->
      <section>
          <h2 class="title">その他のおすすめ</h2>
          <ul class="list-layout">

          <!--{if $arrRecommendProducts}-->
              <!--{assign var=rCCC value=$arrRecommendProducts.arrCC}-->
              <!--{foreach from=$arrRecommendProducts.dat item=rP key=gege name=arrRecommendProducts}-->
                <!--{assign var=rCC value=$rCCC[$rP.product_id]}-->

                <li class="box js-all-link">
                  <p class="logo"><img src="<!--{$TPL_URLPATH}--><!--{$rP.mk_image}-->" alt="<!--{$rP.maker_name}-->"></p>
                  <div class="pic-outer">
                    <ul class="pic bxslider">
                      <!--{foreach from=$rCC item=rc name=rCC}-->
                      <li><img src="<!--{$TPL_URLPATH}--><!--{$rc.cc_img_url1}-->" alt=""><br><span class="brand"><!--{$rc.cc_brand}--></span><br><span class="device"><!--{$rc.classcategory_name1}--></span></li>

                      <!--{/foreach}-->
                    </ul>
                  </div>
                  <p class="name"><!--{$rP.name}--><span></p>                      

                  <dl class="price <!--{$rP.rank1_order|sfGetRankClass}-->">
                    <dt>月額料金</dt>
                    <dd><!--{$rP.y1_price|number_format}--><span>円</span></dd>
                  </dl>
                  <dl class="price rank1">
                    <dt>総額料金</dt>
                    <dd><!--{$rP.total_price|number_format}--><span>円</span></dd>
                  </dl>
                  <div class="data">
                    <p>下り最大<br><span><!--{$rP.data_speed_down}-->Mbps</span></p>
                    <p>月間データ量<br><span>
                      <!--{if $rP.datasize==999}-->
                      上限なし
                      <!--{else}-->
                      <!--{$rP.datasize}-->GB
                      <!--{/if}-->
                    </span></p>
                  </div>
                  <p class="detail-btn"><a href="/products/detail.php?product_id=<!--{$rP.product_id}-->" class="js-link-btn">詳細はこちら</a></p>
                </li>


              <!--{/foreach}-->
          <!--{/if}-->
        </ul>
      </section>


      <section>
          <h2 class="title">その他のおすすめ</h2>
          <ul class="list-layout">
            <li class="box js-all-link">
              <p class="logo"><img src="img/item/yahoowifi/logo.png" alt="yahoo!JAPAN Wi-Fi"></p>
              <div class="pic-outer">
                <ul class="pic bxslider">
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                </ul>
              </div>
              <p class="name"><span>Y! Fi データプラン2(4G/LTE）</span></p>
              <dl class="price rank1">
                <dt>月額料金</dt>
                <dd>99,999<span>円</span></dd>
              </dl>
              <dl class="price rank1">
                <dt>総額料金</dt>
                <dd>9,999<span>円</span></dd>
              </dl>
              <div class="data">
                <p>下り最大<br><span>165Mbps</span></p>
                <p>月間データ量<br><span>上限なし</span></p>
              </div>
              <p class="detail-btn"><a href="" class="js-link-btn">詳細を見る</a></p>
            </li>
            <li class="box js-all-link">
              <p class="logo"><img src="img/item/yahoowifi/logo.png" alt="yahoo!JAPAN Wi-Fi"></p>
              <div class="pic-outer">
                <ul class="pic bxslider">
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                </ul>
              </div>
              <p class="name"><span>Y! Fi データプラン2(4G/LTE）</span></p>
              <dl class="price rank1">
                <dt>月額料金</dt>
                <dd>99,999<span>円</span></dd>
              </dl>
              <dl class="price rank1">
                <dt>総額料金</dt>
                <dd>9,999<span>円</span></dd>
              </dl>
              <div class="data">
                <p>下り最大<br><span>165Mbps</span></p>
                <p>月間データ量<br><span>上限なし</span></p>
              </div>
              <p class="detail-btn"><a href="" class="js-link-btn">詳細を見る</a></p>
            </li>
            <li class="box js-all-link">
              <p class="logo"><img src="img/item/yahoowifi/logo.png" alt="yahoo!JAPAN Wi-Fi"></p>
              <div class="pic-outer">
                <ul class="pic bxslider">
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                  <li><img src="img/item/yahoowifi/502hw-photo.png" alt=""><br><span class="brand">Huawei</span><br><span class="device">Pocket WiFi 502HW</span></li>
                </ul>
              </div>
              <p class="name"><span>Y! Fi データプラン2(4G/LTE）</span></p>
              <dl class="price rank1">
                <dt>月額料金</dt>
                <dd>99,999<span>円</span></dd>
              </dl>
              <dl class="price rank1">
                <dt>総額料金</dt>
                <dd>9,999<span>円</span></dd>
              </dl>
              <div class="data">
                <p>下り最大<br><span>165Mbps</span></p>
                <p>月間データ量<br><span>上限なし</span></p>
              </div>
              <p class="detail-btn"><a href="" class="js-link-btn">詳細を見る</a></p>
            </li>
          </ul>
      </section>
<!--{/strip}-->