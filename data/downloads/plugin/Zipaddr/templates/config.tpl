<!--{*
 * Zipaddr
 * Copyright (C) 2013 pierre-soft All Rights Reserved.
 * http://zipaddr.com/
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

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<script type="text/javascript">
</script>

<h2><!--{$tpl_subtitle}--></h2>
<form name="form1" id="form1" method="post" action="<!--{$smarty.server.REQUEST_URI|h}-->">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="edit">
<p>　郵便番号DBの稼働環境を変更することができます。<br/>
    <br/>
</p>

<table border="0" cellspacing="1" cellpadding="8" summary=" ">
    <tr>
        <td colspan="2" width="90" bgcolor="#f3f3f3">▼動作環境の選択（<span style="color: #ff0000;">※</span>：必須）</td>
    </tr>
    <tr >
        <td bgcolor="#f3f3f3">利用サイト<span class="red">※</span></td>
        <td>
        <!--{assign var=key value="level"}-->
        <span class="red"><!--{$arrErr[$key]}--></span>
        <label><input type="radio" name="level" value="1" <!--{if $arrForm.level == "1"}-->checked<!--{/if}--> >商用版のサイト（default）</input></label><br/>
        <label><input type="radio" name="level" value="2" <!--{if $arrForm.level == "2"}-->checked<!--{/if}--> >有償版のサイト</input></label><br/>
        <label><input type="radio" name="level" value="3" <!--{if $arrForm.level == "3"}-->checked<!--{/if}--> >御社サイト内で郵便番号簿管理</input></label>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">ガイダンス画面の出力<span class="red">※</span></td>
        <td>
        <!--{assign var=key value="keta"}-->
        <span class="red"><!--{$arrErr[$key]}--></span>
        <label><input type="radio" name="keta" value="5" <!--{if $arrForm.keta == "5"}-->checked<!--{/if}--> >5桁～（default）</input></label><br/>
        <label><input type="radio" name="keta" value="6" <!--{if $arrForm.keta == "6"}-->checked<!--{/if}--> >6桁～</input></label><br/>
        <label><input type="radio" name="keta" value="7" <!--{if $arrForm.keta == "7"}-->checked<!--{/if}--> >7桁～</input></label>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">ガイダンス表示位置の補正</td>
        <td>
縦：<input type="text" name="tate" size="5" maxlength="4" style="ime-mode:disabled;" value="<!--{$arrForm.tate}-->" />　（default: 18）<br />
横：<input type="text" name="yoko" size="5" maxlength="4" style="ime-mode:disabled;" value="<!--{$arrForm.yoko}-->" />　（default: 22）
        </td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">ガイダンス画面の文字サイズ</td>
        <td>
PC：<input type="text" name="pfon" size="5" maxlength="4" style="ime-mode:disabled;" value="<!--{$arrForm.pfon}-->" />　（default: 12）<br />
SP：<input type="text" name="sfon" size="5" maxlength="4" style="ime-mode:disabled;" value="<!--{$arrForm.sfon}-->" />　（default: 20）
        </td>
    </tr>
    <tr >
        <td colspan="2">
▼郵便番号DBの稼働場所は、次の3系統があります。<br />
　商用版サイト： http://zipaddr.com/ 系<br />
　有償版サイト： http://zipaddr2.com/ 系<br />
　御社サイト版： http://zipaddr3.com/ 系<br />
<br />
※有償版は利用申請をしないと動きません。<br />
▼有償版のご利用には別途、<a href="https://zipaddr2-com.ssl-sixcore.jp/use/" target="_blank">利用申請（有償）</a> が必要となります。<br />
▼御社サイト版のご利用には別途、<a href="https://zipaddr3-com.ssl-sixcore.jp/use/" target="_blank">利用申請（有償）</a> が必要となります。<br />
        </td>
    </tr>
</table>

<div class="btn-area">
    <ul>
        <li>
            <a class="btn-action" href="javascript:;" onclick="document.form1.submit();return false;"><span class="btn-next">この内容で登録する</span></a>
        </li>
    </ul>
</div>

</form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
