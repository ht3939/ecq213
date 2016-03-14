<?php
/*
 * DIYCampaign
 *
 * Copyright(c) 2009-2012 SUNATMARK CO.,LTD. All Rights Reserved.
 *
 * http://www.sunatmark.co.jp/
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
 * キャンペーン閲覧クラス.
 *
 * @package Page
 * @author SUNATMARK CO.,LTD.
 */
class plg_DIYCampaign_LC_Page_Admin_Contents_Campaign extends LC_Page_Admin_Ex {
    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();

        $this->tpl_mainpage = PLUGIN_UPLOAD_REALDIR . "DIYCampaign/templates/admin/plg_DIYCampaign_list.tpl";
        $this->tpl_maintitle= "コンテンツ管理";
        $this->tpl_mainno   = "contents";
        $this->tpl_subtitle = "キャンペーン一覧";
        $this->tpl_subno    = "campaign";
        $this->tpl_subnavi  = "contents/subnavi.tpl";

        if ($_POST["mode"] == "hidden_flg" || $_POST["mode"] == "delete") {
            $this->skip_load_page_layout  = true;
        }

        // プラグインが無効化されていたら、動作を停止し、適当なヘッダを出力する
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        if (!$objQuery->exists("dtb_plugin", "plugin_code = 'DIYCampaign' AND enable = 1")) {
            SC_Utils_Ex::sfDispSiteError(PRODUCT_NOT_FOUND);
            SC_Response_Ex::actionExit();
        }
    }

    /**
     * Page のプロセス.
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

        $objQuery   = SC_Query_Ex::getSingletonInstance();

        if (!$this->skip_load_page_layout) {

            // 通常の一覧表示

            // ページリストを取得
            $objQuery->setOrder("update_date DESC");
            $this->campaigns    = $objQuery->select("t1.*, t2.page_name AS campaign_name", "plg_diycampaign_campaigns AS t1 INNER JOIN dtb_pagelayout AS t2 ON t1.page_id = t2.page_id");

            // 商品IDを取得
            $objProduct = new SC_Product_Ex();
            $productIDs = array();
            foreach ($this->campaigns as &$campaign) {
                $campaign["items"]  = array();
                $layout_json        = json_decode($campaign["layout_json"], true);
                foreach ($layout_json["rows"] as $row) {
                    foreach ($row as $column) {
                        foreach ($column as $value) {
                            if (preg_match("/^__(\d+)__$/", $value, $matches)) {
                                $product_id     = intval($matches[1]);
                                $productIDs[]   = $product_id;
                                $campaign["items"][$product_id] = array();
                            }
                        }
                    }
                }
            }

            // 商品データを取得
            $objQuery->setOrder("");
            $products   = $objProduct->getListByProductIds(&$objQuery, array_values(array_unique($productIDs, SORT_NUMERIC)));
            $productIDs = array_keys($products);
            foreach ($this->campaigns as &$campaign) {
                foreach ($campaign["items"] as $product_id => &$item) {
                    if (in_array($product_id, $productIDs, true)) {
                        $item   = $products[$product_id];
                    }
                }
            }
        } else {

            // AJAXアクセス: 公開設定の編集やキャンペーンの削除など
            header("Content-Type: application/json; charset=utf-8");

            // パラメータ取得
            $objFormParam   = new SC_FormParam_Ex();
            $this->lfInitFormParam($objFormParam, $_POST);
            $arrPost    = $objFormParam->getHashArray();

            // エラーがあればその旨を返して終了
            $this->arrErr   = $this->lfCheckError($objFormParam);
            if (!SC_Utils_Ex::isBlank($this->arrErr)) {
                $arrJSON    = array(
                    "affected"  => 0,
                    "message"   => "エラーが発生しました。",
                    "error"     => true
                );
                echo json_encode($arrJSON);
                SC_Response_Ex::actionExit();
            }

            $campaign_id    = $objFormParam->getValue("campaign_id");
            $hidden_flg     = $objFormParam->getValue("hidden_flg") > 0 ? 1 : 0;

            switch ($_POST["mode"]) {

                case "hidden_flg":

                    // 公開設定を更新
                    $result = $objQuery->update("plg_diycampaign_campaigns", array("hidden_flg" => $hidden_flg), "campaign_id = ?", (array)$campaign_id);

                    // JSONオブジェクトを返して終了
                    if (is_numeric($result)) {
                        if ($result === 1) {

                            $data   = $objQuery->getRow("t1.campaign_id, t2.page_name AS campaign_name", "plg_diycampaign_campaigns AS t1 INNER JOIN dtb_pagelayout AS t2 ON t1.page_id = t2.page_id", "campaign_id = ?", (array)$campaign_id);

                            $arrJSON    = array(
                                "affected"  => 1,
                                "message"   => sprintf("【%s】を%sしました。", $data["campaign_name"], ($hidden_flg === 1 ? "非公開に" : "公開")),
                                "error"     => false
                            );
                        } else {
                            $arrJSON    = array(
                                "affected"  => 0,
                                "message"   => "公開設定は変更されませんでした。",
                                "error"     => false
                            );
                        }
                    } else {
                        $arrJSON    = array(
                            "affected"  => 0,
                            "message"   => "公開設定の変更でエラーが発生しました。",
                            "error"     => true
                        );
                    }
                    break;

                case "delete":

                    // 削除する前にキャンペーンデータを取得
                    $data   = $objQuery->getRow("*", "plg_diycampaign_campaigns", "campaign_id = ?", (array)$campaign_id);

                    // 削除
                    $result = $objQuery->delete("plg_diycampaign_campaigns", "campaign_id = ?", (array)$campaign_id);

                    // JSONオブジェクトを返して終了
                    if (is_numeric($result)) {
                        if ($result === 1) {

                            // テンプレートファイルを削除
                            $data   = $objQuery->getRow("*", "dtb_pagelayout", "page_id = ?", array($data["page_id"]));

                            $files  = array(
                                TEMPLATE_REALDIR . $data["filename"] . ".tpl",
                                TEMPLATE_REALDIR . $data["filename"] . "_preview.tpl"
                            );
                            foreach ($files as $realfilename) {
                                if (file_exists($realfilename)) {
                                    unlink($realfilename);
                                }
                            }

                            // dtb_pagelayoutから削除
                            $objQuery->delete("dtb_pagelayout", "page_id = ?", array($data["page_id"]));

                            $arrJSON    = array(
                                "affected"  => 1,
                                "message"   => "キャンペーンを削除しました。",
                                "error"     => false
                            );
                        } else {
                            $arrJSON    = array(
                                "affected"  => 0,
                                "message"   => "キャンペーンは削除されませんでした。",
                                "error"     => false
                            );
                        }
                    } else {
                        $arrJSON    = array(
                            "affected"  => 0,
                            "message"   => "キャンペーンの削除でエラーが発生しました。",
                            "error"     => true
                        );
                    }
                    break;

                default:
                    $arrJSON    = array(
                        "affected"  => 0,
                        "message"   => "不正な操作が行われました。",
                        "error"     => true
                    );
            }
            echo json_encode($arrJSON);
            SC_Response_Ex::actionExit();
        }
    }

    /**
     * パラメータの初期化を行う
     * @param Object $objFormParam
     */
    function lfInitFormParam(&$objFormParam, $arrPost){

        $objFormParam->addParam("キャンペーンID", "campaign_id", MTEXT_LEN, "n", array("MAX_LENGTH_CHECK","NO_SPTAB", "NUM_CHECK"));
        $objFormParam->addParam("公開設定", "hidden_flg", 1, "n", array("MAX_LENGTH_CHECK","NO_SPTAB", "NUM_CHECK"));
        $objFormParam->setParam($arrPost);
        $objFormParam->convParam();
    }

    /**
     * 入力されたパラメータのエラーチェックを行う。
     * @param Object $objFormParam
     * @return Array エラー内容
     */
    function lfCheckError(&$objFormParam){
        $objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
        $objErr->arrErr = $objFormParam->checkError();
        return $objErr->arrErr;
    }

    /**
     * 破棄されるときの処理
     *
     * @return void
     */
    function destroy() {
        // do nothing
    }
}
?>