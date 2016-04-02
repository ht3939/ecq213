<!--{strip}-->
			<section>
				<div id="ranking">
					<h2 class="ranking-title">格安モバイルルーター 価格ランキング</h2>
					<p class="sub-title">格安モバイルルーターの価格動向を、ランキング形式でご覧いただけます。(毎週更新)</p>
					<div id="tabsbox" class="tabsbox">
						<!-- ソートタブ -->
			     <div class="">
					<div class="sort">
						<form name="search_navi_top" id="search_navi_top" action="?">
				          <input type="hidden" name="mode" value="filter" />
				          <input type="hidden" id="orderby" name="orderby" value="<!--{$orderby}-->" />
						</form>

						<!--{$smarty.capture.search_navi_body|smarty:nodefaults}-->
						<ul class="sort-tabs tabs-top">
							<li id="y1price"><a href="#tab0" <!--{if $tpl_orderby_y1price}-->class="selected"<!--{/if}-->>月額料金が安い順</a></li>
							<li id="totalprice"><a href="#tab1" <!--{if $tpl_orderby_totalprice}-->class="selected"<!--{/if}-->>2年間総額が安い順</a></li>
							<!--<li class="note-click">← タブをクリックで並び替え</li>-->
						</ul>

					</div>

					<div class="tabscont sort-contents">
						<div id="tab0">
							<div class="filter-contents">
								<div id="data0" class="filter-tabs-contents">
									<p class="search_num"><span><!--{$tpl_datanum}--></span>件中
										<!--{if $tpl_datanum==0}-->
										<span>0</span>
										<!--{else}-->
										<span>1〜<!--{if $tpl_datanum<5}--><!--{$tpl_datanum}--><!--{else}-->5<!--{/if}--></span>
										<!--{/if}-->


										件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">※表記の金額はすべて税抜価格となります。</span></p>
									<table class="ranking_table-caption">
										<tbody>
											<tr class="caption">
												<th class="rank-num">順位</th>
												<th class="rank-service">提供サービス元/<br />プラン</th>
												<th class="rank-device">対応端末</th>
												<th class="rank-price current"><!--{if $tpl_orderby_y1price}-->月額利用料
												<!--{else}-->2年間総額
												<!--{/if}--></th>
												<th class="rank-data">月額データ量/<br />
												下り最大速度</th>
												<th class="rank-conditions">主な特典/<br />注意事項</th>
												<th class="rank-company">詳細</th>
											</tr>
										</tbody>
									</table>
									<table class="ranking_table">
										<tbody>
											<!--{include file=products/yh-list-row-bloc.tpl}-->
										</tbody>
									</table>
									<p class="ranking-more js-ranking-more"></p>
								</div>

							</div>
						</div>
						<!--tabs No1-->
						<div id="tab1">
							<div class="filter-contents">
								<div id="data0" class="filter-tabs-contents">
									<p class="search_num"><span><!--{$tpl_datanum}--></span>件中
										<!--{if $tpl_datanum==0}-->
										<span>
										0</span>
										<!--{else}-->

										<span>
										1〜<!--{if $tpl_datanum<5}--><!--{$tpl_datanum}--><!--{else}-->5<!--{/if}--></span>
										<!--{/if}-->

										件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">※表記の金額はすべて税抜価格となります。</span></p>
									<table class="ranking_table-caption">
										<tbody>
											<tr class="caption">
												<th class="rank-num">順位</th>
												<th class="rank-service">提供サービス元/<br />プラン</th>
												<th class="rank-device">対応端末</th>
												<th class="rank-price current">総額利用料</th>
												<th class="rank-data">月額データ量/<br />
												下り最大速度</th>
												<th class="rank-conditions">主な特典/<br />注意事項</th>
												<th class="rank-company">詳細</th>
											</tr>
										</tbody>
									</table>
									<table class="ranking_table">
										<tbody>
											<!--{include file=products/yh-list-row-bloc.tpl}-->
										</tbody>
									</table>
									<p class="ranking-more js-ranking-more"></p>
								</div>

							</div>

						</div>

						<!--{if $tpl_datanum==0}-->
						<p class="zero">条件に一致する項目は見つかりませんでした。</p>
						<!--{/if}-->

					</div><!--tabscont-->


								<!-- ソートタブ -->
					<div class="sort-lower">
						<ul class="sort-tabs tabs-bottom">
							<li id="y1price"><a href="#tab0" <!--{if $tpl_orderby_y1price}-->class="selected"<!--{/if}-->>月額料金が安い順</a></li>
							<li id="totalprice"><a href="#tab1" <!--{if $tpl_orderby_totalprice}-->class="selected"<!--{/if}-->>2年間総額が安い順</a></li>
						</ul>
					</div>

					</div><!--tabs-->

				</div><!--#ranking-->
				<div class="note">
					<p> 表記の金額は表記の金額は特に記載のある場合を除き全て税抜となります。</p>
					<p> 月間のデータ量とは別に、混雑開始のため数日間で数GB以上の利用の際に速度を制限する商品もございます。詳細は各事業者のホームページよりご確認下さい。</p>
					<p> 当ランキングは月間データ量5GB以上の商品のみを掲載対象としております。</p>
					<p> 表示の回線速度は、送信時の技術規格上の最大値であり、実際の回線速度を示すものではありません。ご利用地域や環境によって最大通信速度は異なる場合があります。</p>
					<br>
					<p> 【月額料金が安い順の算出方法】<br>　※ ご契約初年度の月額利用料のうち、加入月割引などの金額を除外した料金で掲載しています</p>
					<br>
					<p> 【2年間のお支払い総額が安い順の算出方法】<br>　契約事務手数料+月額料金(2年間分)-割引金額(キャンペーン割引+月額割引) を元に算出しております。</p>
				</div>
			</section>
<!--{/strip}-->