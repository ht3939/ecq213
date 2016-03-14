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
 * プラグインのメインクラス
 * @package Zipaddr
 * @author zipaddrピエールソフト
 * @version id: 1.8
 */
class Zipaddr extends SC_Plugin_Base {

/**
 * コンストラクタ
 * プラグイン情報(dtb_plugin)をメンバ変数をセットします.
 */
	public function __construct(array $arrSelfInfo) {
		parent::__construct($arrSelfInfo);
	}

/**
 * インストール
 * installはプラグインのインストール時に実行されます.
 * 引数にはdtb_pluginのプラグイン情報が渡されます.
 * @param array $arrPlugin plugin_infoを元にDBに登録されたプラグイン情報(dtb_plugin)
 * @return void
 */
	function install($arrPlugin) {
		$objQuery =& SC_Query_Ex::getSingletonInstance();
		$objQuery->begin();
		$sqlval = array();
		$sqlval['free_field1'] = "1";
		$sqlval['free_field2'] = "5";
		$sqlval['free_field3'] = "";
		$where = "plugin_code = 'zipaddr'";
		$objQuery->update('dtb_plugin', $sqlval, $where); // UPDATEの実行
		$objQuery->commit();
		copy(PLUGIN_UPLOAD_REALDIR."Zipaddr/logo.png",  PLUGIN_HTML_REALDIR."Zipaddr/logo.png");
		copy(PLUGIN_UPLOAD_REALDIR."Zipaddr/config.php",PLUGIN_HTML_REALDIR."Zipaddr/config.php");
	}

/**
 * アンインストール
 * uninstallはアンインストール時に実行されます.
 * 引数にはdtb_pluginのプラグイン情報が渡されます.
 * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
 * @return void
 */
	function uninstall($arrPlugin) {
		SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR."Zipaddr");
	}

/**
 * 稼働
 * enableはプラグインを有効にした際に実行されます.
 * 引数にはdtb_pluginのプラグイン情報が渡されます.
 * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
 * @return void
 */
	function enable($arrPlugin) {
		// nop
	}

/**
 * 停止
 * disableはプラグインを無効にした際に実行されます.
 * 引数にはdtb_pluginのプラグイン情報が渡されます.
 * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
 * @return void
 */
	function disable($arrPlugin) {
		// nop
	}

/**
 * 処理の介入箇所とコールバック関数を設定
 * registerはプラグインインスタンス生成時に実行されます
 * @param SC_Helper_Plugin $objHelperPlugin 
 */
	function register(SC_Helper_Plugin $objHelperPlugin) {
		$objHelperPlugin->addAction('prefilterTransform',array(&$this,'prefilterTransform'),1);
    }

/**
 * プレフィルタコールバック関数
 * @param string &$source テンプレートのHTMLソース
 * @param LC_Page_Ex $objPage ページオブジェクト
 * @param string $filename テンプレートのファイル名
 * @return void
 */
	function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename){
		$objTransform = new SC_Helper_Transform($source);
		switch($objPage->arrPageLayout['device_type_id']){
			case DEVICE_TYPE_MOBILE:
				break;
			case DEVICE_TYPE_SMARTPHONE:
			case DEVICE_TYPE_PC:
			case DEVICE_TYPE_ADMIN:
			default:                              // admin
				$source= $this->zipaddr_change($source, $filename);
				break;
		}
	}

