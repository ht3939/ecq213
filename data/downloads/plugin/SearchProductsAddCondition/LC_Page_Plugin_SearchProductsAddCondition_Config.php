<?php
/*
 * SearchProductsAddCondition
 * @Copyright (C) 2014 aratana Inc. All Rights Reserved.
 * @link http://aratana.jp/
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

// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

/**
 * プラグインファイル自動生成のクラス
 *
 * @package SearchProductsAddCondition
 * @author aratana Inc.
 * @version $Id: $
 */
class LC_Page_Plugin_SearchProductsAddCondition_Config extends LC_Page_Admin_Ex {
    // 定数宣言
    const CLASS_NAME = 'SearchProductsAddCondition';
    var $arrForm = array();

    /**
     * 初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = PLUGIN_UPLOAD_REALDIR . self::CLASS_NAME . "/templates/config.tpl";
        $this->tpl_subtitle = "かんたんに検索条件が増えるプラグイン";
    }

    /**
     * プロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        //かならずPOST値のチェックを行う
        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);
        $objFormParam->convParam();
        $arrForm = array();

        switch ($this->getMode()) {
        case 'register':
            $arrForm = $objFormParam->getHashArray();
            $this->arrErr = $objFormParam->checkError();

            // エラーなしの場合にはデータを送信
            if (count($this->arrErr) == 0) {
                $this->arrErr = $this->registData($arrForm);
                if (count($this->arrErr) == 0) {
                    SC_Utils_Ex::clearCompliedTemplate();
                    $this->tpl_onload = "alert('設定が完了しました。');";
                }
            }
            break;
        default:
            $arrForm = $this->loadData();
            $this->tpl_is_init = true;
            break;
        }
        $this->arrForm = $arrForm;
        // ポップアップ用の画面は管理画面のナビゲーションを使わない
        $this->setTemplate($this->tpl_mainpage);
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        //parent::destroy();
    }

    /**
     * パラメーター情報の初期化
     *
     * @param object $objFormParam SC_FormParamインスタンス
     * @return void
     */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('商品ステータス' , 'disp_SearchProductsAddCondition_status',  3, ''  , array());
        $objFormParam->addParam('金額' , 'disp_SearchProductsAddCondition_price',  3, ''  , array());
        $objFormParam->addParam('コメントワード' , 'disp_SearchProductsAddCondition_comment',  3, ''  , array());
    }

    /**
     * プラグイン設定値をDBから取得.
     *
     * @return void
     */
    function loadData() {
        $arrRet = array();
        $arrData = SC_Plugin_Util_Ex::getPluginByPluginCode(self::CLASS_NAME);
        $arrRet = unserialize($arrData['free_field1']);
        return $arrRet;
    }

    /**
     * プラグイン設定値をDBに書き込み.
     *
     * @return void
     */
    function registData($arrData) {
        $objQuery = SC_Query_Ex::getSingletonInstance();

        // UPDATEする値を作成する。
        $sqlval = array();
        $sqlval['free_field1'] = serialize($arrData);
        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $where = "plugin_code = ?";
        $arrWhereVal[] = self::CLASS_NAME;
        // UPDATEの実行
        $objQuery->update('dtb_plugin', $sqlval, $where, $arrWhereVal);
    }
}