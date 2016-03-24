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

require_once CLASS_REALDIR . 'pages/products/LC_Page_Products_Detail.php';

/**
 * LC_Page_Products_Detail のページクラス(拡張).
 *
 * LC_Page_Products_Detail をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Products_Detail_Ex extends LC_Page_Products_Detail
{

    /** @var array 関連商品情報 */
    public $arrOtherPlanProducts;
    /** @var array 関連商品情報 */
    public $arrRecommendProducts;

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

        // 会員クラス
        $objCustomer = new SC_Customer_Ex();

        // パラメーター管理クラス
        $this->objFormParam = new SC_FormParam_Ex();
        // パラメーター情報の初期化
        $this->arrForm = $this->lfInitParam($this->objFormParam);
        // ファイル管理クラス
        $this->objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, IMAGE_SAVE_REALDIR);
        // ファイル情報の初期化
        $this->objUpFile = $this->lfInitFile($this->objUpFile);
        $this->mode = $this->getMode();

        $objProduct = new SC_Product_Ex();

        // プロダクトIDの正当性チェック
        $product_id = $this->lfCheckProductId($this->objFormParam->getValue('admin'), $this->objFormParam->getValue('product_id'), $objProduct);

        $objProduct->setProductsClassByProductIds(array($product_id));

        // 規格1クラス名
        $this->tpl_class_name1 = $objProduct->className1[$product_id];

        // 規格2クラス名
        $this->tpl_class_name2 = $objProduct->className2[$product_id];

        // 規格1
        $this->arrClassCat1 = $objProduct->classCats1[$product_id];

        // 規格1が設定されている
        $this->tpl_classcat_find1 = $objProduct->classCat1_find[$product_id];
        // 規格2が設定されている
        $this->tpl_classcat_find2 = $objProduct->classCat2_find[$product_id];

        $this->tpl_stock_find = $objProduct->stock_find[$product_id];
        $this->tpl_product_class_id = $objProduct->classCategories[$product_id]['__unselected']['__unselected']['product_class_id'];
        $this->tpl_product_type = $objProduct->classCategories[$product_id]['__unselected']['__unselected']['product_type'];

        // 在庫が無い場合は、OnLoadしない。(javascriptエラー防止)
        if ($this->tpl_stock_find) {
            // 規格選択セレクトボックスの作成
            $this->js_lnOnload .= $this->lfMakeSelect();
        }

        $this->tpl_javascript .= 'eccube.classCategories = ' . SC_Utils_Ex::jsonEncode($objProduct->classCategories[$product_id]) . ';';
        $this->tpl_javascript .= 'function lnOnLoad()
        {' . $this->js_lnOnload . '}';
        $this->tpl_onload .= 'lnOnLoad();';

        // モバイル用 規格選択セレクトボックスの作成
        if (SC_Display_Ex::detectDevice() == DEVICE_TYPE_MOBILE) {
            $this->lfMakeSelectMobile($this, $product_id, $this->objFormParam->getValue('classcategory_id1'));
        }

        // 商品IDをFORM内に保持する
        $this->tpl_product_id = $product_id;
        switch ($this->mode) {
            case 'cart':
                $this->doCart();
                break;

            case 'add_favorite':
                $this->doAddFavorite($objCustomer);
                break;

            case 'add_favorite_sphone':
                $this->doAddFavoriteSphone($objCustomer);
                break;

            case 'select':
            case 'select2':
            case 'selectItem':
                /**
                 * モバイルの数量指定・規格選択の際に、
                 * $_SESSION['cart_referer_url'] を上書きさせないために、
                 * 何もせずbreakする。
                 */
                break;

            default:
                $this->doDefault();
                break;
        }

        // モバイル用 ポストバック処理
        if (SC_Display_Ex::detectDevice() == DEVICE_TYPE_MOBILE) {
            switch ($this->mode) {
                case 'select':
                    $this->doMobileSelect();
                    break;

                case 'select2':
                    $this->doMobileSelect2();
                    break;

                case 'selectItem':
                    $this->doMobileSelectItem();
                    break;

                case 'cart':
                    $this->doMobileCart();
                    break;

                default:
                    $this->doMobileDefault();
                    break;
            }
        }

        // 商品詳細を取得
        $this->arrProduct = $objProduct->getDetail($product_id);

        // サブタイトルを取得
        $this->tpl_subtitle = $this->arrProduct['name'];

        // 関連カテゴリを取得
        $this->arrRelativeCat = SC_Helper_DB_Ex::sfGetMultiCatTree($product_id);

        // 商品ステータスを取得
        $this->productStatus = $objProduct->getProductStatus($product_id);

        // 画像ファイル指定がない場合の置換処理
        $this->arrProduct['main_image']
            = SC_Utils_Ex::sfNoImageMain($this->arrProduct['main_image']);

        $this->subImageFlag = $this->lfSetFile($this->objUpFile, $this->arrProduct, $this->arrFile);
        //レビュー情報の取得
        $this->arrReview = $this->lfGetReviewData($product_id);

        //関連商品情報表示
        $this->arrRecommend = $this->lfPreGetRecommendProducts($product_id);

        //関連商品情報表示
        $this->arrOtherPlanProducts = $this->lfGetOtherPlanProducts();

        //関連商品情報表示
        $this->arrRecommendProducts = $this->lfGetRecommendProducts();
        // ログイン判定
        if ($objCustomer->isLoginSuccess() === true) {
            //お気に入りボタン表示
            $this->tpl_login = true;
            $this->is_favorite = SC_Helper_DB_Ex::sfDataExists('dtb_customer_favorite_products', 'customer_id = ? AND product_id = ?', array($objCustomer->getValue('customer_id'), $product_id));
        }
    }


    /* その他プラン商品一覧の表示 */
    /**
     * @param SC_Product_Ex $objProduct
     */
    public function lfGetOtherPlanProducts()
    {
        $objProduct = new SC_Product_Ex();

        $arrSearch = array("maker_id"=>$this->arrProduct['maker_id']);
        $arrCond = $this->lfGetSearchCondition($arrSearch);
        //var_dump($arrCond);
        $ret['dat'] = $this->lfGetProductsList($arrCond,10,0,$objProduct);
        unset($ret['dat']['productStatus']);
        $ret['arrCC'] = $objProduct->classCats1;
        return $ret;

    }

    /* おすすめ商品一覧の表示 */
    /**
     * @param SC_Product_Ex $objProduct
     */
    public function lfGetRecommendProducts()
    {
        $objProduct = new SC_Product_Ex();

        $arrSearch = array("category_id"=>"0");
        $arrCond = $this->lfGetSearchCondition($arrSearch);
        $ret['dat'] = $this->lfGetProductsList($arrCond,10,0,$objProduct);
        unset($ret['dat']['productStatus']);
        $ret['arrCC'] = $objProduct->classCats1;
        return $ret;

    }
    /**
     * 検索条件のwhere文とかを取得
     *
     * @return array
     */
    public function lfGetSearchCondition($arrSearchData)
    {
        $searchCondition = array(
            'where'             => '1=1 and del_flg=0',
            'arrval'            => array(),
            'where_category'    => '',
            'arrvalCategory'    => array()
        );

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

        // XXX 一時期内容が異なっていたことがあるので別要素にも格納している。
        $searchCondition['where_for_count'] = $searchCondition['where'];
        return $searchCondition;
    }

    /* 商品一覧の表示 */
    /**
     * @param SC_Product_Ex $objProduct
     */
    public function lfGetProductsList($searchCondition, $disp_number, $startno, &$objProduct)
    {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrOrderVal = array();
        $orderby='y1price';
        // 表示順序
        switch ($orderby) {
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
        return $arrProducts;
    }        
}
