<?php
/*
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
 *
 * プラグインの情報クラス
 * @package Zipaddr
 * @author zipaddrピエールソフト
 * @version id: 1.8
 * 
 * 更新履歴:
 * 2013/12/18 V1.0 新規作成
 * 2013/12/22 V1.1 対象を管理画面に拡大
 * 2013/12/25 V1.2 ガイダンス画面の表示桁選択
 * 2014/02/03 V1.3 btn_address_input.jpgのカット
 * 2014/02/09 V1.4 eccube識別フラグの定数定義
 * 2014/03/30 V1.5 御社サイト内で郵便番号簿の管理をするモード追加
 * 2014/09/13 V1.6 ガイダンス画面の文字サイズ変更機能を追加
 * 2014/12/12 V1.7 サーバアップによるurl変更
 * 2015/06/06 V1.8 Google Codeサービス閉鎖による修正
 */
class plugin_info{
static $PLUGIN_CODE      = "Zipaddr";                  // プラグイン識別(必須)
static $PLUGIN_NAME      = "郵便番号から住所自動入力"; // プラグイン名(必須)
static $PLUGIN_VERSION   = "1.8";                      // プラグインバージョン(必須)
static $COMPLIANT_VERSION= "maybe ALL";                // 対応バージョン(必須)
static $AUTHOR           = "zipaddrピエールソフト";    // 作者(必須)
static $DESCRIPTION      = "郵便番号から住所の一部を自動入力するZipAddr"; // プラグイン説明(必須)
static $PLUGIN_SITE_URL  = "http://zipaddr.com/eccube/plugin.html"; // 説明ページURL
static $AUTHOR_SITE_URL  = "http://pierre-soft.com/";  // プラグイン作成者URL
static $CLASS_NAME       = "Zipaddr";                  // クラス名(必須)
static $HOOK_POINTS      = array(                      // フックポイント
	array("prefilterTransform", 'prefilterTransform'));
static $LICENSE          = "LGPL";                     // ライセンス
}
?>
