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
 * キャンペーン編集クラス.
 *
 * @package Page
 * @author SUNATMARK CO.,LTD.
 */
class plg_DIYCampaign_LC_Page_Admin_Contents_Campaign_Edit extends LC_Page_Admin_Ex {
    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();

        $this->is_db_mysql    = strcasecmp(DB_TYPE, "mysql") === 0;

        $this->tpl_mainpage = PLUGIN_UPLOAD_REALDIR . "DIYCampaign/templates/admin/plg_DIYCampaign_edit.tpl";
        $this->tpl_maintitle = "コンテンツ管理";
        $this->tpl_mainno   = "contents";
        $this->tpl_subtitle = "キャンペーン編集";
        $this->tpl_subno    = "campaign";
        $this->tpl_subnavi  = "contents/subnavi.tpl";

        // コピー元テンプレート
        $this->template_main= PLUGIN_UPLOAD_REALDIR . "DIYCampaign/templates/plg_DIYCampaign_main.tpl";

        // JSONを返すべきmode群
        $this->json_modes   = array("get_items", "get_items_by_ids", "preview");

        // セッション変数がなければ初期化
        if (!array_key_exists("plg_diycampaign", $_SESSION)) {
            $_SESSION["plg_diycampaign"] = array();
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

        // ヘッダ送出
        $this->sendAppropriateHeaders();

        // パラメータ取得
        $objFormParam   = new SC_FormParam_Ex();
        $this->lfInitFormParam($objFormParam, $_REQUEST);
        $this->arrErr   = $this->lfCheckError($objFormParam);

        // エラーがあればその旨を返して終了
        if (!SC_Utils_Ex::isBlank($this->arrErr)) {
            if ($this->isJsonExpected()) {
                $arrJSON    = array(
                     "message"  => "以下のエラーが発生しました。\n\n" . preg_replace("|<br */?>|", "", implode("\n", $this->arrErr))
                    ,"error"    => true
                );
                echo json_encode($arrJSON);
                SC_Response_Ex::actionExit();
            }
        }

        $mode   = $this->getMode();
        switch ($mode) {

            case "get_items":
            case "get_items_by_ids":

                $this->skip_load_page_layout  = true;

                $objQuery   =& SC_Query_Ex::getSingletonInstance();
                $objProduct = new SC_Product_Ex();

                $arrReturnValue = array();
                $arrReturnValue["items"]    = array();

                if ($mode == "get_items_by_ids") {
                    // 商品IDで呼び出された時

                    // 製品リストを取得
                    $productIDs     = explode(",", $objFormParam->getValue("product_ids"));
                    $arrProducts    = $objProduct->getListByProductIds(&$objQuery, $productIDs);
                } else {
                    // カテゴリーIDで商品リストが呼び出された時
                    $category_id    = $objFormParam->getValue("category_id");
                    $page           = $objFormParam->getValue("page");
                    $n              = $objFormParam->getValue("n");
                    $limit  = $n;
                    $offset = ($page - 1) * $n;

                    if (!SC_Utils_Ex::isBlank($category_id)) {
                        //表示条件の取得
                        $this->arrSearchData = array(
                             'category_id'  => $this->lfGetCategoryId(intval($category_id))
                            ,'maker_id'     => 0
                            ,'name'         => ""
                        );
                    }

                    // 製品リストを取得
                    $arrSearchCondition = $this->lfGetSearchCondition($this->arrSearchData);
                    $count  = $this->lfGetProductsListCount($arrSearchCondition, $objProduct);
                    $arrProducts    = $this->lfGetProductsList($arrSearchCondition, $objProduct, $limit, $offset);
                    $arrReturnValue["count"]    = $count;
                }

                foreach ($arrProducts as $product) {

                    if (!array_key_exists("product_id", $product)) {
                        continue;
                    }

                    $arrReturnValue["items"][]    = array(
                         "id"    => $product["product_id"]
                        ,"name"  => $product["name"]
                        ,"code"  => $product["product_code_min"] == $product["product_code_max"] ? $product["product_code_min"] : sprintf("%s ～ %s", $product["product_code_min"], $product["product_code_max"])
                        ,"image" => array(
                            "src"   => IMAGE_SAVE_URLPATH . (!empty($product["main_list_image"]) ? $product["main_list_image"] : SC_Utils_Ex::sfNoImageMainList($product["main_list_image"])),
                            "alt"   => $product["name"]
                        )
                    );
                }
                echo json_encode($arrReturnValue);
                SC_Response_Ex::actionExit();
                break;

            case "preview":

                $data   = array();
                $data["layout_json"]    = $objFormParam->getValue("layout_json");
                $data["campaign_name"]  = $objFormParam->getValue("campaign_name");
                $data["display_key"]    = $this->makeRandumString(100); // 255まで可

                $objQuery =& SC_Query_Ex::getSingletonInstance();
                $table  = "plg_diycampaign_campaigns_temp";

                // 一時情報の新規追加
                $objQuery->insert($table, $data);

                // 24時間以上前のデータは不要とみなして削除する
                $sql    = $this->is_db_mysql ?
                    "create_date <= CURRENT_TIMESTAMP - INTERVAL 1 DAY":
                    "create_date <= CURRENT_TIMESTAMP - INTERVAL '1 DAY'";
                $objQuery->delete($table, $sql);

                // 24時間以上前のプレビューファイルも不要とみなして削除する
                $interval   = 60*60*24;
                $dir    = dir(TEMPLATE_REALDIR . USER_DIR);
                while (false !== ($file = $dir->read())) {
                    if (!preg_match("/^\.\.?$/", $file) && preg_match("/^plg_DIYCampaign.+_preview\.tpl$/", $file)) {
                        $realfile   = $dir->path . DIRECTORY_SEPARATOR . $file;
                        $timestamp  = filemtime($realfile);
                        if (time() - $timestamp > $interval){
                            unlink($realfile);
                        }
                    }
                }
                $dir->close();

                // キャンペーンIDを取得。新規作成時は空なので、ダミーを作成する
                $data["campaign_id"]    = $objFormParam->getValue("campaign_id");
                if (empty($data["campaign_id"])) {
                    $data["campaign_id"] = mt_rand(9000000000, 9999999999);
                }

                // テンプレートファイルを作成/更新する
                $new_template_name  = sprintf("plg_DIYCampaign_%03d_%010d_preview", DEVICE_TYPE_PC, $data["campaign_id"]);
                $this->template_main    = TEMPLATE_REALDIR . USER_DIR . $new_template_name . ".tpl";
                file_put_contents($this->template_main, $objFormParam->getValue("campaign_source"));

                // フロント側にJSONデータを返して終了
                $arrReturnValue = array(
                     "baseurl"      => PLUGIN_HTML_URLPATH . "DIYCampaign/campaign.php"
                    ,"campaign_id"  => $data["campaign_id"]
                    ,"key"          => $data["display_key"]
                );
                echo json_encode($arrReturnValue);
                SC_Response_Ex::actionExit();
                break;

            case "save":

                $data   = array();
                $data_for_dtb_pagelayout    = array();
                $parts_data = array();

                $data["campaign_id"]    = $objFormParam->getValue("campaign_id");
                $data["layout_json"]    = $objFormParam->getValue("layout_json");

                if (count($this->arrErr) === 0) {

                    $data["campaign_comment"]   = $objFormParam->getValue("campaign_comment");
                    $data["update_date"]        = "CURRENT_TIMESTAMP";
                    $data["member_flg"]         = $objFormParam->getValue("member_flg") > 0 ? 1 : 0;
                    $data["hidden_flg"]         = $objFormParam->getValue("hidden_flg");

                    $data_for_dtb_pagelayout["keyword"]     = $objFormParam->getValue("campaign_keywords");
                    $data_for_dtb_pagelayout["description"] = $objFormParam->getValue("campaign_description");
                    $data_for_dtb_pagelayout["page_name"]   = $objFormParam->getValue("campaign_name");

                    $layout_json    = json_decode($data["layout_json"], true);
                    $parts_data["parts_content"]    = serialize($layout_json["parts"]);

                    $objQuery =& SC_Query_Ex::getSingletonInstance();
                    $objQuery->begin();

                    $campaign_table  = "plg_diycampaign_campaigns";
                    $layout_table    = "dtb_pagelayout";
                    $parts_table     = "plg_diycampaign_parts";
                    $template_basename  = "plg_DIYCampaign_%03d_%010d";

                    if (!empty($data["campaign_id"]) && $objQuery->exists($campaign_table, "campaign_id = ?", (array)$data["campaign_id"])) {

                        // 更新
                        $objQuery->update($layout_table, $data_for_dtb_pagelayout, "page_id = ?", (array)$objFormParam->getValue("page_id"));
                        $objQuery->update($campaign_table, $data, "campaign_id = ?", (array)$data["campaign_id"]);
                        $objQuery->update($parts_table, $parts_data, "parts_user_id = ?", (array)$this->tpl_authority);

                    } else {

                        // キャンペーンIDを取得
                        if ($this->is_db_mysql) {
                            $data["campaign_id"]    = $objQuery->nextVal("plg_diycampaign_campaigns_campaign_id");
                        } else {
                            unset($data["campaign_id"]);
                        }
                        $data["page_id"]    = $objQuery->nextVal("dtb_pagelayout_page_id");
                        $objQuery->insert($campaign_table, $data);

                        $data   = $objQuery->getRow("*", $campaign_table, "page_id = ?", $data["page_id"]);
                        $new_template_name  = sprintf($template_basename, DEVICE_TYPE_PC, $data["campaign_id"]);

                        // dtb_pagelayoutに追加
                        $data_for_dtb_pagelayout["page_id"]     = $data["page_id"];
                        $data_for_dtb_pagelayout["device_type_id"]  = DEVICE_TYPE_PC;
                        $data_for_dtb_pagelayout["url"]         = USER_DIR . $new_template_name . ".php";
                        $data_for_dtb_pagelayout["filename"]    = USER_DIR . $new_template_name;
                        $data_for_dtb_pagelayout["header_chk"]  = 1;
                        $data_for_dtb_pagelayout["footer_chk"]  = 1;
                        $data_for_dtb_pagelayout["edit_flg"]    = 2;
                        $data_for_dtb_pagelayout["author"]      = "";
                        $data_for_dtb_pagelayout["update_url"]  = "";
                        $data_for_dtb_pagelayout["update_date"]  = "CURRENT_TIMESTAMP";
                        $data_for_dtb_pagelayout["meta_robots"] = "";

                        // 新規追加
                        $objQuery->insert($layout_table, $data_for_dtb_pagelayout);

                        if (!$objQuery->exists($parts_table, "parts_user_id = ?", (array)$this->tpl_authority)) {
                            $parts_data["parts_user_id"]    = $this->tpl_authority;
                            $objQuery->insert($parts_table, $parts_data);
                        } else {
                            $objQuery->update($parts_table, $parts_data, "parts_user_id = ?", (array)$this->tpl_authority);
                        }
                    }

                    // キャンペーンIDが未指定の画像があれば指定させる
                    $oldstr = "campaign_id=\\\"";
                    $newstr = sprintf("campaign_id=%d\\\"", $data["campaign_id"]);
                    $layout_json    = str_replace($oldstr, $newstr, $data["layout_json"]);
                    $values = array(
                        "layout_json"   => $layout_json
                    );
                    $objQuery->update($campaign_table, $values, "campaign_id = ?", (array)$data["campaign_id"]);

                    $objQuery->commit();

                    // テンプレートファイルを作成/更新する
                    $new_template_name  = sprintf($template_basename, DEVICE_TYPE_PC, $data["campaign_id"]);
                    file_put_contents(TEMPLATE_REALDIR . USER_DIR . $new_template_name . ".tpl", $objFormParam->getValue("campaign_source"));

                    $url    = ROOT_URLPATH . ADMIN_DIR . "contents/plg_DIYCampaign.php";
                    SC_Response_Ex::sendRedirect($url);
                }
                else {
                    // 入力エラー
                    $data["campaign_keywords"]      = $objFormParam->getValue("campaign_keywords");
                    $data["campaign_description"]   = $objFormParam->getValue("campaign_description");
                    $this->default_layout   =& $data["layout_json"];
                    $this->campaign_source  = $objFormParam->getValue("campaign_source");
                    $this->data = $data;
                }
                break;

            case "quit":

                $objQuery =& SC_Query_Ex::getSingletonInstance();

                // リダイレクト
                $url    = ROOT_URLPATH . ADMIN_DIR . "contents/plg_DIYCampaign.php";
                SC_Response_Ex::sendRedirect($url);
                SC_Response_Ex::actionExit();
                break;

            default:

                // カテゴリ取得
                $objDb = new SC_Helper_DB_Ex();
                $this->arrCategories = $objDb->sfGetCategoryList();

                $objQuery =& SC_Query_Ex::getSingletonInstance();

                $layout = array();
                $table  = "plg_diycampaign_campaigns AS t1 JOIN dtb_pagelayout AS t2 ON t1.page_id = t2.page_id";
                $campaign_id    = $_GET["campaign_id"];
                if (!empty($campaign_id) && $objQuery->exists($table, "campaign_id = ?", (array)$campaign_id)) {
                    $data   = $objQuery->getRow("t1.*, t2.page_id, t2.page_name AS campaign_name, t2.filename, t2.keyword AS campaign_keywords, t2.description AS campaign_description", $table, "campaign_id = ?", (array)$campaign_id);
                    $this->campaign_source  = file_get_contents(TEMPLATE_REALDIR . $data["filename"] . ".tpl");
                    $layout = json_decode($data["layout_json"], true);
                } else {
                    $this->campaign_source  = file_get_contents($this->template_main);
                }

                // パーツデータ
                $parts  = $objQuery->get("parts_content", "plg_diycampaign_parts", "parts_user_id = ?", (array)$this->tpl_authority);
                $data["layout_json"]    = array();
                if (!empty($parts)) {
                    $layout["parts"]        = unserialize($parts);
                    $data["layout_json"]    = json_encode($layout);
                }
                $this->default_layout   =& $data["layout_json"];
                $this->data = $data;
        }
    }

