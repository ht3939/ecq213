 <!--{strip}-->
      <section>
          <h2 class="title">このプランの詳細について</h2>
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
                <!--{if $arrProduct.y1_price==$arrProduct.y2_price}-->
                <!--{assign var=gptn value="ptn1"}-->

                <!--{/if}-->
                <!--{if $arrProduct.y1_price > $arrProduct.y2_price}-->
                <!--{assign var=gptn value="ptn2"}-->

                <!--{/if}-->
                <!--{if $arrProduct.y1_price < $arrProduct.y2_price}-->
                <!--{assign var=gptn value="ptn3"}-->

                <!--{/if}-->

                <div class="graph <!--{$gptn}-->">
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
              <dd><!--{$arrProduct.main_list_comment|h}--></dd>
            </dl>
            <p class="link-btn"><a href="<!--{$arrProduct.mk_site_url}-->">このプランのページへ</a></p>
            <p class="link-blank-nav">(外部サイトへ)</p>
          </div>
      </section>
 
 <!--{/strip}-->