/* templateの変換処理 */
	function zipaddr_change($output, $filename){
		if( strstr($output,'zip01') == false ) {return $output;}
		if( strstr($filename,'_mail')==false ) {;}
		else {return $output;}
		$zipaddr_VERS='1.8';
		$eccube_VERS= defined('ECCUBE_VERSION') ?  ECCUBE_VERSION : '???';
//btn_address_input.jpgのカット
		$kimgs= '<p class="zipimg">';
		$kimge= '</p>';
		$wk1= strstr($output, $kimgs);
		if( !empty($wk1) ) {
			$wk2= strstr($wk1, $kimge);
			if( !empty($wk2) ) {
				$wk3= str_replace($wk2,"",$wk1).$kimge;
				$output= str_replace($wk3,"", $output);
//				$output= str_replace($wk3,"<p>　【住所自動入力】</p>", $output);
		}	}
//ECCUBE_VERSION
		$plugin = SC_Plugin_Util_Ex::getPluginByPluginCode("Zipaddr");
		$ac = $plugin['free_field1'];  // 1:無償,2:有償,3:御社
		$kt = $plugin['free_field2'];  // 5-7:ガイダンス表示桁数
		$fld3=$plugin['free_field3'];
		if( $kt < "5" || "7" < $kt )  $kt= "5";
		$prm= explode("_", $fld3);
		while( count($prm) < 4 ) {$prm[]="";}
		$ta= $prm[0];
		$yo= $prm[1];
		$pf= $prm[2];
		$sf= $prm[3];
		if( isset($_SERVER['HTTPS']) ) {
			$http= (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS']=='off' ) ?  'http' : 'https';
		}
		else $http= 'http';
		$hosts= isset($_SERVER['SERVER_NAME']) ?  $_SERVER['SERVER_NAME'] : "";
		$pth= $http.'://'.$hosts;
		$ul=  'http://zipaddr.com/js/zipaddr7.js';
		$u2= 'http://zipaddr2.com/js/zipaddr3.js';
		$uls= 'https://zipaddr-com.ssl-xserver.jp/js/zipaddr7.js';
		$u2s='https://zipaddr2-com.ssl-sixcore.jp/js/zipaddr3.js';
		$ph2='https://zipaddr2-com.ssl-sixcore.jp/css/zipaddr.css';
		if( defined('HTTP_URL') || defined('HTTPS_URL') ) {
			if( defined('HTTPS_URL') ) $pth= HTTPS_URL;
			else                       $pth= HTTP_URL;
			$pths= strtolower($pth);
			if( strncmp($pths,"https",5)==0 ) {
				$http='https';
				$ul= $uls;
				$u2= $u2s;
			}
			else $http='http';
			$urls= parse_url($pth); // url解析
			if( isset($urls['host']) ) {
				$pth= $http.'://'.$urls['host'];
				     if( $ac=="3" ) $lpath= $pth.'/js/zipaddr.css';
				else if( $ac=="2" ) {
					$lpath= $pth.'/css/zipaddr.css';
					$wk= @file_get_contents($lpath);
					$wk2=strstr($wk,"autozip");
					if( empty($wk) || empty($wk2) ) $lpath= $ph2; // 定義がなければ補う
				}
			}
			else $lpath= $pth.'/??/zipaddr.css'; // あり得ない
		}
		else $lpath= $pth.'/???/zipaddr.css'; // あり得ない
			 if( $ac=="3" ) $url= $pth.'/js/zipaddr.js';
		else if( $ac=="2" ) $url= $u2;
		else                $url= $ul;
		$js='<script type="text/javascript" src="'.$url.'?v='.$zipaddr_VERS.'" charset="UTF-8"></script>';
		$js.= '<script type="text/javascript" charset="UTF-8">function zipaddr_ownb(){';
		$js.= "ZP.eccube='1';";
		$js.= "ZP.min='".$kt."';";
		if( !empty($ta) ) $js.= 'ZP.top='. $ta.';';
		if( !empty($yo) ) $js.= 'ZP.left='.$yo.';';
		if( !empty($pf) ) $js.= 'ZP.pfon='.$pf.';';
		if( !empty($sf) ) $js.= 'ZP.sfon='.$sf.';';
		$js.= 'ZP.uver=\''.$eccube_VERS.'\';';
		$js.= '}</script>';
		if( $ac=="2" || $ac=="3" ) $js.= '<link rel="stylesheet" href="'.$lpath.'" />';
		return $output.$js;
	}
}
?>
