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
$meta_title = SITE_NAME.' - サイトの紹介文';
$meta_keywords = '';//当ページのキーワードを半角カンマ区切りで3個以上～5個以内で記述する。半角カンマの前後は半角スペースを入れてはいけない。
$meta_description = '';//当ページの概要分を約110文字で記述する。
$link_canonical = '';//基本的に当ページのURLを記述する
$link_alternate = '';//基本的に対応するSPサイトのURLを記述する



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
	<meta property="og:type" content="article">
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
  <link rel="stylesheet" href="css/general/detail.css">
	<link rel="stylesheet" href="css/general/list-layout.css">
	<?php echo $head_end; ?>
</head>

<body>
<?php echo $body_top; ?>
<?php include_once('./lib/front/general/header.php'); ?>
<p id="breadcrumbs">
  <span class="parent" prefix="v: http://rdf.data-vocabulary.org/#">
    <span class="children first" typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="/">トップ</a></span>
    <span class="children" typeof="v:Breadcrumb"><span property="v:title">Y! Fi 2年間ずーっと得するプラン（4G）</span></span>
  </span>
</p>
<div class="row-container is-reverse">

  <div class="main-column">
    <main>
      <h1 class="plan-title"><span>Yahoo! Wi-Fi</span>Y! Fi 2年間ずーっと得するプラン（4G）</h1>
      <section>
        <div class="title-name">
          <p class="logo"><img src="img/item/yahoowifi/logo.png" alt=""></p>
          <div class="title">
            <p class="name">Y! Fi 2年間ずーっと得するプラン（4G）</p>
            <p class="condition">Yahoo! プレミアム会員限定のお得なプラン。２年目からは、月々の料金が2,743円一定です。</p>
          </div>
        </div>
        <div class="detail-data">
          <dl class="ptn1">
            <dt>主な特典</dt>
            <dd>○○の条件で、キャッュバック35,000円！</dd>
          </dl>
          <dl class="ptn2">
            <dt>注意事項</dt>
            <dd>プレミアム会員必須 ※３日で３GB制限あり</dd>
          </dl>
        </div>
        <div class="data-boxs">
          <ul class="top-data">
            <li class="rank1">
            <img src="img/detail/tag1.png" alt="" class="tag">
              <p class="head">月額料金</p>
              <p class="data">9,999<span>円</span></p>
            </li>
            <li class="rank2">
            <img src="img/detail/tag2.png" alt="" class="tag">
              <p class="head">お支払い総額</p>
              <p class="data">99,999<span>円</span></p>
            </li>
            <li class="rank2">
            <img src="img/detail/tag3.png" alt="" class="tag">
              <p class="head">月間データ量</p>
              <p class="data">7<span>GB/月</span></p>
            </li>
            <li class="rank3">
            <img src="img/detail/tag4.png" alt="" class="tag">
              <p class="head">下り最大速度</p>
              <p class="data">110<span>Mbps</span></p>
            </li>
          </ul>
          <div class="rank-graph">
            <img src="img/detail/tag5.png" alt="" class="tag">
            <p class="head">項目別スコア</p>
            <div class="detail">
              <ul class="rank-list">
                <li class="rank1">月額料金</li>
                <li class="rank2">月間データ量</li>
                <li class="rank2">上り最大速度</li>
                <li class="rank3">下り最大速度</li>
                <li class="rank3">お支払総額</li>
              </ul>
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
        <div class="device-content js-device-content">
          <div class="device-data active">
            <img src="img/detail/tag6.png" alt="" class="tag">
            <div class="image">
              <p class="head">選べる対応端末</p>
              <p class="pic"><img src="img/detail/device.png" alt=""></p>
            </div>
            <div class="detail">
                <p class="date">発売：2016年01月02日</p>
              <p class="device-name"><span>Huawei1</span><br>Pocket WiFi 303HW</p>
              <div class="colors">
                <p class="red">レッド</p>
                <p class="dark-silver">ダークシルバー</p>
              </div>
              <ul class="data-list">
                <li>
                  <dl class="data js-height">
                    <dt>下り<br>通信速度</dt>
                    <dd>最大25<span>Mbps</span></dd>
                  </dl>
                </li>
                <li>
                  <dl class="data js-height">
                    <dt>上り<br>通信速度</dt>
                    <dd>最大25<span>Mbps</span></dd>
                  </dl>
                </li>
              </ul>
              <p class="link-btn"><a href="">この商品ページへ</a></p>
            </div>
          </div>
          <div class="device-data">
              <img src="img/detail/tag6.png" alt="" class="tag">
              <div class="image">
                <p class="head">選べる対応端末</p>
                <p class="pic"><img src="img/detail/device.png" alt=""></p>
              </div>
              <div class="detail">
                <p class="date">発売：2016年01月02日</p>
                <p class="device-name"><span>Huawei2</span><br>Pocket WiFi 303HW</p>
                <div class="colors">
                  <p class="red">レッド</p>
                  <p class="dark-silver">ダークシルバー</p>
                </div>
                <ul class="data-list">
                  <li>
                    <dl class="data js-height">
                      <dt>下り<br>通信速度</dt>
                      <dd>最大25<span>Mbps</span></dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="data js-height">
                      <dt>上り<br>通信速度</dt>
                      <dd>最大25<span>Mbps</span></dd>
                    </dl>
                  </li>
                </ul>
                <p class="link-btn"><a href="">この商品ページへ</a></p>
              </div>
          </div>
          <div class="device-data">
              <img src="img/detail/tag6.png" alt="" class="tag">
              <div class="image">
                <p class="head">選べる対応端末</p>
                <p class="pic"><img src="img/detail/device.png" alt=""></p>
              </div>
              <div class="detail">
                <p class="date">発売：2016年01月02日</p>
                <p class="device-name"><span>Huawei3</span><br>Pocket WiFi 303HW</p>
                <div class="colors">
                  <p class="red">レッド</p>
                  <p class="dark-silver">ダークシルバー</p>
                </div>
                <ul class="data-list">
                  <li>
                    <dl class="data js-height">
                      <dt>下り<br>通信速度</dt>
                      <dd>最大25<span>Mbps</span></dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="data js-height">
                      <dt>上り<br>通信速度</dt>
                      <dd>最大25<span>Mbps</span></dd>
                    </dl>
                  </li>
                </ul>
                <p class="link-btn"><a href="">この商品ページへ</a></p>
              </div>
          </div>
          <div class="device-data">
              <img src="img/detail/tag6.png" alt="" class="tag">
              <div class="image">
                <p class="head">選べる対応端末</p>
                <p class="pic"><img src="img/detail/device.png" alt=""></p>
              </div>
              <div class="detail">
                <p class="date">発売：2016年01月02日</p>
                <p class="device-name"><span>Huawei4</span><br>Pocket WiFi 303HW</p>
                <div class="colors">
                  <p class="red">レッド</p>
                  <p class="dark-silver">ダークシルバー</p>
                </div>
                <ul class="data-list">
                  <li>
                    <dl class="data js-height">
                      <dt>下り<br>通信速度</dt>
                      <dd>最大25<span>Mbps</span></dd>
                    </dl>
                  </li>
                  <li>
                    <dl class="data js-height">
                      <dt>上り<br>通信速度</dt>
                      <dd>最大25<span>Mbps</span></dd>
                    </dl>
                  </li>
                </ul>
                <p class="link-btn"><a href="">この商品ページへ</a></p>
              </div>
          </div>
        </div>
        <table class="device-list-tab js-device-tab">
          <tr>
            <td class="active">
              <div class="inner">
                <p class="pic"><img src="img/detail/device.png" alt=""></p>
                <div class="name">Pocket WiFi <br>303HW</div>
              </div>
            </td>
            <td>
              <div class="inner">
                <p class="pic"><img src="img/detail/device.png" alt=""></p>
                <div class="name">Pocket WiFi <br>303HW</div>
              </div>
            </td>
            <td>
              <div class="inner">
                <p class="pic"><img src="img/detail/device.png" alt=""></p>
                <div class="name">Pocket WiFi <br>303HW</div>
              </div>
            </td>
            <td>
              <div class="inner">
                <p class="pic"><img src="img/detail/device.png" alt=""></p>
                <div class="name">Pocket WiFi <br>303HW</div>
              </div>
            </td>
          </tr>
        </table>
      </section>
      <section>
          <h2 class="title">このプランの詳細について</h2>
          <div class="price">
            <div class="price-content">
              <div class="title">
                <p class="logo"><img src="img/item/yahoowifi/logo.png" alt=""></p>
                <p class="text">Y!Fi2年間ずーっと得するプラン（4G）</p>
              </div>
              <div class="price-data1">
                <p class="price-data-head">2年間の月額料金について</p>
                <ul class="data">
                  <li>
                    <p class="head">1年目の月額料金</p>
                    <p class="price">9,999円</p>
                  </li>
                  <li>
                    <p class="head">2年目の月額料金</p>
                    <p class="price">9,999円</p>
                  </li>
                </ul>
                <div class="graph ptn1">
                  <p class="head">お支払イメージ</p>
                  <p class="price-text price-1y">1年目の月額料金<br><span class="price">1,980<span class="yean">円</span></span></p>
                  <p class="price-text price-2y">2年目の月額料金<br><span class="price">2,743<span class="yean">円</span></span></p>
                  <p class="text">12ヶ月目</p>
                  <p></p>
                </div>
              </div>
              <div class="price-data2">
                <p class="price-data-head">別途費用</p>
                <ul class="data">
                  <li>
                    <p class="head">初期費用</p>
                    <p class="price">9,999円</p>
                  </li>
                  <li>
                    <p class="head">事務手数料</p>
                    <p class="price">9,999円</p>
                  </li>
                </ul>
              </div>
            </div>
            <dl class="plan">
              <dt>Y! Fi 2年間ずーっと得するプラン（4G）について</dt>
              <dd>Yahoo! プレミアム会員必須のプラン。２年目からは、月々の料金が2,743円一定です。</dd>
            </dl>
            <p class="link-btn"><a href="">このプランのページへ</a></p>
            <p class="link-blank-nav">(外部サイトへ)</p>
          </div>
      </section>
      <section>
          <h2 class="title">Yahoo! Wi-Fi の別プラン</h2>
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
      <div class="note">
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
      </div>
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
      <div class="note">
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
        <p>必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。必要に応じて、ここに注釈。</p>
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
      <p class="index-link"><a href="">トップへ戻る</a></p>
    </main>
  </div>
