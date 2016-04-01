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
#maker_area h2 {
    border-top: solid 1px #f90;
    background: url('<!--{$TPL_URLPATH}-->/img/background/bg_tit_bloc_01.jpg') repeat-x left bottom;
    padding: 5px 0 8px 10px;
    font-size: 14px;
}
#maker_area .block_body {
    background-color: #fffaf0;
}

#maker_area li {
    padding-left: 5px;
    border-bottom: solid 1px #ccc;
}
#maker_area li.maker_list_last {
    border-bottom: none;
}
#maker_area li p {
    padding-left: 20px;
    margin: 7px 3px;
    background: url("<!--{$TPL_URLPATH}-->/img/icon/ico_arrow_01.gif") 2px 3px no-repeat;
}
#maker_area li a {
    display: block;
    padding: 0;
}
</style>

<!--メーカー一覧ここから-->
<div class="block_outer">
    <div id="maker_area">
        <div class="block_body">
            <h2><img src="<!--{$smarty.const.TOP_URLPATH}-->plugin/MakerBlock/media/tit_bloc_maker.gif" alt="メーカー一覧" /></h2>
            <!--{strip}-->
                <ul id="makertree">
                    <!--{section name=cnt loop=$arrMaker}-->
                        <!--{assign var=maker_id value=$arrMaker[cnt].maker_id}-->
                        <!--{if $arrMaker[cnt].maker_id}-->
                            <li<!--{if $smarty.section.cnt.last}--> class="maker_list_last"<!--{/if}-->>
                                <p>
                                    <a href="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php?maker_id=<!--{$arrMaker[cnt].maker_id}-->" title="<!--{$arrMaker[cnt].name|escape}-->">
                                        <!--{$arrMaker[cnt].name|escape}-->(<!--{$arrMaker[cnt].product_count|default:0}-->)
                                    </a>
                                </p>
                            </li>
                        <!--{/if}-->
                    <!--{/section}-->
                </ul>
            <!--{/strip}-->
        </div>
    </div>
</div>
<!--メーカー一覧ここまで-->
