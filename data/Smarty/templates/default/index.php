<?php
/*
# トップページ
*/



//----------------------------------------------------------------------------------------------------
## 共通のファイルを読み込む
//----------------------------------------------------------------------------------------------------
include_once('./lib/common.php');



//----------------------------------------------------------------------------------------------------
## <head>内のユニークな記述を設定する
//----------------------------------------------------------------------------------------------------
$meta_title = SITE_NAME.' - Yahoo!買い物ナビゲーター';
$meta_keywords = ' モバイルルーター,Wi-Fi,価格,比較,ランキング';//当ページのキーワードを半角カンマ区切りで3個以上～5個以内で記述する。半角カンマの前後は半角スペースを入れてはいけない。
$meta_description = '';//当ページの概要分を約110文字で記述する。
$link_canonical = 'http://kainavi.yahoo-net.jp/';//基本的に当ページのURLを記述する
$link_alternate = 'Yahoo!買い物ナビゲーターの格安モバイルルーター価格ランキングなら、お得なモバイルルータが一目で分かる！月額料金、2年総額、月間データ量などの項目から、自分にぴったりのルーターをお探しください。';//基本的に対応するSPサイトのURLを記述する



?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<?php echo $head_top; ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=<?php echo META_VIEWPORT_WIDTH; ?>">
	<meta name="format-detection" content="telephone=no">
	<?php if(!empty($meta_keywords)): ?>
	<meta name="keywords" content="<?php echo $meta_keywords; ?>">
	<?php endif; ?>
	<?php if(!empty($meta_description)): ?>
	<meta name="description" content="<?php echo $meta_description; ?>">
	<?php endif; ?>
	<meta property="og:site_name" content="<?php echo SITE_NAME; ?>">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $meta_title; ?>">
	<meta property="og:url" content="<?php echo OG_URL_CONTENT; ?>">
	<meta property="og:image" content="<?php echo OG_IMAGE_CONTENT; ?>">
	<?php if(!empty($meta_description)): ?>
	<meta property="og:description" content="<?php echo $meta_description; ?>">
	<?php endif; ?>
	<title><?php echo $meta_title; ?></title>
	<?php if(!empty($link_canonical)): ?>
	<link rel="canonical" href="<?php echo $link_canonical; ?>">
	<?php endif; ?>
	<?php if(!empty($link_alternate)): ?>
	<link rel="alternate" href="<?php echo $link_alternate; ?>" media="only screen and (max-width: 640px)">
	<?php endif; ?>
	<link rel="shortcut icon" href="<?php echo 'https://'.$_SERVER['SERVER_NAME']; ?>/favicon.ico">
	<link rel="stylesheet" href="css/general/common.css">
	<link rel="stylesheet" href="css/general/index.css">
	<link rel="stylesheet" href="css/general/sumoselect.css">
	<?php echo $head_end; ?>
</head>

<body>
<?php echo $body_top; ?>
<?php include_once('./lib/front/general/header.php'); ?>
<div id="mainv">
  <div class="base-container">
    <img src="<?php echo SITE_ROOT_DIR; ?>img/header/mainv.png" alt="一番安い！がすぐ分かる！">
  </div>
</div>
<div class="top-data">
	<div class="inner">
		<div class="update-date"><p>ランキング最終更新日：2016年03月01日</p></div>
		<div class="sns-list"></div>
	</div>
