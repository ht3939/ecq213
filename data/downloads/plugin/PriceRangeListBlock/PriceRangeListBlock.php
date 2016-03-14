<?php
/*
 * PriceRangeListBlock
 * Copyright(c) C-Rowl Co., Ltd. All Rights Reserved.
 * http://www.c-rowl.com/
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

/**
 * 価格帯一覧ブロック のメインクラス.
 *
 * @package PriceRangeListBlock
 * @author C-Rowl Co., Ltd.
 */
// ver
define('PLG_PRICE_RANGE_VER212', 1);
define('PLG_PRICE_RANGE_VERNEW', 99);
class PriceRangeListBlock extends SC_Plugin_Base {

    /** プラグインコード */
    static $PLUGIN_CODE = "PriceRangeListBlock";

    function process(LC_Page_EX $objPage) {
        //この関数をプラグイン内に定義するだけで実行されます。
    }

    /**
     * インストール
     * installはプラグインのインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin plugin_infoを元にDBに登録されたプラグイン情報(dtb_plugin)
     * @return void
     */
    function install($arrPlugin) {
        // テーブル追加
        PriceRangeListBlock::TableAdd();
        // ファイルのインストール
        PriceRangeListBlock::InstallFile();
        // ブロックの追加
        PriceRangeListBlock::BlockAdd($arrPlugin, 'plg_PriceRangeList_block', '価格帯一覧ブロック');
    }

    /**
     * アンインストール
     * uninstallはアンインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function uninstall($arrPlugin) {
        // テーブル削除
        PriceRangeListBlock::TableDel();
        // ファイルの削除
        PriceRangeListBlock::UninstallFile();
        // 全てブロック削除
        PriceRangeListBlock::AllBlockDel($arrPlugin);
    }

    /**
     * 稼働
     * enableはプラグインを有効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
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
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function disable($arrPlugin) {
        // nop
    }

    /**
     * 処理の介入箇所とコールバック関数を設定
     * registerはプラグインインスタンス生成時に実行されます
     *
     * @param SC_Helper_Plugin $objHelperPlugin
     * @return void
     */
    function register(SC_Helper_Plugin $objHelperPlugin) {
        $objHelperPlugin->addAction("prefilterTransform", array(&$this, "prefilterTransform"), $this->arrSelfInfo['priority']);
        $objHelperPlugin->addAction("LC_Page_Products_List_action_after", array($this, "products_list_after"), $this->arrSelfInfo['priority']);
    }

