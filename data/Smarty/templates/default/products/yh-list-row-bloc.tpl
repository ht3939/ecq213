<!--{strip}-->
	<!--{if $arrProducts}-->
		<!--{assign var=rcnt value=1}-->

		<!--{assign var=rCCC value=$arrClassCat1}-->

		<!--{foreach from=$arrProducts item=rP key=gege name=arrProducts}-->

			<!--{assign var=rCC value=$rCCC[$rP.product_id]}-->


				<!--{if $rcnt<=3}-->
					<tr class="js-ranking-item rank<!--{$rcnt}-->">
				<!--{else}-->
					<tr class="js-ranking-item">
				<!--{/if}-->
						<td class="rank-num">
							<span class="rank">
							<!--{if $rcnt<=3}-->
									<img src="<!--{$TPL_URLPATH}-->/img/common/rank<!--{$rcnt}-->-L.png" alt="<!--{$rcnt}-->位">
							<!--{else}-->
									<span class="rank-4more"><!--{$rcnt}-->位</span>
							<!--{/if}-->
							</span>
						</td>

					 	<td class="rank-service">
							<div class="td-inner">
								<div class="logo"><img src="<!--{$TPL_URLPATH}--><!--{$rP.mk_image}-->" alt="<!--{$rP.maker_name}-->"></div>
								<div class="title">
									<p class="plan-name"><!--{$rP.name}--></p>
								</div>
							</div>
						</td>

						<td class="rank-name">
							<div class="td-inner">
								<div class="pic-outer">
									<ul class="pic bxslider">
										<!--{foreach from=$rCC item=rc key=k}-->

										<li>
										<img src="<!--{$TPL_URLPATH}--><!--{$rc.cc_image}-->" alt="">
										<div class="status">
											<p class="name"><span><!--{$rc.cc_brand}--></span><br><!--{$rc.classcategory_name1}--></p>
										</div>
										</li>
										<!--{/foreach}-->
									</ul>
								</div>
							</div>
						</td>

						<td <!--{if $rcnt>3}-->class="rank-price"<!--{else}-->class="rank-price rank<!--{$rcnt}-->"<!--{/if}-->>
							<div class="td-inner w140"><span>
								<!--{if $tpl_orderby_totalprice}-->
								<!--{$rP.total_price|number_format}-->
								<!--{else}-->
								<!--{$rP.y1_price|number_format}-->
								<!--{/if}-->

							</span>円</div>
						</td>

						<td class="rank-data">
							<div class="td-inner w110">
							<span>
		                      <!--{if $rP.datasize==999}-->
								<span class="none-limit">上限なし</span></span>
		                      <!--{else}-->
								<span class="num"><!--{$rP.datasize}--></span><span class="gb">GB</span></span>/月
		                      <!--{/if}-->
								<span class="speed"><!--{$rP.data_speed_down}-->Mbps</span>
							</div>
						</td>
						<td class="rank-conditions">
							<div class="td-inner">
								<!--{if $rP.sub_comment2|count_characters>0}-->
								<span class="head ptn1">主な特典</span><br>
							<span class="text-ptn1"><!--{$rP.sub_comment2}--></span><br>
								<!--{/if}-->
								<!--{if $rP.sub_comment3|count_characters>0}-->
							<span class="head ptn2">注意事項</span><br>
							<span class="text-ptn2"><!--{$rP.sub_comment3}--></span>
								<!--{/if}-->

							</div>
						</td>

						<td class="rank-company">
							<div class="td-inner w110">
								<p class="site_btn"><a href="/products/detail.php?product_id=<!--{$rP.product_id}-->" target="device">詳細を見る</a></p>
								<div class="site-link">
								<a href="<!--{$rP.mk_site_url}-->" target="device"><img src="<!--{$TPL_URLPATH}--><!--{$rP.mk_img_url1}-->" alt=""><!--{$rP.maker_name}--></a>
								<!--{if $rP.maker_id > 1}-->
								<span class="outer-site">(外部サイトへ)</span>
								<!--{else}-->
								<span class="outer-site">(Yahoo! Wi-Fi)</span>
								<!--{/if}-->
								</div>
							</div>
						</td>
					</tr>
			<!--{assign var=rcnt value=$rcnt+1}-->


		<!--{/foreach}-->
	<!--{/if}-->


<!--{/strip}-->