</div>
<div class="top-container">
	<section>
		<div id="weekly-top">
			<div class="weekly-top-head">
				<img src="./img/index/ribbon.png" class="ribbon">
				<h1>今週の総合TOP</h1>
			</div>
			<div class="weekly-top-in clearfix">
				<div class="title-name">
					<p class="logo"><img src="./img/index/Yahoo-wifi-logo.png" alt="Yahoo!JAPAN Wi-Fi"></p>
					<ul class="topbxslider">
						<li>
							<div class="pic">
								<img src="./img/item/w01.png" alt="">
							</div>
							<div class="title">
								<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
							</div>
						</li>
						<li>
							<div class="pic">
								<img src="./img/item/w01.png" alt="">
							</div>
							<div class="title">
								<p>Y!Fi2年間ずーっと<br>得するプラン(4G)</p>
							</div>
						</li>
					</ul>
				</div>
				<div class="rank-graph clearfix">
						<div class="detail">

							<div class="rank-list">
								<img src="./img/index/crown.png" class="tag">
								<p class="head">項目別ランキング</p>
								<table>
									<tbody>
										<tr>
											<th>月額料金</th>
											<td class="price-monthly rank1"><span class="f26">1,980</span>円</td>
										</tr>
										<tr>
											<th>お支払総額</th>
											<td class="price-sum rank3"><span class="f26">59,800</span>円</td>
										</tr>
										<tr>
											<th>月間データ量</th>
											<td class="traffic-monthly rank2"><span class="f20">7</span>GB</td>
										</tr>
										<tr>
											<th>下り最大速度</th>
											<td class="downspeed rank3"><span class="f20">110</span>Mbps</td>
										</tr>
										<tr>
											<th>上り最大速度</th>
											<td class="upspeed rank4"><span class="f20">10</span>Mbps<span class="rank-4more">4位</span></td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="graph">
								<p class="status1">月額料金<br><span class="rank">1位</span><br><span class="data">（1,980円）</span></p>
								<p class="status2">お支払総額<br><span class="rank">3位</span><br><span class="data">（59,800円）</span></p>
								<p class="status3">月間データ量<br><span class="rank">2位</span><br><span class="data">（7GB）</span></p>
								<p class="status4">下り最大速度<br><span class="rank">3位</span><br><span class="data">（110Mbps）</span></p>
								<p class="status5">上り最大速度<br><span class="rank">2位</span><br><span class="data">（10Mbps）</span></p>
								<canvas id="canvas" width="185" height="185"></canvas>
								<p class="score"><span>3.6</span>点</p>
							</div>
						</div>
				</div>
			</div>
			<ul class="btn">
				<li class="btn-inner"><a href="" class="btn-detail">詳細を見る</a></li>
				<li class="btn-inner"><a href="" class="btn-site">サイトを見る</a></li>
			</ul>
		</div>
		</section>
</div>

