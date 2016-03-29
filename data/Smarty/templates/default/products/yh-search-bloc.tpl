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
        <p class="sort-head">比較する条件を変更する<span class="clear-all-sort" onclick="javascript:fnFilterReset('<!--{$orderby}-->'); return false;">すべての条件を解除する</span></p>
        <table class="sort-condition">
            <tbody>
                <tr>
                    <th>月間データ量
                        <div class="clear-sort" onclick="javascript:fnFilterDelete('test','<!--{$orderby}-->'); return false;"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_datasize" id="filter_datasize" class="js-select">
                            <!--{if $tpl_filtermode}-->
                                <!--{if $arrSearchFilterData.filter_datasize>0}-->
                                    <!--{assign var=sel  value=$arrSearchFilterData.filter_datasize}-->
                                <!--{else}-->
                                    <!--{assign var=sel  value=0}-->
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{assign var=sel  value=0}-->
                            <!--{/if}-->

                            <!--{foreach from=$arrSearchFilter.filterVal_datasize.value item=v key=k}-->
                                <option value="<!--{$k}-->" <!--{if $k==$sel}-->selected<!--{/if}-->><!--{$v}--></option>
                            <!--{/foreach}-->
                        </select>
                    </th>

                    <th>下り最大速度
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_data_speed_down" id="filter_data_speed_down" class="js-select">
                            <!--{if $tpl_filtermode}-->
                                <!--{if $arrSearchFilterData.filter_data_speed_down>0}-->
                                    <!--{assign var=sel  value=$arrSearchFilterData.filter_data_speed_down}-->
                                <!--{else}-->
                                    <!--{assign var=sel  value=0}-->
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{assign var=sel  value=0}-->
                            <!--{/if}-->

                            <!--{foreach from=$arrSearchFilter.filterVal_dataspeed.value item=v key=k}-->
                                <option value="<!--{$k}-->" <!--{if $k==$sel}-->selected<!--{/if}-->><!--{$v}--></option>
                            <!--{/foreach}-->
                        </select>
                    </th>

                    <th>端末
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_device" id="filter_device" multiple="multiple" class="js-select">

                            <!--{if $tpl_filtermode}-->
                                <!--{if $arrSearchFilterData.filter_device|count>0}-->
                                    <!--{assign var=sel  value=$arrSearchFilterData.filter_device}-->
                                <!--{else}-->
                                    <!--{assign var=sel  value=array(0)}-->
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{assign var=sel  value=array(0)}-->
                            <!--{/if}-->

                            <!--{foreach from=$arrSearchFilter.filterVal_device.value item=v key=k}-->

                                <option value="<!--{$arrSearchFilter.filterVal_device.search[$k]}-->"
                                    <!--{if $arrSearchFilter.filterVal_device.search[$k]|in_array:$sel}-->selected<!--{/if}-->
                                >
                                    <!--{$v}-->
                                </option>
                            
                            <!--{/foreach}-->


                        </select>
                    </th>
                </tr>
                <tr>
                    <th>回線タイプ
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_lntype" id="filter_lntype" class="js-select">
                            <!--{if $tpl_filtermode}-->
                                <!--{if $arrSearchFilterData.filter_lntype>0}-->
                                    <!--{assign var=sel  value=$arrSearchFilterData.filter_lntype}-->
                                <!--{else}-->
                                    <!--{assign var=sel  value=0}-->
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{assign var=sel  value=0}-->
                            <!--{/if}-->

                            <!--{foreach from=$arrSearchFilter.filterVal_lntype.value item=v key=k}-->
                                <option value="<!--{$k}-->" <!--{if $k==$sel}-->selected<!--{/if}-->><!--{$v}--></option>
                            <!--{/foreach}-->
                        </select>
                    </th>

                    <th>提供サービス元
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_maker_id" id="filter_maker_id" multiple="multiple" class="js-select">
                            <!--{if $tpl_filtermode}-->
                                <!--{if $arrSearchFilterData.filter_maker_id|count>0}-->
                                    <!--{assign var=sel  value=$arrSearchFilterData.filter_maker_id}-->
                                <!--{else}-->
                                    <!--{assign var=sel  value=array(0)}-->
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{assign var=sel  value=array(0)}-->
                            <!--{/if}-->

                            <!--{foreach from=$arrSearchFilter.filterVal_maker.value item=v key=k}-->
                            
                                <option value="<!--{$arrSearchFilter.filterVal_maker.search[$k]}-->"
                                    <!--{if $arrSearchFilter.filterVal_maker.search[$k]|in_array:$sel}-->selected<!--{/if}-->
                                >
                                    <!--{$v}-->
                                </option>

                            <!--{/foreach}-->

                        </select>

                    </th>

                    <th>割引・キャッシュバック
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_cptype" id="filter_cptype" class="js-select">
                            <!--{if $tpl_filtermode}-->
                                <!--{if $arrSearchFilterData.filter_cptype>0}-->
                                    <!--{assign var=sel  value=$arrSearchFilterData.filter_cptype}-->
                                <!--{else}-->
                                    <!--{assign var=sel  value=0}-->
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{assign var=sel  value=0}-->
                            <!--{/if}-->

                            <!--{foreach from=$arrSearchFilter.filterVal_cptype.value item=v key=k}-->
                                <option value="<!--{$k}-->" <!--{if $k==$sel}-->selected<!--{/if}-->><!--{$v}--></option>
                            <!--{/foreach}-->
                        </select>
                    </th>
                </tr>
            </tbody>
        </table>
        <p class="arrow-down"><img src="<!--{$TPL_URLPATH}-->/img/index/icon-arrow-down.png"></p>
    </div>
    <div>
        <table >
            <tbody>
                <tr>
                    <th>月間データ量
                        <div class="clear-sort" onclick="javascript:fnFilterDelete('test','<!--{$orderby}-->'); return false;"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_datasize2" id="filter_datasize2" >
                            <!--{if $tpl_filtermode}-->
                                <!--{if $arrSearchFilterData.filter_datasize>0}-->
                                    <!--{assign var=sel  value=$arrSearchFilterData.filter_datasize}-->
                                <!--{else}-->
                                    <!--{assign var=sel  value=0}-->
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{assign var=sel  value=0}-->
                            <!--{/if}-->

                            <!--{foreach from=$arrSearchFilter.filterVal_datasize.value item=v key=k}-->
                                <option value="<!--{$k}-->" <!--{if $k==$sel}-->selected<!--{/if}-->><!--{$v}--></option>
                            <!--{/foreach}-->
                        </select>
                    </th>


                    <th>端末
                        <div class="clear-sort"><img src="<!--{$filterreset}-->" alt="この条件を解除する"></div>
                        <select name="filter_device2" id="filter_device2" multiple="multiple">

                            <!--{if $tpl_filtermode}-->
                                <!--{if $arrSearchFilterData.filter_device|count>0}-->
                                    <!--{assign var=sel  value=$arrSearchFilterData.filter_device}-->
                                <!--{else}-->
                                    <!--{assign var=sel  value=array(0)}-->
                                <!--{/if}-->
                            <!--{else}-->
                                <!--{assign var=sel  value=array(0)}-->
                            <!--{/if}-->

                            <!--{foreach from=$arrSearchFilter.filterVal_device.value item=v key=k}-->

                                <option value="<!--{$arrSearchFilter.filterVal_device.search[$k]}-->"
                                    <!--{if $arrSearchFilter.filterVal_device.search[$k]|in_array:$sel}-->selected<!--{/if}-->
                                >
                                    <!--{$v}-->
                                </option>
                            
                            <!--{/foreach}-->


                        </select>
                    </th>
                </tr>

            </tbody>
        </table>
        <p class="arrow-down"><img src="<!--{$TPL_URLPATH}-->/img/index/icon-arrow-down.png"></p>
    </div>

<!--{/strip}-->
