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

<!--▼FOOTER-->
<!--{strip}-->
    <div id="footer_wrap">
        <div id="footer" class="clearfix">
            <div id="pagetop"><a href="#top">このページの先頭へ</a></div>
            <div id="copyright">Copyright ©
                &nbsp;<!--{if $smarty.const.RELEASE_YEAR != $smarty.now|date_format:"%Y"}--><!--{$smarty.const.RELEASE_YEAR}-->-<!--{/if}--><!--{$smarty.now|date_format:"%Y"}-->
                &nbsp;<!--{$arrSiteInfo.shop_name_eng|default:$arrSiteInfo.shop_name|h}--> All rights reserved.
            </div>
        </div>
    </div>


<footer>
	<div id="footer">
		<div id="page_top">
			<div class="base-container">
				<p class="page_top_btn"><a href="#header" class="js-scroll">ページの先頭へ</a></p>
			</div>
		</div>
		<div id="copy">
			<nav>
				<ul class="footer-nav">
					<li><a href="http://docs.yahoo.co.jp/docs/info/terms/chapter1.html#cf2nd">プライバシーポリシー</a></li>
					<li><a href="http://docs.yahoo.co.jp/docs/info/terms/">利用規約</a></li>
					<li><a href="http://docs.yahoo.co.jp/docs/pr/disclaimer.html">免責事項</a></li>
					<li><a href="http://www.yahoo-help.jp/app/home/p/595/">ヘルプ・お問い合わせ</a></li>
				</ul>
			</nav>
			<p>Copyright (C) 2016 Yahoo Japan Corporation. All Rights Reserved.</p>
		</div>
	</div>
</footer><script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>window.jQuery || document.write('<script src="<!--{$TPL_URLPATH}-->js/jquery-1.11.3.min.js"><\/script>');</script>
<script src="<!--{$TPL_URLPATH}-->js/front/common.js"></script>

<!--[if lt IE 9]>
<script src="<!--{$TPL_URLPATH}-->js/front/html5shiv.js"></script>
<![endif]-->
<script src="<!--{$TPL_URLPATH}-->js/front/index.js"></script>
<!--{/strip}-->
<!--▲FOOTER-->
