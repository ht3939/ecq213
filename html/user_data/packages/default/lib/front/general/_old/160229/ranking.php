<?php
/*
# index.php　ランキングループコンテンツ
*/
?>
<?php //表示数分だけループ
	for ($i=1; $i < 11 ; $i++) :
?>

<tr class="js-ranking-item">
	<td class="rank-name">
		<span class="rank"><?php echo $i; ?><span>位</span></span>
		<div class="img">
			<img src="<?php echo SITE_ROOT_DIR; ?>img/item/yahoowifi/item1.png" alt="Pocket Wi-Fi GL10P">
		</div>
		<div class="status">
			<p class="name"><span>Huawei</span>Pocket Wi-Fi GL10P</p>
			<p class="release">発売：2016年01月02日</p>
			<p class="color">カラー：<span><i style="background-color: #333"></i><i style="background-color: #12cc4f"></i><i style="background-color: #099be4"></i></span></p>
		</div>
	</td>
	<td class="rank-price"><span>1,980</span>円</td>
	<td class="rank-data"><span><?php echo $i; ?></span>GB/月</td>
	<td class="rank-conditions">プレミアム会員必須<br>3日で3GB制限あり</td>
	<td class="rank-company">
		<a href="#">Yahoo! Wi-Fi</a>
		<p class="site_btn"><a href="#" target="_blank">サイトを見る</a></p>
		<p class="note">外部サイトへ<br>移動します</p>
	</td>
</tr>

<?php endfor; ?>