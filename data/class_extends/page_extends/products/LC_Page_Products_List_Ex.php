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
    /** フィルタ条件(パラメータ用) */    
    public $arrSearchFilterData = array();

    public $tpl_filtermode = false;

    /**ソートタブの選択用*/
    public $tpl_orderby_totalprice = false;
    public $tpl_orderby_y1price = false;

    public $tpl_bestproduct_graph = "data: [5,3,4,3,4]";

    public $arrProductclass = array();
    public $arrMaker = array();

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init()
    {
        parent::init();

        $this->lfGetMakerTree();
        $this->lfGetProductclass();
        $this->setSearchFilter();

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
     * フィルタの選択対象の設定
     *
     * @return void
     */
    public function setSearchFilter()
    {
        $this->arrSearchFilter['filterVal_datasize'] = 
                    array('type'=>'options'
                            ,'value'=>array('すべて','５Ｇ未満','５Ｇ～８Ｇ未満','８Ｇ以上')
                            ,'search'=>array(-1,array(0,4.9),array(5,7.9),array(8,999))
                            );

        $this->arrSearchFilter['filterVal_dataspeed'] = 
                    array('type'=>'options'
                            ,'value'=>array('すべて','50','100','200')
                            ,'search'=>array(-1,array(0,49.9),array(50.0,99.9),array(100.0,199.9),array(200.0,999.9))
                            );

        if(count($this->arrProductclass)>0){
            foreach($this->arrProductclass as $k=>$v){
                if($v['classcategory_id']=="0"){
                    $value[]='すべて';
                    $search[]=-1;
                }else{
                    $value[]=$v['name'];
                    $search[]=intval($v['classcategory_id']);
                }
            }
            $this->arrSearchFilter['filterVal_device'] = 
            array('type'=>'checkbox'
                    ,'value'=>$value
                    ,'search'=>$search
                    );

        }else{
            $this->arrSearchFilter['filterVal_device'] = 
            array('type'=>'checkbox'
                    ,'value'=>array('すべて')
                    ,'search'=>array(-1)
                    );

        }

        $this->arrSearchFilter['filterVal_lntype'] = 
                    array('type'=>'options'
                            ,'value'=>array('すべて','WiMAX','LTE/4G')
                            ,'search'=>array(-1,array('WiMAX'),array('LTE','4G'))
                            );
var_dump($this->arrMaker);
        $this->arrSearchFilter['filterVal_maker'] = 
                    array('type'=>'checkbox'
                            ,'value'=>array('すべて','YahooWifi','とくとくBB')
                            ,'search'=>array(0,1,3)
                            );

        $this->arrSearchFilter['filterVal_cptype'] = 
                    array('type'=>'options'
                            ,'value'=>array('すべて','あり','なし')
                            ,'serach'=>array(-1,array(1,99999),array(0,0))
                            );
    }

    /**
     * デフォルトで設定するFormのパラメータ
     *
     * @return void
     */
    public function setDefaultFormParam()
    {        //デフォルト設定
        if(!isset($this->arrForm['category_id'])){
            $this->arrForm['category_id']='0';
        }elseif(strlen($this->arrForm['category_id'])==0){
            $this->arrForm['category_id']='0';
        }
        //デフォルト設定
        if(!isset($this->arrForm['orderby'])){
            $this->arrForm['orderby']='y1price';
        }elseif(strlen($this->arrForm['orderby'])==0){
            $this->arrForm['orderby']='y1price';
        }
        //デフォルト設定
        if(!isset($this->arrForm['disp_number'])){
            $this->arrForm['disp_number']='10';
        }elseif(strlen($this->arrForm['disp_number'])==0){
            $this->arrForm['disp_number']='10';
        }
    }

    function lfGetMakerTree() {
        $objView = new SC_SiteView();
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objDb = new SC_Helper_DB_Ex();

        $col = '*';
        $from = 'dtb_maker left join dtb_maker_count ON dtb_maker.maker_id = dtb_maker_count.maker_id';
        $where = "del_flg <> 1 AND product_count > 0";
        $objQuery->setorder("rank DESC");
        $this->arrMaker = $objQuery->select($col, $from, $where);

    }

    /**
     * 端末一覧を表示するためのデータ取得
     *
     * @return void
     */
    function lfGetProductclass() {
        $objView = new SC_SiteView();
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objDb = new SC_Helper_DB_Ex();

        $col = '*';
        $from = 'dtb_classcategory ';
        $where = "del_flg <> 1";
        $objQuery->setorder("class_id,rank DESC");
        $this->arrProductclass = $objQuery->select($col, $from, $where);


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

        //デフォルトのフォームパラメータの設定
        $this->setDefaultFormParam();



        //modeの取得
        $this->mode = $this->getMode();
        //表示条件の取得
        $this->arrSearchData = array(
            'category_id' => $this->lfGetCategoryId(intval($this->arrForm['category_id'])),
            'maker_id' => ($this->arrForm['maker_id']),
            'name' => $this->arrForm['name'],
            'keyword' => $this->arrForm['keyword'],
            'product_status_id' => intval($this->arrForm['product_status_id']),
            'y1_price_min' => intval($this->arrForm['y1_price_min']),
            'y1_price_max' => intval($this->arrForm['y1_price_max'])
            ,'total_price_min' => intval($this->arrForm['total_price_min'])
            ,'total_price_max' => intval($this->arrForm['total_price_max'])
            ,'cp_price_min' => intval($this->arrForm['cp_price_min'])
            ,'cp_price_max' => intval($this->arrForm['cp_price_max'])
            ,'datasize_min' => intval($this->arrForm['datasize_min'])
            ,'datasize_max' => intval($this->arrForm['datasize_max'])
            ,'data_speed_down_min' => intval($this->arrForm['data_speed_down_min'])
            ,'data_speed_down_max' => intval($this->arrForm['data_speed_down_max'])
            ,'classcategory_id1' => intval($this->arrForm['classcategory_id1'])
            ,'classcategory_id2' => intval($this->arrForm['classcategory_id2'])
            ,'product_code' => ($this->arrForm['product_code'])
            ,'lntype' => ($this->arrForm['lntype'])
            ,'cc_type' => ($this->arrForm['cc_type'])
        );


        $this->arrSearchFilterData = array(
            'filter_lntype' => intval($this->arrForm['filter_lntype'])
            ,'filter_datasize' => intval($this->arrForm['filter_datasize'])
            ,'filter_data_speed_down' => intval($this->arrForm['filter_data_speed_down'])
            ,'filter_maker_id' => $this->arrForm['filter_maker_id']
            ,'filter_cptype' => intval($this->arrForm['filter_cptype'])
            ,'filter_device_id' => $this->arrForm['filter_device_id']
        );

        $this->orderby = $this->arrForm['orderby'];
        $this->tpl_orderby_totalprice = ($this->orderby==='totalprice');
        $this->tpl_orderby_y1price = ($this->orderby==='y1price');

        //ページング設定
        $this->tpl_pageno = $this->arrForm['pageno'];
        $this->disp_number = $this->lfGetDisplayNum($this->arrForm['disp_number']);
        // 画面に表示するサブタイトルの設定
        $this->tpl_subtitle = $this->lfGetPageTitle($this->mode, $this->arrSearchData);
        // 画面に表示する検索条件を設定
        $this->arrSearch = $this->lfGetSearchConditionDisp($this->arrSearchData);

        if($this->mode=="filter"){
            $this->tpl_filtermode = true;
        // 商品一覧データの取得
            $arrSearchCondition = $this->lfGetSearchFilterCondition($this->arrSearchData);
            $this->tpl_linemax = $this->lfGetProductAllNum($arrSearchCondition);
            $this->arrProducts = $this->lfGetProductsList($arrSearchCondition
                                                            , $this->disp_number
                                                            , 0, $objProduct);



        }else{
            // 商品一覧データの取得
            $arrSearchCondition = $this->lfGetSearchCondition($this->arrSearchData);
            $this->tpl_linemax = $this->lfGetProductAllNum($arrSearchCondition);
            $urlParam = "category_id={$this->arrSearchData['category_id']}&pageno=#page#";


            // モバイルの場合に検索条件をURLの引数に追加
            if (SC_Display_Ex::detectDevice() === DEVICE_TYPE_MOBILE) {
                $searchNameUrl = urlencode(mb_convert_encoding($this->arrSearchData['name'], 'SJIS-win', 'UTF-8'));
                $urlParam .= "&mode={$this->mode}&name={$searchNameUrl}&orderby={$this->orderby}";
            }
            $this->objNavi = new SC_PageNavi_Ex($this->tpl_pageno, $this->tpl_linemax, $this->disp_number, 'eccube.movePage', NAVI_PMAX, $urlParam, SC_Display_Ex::detectDevice() !== DEVICE_TYPE_MOBILE);
            $this->arrProducts = $this->lfGetProductsList($arrSearchCondition, $this->disp_number, $this->objNavi->start_row, $objProduct);

        }
        $this->arrClassCat1 = $objProduct->classCats1;

        $this->arrBestProducts = $this->lfGetRanking();
        $this->tpl_bestproduct_graph = $this->arrBestProducts['graphdata'];

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
        $objFormParam->addParam('月額(下限)', 'y1_price_min', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('月額(上限)', 'y1_price_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('総額(下限)', 'total_price_min', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('総額(上限)', 'total_price_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('CP額(下限)', 'cp_price_min', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('CP額(上限)', 'cp_price_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('データ量(下限)', 'datasize_min', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('データ量(上限)', 'datasize_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('転送速度下り(下限)', 'data_speed_down_min', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('転送速度下り(上限)', 'data_speed_down_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('商品コード', 'product_code', STEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('回線タイプ', 'lntype', STEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));

        $objFormParam->addParam('絞込条件回線タイプ', 'filter_lntype', STEXT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('絞込条件データ容量', 'filter_datasize', STEXT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('絞込条件転送速度下り', 'filter_data_speed_down', STEXT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('絞込条件対応端末', 'filter_device_id', STEXT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('絞込条件提供サービス', 'filter_maker_id', STEXT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('絞込条件ＣＢ・キャンペーン', 'filter_cptype', STEXT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));

    }

    /**
     * 検索条件のwhere文とかを取得
     *
     * @return array
     */
    public function lfGetSearchConditionOrg($arrSearchData)
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
        $searchCondition['where'] = SC_Product_Ex::getProductDispConditions('alldtl');

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
            
            if(is_array($arrSearchData['maker_id'])){
                $tmp = '';
                foreach($arrSearchData['maker_id'] as $kv){
                    $tmp .= 'alldtl.maker_id = ? or ';
                    $searchCondition['arrval'][] = intval($kv);

                }
                $tmp .= 'alldtl.maker_id = 0';
                unset($kv);
                $searchCondition['where']   .= ' AND ('. $tmp .')';
                $searchCondition['arrval'][] = $arrSearchData['maker_id'];

            }else
            {
                $searchCondition['where']   .= ' AND alldtl.maker_id = ? ';
                $searchCondition['arrval'][] = $arrSearchData['maker_id'];

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
     * 検索条件のwhere文とかを取得
     *
     * @return array
     */
    public function lfGetSearchFilterCondition($arrSearchFilterData)
    {
        //フィルター設定を、通常条件パラメータの設定に変換。


            //実装中。
        //

        $this->lfGetSearchCondition($arrSearchData);
    }
    /**
     * 検索条件のwhere文とかを取得
     *
     * @return array
     */
    public function lfGetSearchCondition($arrSearchData)
    {
        $searchCondition = $this->lfGetSearchConditionOrg($arrSearchData);



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

        // 回線タイプ
        $tmpWhere = '';
        $condkey ='cc_type';
        // WHERE文字列取得
        if ($arrSearchData[$condkey]) {
            
            if(is_array($arrSearchData[$condkey])){
                $tmp = '';
                foreach($arrSearchData[$condkey] as $kv){
                    $tmp .= 'dtb_classcategory.$condkey = ? or ';
                    $searchCondition['arrval'][] = intval($kv);

                }
                $tmp .= 'dtb_classcategory.$condkey=0';
                unset($kv);
                $searchCondition['where']   .= ' AND ('. $tmp .')';
                $searchCondition['arrval'][] = $arrSearchData[$condkey];

            }else
            {
                // 
                if (strlen($arrSearchData[$condkey]) > 0) {
                    $tmpWhere .= " AND dtb_classcategory.$condkey = ? ";
                    $searchCondition['arrval'][] = $arrSearchData[$condkey];
                }

            }

            if (strlen($tmpWhere) > 0) {
                $searchCondition['where'] .= ' AND alldtl.product_id IN ('
                        . 'SELECT product_id FROM dtb_products_class inner join dtb_classcategory'
                        . ' on dtb_products_class.classcategory_id1 = dtb_classcategory.classcategory_id'
                        . 'WHERE product_id = alldtl.product_id AND del_flg = 0'
                        . $tmpWhere
                        . 'GROUP BY product_id'
                        . ')';
            }

        }

        // 月額１年目
        $tmpWhere = '';
        // 下限
        if ($arrSearchData['y1_price_min'] > 0) {
            $tmpWhere .= " AND alldtl.y1_price >= ? ";
            $searchCondition['arrval'][] = $arrSearchData['y1_price_min'];
        }
        // 上限
        if ($arrSearchData['y1_price_max'] > 0) {
            $tmpWhere .= " AND alldtl.y1_price <= ? ";
            $searchCondition['arrval'][] = $arrSearchData['y1_price_max'];
        }
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= $tmpWhere;
        }

        // CP金宅
        $tmpWhere = '';
        // 下限
        if ($arrSearchData['cp_price_min'] > 0) {
            $tmpWhere .= " AND alldtl.cp_price >= ? ";
            $searchCondition['arrval'][] = $arrSearchData['cp_price_min'];
        }
        // 上限
        if ($arrSearchData['cp_price_max'] > 0) {
            $tmpWhere .= " AND alldtl.cp_price <= ? ";
            $searchCondition['arrval'][] = $arrSearchData['cp_price_max'];
        }
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= $tmpWhere;
        }

        // 総額
        $tmpWhere = '';
        // 下限
        if ($arrSearchData['total_price_min'] > 0) {
            $tmpWhere .= " AND alldtl.total_price >= ? ";
            $searchCondition['arrval'][] = $arrSearchData['total_price_min'];
        }
        // 上限
        if ($arrSearchData['total_price_max'] > 0) {
            $tmpWhere .= " AND alldtl.total_price <= ? ";
            $searchCondition['arrval'][] = $arrSearchData['total_price_max'];
        }
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= $tmpWhere;
        }

        // データ量
        $tmpWhere = '';
        // 下限
        if ($arrSearchData['datasize_min'] > 0) {
            $tmpWhere .= " AND alldtl.datasize >= ? ";
            $searchCondition['arrval'][] = $arrSearchData['datasize_min'];
        }
        // 上限
        if ($arrSearchData['datasize_max'] > 0) {
            $tmpWhere .= " AND alldtl.datasize <= ? ";
            $searchCondition['arrval'][] = $arrSearchData['datasize_max'];
        }
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= $tmpWhere;
        }

        // 転送速度下り
        $tmpWhere = '';
        // 下限
        if ($arrSearchData['data_speed_down_min'] > 0) {
            $tmpWhere .= " AND alldtl.data_speed_down >= ? ";
            $searchCondition['arrval'][] = $arrSearchData['data_speed_down_min'];
        }
        // 上限
        if ($arrSearchData['data_speed_down_max'] > 0) {
            $tmpWhere .= " AND alldtl.data_speed_down <= ? ";
            $searchCondition['arrval'][] = $arrSearchData['data_speed_down_max'];
        }        
        if (strlen($tmpWhere) > 0) {
            $searchCondition['where'] .= $tmpWhere;
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
        return null;
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
            // 月額が安い順
            case 'y1price':
                $objProduct->setProductsOrder('y1_price', 'dtb_products', 'ASC');
                break;
            // 総額安い順
            case 'totalprice':
                $objProduct->setProductsOrder('total_price', 'dtb_products', 'ASC');
                break;
            // 転送下り順
            case 'dataspeeddown':
                $objProduct->setProductsOrder('data_speed_down', 'dtb_products', 'DESC');
                break;
            // 転送上り順
            case 'dataspeedup':
                $objProduct->setProductsOrder('data_speed_up', 'dtb_products', 'DESC');
                break;
            // データ量順
            case 'datasize':
                $objProduct->setProductsOrder('datasize', 'dtb_products', 'DESC');
                break;
            // CPが高い順
            case 'cpprice':
                $objProduct->setProductsOrder('cp_price', 'dtb_products', 'ASC');
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
        $this->arrClassCat1=$objProduct->classCats1;

        return $arrProducts;
    }



    /**
     * おすすめ商品検索.
     *
     * @return array $arrBestProducts 検索結果配列
     */
    public function lfGetRanking()
    {
        $objRecommend = new SC_Helper_BestProducts_Ex();

        // おすすめ商品取得
        $arrRecommends = $objRecommend->getList(RECOMMEND_NUM);

        $response = array();
        if (count($arrRecommends) > 0) {
            // 商品一覧を取得
            $objQuery =& SC_Query_Ex::getSingletonInstance();
            $objProduct = new SC_Product_Ex();
            // where条件生成&セット
            $arrProductId = array();
            foreach ($arrRecommends as $key => $val) {
                $arrProductId[] = $val['product_id'];
            }
            $arrProducts = $objProduct->getListByProductIds($objQuery, $arrProductId);
            $objProduct->setProductsClassByProductIds($arrProductId);


            // おすすめ商品情報にマージ
            foreach ($arrRecommends as $key => $value) {
                if (isset($arrProducts[$value['product_id']])) {
                    $product = $arrProducts[$value['product_id']];
                    if ($product['status'] == 1 && (!NOSTOCK_HIDDEN || ($product['stock_max'] >= 1 || $product['stock_unlimited_max'] == 1))) {
                        $response[] = array_merge($value, $arrProducts[$value['product_id']]);
                    }
                } else {
                    // 削除済み商品は除外
                    unset($arrRecommends[$key]);
                }
            }
        }
        $ret['dat'] = $response[0];
        $ret['arrCC'] = $objProduct->classCats1;
        $dt = array(
            SC_Utils_Ex::sfConvertRank2Point($response[0]['rank1_order'])
            ,SC_Utils_Ex::sfConvertRank2Point($response[0]['rank2_order'])
            ,SC_Utils_Ex::sfConvertRank2Point($response[0]['rank3_order'])
            ,SC_Utils_Ex::sfConvertRank2Point($response[0]['rank4_order'])
            ,SC_Utils_Ex::sfConvertRank2Point($response[0]['rank5_order'])
            );
        $ret['graphdata'] = "data: [$dt[0],$dt[1],$dt[2],$dt[3],$dt[4]]";
        return $ret;
    }
}