    /**
     * パラメータの初期化を行う
     * @param Object $objFormParam
     */
    function lfInitFormParam(&$objFormParam, $arrPost)
    {
        switch ($this->getMode()) {
            case "get_items_by_ids":
                $objFormParam->addParam("商品ID", "product_ids", LTEXT_LEN, "a", array("MAX_LENGTH_CHECK", "NO_SPTAB", "EXIST_CHECK"));
                break;

            case "get_items":
                $objFormParam->addParam("カテゴリーID", "category_id", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK", "EXIST_CHECK"));
                $objFormParam->addParam("取得商品ページ数", "page", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK", "EXIST_CHECK"));
                $objFormParam->addParam("取得商品点数", "n", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK", "EXIST_CHECK"));
                break;

            case "preview":
                $objFormParam->addParam("キャンペーン名", "campaign_name", MTEXT_LEN, "KV", array("MAX_LENGTH_CHECK", "SPTAB_CHECK", "EXIST_CHECK"));
                $objFormParam->addParam("公開設定", "hidden_flg", 1, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK"));
                break;

            case "save":
                $objFormParam->addParam("キャンペーン名", "campaign_name", MTEXT_LEN, "KV", array("MAX_LENGTH_CHECK", "SPTAB_CHECK", "EXIST_CHECK"));
                $objFormParam->addParam("公開設定", "hidden_flg", 1, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK", "EXIST_CHECK"));
                $objFormParam->addParam("ページID", "page_id", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK", "EXIST_CHECK"));
                break;

            default:
        }

        $objFormParam->addParam("キャンペーンID", "campaign_id", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK"));
        $objFormParam->addParam("会員限定", "member_flg", 1, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK"));

        $objFormParam->addParam("カテゴリーID", "category_id", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NO_SPTAB", "NUM_CHECK"));
        $objFormParam->addParam("コメント", "campaign_comment", MTEXT_LEN, "KV", array("MAX_LENGTH_CHECK", "SPTAB_CHECK"));
        $objFormParam->addParam("meta keywords", "campaign_keywords", MTEXT_LEN, "KV", array("MAX_LENGTH_CHECK", "SPTAB_CHECK"));
        $objFormParam->addParam("meta description", "campaign_description", MTEXT_LEN, "KV", array("MAX_LENGTH_CHECK", "SPTAB_CHECK"));

        $objFormParam->addParam("レイアウト情報", "layout_json", 0, "KV", array());
        $objFormParam->addParam("テンプレートのソースコード", "campaign_source", 0, "KV", array());

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

        // 入力パラメーターチェック
        $objErr->arrErr = $objFormParam->checkError();

        return $objErr->arrErr;
    }

    /**
     * カテゴリIDの取得
     *
     * @param int $category_id
     * @return integer|void カテゴリID
     */
    public function lfGetCategoryId($category_id)
    {
        // 指定なしの場合、0 を返す
        if (empty($category_id)) return 0;

        // 正当性チェック
        $objCategory = new SC_Helper_Category_Ex();
        if ($objCategory->isValidCategoryId($category_id)) {
            return $category_id;
        } else {
            SC_Utils_Ex::sfDispSiteError(CATEGORY_NOT_FOUND);
        }
    }

    /**
     * 検索条件のwhere文とかを取得
     *
     * @return array
     */
    public function lfGetSearchCondition($arrSearchData)
    {
        $searchCondition = array(
            'where'             => "",
            'arrval'            => array(),
            'where_category'    => "",
            'arrvalCategory'    => array()
        );

        // カテゴリからのWHERE文字列取得
        if ($arrSearchData['category_id'] != 0) {
            list($searchCondition['where_category'], $searchCondition['arrvalCategory']) = SC_Helper_DB_Ex::sfGetCatWhere($arrSearchData['category_id']);
        }
        // ▼対象商品IDの抽出
        // 商品検索条件の作成（未削除、表示）
        $searchCondition['where'] = SC_Product_Ex::getProductDispConditions('alldtl');

        if (strlen($searchCondition['where_category']) >= 1) {
            $searchCondition['where'] .= ' AND EXISTS (SELECT * FROM dtb_product_categories WHERE ' . $searchCondition['where_category'] . ' AND product_id = alldtl.product_id)';
            $searchCondition['arrval'] = array_merge($searchCondition['arrval'], $searchCondition['arrvalCategory']);
        }

        // 商品名をwhere文に
        $name = $arrSearchData['name'];
        $name = str_replace(',', "", $name);
        // 全角スペースを半角スペースに変換
        $name = str_replace('　', ' ', $name);
        // スペースでキーワードを分割
        $names = preg_split('/ +/', $name);
        // 分割したキーワードを一つずつwhere文に追加
        foreach ($names as $val) {
            if (strlen($val) > 0) {
                $searchCondition['where']    .= ' AND ( alldtl.name ILIKE ? OR alldtl.comment3 ILIKE ?) ';
                $searchCondition['arrval'][]  = "%$val%";
                $searchCondition['arrval'][]  = "%$val%";
            }
        }

        // メーカーらのWHERE文字列取得
        if ($arrSearchData['maker_id']) {
            $searchCondition['where']   .= ' AND alldtl.maker_id = ? ';
            $searchCondition['arrval'][] = $arrSearchData['maker_id'];
        }

        // 在庫無し商品の非表示
        if (NOSTOCK_HIDDEN) {
            $searchCondition['where'] .= ' AND EXISTS(SELECT * FROM dtb_products_class WHERE product_id = alldtl.product_id AND del_flg = 0 AND (stock >= 1 OR stock_unlimited = 1))';
        }

        // XXX 一時期内容が異なっていたことがあるので別要素にも格納している。
        $searchCondition['where_for_count'] = $searchCondition['where'];

        return $searchCondition;
    }

    /**
     * @param SC_Product_Ex $objProduct
     */
    public function lfGetProductsList($searchCondition, &$objProduct, $limit = null, $offset = null, $count = false)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        $arrOrderVal = array();

        // 表示順序
        if (strlen($searchCondition['where_category']) >= 1) {
            $dtb_product_categories = '(SELECT * FROM dtb_product_categories WHERE '.$searchCondition['where_category'].')';
            $arrOrderVal           = $searchCondition['arrvalCategory'];
        } else {
            $dtb_product_categories = 'dtb_product_categories';
        }
        $col = 'MAX(T3.rank * 2147483648 + T2.rank)';
        $from = "$dtb_product_categories T2 JOIN dtb_category T3 ON T2.category_id = T3.category_id";
        $where = 'T2.product_id = alldtl.product_id';
        $sub_sql = $objQuery->getSql($col, $from, $where);

        // 取得範囲の指定
        $objQuery->setWhere($searchCondition['where']);

        if (!$count) {

            $objQuery->setOrder("($sub_sql) DESC ,product_id DESC");

            // 件数制限
            $objQuery->setLimitOffset($limit, $offset);

            // 表示すべきIDとそのIDの並び順を一気に取得
            $arrProductId = $objProduct->findProductIdsOrder($objQuery, array_merge($searchCondition['arrval'], $arrOrderVal));

            $objQuery =& SC_Query_Ex::getSingletonInstance();
            $arrProducts = $objProduct->getListByProductIds($objQuery, $arrProductId);

            // 規格を設定
            $objProduct->setProductsClassByProductIds($arrProductId);
            $arrProducts['productStatus'] = $objProduct->getProductStatus($arrProductId);

            return $arrProducts;
        } else {
            return $objProduct->findProductCount($objQuery, array_merge($searchCondition['arrval'], $arrOrderVal));
        }
    }

    // 商品点数を数える
    public function lfGetProductsListCount($searchCondition, &$objProduct)
    {
        return $this->lfGetProductsList($searchCondition, $objProduct, null, null, true);
    }

    // リクエストに対応したヘッダを送出
    function sendAppropriateHeaders() {
        if ($this->isJsonExpected()) {
            header("Content-Type:application/json; charset=utf-8");
        }
    }

    // JSONを返すべきかどうかを返す
    function isJsonExpected() {
        return in_array($this->getMode(), $this->json_modes);
    }

    /**
     * ランダム文字列生成 (英数字)
     * $length: 生成する文字数
     */
    function makeRandumString($length) {
        $str    = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str  = null;
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str))];
        }
        return $r_str;
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