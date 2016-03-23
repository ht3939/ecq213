<!--{*
/*
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
 */
*}-->

<form name="form1" id="form1" method="post" action="">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="edit" />
    <input type="hidden" name="classcategory_id" value="<!--{$tpl_classcategory_id}-->" />
    <!--{foreach key=key item=item from=$arrHidden}-->
        <input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->" />
    <!--{/foreach}-->
    <div id="products" class="contents-main">

        <table>
            <tr>
                <th>規格名</th>
                <td><!--{$tpl_class_name|h}--></td>
            </tr>
            <tr>
                <th>分類名<span class="attention"> *</span></th>
                <td>
                    <!--{if $arrErr.name}-->
                        <span class="attention"><!--{$arrErr.name}--></span>
                    <!--{/if}-->
                    <input type="text" name="name" value="<!--{$arrForm.name.value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.name|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>

            <!--{section name=cnt start=1 loop=9}-->
            <!--{assign var=key value="cc_img_url`$smarty.section.cnt.iteration`"}-->

            <tr>
                <th>画像参照URL<!--{$smarty.section.cnt.iteration}--></th>
                <td>
                    <input type="text" name="cc_img_url<!--{$smarty.section.cnt.iteration}-->" value="<!--{$arrForm[$key].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>         
            <!--{/section}-->

            <tr>
                <th>サイトURL</th>
                <td>
                    <input type="text" name="cc_site_url" value="<!--{$arrForm.cc_site_url.value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.cc_site_url|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>            
            <tr>
                <th>画像</th>
                <td>
                    <input type="text" name="cc_image" value="<!--{$arrForm.cc_image.value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.cc_image|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>            
            <tr>
                <th>発売日</th>
                <td>
                    <!--{if $arrErr.cc_release_date}-->
                        <span class="attention"><!--{$arrErr.cc_release_date}--></span>
                    <!--{/if}-->
                    <input type="text" name="cc_release_date" value="<!--{$arrForm.cc_release_date.value|date_format:"%Y/%m/%d"}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.cc_release_date|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>
         
            <tr>
                <th>ルータタイプ</th>
                <td>
                    <input type="text" name="cc_type" value="<!--{$arrForm.cc_type.value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.cc_type|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>            
            <tr>
                <th>ブランド</th>
                <td>
                    <input type="text" name="cc_brand" value="<!--{$arrForm.cc_brand.value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.cc_brand|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>            
            <tr>
                <th>カラー</th>
                <td>
                    <input type="text" name="cc_color" value="<!--{$arrForm.cc_color.value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.cc_color|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>            
            <tr>
                <th>転送速度下り</th>
                <td>
                    <input type="text" name="cc_data_speed_down" value="<!--{$arrForm.cc_data_speed_down.value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.cc_data_speed_down|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>            

            <tr>
                <th>転送速度上り</th>
                <td>
                    <input type="text" name="cc_data_speed_up" value="<!--{$arrForm.cc_data_speed_up.value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr.cc_data_speed_up|sfGetErrorColor}-->" size="30" class="box30" />
                    <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
                </td>
            </tr>            



        </table>
        <div class="btn-area">
            <ul>
                <li><a class="btn-action" href="javascript:;" onclick="eccube.fnFormModeSubmit('form1', 'edit', '', ''); return false;"><span class="btn-next">この内容で登録する</span></a></li>
            </ul>
        </div>

        <table class="list">
            <col width="10%" />
            <col width="10%" />
            <col width="10%" />
            <col width="10%" />
            <col width="2%" />
            <col width="2%" />
            <col width="2%" />
            <col width="2%" />
            <col width="2%" />
            <col width="10%" />
            <col width="10%" />
            <col width="10%" />
            <col width="10%" />
            <col width="10%" />
            <col width="10%" />
            <col width="8%" />
            <col width="8%" />
            <col width="8%" />
            <tr>
                <th>分類名</th>

                <!--{section name=cnt start=1 loop=9}-->
                <!--{assign var=key value="cc_img_url`$smarty.section.cnt.iteration`"}-->

                <th>画像参照URL<!--{$smarty.section.cnt.iteration}--></th>
                <!--{/section}-->

                <th>サイトURL</th>
                <th>画像</th>
                <th>発売日</th>
                <th>ルータタイプ</th>
                <th>ブランド</th>
                <th>カラー</th>
                <th>転送速度下り</th>
                <th>転送速度上り</th>

                <th class="edit">編集</th>
                <th class="delete">削除</th>
                <th>移動</th>
            </tr>
            <!--{section name=cnt loop=$arrClassCat}-->
                <tr style="background:<!--{if $tpl_classcategory_id != $arrClassCat[cnt].classcategory_id}-->#ffffff<!--{else}--><!--{$smarty.const.SELECT_RGB}--><!--{/if}-->;">
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].name|h}--></td>

                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_img_url1|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_img_url2|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_img_url3|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_img_url4|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_img_url5|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_img_url6|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_img_url7|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_img_url8|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_site_url|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_image|h}--></td>

                    <td><!--{* 発売日 *}--><!--{$arrClassCat[cnt].cc_release_date|date_format:"%Y/%m/%d"}--></td>

                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_type|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_brand|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_color|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_data_speed_down|h}--></td>
                    <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].cc_data_speed_up|h}--></td>

                    <td align="center" >
                        <!--{if $tpl_classcategory_id != $arrClassCat[cnt].classcategory_id}-->
                            <a href="?" onclick="eccube.setModeAndSubmit('pre_edit','classcategory_id', <!--{$arrClassCat[cnt].classcategory_id}-->); return false;">編集</a>
                        <!--{else}-->
                            編集中
                        <!--{/if}-->
                    </td>
                    <td align="center">
                        <a href="?" onclick="if(window.confirm('分類名を削除すると、その分類を利用している商品規格が無効になります。\n整合性の問題を把握し、バックアップを行ってから削除することを推奨致します。')){ eccube.setModeAndSubmit('delete','classcategory_id', <!--{$arrClassCat[cnt].classcategory_id}-->); } return false;">削除</a>
                    </td>
                    <td align="center">
                        <!--{if $smarty.section.cnt.iteration != 1}-->
                            <a href="?" onclick="eccube.setModeAndSubmit('up','classcategory_id', <!--{$arrClassCat[cnt].classcategory_id}-->); return false;">上へ</a>
                        <!--{/if}-->
                        <!--{if $smarty.section.cnt.iteration != $smarty.section.cnt.last}-->
                            <a href="?" onclick="eccube.setModeAndSubmit('down','classcategory_id', <!--{$arrClassCat[cnt].classcategory_id}-->); return false;">下へ</a>
                        <!--{/if}-->
                    </td>
                </tr>
            <!--{/section}-->
        </table>
        <div class="btn">
            <a class="btn-action" href="./class.php"><span class="btn-prev">規格一覧に戻る</span></a>
        </div>
    </div>
</form>