<div class="row-container is-reverse">
	<div class="main-column">
		<main>
			<section>
				<div id="ranking">
					<h2 class="ranking-title">格安モバイルルーター 価格ランキング</h2>
					<p class="sub-title">格安モバイルルーターの価格動向を、ランキング形式でご覧いただけます。(毎週更新)</p>
					<div id="tabsbox" class="tabsbox">
						<!-- ソートタブ -->
			<div class="">
	            <div class="sort">
		            <div class="sort-filter-btn">
		            	<p class="btn">比較する条件を変更する</p>
		            </div>
	            	<div class="sort-filter">
	            		<p class="sort-head">比較する条件を変更する<span class="clear-all-sort">すべての条件を解除する</span></p>
						<table class="sort-condition">
							<tbody>
								<tr>
									<th>月間データ量
										<div class="clear-sort"><img src="./img/index/icon-filter-reset.png" alt="この条件を解除する"></div>
										<select name="" id="" class="js-select">
											<option value="" selected>すべて</option>
											<option value="">A</option>
											<option value="">B</option>
										</select>
									</th>

									<th>下り最大速度
										<div class="clear-sort"><img src="./img/index/icon-filter-reset.png" alt="この条件を解除する"></div>
										<select name="" id="" class="js-select">
											<option value="" selected>すべて</option>
											<option value="">A</option>
											<option value="">B</option>
										</select>
									</th>

									<th>端末
										<div class="clear-sort"><img src="./img/index/icon-filter-reset.png" alt="この条件を解除する"></div>
										<select name="" id="" multiple="multiple" class="js-select">
											<option value="" selected>すべて</option>
											<option value="">A</option>
											<option value="">B</option>
											<option value="">C</option>
											<option value="">D</option>
											<option value="">E</option>
										</select>
									</th>
								</tr>
								<tr>
									<th>回線タイプ
										<div class="clear-sort"><img src="./img/index/icon-filter-reset.png" alt="この条件を解除する"></div>
										<select name="" id="" class="js-select">
											<option value="" selected>すべて</option>
											<option value="">A</option>
											<option value="">B</option>

										</select>
									</th>

									<th>提供サービス元
										<div class="clear-sort"><img src="./img/index/icon-filter-reset.png" alt="この条件を解除する"></div>
										<select name="" id="" multiple="multiple" class="js-select">
											<option value="" selected>すべて</option>
											<option value="">A</option>
											<option value="">B</option>
											<option value="">C</option>
											<option value="">D</option>
											<option value="">E</option>
										</select>
									</th>

									<th>割引・キャッシュバック
										<div class="clear-sort"><img src="./img/index/icon-filter-reset.png" alt="この条件を解除する"></div>
										<select name="" id="" class="js-select">
											<option value="" selected>すべて</option>
											<option value="">A</option>
											<option value="">B</option>
										</select>
									</th>
								</tr>
							</tbody>
						</table>
						<p class="arrow-down"><img src="./img/index/icon-arrow-down.png"></p>
					</div>
					<ul class="sort-tabs tabs-top">
						<li><a href="#tab0" class="selected">月額料金が安い順</a></li>
						<li><a href="#tab1">2年総額が安い順</a></li>
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
              					<?php include('./lib/front/general/ranking-5gb.php'); ?>
              				</tbody>
              			</table>
              			<p class="ranking-more js-ranking-more"></p>
              		</div>

              		<!-- ↓↓↓↓↓↓↓↓↓↓↓↓↓↓display: none↓↓↓↓↓↓↓↓↓↓↓↓↓↓-->
              		<!-- ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓-->
              		<div id="data1" class="filter-tabs-contents">
              			<p class="search_num"><span>10</span>件中<span>1〜5</span>件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">表記の金額はすべて税抜価格となります。</span></p>
              			<table class="ranking_table-caption">
              				<tbody>
              					<tr class="caption">
              						<th class="rank-name">製品名</th>
              						<th class="rank-price current">月額利用料</th>
              						<th class="rank-data">月額データ量/<br />
                          下り最大速度</th>
              						<th class="rank-conditions">条件・特記事項</th>
              						<th class="rank-company">提供サービス元</th>
              					</tr>
              				</tbody>
              			</table>
              			<table class="ranking_table">
              				<tbody>
              					<?php include('./lib/front/general/ranking-5-8gb.php'); ?>
              				</tbody>
              			</table>
              			<p class="ranking-more js-ranking-more"></p>
              		</div>
              		<div id="data2" class="filter-tabs-contents">
              			<p class="search_num"><span>10</span>件中<span>1〜5</span>件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">表記の金額はすべて税抜価格となります。</span></p>
              			<table class="ranking_table-caption">
              				<tbody>
              					<tr class="caption">
              						<th class="rank-name">製品名</th>
              						<th class="rank-price current">月額利用料</th>
              						<th class="rank-data">月額データ量/<br />
                          下り最大速度</th>
              						<th class="rank-conditions">条件・特記事項</th>
              						<th class="rank-company">提供サービス元</th>
              					</tr>
              				</tbody>
              			</table>
              			<table class="ranking_table">
              				<tbody>
              					<?php include('./lib/front/general/ranking-8gb.php'); ?>
              				</tbody>
              			</table>
              			<p class="ranking-more js-ranking-more"></p>
              		</div>
              		<!-- ↑↑↑↑↑↑↑↑↑↑↑↑↑↑display: none↑↑↑↑↑↑↑↑↑↑↑↑↑↑-->

              	</div>
              </div><!--tabs No1-->
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
              						<th class="rank-price current">2年間総額</th>
              						<th class="rank-data">月額データ量/<br />
              						下り最大速度</th>
              						<th class="rank-conditions">主な特典/<br />注意事項</th>
              						<th class="rank-company">詳細</th>
              					</tr>
              				</tbody>
              			</table>
              			<table class="ranking_table">
              				<tbody>
              					<?php include('./lib/front/general/ranking2y-5gb.php'); ?>
              				</tbody>
              			</table>
              			<p class="ranking-more js-ranking-more"></p>
              		</div>

              		<!-- ↓↓↓↓↓↓↓↓↓↓↓↓↓↓display: none↓↓↓↓↓↓↓↓↓↓↓↓↓↓-->
              		<!-- ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓-->
              		<div id="data1" class="filter-tabs-contents">
              			<p class="search_num"><span>10</span>件中<span>1〜5</span>件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">表記の金額はすべて税抜価格となります。</span></p>
              			<table class="ranking_table-caption">
              				<tbody>
              					<tr class="caption">
              						<th class="rank-name">製品名</th>
              						<th class="rank-price current">2年間総額</th>
              						<th class="rank-data">月額データ量/<br />
                          下り最大速度</th>
              						<th class="rank-conditions">条件・特記事項</th>
              						<th class="rank-company">提供サービス元</th>
              					</tr>
              				</tbody>
              			</table>
              			<table class="ranking_table">
              				<tbody>
              					<?php include('./lib/front/general/ranking2y-5-8gb.php'); ?>
              				</tbody>
              			</table>
              			<p class="ranking-more js-ranking-more"></p>
              		</div>
              		<div id="data2" class="filter-tabs-contents">
              			<p class="search_num"><span>10</span>件中<span>1〜5</span>件を表示&nbsp;(各ランキングにつき上位10商品のみ掲載)<span class="tax-caution">表記の金額はすべて税抜価格となります。</span></p>
              			<table class="ranking_table-caption">
              				<tbody>
              					<tr class="caption">
              						<th class="rank-name">製品名</th>
              						<th class="rank-price current">2年間総額</th>
              						<th class="rank-data">月額データ量/<br />
                          下り最大速度</th>
              						<th class="rank-conditions">条件・特記事項</th>
              						<th class="rank-company">提供サービス元</th>
              					</tr>
              				</tbody>
              			</table>
              			<table class="ranking_table">
              				<tbody>
              					<?php include('./lib/front/general/ranking2y-8gb.php'); ?>
              				</tbody>
              			</table>
              			<p class="ranking-more js-ranking-more"></p>
              		</div>
              		<!-- ↑↑↑↑↑↑↑↑↑↑↑↑↑↑display: none↑↑↑↑↑↑↑↑↑↑↑↑↑↑-->


              	</div>
              </div><!--tabs No2-->
            </div><!--tabscont-->


						<!-- ソートタブ -->
            <div class="sort-lower">
            	<ul class="sort-tabs tabs-bottom">
            	  <li><a href="#tab0" class="selected">月額料金が安い順</a></li>
            	  <li><a href="#tab1">2年総額が安い順</a></li>
            	</ul>
            </div>

          </div><!--tabs-->
					<div class="note">
						<p>表記の金額は表記の金額は特に記載のある場合を除き全て税抜となります。</p>
            <p>1月間のデータ量とは別に、混雑開始のため数日間で数GB以上の利用の際に速度を制限する商品もございます。詳細は各事業者のホームページよりご確認下さい。</p>
            <p>当ランキングは月間データ量5GB以上の商品のみを掲載対象としております。</p>
            <p>表示の回線速度は、送信時の技術規格上の最大値であり、実際の回線速度を示すものではありません。ご利用地域や環境によって最大通信速度は異なる場合があります。</p>
            <br>
            <p>【月額料金が安い順の算出方法】<br>※ご契約初年度の月額利用料のうち、加入月割引などの金額を除外した料金で掲載しています</p>
            <br>
            <p>【2年間のお支払い総額が安い順の算出方法】<br>契約事務手数料+月額料金(2年間分)-割引金額(キャンペーン割引+月額割引) を元に算出しております。</p>
					</div>
				</div><!--#ranking-->
			</section>

			<section>
				<div id="ranking-about">
					<h1 class="title">ランキングに関して</h1>
					<h2>当サイトは下記基準にて厳正にランキングを行っております。</h2>
					<div class="rank-rule">
						<ul>
							<li>
								<img src="<?php echo SITE_ROOT_DIR; ?>img/index/illust_1.png" alt="イラスト">
								<h3>MVNO事業者限定</h3>
								<p>インターネット上での販売を中心とするMVNO事業者のみを比較したランキングです。</p>
							</li>
							<li>
								<img src="<?php echo SITE_ROOT_DIR; ?>img/index/illust_2.png" alt="イラスト">
								<h3>毎週情報を更新</h3>
								<p>毎週祝日を除く月曜日に情報を最新に更新いたします。（祝日の場合は翌営業日）</p>
							</li>
							<li>
								<img src="<?php echo SITE_ROOT_DIR; ?>img/index/illust_3.png" alt="イラスト">
								<h3 class="h3_br">各社ホームページ<br>の最新情報のみ</h3>
								<p>掲載する情報は各事業者のホームページに掲載されている最新情報のみを取り扱います。</p>
							</li>
							<li>
								<img src="<?php echo SITE_ROOT_DIR; ?>img/index/illust_4.png" alt="イラスト">
								<h3>公平な比較</h3>
								<p>比較対象となる項目において公平に順位を決定し、掲載いたします。</p>
							</li>
						</ul>
					</div>
					<!-- <p class="rank-contact">ランキング内容やサイトに関するお問合せ・ご意見は<a href="#">こちら</a>まで</p> -->
					<div class="note">
						<p>情報はすべて更新日時点での内容です。売切、価格改訂などがありますので詳細は各社サイト上でご確認下さい</p>
						<p>特定の媒体での限定キャンペーンなどは調査対象外となっております。</p>
					</div>
					<div class="comparison clearfix">
						<div class="comparison-company">
							<p class="comparison-title">比較対象サービス</p>
							<ul>
								<li><a href="http://wifi.yahoo.co.jp/" target="_blank">Yahoo! Wi-Fi</a></li>
								<li><a href="https://wimax-broad.jp/" target="_blank">Broad WiMAX</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="http://gmobb.jp/lp/wimax2plus/" target="_blank">とくとくBB</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
							</ul>
							<ul>
								<li><a href="https://www.so-net.ne.jp/access/mobile/wimax2/" target="_blank">So-net</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="http://join.biglobe.ne.jp/mobile/wimax/" target="_blank">BIGLOBE</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="https://3-wimax.jp/" target="_blank">3 WiMAX</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
							</ul>
							<ul>
								<li><a href="http://setsuzoku.nifty.com/wimax/" target="_blank">@nifty</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="https://wimax.pepabo.com/" target="_blank">Pepabo WiMAX</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="https://broad-lte.jp/" target="_blank">Broad LTE</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
							</ul>
						</div>
						<div class="comparison-model">
							<p class="comparison-title">比較対象端末</p>
							<ul>
								<li>Pocket Wi-Fi 303HW</li>
								<li>Pocket Wi-Fi 502HW</li>
								<li>Pocket Wi-Fi 401HW</li>
							</ul>
							<ul>
								<li>Pocket Wi-Fi 305ZT</li>
								<li>Pocket Wi-Fi GL10P</li>
								<li>Speed Wi-Fi NEXT W02</li>
							</ul>
							<ul>
								<li>Speed Wi-Fi NEXT WX02</li>
								<li>Speed Wi-Fi NEXT W01</li>
								<li>Speed Wi-Fi NEXT WX01</li>
							</ul>
						</div>
					</div>
					<nav>
						<div class="official">
							<p>各モバイルルーター公式サイトの情報はこちら(外部サイトへ)</p>
							<ul>
								<li><a href="https://www.nttdocomo.co.jp/product/data/" target="_blank">docomo</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="http://www.au.kddi.com/mobile/product/data/" target="_blank">au</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="http://www.softbank.jp/mobile/products/data-com/" target="_blank">SoftBank</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="http://www.ymobile.jp/lineup/index.html?category=data" target="_blank">Y!mobile</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
								<li><a href="http://www.uqwimax.jp/products/" target="_blank">UQ WiMAX</a><img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト"></li>
							</ul>
            </div>
            <p class="about_icon_txt">※アイコンについて <img class="icon-link" src="img/index/icon-link.gif" alt="外部サイト">・・・外部リンク</p>
					</nav>
				</div>
				<!-- /#ranking-about -->
			</section>
		</main>
	</div>