    /**
     * ファイルのインストール
     *
     * @return void
     */
    function InstallFile() {
        // プラグインコード
        $plugin_code = PriceRangeListBlock::$PLUGIN_CODE;
        if(copy(PLUGIN_UPLOAD_REALDIR . "$plugin_code/logo.png", PLUGIN_HTML_REALDIR . "$plugin_code/logo.png") === false);

        // ブロック
        if(copy(PLUGIN_UPLOAD_REALDIR . "$plugin_code/templates/default/frontparts/bloc/plg_PriceRangeList_block.tpl", TEMPLATE_REALDIR . "frontparts/bloc/plg_PriceRangeList_block.tpl") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "$plugin_code/html/frontparts/bloc/plg_PriceRangeList_block.php", HTML_REALDIR . "frontparts/bloc/plg_PriceRangeList_block.php") === false);
    }

    /**
     * ファイルの削除
     *
     * @return void
     */
    function UninstallFile() {
        // プラグインコード
        $plugin_code = PriceRangeListBlock::$PLUGIN_CODE;
        if(SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR . "$plugin_code/logo.png") === false);// print_r("失敗");

        // ブロック
        if(SC_Helper_FileManager_Ex::deleteFile(TEMPLATE_REALDIR . "frontparts/bloc/plg_PriceRangeList_block.tpl") === false);
        if(SC_Helper_FileManager_Ex::deleteFile(HTML_REALDIR . "frontparts/bloc/plg_PriceRangeList_block.php") === false);
    }

    /**
     * テーブルの追加
     *
     * @return void
     */
    function TableAdd() {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $create_sql  = <<< __EOS__
                CREATE TABLE plg_pricerangelistblock_price_range (
                    price_range_id integer NOT NULL,
                    price_range_name text,
                    price_range_lower text,
                    price_range_upper text,
                    rank integer NOT NULL,
                    creator_id integer NOT NULL,
                    create_date timestamp NOT NULL DEFAULT now(),
                    update_date timestamp NOT NULL,
                    PRIMARY KEY (price_range_id)
                );
__EOS__;
        $objQuery->query($create_sql);
    }

    /**
     * テーブルの削除
     *
     * @return void
     */
    function TableDel() {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->query("DROP TABLE plg_pricerangelistblock_price_range;");
    }

    /**
     * ブロックの追加
     *
     * @return void
     */
    function BlockAdd($arrPlugin, $block_path, $block_name) {
        //プラグイン専用テーブルの作成
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();
        // dtb_blocにブロックを追加する.
        $sqlval_bloc = array();
        $sqlval_bloc['device_type_id'] = DEVICE_TYPE_PC;
        $sqlval_bloc['bloc_id'] = $objQuery->max('bloc_id', "dtb_bloc", "device_type_id = " . DEVICE_TYPE_PC) + 1;
        $sqlval_bloc['bloc_name'] = $block_name;
        $sqlval_bloc['tpl_path'] = "$block_path.tpl";
        $sqlval_bloc['filename'] = "$block_path";
        $sqlval_bloc['create_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['update_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['php_path'] = "frontparts/bloc/$block_path.php";
        $sqlval_bloc['deletable_flg'] = 0;
        $sqlval_bloc['plugin_id'] = $arrPlugin['plugin_id'];
        $objQuery->insert("dtb_bloc", $sqlval_bloc);
        $objQuery->commit();
    }

    /**
     * ブロックの削除(プラグインが作成したブロック全て)
     *
     * @return void
     */
    function AllBlockDel($arrPlugin) {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $arrBlocId = $objQuery->getCol('bloc_id', "dtb_bloc", "device_type_id = ? AND plugin_id = ?", array(DEVICE_TYPE_PC , $arrPlugin['plugin_id']));
        $arr_bloc_id = $arrBlocId;
        // すべてのブロックを削除する
        foreach ($arr_bloc_id as $val) {
            $bloc_id = (int) $val;
            // ブロックを削除する.
            $where = "device_type_id = ? AND bloc_id = ?";
            $objQuery->delete("dtb_bloc", $where, array(DEVICE_TYPE_PC , $bloc_id));
            $objQuery->delete("dtb_blocposition", $where, array(DEVICE_TYPE_PC , $bloc_id));
        }
    }

    /**
     * テンプレートをフックする
     *
     * @param string &$source
     * @param LC_Page_Ex $objPage
     * @param string $filename
     * @return void
     */
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {

        // プラグインコード
        $plugin_code = PriceRangeListBlock::$PLUGIN_CODE;
        $objTransform = new SC_Helper_Transform($source);
        $template_dir = PLUGIN_UPLOAD_REALDIR ."$plugin_code/templates/";
        switch($objPage->arrPageLayout['device_type_id']) {
            case DEVICE_TYPE_PC:
                $template_dir .= "default/";
                if (strpos($filename, 'products/list.tpl') !== false) {
                    $objTransform->select('form#form1')->appendChild(file_get_contents($template_dir . 'products/plg_PriceRangeListBlock_list_form.tpl'));
                }
                break;
            default:
                break;
        }
        $source = $objTransform->getHTML();
    }

    /**
     * 商品一覧の表示(フロント)
     *
     * @param LC_Page_Products_List_action_after $objPage 商品一覧のページクラス
     * @return void
     */
    function products_list_after($objPage) {

        // IDの正当性のチェック(ここでチェックする)
        if ((!empty($_REQUEST['pr_id'])) && (!SC_Utils_Ex::sfIsInt(intval($_REQUEST['pr_id'])) )) {
            $_REQUEST['pr_id'] = ''; // 何も指定しない
        }
        if (strlen($_REQUEST['pr_id']) <= 0) {
            return;
        }

        $objProduct = new SC_Product_Ex();

        // パラメーター管理クラス
        $objFormParam = new SC_FormParam_Ex();

        // パラメーター情報の初期化
        $objPage->lfInitParam($objFormParam);

        // 値の設定
        $objFormParam->setParam($_REQUEST);

        // 入力値の変換
        $objFormParam->convParam();

        // 値の取得
        $objPage->arrForm = $objFormParam->getHashArray();

        //modeの取得
        $objPage->mode = $objPage->getMode();

        //表示条件の取得
        $objPage->arrSearchData = array(
            'category_id'   => $objPage->lfGetCategoryId(intval($objPage->arrForm['category_id'])),
            'maker_id'      => intval($objPage->arrForm['maker_id']),
            'name'          => $objPage->arrForm['name'],
            'plg_pr_id'    => intval($_REQUEST['pr_id'])    // pr_id追加
        );
        $objPage->orderby = $objPage->arrForm['orderby'];

        //ページング設定
        $objPage->tpl_pageno   = $objPage->arrForm['pageno'];
        $objPage->disp_number  = $objPage->lfGetDisplayNum($objPage->arrForm['disp_number']);

        // 画面に表示するサブタイトルの設定
        // this
        $objPage->tpl_subtitle = $this->lfGetPageTitle($objPage->mode, $objPage->arrSearchData['category_id'], $objPage);

        // 画面に表示する検索条件を設定
        $objPage->arrSearch    = $objPage->lfGetSearchConditionDisp($objPage->arrSearchData);

        // 商品一覧データの取得
        // this
        $arrSearchCondition = $this->lfGetSearchCondition($objPage->arrSearchData);
        $objPage->tpl_linemax  = $objPage->lfGetProductAllNum($arrSearchCondition);
        // 価格帯追加
        $urlParam           = "category_id={$objPage->arrSearchData['category_id']}&pageno=#page#&pr_id={$objPage->arrSearchData['plg_pr_id']}";

        // モバイルの場合に検索条件をURLの引数に追加
        if (SC_Display_Ex::detectDevice() === DEVICE_TYPE_MOBILE) {
            $searchNameUrl = urlencode(mb_convert_encoding($objPage->arrSearchData['name'], 'SJIS-win', 'UTF-8'));
            $urlParam .= "&mode={$objPage->mode}&name={$searchNameUrl}&orderby={$objPage->orderby}";
        }

        $objPage->objNavi      = new SC_PageNavi_Ex($objPage->tpl_pageno, $objPage->tpl_linemax, $objPage->disp_number, 'fnNaviPage', NAVI_PMAX, $urlParam, SC_Display_Ex::detectDevice() !== DEVICE_TYPE_MOBILE);

        if ($this->lfgetVer() == PLG_PRICE_RANGE_VER212) {
            // 2.12
            $objPage->arrProducts  = $objPage->lfGetProductsList($arrSearchCondition, $objPage->disp_number, $objPage->objNavi->start_row, $objPage->tpl_linemax, $objProduct);
        } else {
            $objPage->arrProducts  = $objPage->lfGetProductsList($arrSearchCondition, $objPage->disp_number, $objPage->objNavi->start_row, $objProduct);
        }

        switch ($objPage->getMode()) {
            case 'json':
                $objPage->doJson($objProduct);
                break;
            default:
                $objPage->doDefault($objProduct);
                break;
        }
        $objPage->tpl_rnd          = SC_Utils_Ex::sfGetRandomString(3);

    }

    /**
     * 商品一覧 ページタイトルの設定
     *
     * @return str
     */
    function lfGetPageTitle($mode, $category_id = 0, $objPage) {
        if ($mode == 'search') {
            return '検索結果';
        } elseif ((strlen($objPage->arrSearchData['plg_pr_id']) > 0) && ($objPage->arrSearchData['plg_pr_id']) != "") {
            // 価格帯の表示
            $objData = $this->lfgetData($objPage->arrSearchData['plg_pr_id']);
            return $objData['price_range_name'];
        } elseif ($category_id == 0) {
            return '全商品';
        } else {
            $objCategory = new SC_Helper_Category_Ex();
            $arrCat = $objCategory->get($category_id);

            return $arrCat['category_name'];
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
            'where'             => '',
            'arrval'            => array(),
            'where_category'    => '',
            'arrvalCategory'    => array()
        );

        // カテゴリからのWHERE文字列取得
        if ($arrSearchData['category_id'] != 0) {
            list($searchCondition['where_category'], $searchCondition['arrvalCategory']) = SC_Helper_DB_Ex::sfGetCatWhere($arrSearchData['category_id']);
        }

        // ▼対象商品IDの抽出
        // 商品検索条件の作成（未削除、表示）
        if ($this->lfgetVer() == PLG_PRICE_RANGE_VER212) {
            // 2.12
            $searchCondition['where'] = 'alldtl.del_flg = 0 AND alldtl.status = 1 ';
        } else {
            $searchCondition['where'] = SC_Product_Ex::getProductDispConditions('alldtl');
        }

        if (strlen($searchCondition['where_category']) >= 1) {
            $searchCondition['where'] .= ' AND EXISTS (SELECT * FROM dtb_product_categories WHERE ' . $searchCondition['where_category'] . ' AND product_id = alldtl.product_id)';
            $searchCondition['arrval'] = array_merge($searchCondition['arrval'], $searchCondition['arrvalCategory']);
        }

        // 商品名をwhere文に
        $name = $arrSearchData['name'];
        $name = str_replace(',', '', $name);
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

        // 価格帯
        if ($arrSearchData['plg_pr_id']) {
            // 価格帯取得
            $objData = $this->lfgetData($arrSearchData['plg_pr_id']);
            $tmpSql = '';
            // 下限
            if (strlen($objData['price_range_lower']) > 0) {
                $tmpSql   .= " AND TPLG1.price02 >= ? ";
                $searchCondition['arrval'][] = $objData['price_range_lower'];
            }
            // 上限
            if (strlen($objData['price_range_upper']) > 0) {
                $tmpSql   .= " AND TPLG1.price02 <= ? ";
                $searchCondition['arrval'][] = $objData['price_range_upper'];
            }
            if(strlen($tmpSql) > 0) {
                $searchCondition['where'] .= ' AND alldtl.product_id in ('
                                             . 'SELECT TPLG1.product_id FROM dtb_products_class as TPLG1 '
                                             . 'WHERE TPLG1.product_id = alldtl.product_id AND del_flg = 0 '
                                             . $tmpSql
                                             . ')';
            }
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
     * 価格帯を取得.
     *
     * @param integer $price_range_id ID
     * @return array  結果
     */
    function lfgetData($price_range_id) {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        // 編集項目を取得する
        $where = 'price_range_id = ?';
        $arrPriceRage = array();
        $arrPriceRage = $objQuery->select('*', 'plg_pricerangelistblock_price_range', $where, array($price_range_id));

        return $arrPriceRage[0];
    }

    /**
     * EC-CUBEバージョンチェック
     * 
     * @return バージョン
     */
    function lfgetVer() {
        if (strstr(ECCUBE_VERSION, '2.12.')) {
            // 2.12.x
            return PLG_PRICE_RANGE_VER212;
        } else {
            // それ以外は最新バージョンとする
            return PLG_PRICE_RANGE_VERNEW;
        }
    }
}
?>
