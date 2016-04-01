<!--{*
 * MakerBlock
 * Copyright (C) 2012 BLUE STYLE All Rights Reserved.
 * http://bluestyle.jp/
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *}-->
<!--{* メーカー一覧 css *}-->
<style type="text/css">
#maker_area {
    margin-bottom: 20px;
}
#makertree ul {
    margin: 10px 10px 0 10px;
    border: #A9ACAB solid 1px;
    border-radius: 8px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    background: #f4F6F8;
}
#makertree li {
    font-size: 16px;
    font-weight: bold;
    -webkit-transition: opacity 0.3s ease-in;
    -webkit-transition-delay: 0.2s;
    clear: both;
    border-bottom: #CCC solid 1px;
    border-top: #FFF solid 1px;
    line-height: 1.3em;
    vertical-align: middle;
}

#makertree li:first-child {
    border-top: none;
}
#makertree li li:first-child {
    border-top: #CCC solid 1px;
}
#makertree li:last-child,
#makertree li li:last-child {
    border-bottom: none;
}
#makertree ul li a,
.makertree > ul > li > ul > li a {
    padding: 0.6em 0;
}
.category_body {
    display: inline-block;
}
.category_body a {
    width: 100%;
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
}
#makertree ul li li {
    padding-bottom: 0.6em;
}
.maker_header {
    width: 1.5em;
    margin: 0 6px 0 8px;
    display: inline-block;
    background: transparent;
    text-align: right;
}
/*レベル調整*/
#makertree li .maker_header {
    width: 1.5em;
}
#makertree li .maker_body {
    width: 86.5%;
}

/*リンクカラー*/
.maker_body a:link,
.maker_body a:visited {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
.maker_header.plus a,
.maker_header.minus a {
    color: #FFF;
}
</style>

<!--メーカー一覧ここから-->
<section id="maker_area">
<h2 class="title_block">メーカー一覧</h2>
<nav id="makertree">
<ul id="makertreelist">
    <!--{section name=cnt loop=$arrMaker}-->
        <!--{assign var=maker_id value=$arrMaker[cnt].maker_id}-->
        <!--{if $arrMaker[cnt].maker_id}-->
            <li><span class="maker_header"></span><span class="maker_body">
                <a href="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php?maker_id=<!--{$arrMaker[cnt].maker_id}-->" title="<!--{$arrMaker[cnt].name|escape}-->">
                    <!--{$arrMaker[cnt].name|escape}-->(<!--{$arrMaker[cnt].product_count|default:0}-->)
                </a></span>
            </li>
        <!--{/if}-->
    <!--{/section}-->
</ul>
</nav>
</section>
<!-- ▲カテゴリ -->
