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
 * @package Zipaddr
 * @author zipaddrピエールソフト
 * @version id: $
 */
require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

class LC_Page_Plugin_Zipaddr_Config extends LC_Page_Admin_Ex {

	var $arrForm = array();
/**
 * 初期化する.
 * @return void
 */
	function init() {
		parent::init();
		$this->tpl_mainpage = PLUGIN_UPLOAD_REALDIR ."Zipaddr/templates/config.tpl";
		$this->tpl_subtitle = "Zipaddr【稼働環境の設定】";
	}

/**
 * プロセス.
 * @return void
 */
	function process() {
		$this->action();
		$this->sendResponse();
	}

/**
 * Page のアクション.
 * @return void
 */
	function action() {
		$objFormParam = new SC_FormParam_Ex();
		$this->lfInitParam($objFormParam);
		$objFormParam->setParam($_POST);
		$objFormParam->convParam();

		$arrForm = array();
		switch ($this->getMode()) {
		case 'edit':                              // 入力データ処理
			$arrForm = $objFormParam->getHashArray();
			$this->arrErr = $objFormParam->checkError();
			if (count($this->arrErr) == 0) {      // エラーなしの場合にはデータを更新
				$this->arrErr = $this->updateData($arrForm);
				if (count($this->arrErr) == 0) {
					$this->tpl_onload = "alert('登録が完了しました。');";
				}
			}
			break;
		default:                                  // プラグイン情報を取得.
			$plugin = SC_Plugin_Util_Ex::getPluginByPluginCode("Zipaddr");
			$level=$plugin['free_field1'];
			$keta= $plugin['free_field2'];
			$fld3= $plugin['free_field3'];
			if( $level < "1" || "3" < $level ) $level="1";
			if( $keta  < "5" || "7" < $keta  ) $keta= "5";
			$prm= explode("_", $fld3);
			while( count($prm) < 4 ) {$prm[]="";}
			$arrForm= array();
			$arrForm['level'] = $level;
			$arrForm['keta']  = $keta;
			$arrForm['tate']  = $prm[0];
			$arrForm['yoko']  = $prm[1];
			$arrForm['pfon']  = $prm[2];
			$arrForm['sfon']  = $prm[3];
//print_r($arrForm);
//exit;
			break;
		}
		$this->arrForm = $arrForm;
		$this->setTemplate($this->tpl_mainpage);
	}

/**
 * デストラクタ.
 * @return void
 */
	function destroy() {
		parent::destroy();
	}

/**
 * パラメーター情報の初期化
 * @param object $objFormParam SC_FormParamインスタンス
 * @return void
 */
	function lfInitParam(&$objFormParam) {
		$objFormParam->addParam('稼働環境', 'level', array('EXIST_CHECK','NUM_CHECK'));
		$objFormParam->addParam('表示桁数', 'keta',  array('EXIST_CHECK','NUM_CHECK'));
		$objFormParam->addParam('補正縦',   'tate',  array());
		$objFormParam->addParam('補正横',   'yoko',  array());
		$objFormParam->addParam('SIZEpc',   'pfon',  array());
		$objFormParam->addParam('SIZEsp',   'sfon',  array());
	}

/**
 * 入力データをＤＢに反映させる
 * @param type $arrData
 * @return type 
 */
	function updateData($arrData) {
		$keta= $arrData['keta'];                  // 表示桁数
		if( $keta < "5" || "7" < $keta )$keta= "5";
		$tate= "";
		$yoko= "";
		$pfon= "";
		$sfon= "";
		$ta= trim($arrData['tate']);
		$yo= trim($arrData['yoko']);
		$pf= trim($arrData['pfon']);
		$sf= trim($arrData['sfon']);
		if( preg_match("/^[0-9]+$/",$ta) ) $tate=$ta;
		if( preg_match("/^[0-9]+$/",$yo) ) $yoko=$yo;
		if( preg_match("/^[0-9]+$/",$pf) ) $pfon=$pf;
		if( preg_match("/^[0-9]+$/",$sf) ) $sfon=$sf;
		$fld3= $tate."_".$yoko."_".$pfon."_".$sfon;
		$arrErr = array();
		$objQuery =& SC_Query_Ex::getSingletonInstance();
		$objQuery->begin();
		$sqlval = array();                        // UPDATEする値を作成する。
		$sqlval['free_field1'] = $arrData['level'];
		$sqlval['free_field2'] = $keta;
		$sqlval['free_field3'] = $fld3;
		$sqlval['update_date'] = 'CURRENT_TIMESTAMP';
		$where = "plugin_code = 'Zipaddr'";
		$objQuery->update('dtb_plugin', $sqlval, $where); // UPDATEの実行
		$objQuery->commit();
		return $arrErr;
	}

}
?>