<!--	<div class="side-column">
		<?php //include_once('./lib/front/general/sidebar.php'); ?>
	</div>-->
</div>

<?php include_once('./lib/front/general/footer.php'); ?>
<?php include_once('./lib/javascript.php'); ?>
<script src="./js/front/jquery.sumoselect.min.js"></script>
<script src="./js/front/index.js"></script>
<?php echo $body_end; ?>
<script src="./js/front/Chart.min.js"></script>
<script src="./js/front/jquery.bxslider.min.js"></script>
<script>
//対応端末スライダー
(function BXSLIDER(){
  $('.bxslider').bxSlider({
    pager: false,
    prevText: '',
    nextText: '',
    slideWidth:233,
    auto: true,
    onSliderLoad:function(currentIndex){
      $('.bx-wrapper,.bx-prev,.bx-next').click(function(e){
        e.stopPropagation();
      });
    }
  });
})();

//今週の総合TOPスライダー
(function TOPBXSLIDER(){
  $('.topbxslider').bxSlider({
    pager: false,
    prevText: '',
    nextText: '',
    slideWidth:233,
    auto: true
  });
})();

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
   data: [5,3,4,3,4]
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
//ソート表示
$('.sort-filter-btn .btn').click(function(){
	$('.sort-filter-btn').hide();
	$('.sort-filter').fadeIn();
});
//セレクトボックス 複数選択「SumoSelect」プラグイン使用
$('.js-select').SumoSelect({placeholder: '選択してください'});
//ゴミ箱アイコンhover時
$('.clear-sort img').hover(function(){
	$(this).attr("src","./img/index/icon-filter-reset_on.png");
},function(){
	$(this).attr("src","./img/index/icon-filter-reset.png");
});

//IE8 グラフ非表示---------------------------------------
if(window.navigator.userAgent.toLowerCase().indexOf("msie") > -1 && window.navigator.appVersion.toLowerCase().indexOf("msie 8")>-1){
$('.graph').hide();
$('.detail .rank-list').css({width:620});
}

</script>
</body>
</html>