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
<!--{strip}-->
			<section>
				<div id="ranking">
					<h1 class="title">格安モバイルルーター 価格ランキング<span>最終更新日時：2016年03月14日</span></h1>

					<div id="tabsbox" class="tabsbox">
						<!-- ソートタブ -->
						<div class="sort">

				            <form name="search_navi_top" id="search_navi_top" action="?">

				                <!--{$smarty.capture.search_navi_body|smarty:nodefaults}-->
				            </form>
							<p class="arrow-down"><img src="<!--{$TPL_URLPATH}-->img/index/icon-arrow-down.png"></p>
							<ul class="sort-tabs tabs-top">

							<!--{if strlen($tpl_orderby_y1price)>0}-->
							<!--{assign var=t value='class="selected"'}-->
							<!--{/if}-->
							<!--{if strlen($tpl_orderby_totalprice)>0}-->
							<!--{assign var=t1 value='class="selected"'}-->
							<!--{/if}-->
	
							  <li><a href="#tab0" <!--{$t}-->>月額料金が安い順</a></li>
							  <li><a href="#tab1" <!--{$t1}-->>2年総額が安い順</a></li>
							  <!--<li class="note-click">← タブをクリックで並び替え</li>-->
							</ul>
						</div>

						<div class="tabscont sort-contents">
						  <div id="tab0">
						        <!-- フィルタータブ -->
								<!-- 		            <div class="filter">
						        	<p><span>月間データ量の選択</span></p>
						        	<ul class="filter-tabs">
						        	  <li><a href="#data0" class="selected filter-btn">5GB以上すべて</a></li>
						        	  <li><a href="#data1" class="filter-btn">5GB以上～8GB未満</a></li>
						        	  <li><a href="#data2" class="filter-btn">8GB以上～上限ナシ<span>※1</span></a></li>
						        	</ul>
						        </div> -->
						  	<div class="filter-contents">
						  		<div id="data0" class="filter-tabs-contents">
						  			<p class="search_num"><span>10</span>件中<span>1〜5</span>件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">※表記の金額はすべて税抜価格となります。</span></p>
						  			<table class="ranking_table-caption">
						  				<tbody>
						  					<tr class="caption">
						  						<th class="rank-num">順位</th>
						  						<th class="rank-service">提供サービス元/<br />プラン</th>
						  						<th class="rank-name">対応端末</th>
						  						<th class="rank-price current">月額利用料</th>
						  						<th class="rank-data">月額データ量/<br />
						  						下り最大速度</th>
						  						<th class="rank-conditions">主な特典/<br />注意事項</th>
						  						<th class="rank-company">詳細</th>
						  					</tr>
						  				</tbody>
						  			</table>
						  			<table class="ranking_table">
						  				<tbody>
						  					<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<img src="<!--{$TPL_URLPATH}-->img/common/rank1-L.png" alt="1位">		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="<!--{$TPL_URLPATH}-->img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price r1">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<img src="<!--{$TPL_URLPATH}-->img/common/rank2-L.png" alt="2位">		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="<!--{$TPL_URLPATH}-->img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price r2">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<img src="<!--{$TPL_URLPATH}-->img/common/rank3-L.png" alt="3位">		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="<!--{$TPL_URLPATH}-->img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price r3">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">4位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="<!--{$TPL_URLPATH}-->img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">5位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">6位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">7位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">8位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">9位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">10位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
						  				</tbody>
						  			</table>
						  			<p class="ranking-more js-ranking-more"></p>
						  		</div>


						  	</div>
						  </div>
						  <div id="tab1">
						        <!-- フィルタータブ -->
								<!-- 		            <div class="filter">
						        	<p><span>月間データ量の選択</span></p>
						        	<ul class="filter-tabs">
						        	  <li><a href="#data0" class="selected filter-btn">5GB以上すべて</a></li>
						        	  <li><a href="#data1" class="filter-btn">5GB以上～8GB未満</a></li>
						        	  <li><a href="#data2" class="filter-btn">8GB以上～上限ナシ<span>※1</span></a></li>
						        	</ul>
						        </div> -->
						  	<div class="filter-contents">
						  		<div id="data0" class="filter-tabs-contents">
						  			<p class="search_num"><span>10</span>件中<span>1〜5</span>件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">※表記の金額はすべて税抜価格となります。</span></p>
						  			<table class="ranking_table-caption">
						  				<tbody>
						  					<tr class="caption">
						  						<th class="rank-num">順位</th>
						  						<th class="rank-service">提供サービス元/<br />プラン</th>
						  						<th class="rank-name">対応端末</th>
						  						<th class="rank-price current">利用料</th>
						  						<th class="rank-data">月額データ量/<br />
						  						下り最大速度</th>
						  						<th class="rank-conditions">主な特典/<br />注意事項</th>
						  						<th class="rank-company">詳細</th>
						  					</tr>
						  				</tbody>
						  			</table>
						  			<table class="ranking_table">
						  				<tbody>
						  					<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<img src="<!--{$TPL_URLPATH}-->img/common/rank1-L.png" alt="1位">		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="<!--{$TPL_URLPATH}-->img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price r1">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<img src="<!--{$TPL_URLPATH}-->img/common/rank2-L.png" alt="2位">		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="<!--{$TPL_URLPATH}-->img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price r2">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<img src="<!--{$TPL_URLPATH}-->img/common/rank3-L.png" alt="3位">		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="<!--{$TPL_URLPATH}-->img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price r3">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">4位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="<!--{$TPL_URLPATH}-->img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="<!--{$TPL_URLPATH}-->img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">5位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">6位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">7位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">8位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">9位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
											<tr class="js-ranking-item">
												<td class="rank-num">
													<span class="rank">
													<span class="rank-4more">10位</span>		</span>
												</td>

											 	<td class="rank-service">
													<div class="td-inner">
														<div class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></div>
														<div class="title">
															<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
														</div>
													</div>
												</td>

												<td class="rank-name">
													<div class="td-inner">
														<div class="pic-outer">
															<ul class="pic bxslider">
																<li>
																<img src="/img/item/w01.png" alt="">
																<div class="status">
																	<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
																<li>
																	<img src="/img/item/w01.png" alt="">
																	<div class="status">
																		<p class="name"><span>Huawei</span><br>Speed Wi-Fi NEXT W01</p>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</td>

												<td class="rank-price">
													<div class="td-inner w140"><span>2,480</span>円</div>
												</td>

												<td class="rank-data">
													<div class="td-inner w110">
													<span><span class="num">7</span><span class="gb">GB</span></span>/月<span class="speed">110Mbps</span>
													</div>
												</td>

												<td class="rank-conditions">
													<div class="td-inner">Yahoo! プレミアム会員（月額462円/税別）が必要</div>
												</td>

												<td class="rank-company">
													<div class="td-inner w110">
														<p class="site_btn"><a href="http://wifi.yahoo.co.jp/campaign/plan" target="_blank">詳細を見る</a></p>
														<div class="site-link"><a href="http://wifi.yahoo.co.jp/" target="_blank" class="yahoo">Yahoo! Wi-Fi</a><span class="outer-site">(外部サイトへ)</span></div>
													</div>
												</td>
											</tr>
						  				</tbody>
						  			</table>
						  			<p class="ranking-more js-ranking-more"></p>
						  		</div>


						  	</div>
						  </div>
						</div><!--tabscont-->


						<!-- ソートタブ -->
						<div class="sort-lower">
							<ul class="sort-tabs tabs-bottom">
							  <li><a href="#tab0" <!--{$t}-->>月額料金が安い順</a></li>
							  <li><a href="#tab1" <!--{$t1}-->>2年総額が安い順</a></li>
							  <li class="note-click">← タブをクリックで並び替え</li>
							</ul>
						</div>

					</div><!--tabs-->
				</div><!--#ranking-->
			</section>

<!--{/strip}-->