</div>

<?php include_once('./lib/front/general/footer.php'); ?>
<?php include_once('./lib/javascript.php'); ?>
<script src="./js/front/Chart.min.js"></script>
<script src="./js/front/jquery.bxslider.min.js"></script>
<script>
//スライダー
$(document).ready(function(){
  $('.bxslider').bxSlider({
    pager: false,
    prevText: '',
    nextText: '',
    onSliderLoad:function(currentIndex){
      $('.bx-wrapper,.bx-prev,.bx-next').click(function(e){
        e.stopPropagation();
      });
    }
  });
});
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
   data: [5,3,3,2,4]
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
   scaleStepWidth : 1 // 目盛の間隔
   // 目盛の最大値の計算：scaleSteps（目盛の数）→5　scaleStepWidth（目盛の間隔）→2 だと5×2で最大値は10
   });

});
//タブ
$('.js-device-tab td').click(function(){
  $(this).parent().children().removeClass('active');
  $(this).addClass('active');
  $('.js-device-content').children().removeClass('active');
  $('.js-device-content').children().eq($(this).index()).addClass('active');
});
//aタグ 全体リンク
$(".js-all-link").click(function(){
  location.href = $(this).find('.js-link-btn').attr("href");
});


</script>
<!--[if lte IE 8]>
<script>
//IE8以下 グラフ非表示
$('.graph').hide();
$('.detail .rank-list').css({width:420});
</script>
<![endif]-->
<?php echo $body_end; ?>
</body>
</html>