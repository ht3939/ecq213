<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2014 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

require_once CLASS_REALDIR . 'pages/products/LC_Page_Products_List.php';

/**
 * LC_Page_Products_List のページクラス(拡張).
 *
 * LC_Page_Products_List をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Products_List_Ex extends LC_Page_Products_List
{

    /** フィルタ条件(表示用) */
    public $arrSearchFilter = array();

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init()
    {
        parent::init();
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process()
    {
        parent::process();
    }

    /**
     * Page のAction.
     *
     * @return void
     */
    public function action()
    {
        //決済処理中ステータスのロールバック
        $objPurchase = new SC_Helper_Purchase_Ex();
        $objPurchase->cancelPendingOrder(PENDING_ORDER_CANCEL_FLAG);
        $objProduct = new SC_Product_Ex();
        // パラメーター管理クラス
        $objFormParam = new SC_FormParam_Ex();
        // パラメーター情報の初期化
        $this->lfInitParam($objFormParam);

        // 値の設定
        $objFormParam->setParam($_REQUEST);
        // 入力値の変換
        $objFormParam->convParam();
        // 値の取得
        $this->arrForm = $objFormParam->getHashArray();
        //modeの取得
        $this->mode = $this->getMode();
        //表示条件の取得
        $this->arrSearchData = array(
            'category_id' => $this->lfGetCategoryId(intval($this->arrForm['category_id'])),
            'maker_id' => ($this->arrForm['maker_id']),
            'name' => $this->arrForm['name'],
            'keyword' => $this->arrForm['keyword'],
            'product_status_id' => intval($this->arrForm['product_status_id']),
            'price_range_lower' => intval($this->arrForm['price_range_lower']),
            'price_range_upper' => intval($this->arrForm['price_range_upper']),
            'classcategory_id1' => intval($this->arrForm['classcategory_id1']),
            'classcategory_id2' => intval($this->arrForm['classcategory_id2'])
            ,'product_code' => ($this->arrForm['product_code'])
            ,'next_price_lower' => intval($this->arrForm['next_price_lower'])
            ,'next_price_upper' => intval($this->arrForm['next_price_upper'])
            ,'plan_datasize_lower' => intval($this->arrForm['plan_datasize_lower'])
            ,'plan_datasize_upper' => intval($this->arrForm['plan_datasize_upper'])
        );

var_dump($this->arrForm);
//die();
        $this->orderby = $this->arrForm['orderby'];
        //ページング設定
        $this->tpl_pageno = $this->arrForm['pageno'];
        $this->disp_number = $this->lfGetDisplayNum($this->arrForm['disp_number']);
        // 画面に表示するサブタイトルの設定
        $this->tpl_subtitle = $this->lfGetPageTitle($this->mode, $this->arrSearchData);
        // 画面に表示する検索条件を設定
        $this->arrSearch = $this->lfGetSearchConditionDisp($this->arrSearchData);
        // 商品一覧データの取得
        $arrSearchCondition = $this->lfGetSearchCondition($this->arrSearchData);
        $this->tpl_linemax = $this->lfGetProductAllNum($arrSearchCondition);
        $urlParam = "category_id={$this->arrSearchData['category_id']}&pageno=#page#";

var_dump($this->arrSearchData);

var_dump($arrSearchCondition);

        // モバイルの場合に検索条件をURLの引数に追加
        if (SC_Display_Ex::detectDevice() === DEVICE_TYPE_MOBILE) {
            $searchNameUrl = urlencode(mb_convert_encoding($this->arrSearchData['name'], 'SJIS-win', 'UTF-8'));
            $urlParam .= "&mode={$this->mode}&name={$searchNameUrl}&orderby={$this->orderby}";
        }
        $this->objNavi = new SC_PageNavi_Ex($this->tpl_pageno, $this->tpl_linemax, $this->disp_number, 'eccube.movePage', NAVI_PMAX, $urlParam, SC_Display_Ex::detectDevice() !== DEVICE_TYPE_MOBILE);
        $this->arrProducts = $this->lfGetProductsList($arrSearchCondition, $this->disp_number, $this->objNavi->start_row, $objProduct);
        switch ($this->getMode()) {
            case 'json':
                $this->doJson($objProduct);
                break;
            default:
                $this->doDefault($objProduct, $objFormParam);
                break;
        }
        $this->tpl_rnd = SC_Utils_Ex::sfGetRandomString(3);
    }
    /**
     * パラメーター情報の初期化
     *
     * @param  SC_FormParam_Ex $objFormParam フォームパラメータークラス
     * @return void
     */
    public function lfInitParam(&$objFormParam)
    {
        parent::lfInitParam($objFormParam);
        $objFormParam->addParam('商品ステータスID', 'product_status_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('キーワード', 'keyword', STEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('価格帯(下限)', 'price_range_lower', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('価格帯(上限)', 'price_range_upper', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('総額(下限)', 'next_price_lower', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('総額(上限)', 'next_price_upper', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('データ量(下限)', 'plan_datasize_lower', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('データ量(上限)', 'plan_datasize_upper', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('商品コード', 'product_code', STEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
    }
    /**
     * 検索条件のwhere文とかを取得
     *
     * @return array
     */
    public function lfGetSearchCondition($arrSearchData)
    {
        $searchCondition = parent::lfGetSearchCondition($arrSearchData);
        // 商品ステータス
        if ($arrSearchData['product_status_id'] > 0) {
            $searchCondition['where'] .= ' AND alldtl.product_id IN ('
                    . 'SELECT product_id FROM dtb_product_status '
                    . 'WHERE product_status_id = ? AND del_flg = 0'
                    . ')';
            $searchCondition['arrval'][] = $arrSearchData['product_status_id'];
        }
        // キーワード
        $keyword = $arrSearchData['keyword'];
        $keyword = str_replace(',', '', $keyword);
        // 全角スペースを半角スペースに変換
        $keyword = str_replace('　', ' ', $keyword);
        // スペースでキーワードを分割
        $keywords = preg_split('/ +/', $keyword);
        // 分割したキーワードを一つずつwhere文に追加
        foreach ($keywords as $val) {
            if (strlen($val) > 0) {
                $searchCondition['where'] .= ' AND ( alldtl.note ILIKE ? OR alldtl.main_comment ILIKE ?) ';
                $searchCondition['arrval'][] = "%$val%";
                $searchCondition['arrval'][] = "%$val%";
            }
        }
        // 価格帯
        $tmpWhere = '';
        // 下限
        if ($arrSearchData['price_range_lower'] > 0) {
            $tmpWhere .= " AND price02 >= ? ";
            $searchCondition['arrval'][] = $arrSearchData['price_range_lower'];
        }
        // 上限
        if ($arrSearchData['price_range_upper'] > 0) {
            $tmpWhere .= " AND price02 <= ? ";
            $searchCondition['arrval'][] = $arrSearchData['price_range_upper'];
        }
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= ' AND alldtl.product_id IN ('
                    . 'SELECT product_id FROM dtb_products_class '
                    . 'WHERE product_id = alldtl.product_id AND del_flg = 0'
                    . $tmpWhere
                    . 'GROUP BY product_id'
                    . ')';
        }
        $tmpWhere = '';
        // 規格1
        if ($arrSearchData['classcategory_id1'] > 0) {
            $tmpWhere .= " AND (classcategory_id1 = ? OR classcategory_id2 = ?) ";
            $searchCondition['arrval'][] = $arrSearchData['classcategory_id1'];
            $searchCondition['arrval'][] = $arrSearchData['classcategory_id1'];
        }
        // 規格2
        if ($arrSearchData['classcategory_id2'] > 0) {
            $tmpWhere .= " AND (classcategory_id1 = ? OR classcategory_id2 = ?) ";
            $searchCondition['arrval'][] = $arrSearchData['classcategory_id2'];
            $searchCondition['arrval'][] = $arrSearchData['classcategory_id2'];
        }
        if ($tmpWhere) {
            $searchCondition['where'] .= ' AND alldtl.product_id IN ('
                    . 'SELECT product_id FROM dtb_products_class '
                    . 'WHERE del_flg = 0'
                    . $tmpWhere
                    . 'GROUP BY product_id'
                    . ')';
        }

        // 総額
        $tmpWhere = '';
        // 下限
        if ($arrSearchData['next_price_lower'] > 0) {
            $tmpWhere .= " AND next_price >= ? ";
            $searchCondition['arrval'][] = $arrSearchData['next_price_lower'];
        }
        // 上限
        if ($arrSearchData['next_price_upper'] > 0) {
            $tmpWhere .= " AND next_price <= ? ";
            $searchCondition['arrval'][] = $arrSearchData['next_price_upper'];
        }
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= ' AND alldtl.product_id IN ('
                    . 'SELECT product_id FROM dtb_products_class '
                    . 'WHERE product_id = alldtl.product_id AND del_flg = 0'
                    . $tmpWhere
                    . 'GROUP BY product_id'
                    . ')';
        }
        // データ量
        $tmpWhere = '';
        // 下限
        if ($arrSearchData['plan_datasize_lower'] > 0) {
            $tmpWhere .= " AND plan_datasize >= ? ";
            $searchCondition['arrval'][] = $arrSearchData['plan_datasize_lower'];
        }
        // 上限
        if ($arrSearchData['plan_datasize_upper'] > 0) {
            $tmpWhere .= " AND plan_datasize <= ? ";
            $searchCondition['arrval'][] = $arrSearchData['plan_datasize_upper'];
        }
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= ' AND alldtl.product_id IN ('
                    . 'SELECT product_id FROM dtb_products_class '
                    . 'WHERE product_id = alldtl.product_id AND del_flg = 0'
                    . $tmpWhere
                    . 'GROUP BY product_id'
                    . ')';
        }
        // 商品コード帯
        $tmpWhere = '';

        // 
        if (strlen($arrSearchData['product_code']) > 0) {
            $tmpWhere .= " AND product_code = ? ";
            $searchCondition['arrval'][] = $arrSearchData['product_code'];
        }
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= ' AND alldtl.product_id IN ('
                    . 'SELECT product_id FROM dtb_products_class '
                    . 'WHERE product_id = alldtl.product_id AND del_flg = 0'
                    . $tmpWhere
                    . 'GROUP BY product_id'
                    . ')';
        }


        // XXX 一時期内容が異なっていたことがあるので別要素にも格納している。
        $searchCondition['where_for_count'] = $searchCondition['where'];
        return $searchCondition;
    }
    /**
     * ページタイトルの設定
     *
     * @param string|null $mode
     * @return str
     */
    public function lfGetPageTitle($mode, $arrSearchData)
    {
        if ($mode == 'search') {
            return '検索結果';
        } elseif ($arrSearchData['product_status_id'] > 0) {
            return $this->arrSTATUS[$arrSearchData['product_status_id']];
        } elseif ($arrSearchData['category_id'] == 0) {
            return '全商品';
        } else {
            $objCategory = new SC_Helper_Category_Ex();
            $arrCat = $objCategory->get($arrSearchData['category_id']);
            return $arrCat['category_name'];
        }
    }
    /* 商品一覧の表示 */
    /**
     * @param SC_Product_Ex $objProduct
     */
    public function lfGetProductsList($searchCondition, $disp_number, $startno, &$objProduct)
    {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrOrderVal = array();
        // 表示順序
        switch ($this->orderby) {
            // 後払い価格が安い順
            case 'dataspeed':
                $objProduct->setProductsOrder('data_speed', 'dtb_products', 'ASC');
                break;
            // 後払い価格が安い順
            case 'nextprice':
                $objProduct->setProductsOrder('next_price', 'dtb_products_class', 'ASC');
                break;
            // 販売価格が安い順
            case 'price':
                $objProduct->setProductsOrder('price02', 'dtb_products_class', 'ASC');
                break;
            // 新着順
            case 'date':
                $objProduct->setProductsOrder('create_date', 'dtb_products', 'DESC');
                break;
            // 更新順
            case 'update':
                $objProduct->setProductsOrder('update_date', 'dtb_products', 'DESC');
                break;
            // 商品ステータスの更新順
            case 'product_status_update':
                $objProduct->setProductsOrder('update_date', 'dtb_product_status', 'DESC');
                break;
            // ポイント付与率が高い順
            case 'point_rate':
                $objProduct->setProductsOrder('point_rate', 'dtb_products_class', 'DESC');
                break;
            default:
                if (strlen($searchCondition['where_category']) >= 1) {
                    $dtb_product_categories = '(SELECT * FROM dtb_product_categories WHERE ' . $searchCondition['where_category'] . ')';
                    $arrOrderVal = $searchCondition['arrvalCategory'];
                } else {
                    $dtb_product_categories = 'dtb_product_categories';
                }
                $col = 'MAX(T3.rank * 2147483648 + T2.rank)';
                $from = "$dtb_product_categories T2 JOIN dtb_category T3 ON T2.category_id = T3.category_id";
                $where = 'T2.product_id = alldtl.product_id';
                $sub_sql = $objQuery->getSql($col, $from, $where);
                $objQuery->setOrder("($sub_sql) DESC ,product_id DESC");
                break;
        }
        // 取得範囲の指定(開始行番号、行数のセット)
        $objQuery->setLimitOffset($disp_number, $startno);
        $objQuery->setWhere($searchCondition['where']);
        // 表示すべきIDとそのIDの並び順を一気に取得
        $arrProductId = $objProduct->findProductIdsOrder($objQuery, array_merge($searchCondition['arrval'], $arrOrderVal));
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrProducts = $objProduct->getListByProductIds($objQuery, $arrProductId);
        // 規格を設定
        $objProduct->setProductsClassByProductIds($arrProductId);
        $arrProducts['productStatus'] = $objProduct->getProductStatus($arrProductId);
        return $arrProducts;
    }


}
