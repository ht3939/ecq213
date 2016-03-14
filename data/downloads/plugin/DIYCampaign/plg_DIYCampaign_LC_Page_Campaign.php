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
require_once CLASS_EX_REALDIR . 'page_extends/LC_Page_Ex.php';

/**
 * 表示クラス
 *
 * @package Page
 * @author SUNATMARK CO.,LTD.
 */
class plg_DIYCampaign_LC_Page_Campaign extends LC_Page_Ex {
    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();

        $this->tpl_subnavi  = "";
        $this->tpl_subno    = "campaign";
        $this->tpl_subtitle = "キャンペーン";
        $this->tpl_mainno   = "";

        $this->tpl_mainpage_login   = PLUGIN_UPLOAD_REALDIR . "DIYCampaign/templates/plg_DIYCampaign_login.tpl";

        // プラグインが無効化されていたら、動作を停止し、適当なヘッダを出力する
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        if (!$objQuery->exists("dtb_plugin", "plugin_code = 'DIYCampaign' AND enable = 1")) {
            SC_Utils_Ex::sfDispSiteError(PRODUCT_NOT_FOUND);
            SC_Response_Ex::actionExit();
        }

        if ($_POST["mode"] == "login") {
            $this->httpCacheControl('nocache');
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

        $objQuery =& SC_Query_Ex::getSingletonInstance();

        // パラメータ取得
        $objFormParam   = new SC_FormParam_Ex();
        $this->lfInitFormParam($objFormParam, $_REQUEST);

        // エラーがあればその旨を表示して終了
        $this->arrErr   = $this->lfCheckError($objFormParam);
        if (!SC_Utils_Ex::isBlank($this->arrErr)) {

            switch ($_POST["mode"]) {
                case "login":
                    $this->tpl_mainpage = $this->tpl_mainpage_login;
                    $this->arrForm      = $objFormParam->getHashArray();

                    break;

                default:
                    SC_Utils_Ex::sfDispSiteError("n/a");
                    SC_Response_Ex::actionExit();
            }
        }

        // プレビュー認証キーを取得
        $key    = $objFormParam->getValue("key");
        $is_preview = !empty($key);

        // キャンペーンIDを取得
        $this->campaign_id    = $objFormParam->getValue("campaign_id");

        // 本番のキャンペーン情報を取得
        $this->campaign = array();
        $where  = $is_preview ? "campaign_id = ?" : "campaign_id = ? AND hidden_flg = 0";
        if (!empty($this->campaign_id)) {
            $this->campaign = $objQuery->getRow("t1.*, t2.page_name AS campaign_name, t2.device_type_id, t2.url", "plg_diycampaign_campaigns AS t1 INNER JOIN dtb_pagelayout AS t2 ON t1.page_id = t2.page_id", $where, (array)$this->campaign_id);
        }

        // プレビュー認証キーがある場合はプレビュー、そうでなければ本番
        if ($is_preview) {

            // プレビュー用のキャンペーン情報を取得
            $campaign_temp  = $objQuery->getRow("*", "plg_diycampaign_campaigns_temp", "display_key = ?", (array)$key);

            if (!empty($this->campaign)) {
                $campaign_temp["url"]   = $this->campaign["url"];
                $campaign_temp["device_type_id"]   = $this->campaign["device_type_id"];
            }
            $this->campaign = $campaign_temp;

        } else {

            // 会員限定の場合、ログインチェック
            if (array_key_exists("member_flg", $this->campaign) && $this->campaign["member_flg"] == 1) {

                $objCustomer= new SC_Customer_Ex();
                $is_login   = (
                    $objCustomer->isLoginSuccess(true) ||
                    $objCustomer->getCustomerDataFromEmailPass($objFormParam->getValue("login_pass"), $objFormParam->getValue("login_email"))
                );

                if (!$is_login) {
                    $this->tpl_mainpage = $this->tpl_mainpage_login;

                    $objCookie = new SC_Cookie_Ex();

                    // クッキー判定(メールアドレスをクッキーに保存しているか）
                    $this->tpl_login_email = $objCookie->getCookie('login_email');
                    if ($this->tpl_login_email != '') {
                        $this->tpl_login_memory = '1';
                    }

                    // POSTされてきたIDがある場合は優先する。
                    if (isset($_POST['login_email']) && !empty($_POST['login_email'])) {
                        $this->tpl_login_email = $_POST['login_email'];
                    }

                    // 携帯端末IDが一致する会員が存在するかどうかをチェックする。
                    if (SC_Display_Ex::detectDevice() === DEVICE_TYPE_MOBILE) {
                        $this->tpl_valid_phone_id   = $objCustomer->checkMobilePhoneId();
                    }

                    // あとの処理は不要なので終了する。
                    return;
                }
            }
        }

        // キャンペーンがなければエラー
        if (empty($this->campaign)) {
            SC_Utils_Ex::sfDispSiteError(PRODUCT_NOT_FOUND);
            SC_Response_Ex::actionExit();
        }

        // ログイン不要のキャンペーンか、ログインしている場合

        // ブロック情報を取得
        if (array_key_exists("url", $this->campaign)) {
            $objPageLayout  = new SC_Helper_PageLayout();
            $objPageLayout->sfGetPageLayout($this, false, $this->campaign["url"], $this->campaign["device_type_id"]);
        }

        // タイトル
        $this->tpl_subtitle = $this->campaign["campaign_name"];

        // テンプレート決定
        $basefilename   = $is_preview ? "plg_DIYCampaign_%03d_%010d_preview" : "plg_DIYCampaign_%03d_%010d";
        $this->tpl_mainpage = TEMPLATE_REALDIR . USER_DIR . sprintf($basefilename, DEVICE_TYPE_PC, $this->campaign_id) . ".tpl";

        // レイアウト構築
        $this->layout   = array();
        $layout = json_decode($this->campaign["layout_json"], true);
        $this->max_width    = 0;

        $objProduct = new SC_Product_Ex();
        $productIDs = array();

        foreach($layout["rows"] as $row_index => $row) {
            $row_data   = array();
            foreach ($row as $column) {
                $column_data    = array(
                    "items" => array(),
                    "width" => 0
                );
                foreach ($column as $key => $item) {
                    if ($key === "width") {

                        $column_data["width"]   = intval($item);
                        if ($row_index === 0) {
                            $this->max_width   += intval($item);
                        }

                    } elseif (preg_match("/^__(\d+)__$/", $item, $matches)) {

                        // 商品ID
                        $product_id             = intval($matches[1]);
                        $productIDs[]           = $product_id;
                        $column_data["items"][] = $product_id;

                    } elseif (!SC_Utils_Ex::isBlank($item)) {

                        // 入力データ（設定情報は除去する）
                        $column_data["items"][] = substr($item, 0, strpos($item, "%%"));
                    }
                }
                if (count($column_data["items"]) === 0) {
                    $column_data["items"][] = "&nbsp;";
                }
                $row_data[] = $column_data;
            }
            if (count($row_data) === 0) {
                continue;
            }
            $this->layout[] = $row_data;
        }

        // 商品データ取得
        $products   = $objProduct->getListByProductIds(&$objQuery, array_values(array_unique($productIDs, SORT_NUMERIC)));
        $productIDs = array_keys($products);
        foreach ($this->layout as &$row) {
            foreach ($row as &$column) {
                foreach ($column["items"] as $i => $product_id) {
                    // アイテムデータを型チェック込みで比較。商品IDなら商品データを入れる
                    if (in_array($product_id, $productIDs, true)) {
                        $column["items"][$i]    = $products[$product_id];
                    }
                }
            }
        }
    }

    public function destroy()
    {
    }

    /**
     * パラメータの初期化を行う
     * @param Object $objFormParam
     */
    function lfInitFormParam(&$objFormParam, $arrPost){
        $objFormParam->addParam("キャンペーンID", "campaign_id", 0, "n", array("NO_SPTAB", "NUM_CHECK", "EXIST_CHECK"));
        $objFormParam->addParam("プレビュー認証キー", "key", MTEXT_LEN, "KVa", array("MAX_LENGTH_CHECK","SPTAB_CHECK"));

        if ($_POST["mode"] == "login") {
            $objFormParam->addParam("メールアドレス", "login_email", MTEXT_LEN, "KVa", array("MAX_LENGTH_CHECK","NO_SPTAB", "EXIST_CHECK"));
            $objFormParam->addParam("パスワード", "login_pass", MTEXT_LEN, "KVa", array("MAX_LENGTH_CHECK","NO_SPTAB", "EXIST_CHECK"));
        }

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
}
?>