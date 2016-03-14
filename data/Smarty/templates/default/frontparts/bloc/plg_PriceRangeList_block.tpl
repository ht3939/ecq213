<!--{*
 * PriceRangeListBlock
 * Copyright(c) C-Rowl Co., Ltd. All Rights Reserved.
 * http://www.c-rowl.com/
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
<div class="block_outer">
    <div id="category_area">
        <div class="block_body">
            <h2>価格帯</h2>
            <!--{strip}-->
                <ul id="categorytree">
                    <!--{section name=cnt loop=$arrPriceRage}-->
                    <li class="level1">
                    <p><a href="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php?pr_id=<!--{$arrPriceRage[cnt].price_range_id|h}-->" <!--{if $arrPriceRage[cnt].price_range_id==$plg_pr_id}-->class="onlink"<!--{/if}-->><!--{$arrPriceRage[cnt].price_range_name|h}--></a></p>
                    </li>
                    <!--{/section}-->
                </ul>
            <!--{/strip}-->
        </div>
    </div>
</div>