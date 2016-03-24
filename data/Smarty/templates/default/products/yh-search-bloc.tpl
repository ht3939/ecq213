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

    <!--{assign var=filterreset value="`$TPL_URLPATH`img/index/icon-filter-reset.png"}-->

    <div class="sort-filter-btn">
        <p class="btn">比較する条件を変更する</p>
    </div>
    <div class="sort-filter">
        <p class="sort-head">比較する条件を変更する<span class="clear-all-sort">すべての条件を解除する</span></p>
        <table class="sort-condition">
            <tbody>
                <tr>
                    <th>月間データ量
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="" id="" class="js-select">
                            <option value="" selected>すべて</option>
                            <option value="">A</option>
                            <option value="">B</option>
                        </select>
                    </th>

                    <th>下り最大速度
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="" id="" class="js-select">
                            <option value="" selected>すべて</option>
                            <option value="">A</option>
                            <option value="">B</option>
                        </select>
                    </th>

                    <th>端末
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
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
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="" id="" class="js-select">
                            <option value="" selected>すべて</option>
                            <option value="">A</option>
                            <option value="">B</option>

                        </select>
                    </th>

                    <th>提供サービス元
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
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
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="" id="" class="js-select">
                            <option value="" selected>すべて</option>
                            <option value="">A</option>
                            <option value="">B</option>
                        </select>
                    </th>
                </tr>
            </tbody>
        </table>
        <p class="arrow-down"><img src="<!--{$TPL_URLPATH}-->/img/index/icon-arrow-down.png"></p>
    </div>
    <div class="sort-filter">
        <p class="sort-head">比較する条件を変更する<span onclick="javascript:fnFilterReset('<!--{$orderby}-->'); return false;" class="clear-all-sort">すべての条件を解除する</span></p>
        <table class="sort-condition">
            <tbody>
                <tr>
                    <th>月間データ量
                        <div class="clear-sort"><img onclick="javascript:fnFilterDelete(['datasize_min','datasize_max'],'<!--{$orderby}-->');" src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_datassize" class="box145">
                            <!--{foreach from=$arrSearchFilter.filter_datasize.value item=arrdatasize key=k name=arrfilterdatasize}-->

                            <option label="<!--{$arrdatasize}-->" value="<!--{$k}-->"><!--{$arrdatasize}--></option>
                            <!--{/foreach }-->
                        </select>
                    </th>

                    <th>下り最大速度
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_dataspeed" class="box145">
                            <!--{foreach from=$arrSearchFilter.filter_dataspeed.value item=arrdataspeed key=k name=arrfilterdataspeed}-->

                            <option label="<!--{$arrdataspeed}-->" value="<!--{$k}-->"><!--{$arrdataspeed}--></option>
                            <!--{/foreach }-->
                        </select>
                    </th>

                    <th>端末
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_device" class="box145">
                            <!--{foreach from=$arrSearchFilter.filter_device.value item=arrdevice key=k name=arrfilterdevice}-->

                            <option label="<!--{$arrdevice}-->" value="<!--{$k}-->"><!--{$arrdevice}--></option>
                            <!--{/foreach }-->
                        </select>
                        <select name="category_id_test" class="box145">
                        <!--{html_options options=$arrSearchFilter.filter_device.value selected=0}-->
                        </select>

                        <select name="" id="">
                            <option value="">すべて</option>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th>回線タイプ
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_type" class="box145">
                            <!--{foreach from=$arrSearchFilter.filter_type.value item=arrtype key=k name=arrfiltertype}-->

                            <option label="<!--{$arrtype}-->" value="<!--{$k}-->"><!--{$arrtype}--></option>
                            <!--{/foreach }-->
                        </select>
                    </th>

                    <th>提供サービス元
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_maker" id="filter_maker">
                            <option value="0">すべて</option>

                            <!--{section name=cnt loop=$arrMaker}-->
                                <!--{assign var=maker_id value=$arrMaker[cnt].maker_id}-->
                                <!--{if $arrMaker[cnt].maker_id}-->
                                    <option label="<!--{$arrMaker[cnt].name}-->" value="<!--{$maker_id}-->">
                                        <p>
                                            <a href="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php?maker_id=<!--{$arrMaker[cnt].maker_id}-->" title="<!--{$arrMaker[cnt].name|escape}-->">
                                                <!--{$arrMaker[cnt].name|escape}-->(<!--{$arrMaker[cnt].product_count|default:0}-->)
                                            </a>
                                        </p>
                                    </option>
                                <!--{/if}-->
                            <!--{/section}-->

                        </select>
                    </th>

                    <th>割引・キャッシュバック
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_cpprice" class="box145">
                            <!--{foreach from=$arrSearchFilter.filter_cpprice.value item=arrcpprice key=k name=arrfiltercpprice}-->

                            <option label="<!--{$arrcpprice}-->" value="<!--{$k}-->"><!--{$arrcpprice}--></option>
                            <!--{/foreach }-->
                        </select>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

<!--{/strip}-->
