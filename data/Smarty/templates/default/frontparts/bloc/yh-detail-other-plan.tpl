<!--{strip}-->

      <section>
          <h2 class="title"><!--{$arrProduct.maker_name}--> の別プラン</h2>
          <ul class="list-layout">

          <!--{if $arrOtherPlanProducts}-->
              <!--{assign var=rCCC value=$arrOtherPlanProducts.arrCC}-->
              <!--{foreach from=$arrOtherPlanProducts.dat item=rP key=gege name=arrOtherPlanProducts}-->
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
                  <p class="name"><span><!--{$rP.name}--></span></p>
                  <dl class="price <!--{$rP.rank1_order|sfGetRankClass}-->">
                    <dt>月額料金</dt>
                    <dd><!--{$rP.y1_price|number_format}--><span>円</span></dd>
                  </dl>
                  <dl class="price <!--{$rP.rank2_order|sfGetRankClass}-->">
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
                  <p class="detail-btn"><a href="/products/detail.php?product_id=<!--{$rP.product_id}-->" class="js-link-btn">詳細を見る</a></p>
                </li>


              <!--{/foreach}-->
          <!--{/if}-->

          </ul>
      </section>
      <div class="note">
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
      </div>      
<!--{/strip}-->