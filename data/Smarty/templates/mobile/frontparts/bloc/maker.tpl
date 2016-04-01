<!--{*
/*
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
 */
*}-->
<!--▼メーカー一覧ここから-->
□メーカー一覧<br>
<!--{section name=cnt loop=$arrMaker}-->
<!--{assign var=maker_id value=$arrMaker[cnt].maker_id}-->
　<font color="<!--{cycle values="#000000,#880000,#8888ff,#88ff88,#ff0000"}-->">■</font><a href="<!--{$path}-->?maker_id=<!--{$arrMaker[cnt].maker_id}-->"><!--{$arrMaker[cnt].name|sfCutString:10:false|h}--></a><br>
<!--{/section}-->
<!--▲メーカー一覧ここまで-->
