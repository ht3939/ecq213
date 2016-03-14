<?php
/*
 * 
 * NakwebProductsClassImageUpload
 * Copyright (C) 2015 NAKWEB CO.,LTD. All Rights Reserved.
 * http://www.nakweb.com/
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

require_once CLASS_EX_REALDIR . 'page_extends/products/LC_Page_Products_List_Ex.php';

/**
 * プラグインのメインクラス
 *
 * @package NakwebProductsClassImageUpload
 * @author NAKWEB CO.,LTD.
 * @version $1.0 Id: $ProductsClassImageUpload01:
 */
class plg_NakwebProductsClassImageUpload_LC_Page_Products_List extends LC_Page_Products_List_Ex
{


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
        exit();
    }

    /**
     * カートに入れる商品情報にエラーがあったら戻す
     *
     * @param integer $product_id
     * @return str
     */
    public function lfSetSelectedData(&$arrProducts, $arrForm, $arrErr, $product_id)
    {
        $arrEcVersion = explode('.',ECCUBE_VERSION,3);
        $js_fnOnLoad = '';
        foreach (array_keys($arrProducts) as $key) {
            if ($arrProducts[$key]['product_id'] == $product_id) {
                $arrProducts[$key]['product_class_id']  = $arrForm['product_class_id'];
                $arrProducts[$key]['classcategory_id1'] = $arrForm['classcategory_id1'];
                $arrProducts[$key]['classcategory_id2'] = $arrForm['classcategory_id2'];
                $arrProducts[$key]['quantity']          = $arrForm['quantity'];
                $arrProducts[$key]['arrErr']            = $arrErr;
                $classcategory_id2 = SC_Utils_Ex::jsonEncode($arrForm['classcategory_id2']);
                if($arrEcVersion[1] >= '13') {
                $js_fnOnLoad .= "fnSetClassCategories(document.product_form{$arrProducts[$key]['product_id']}, {$classcategory_id2});";
                } else {
                    $js_fnOnLoad .= "fnSetClassCategories(document.product_form{$arrProducts[$key]['product_id']}, '{$arrForm['classcategory_id2']}');";
                }
                // 読み込むJSを追加する。
                $js_fnOnLoad .= "fnSetClassCategoriesimage(document.product_form{$arrProducts[$key]['product_id']});";
            }
        }

        return $js_fnOnLoad;
    }

    /**
     *
     * @param  SC_Product_Ex $objProduct
     * @param SC_FormParam_Ex $objFormParam
     * @return void
     */
    public function doDefault(&$objProduct, &$objFormParam)
    {
        $arrEcVersion = explode('.',ECCUBE_VERSION,3);
        //商品一覧の表示処理
        $strnavi            = $this->objNavi->strnavi;
        // 表示文字列
        $this->tpl_strnavi  = empty($strnavi) ? '&nbsp;' : $strnavi;

        // 規格1クラス名
        $this->tpl_class_name1  = $objProduct->className1;

        // 規格2クラス名
        $this->tpl_class_name2  = $objProduct->className2;

        // 規格1
        $this->arrClassCat1     = $objProduct->classCats1;

        // 規格1が設定されている
        $this->tpl_classcat_find1 = $objProduct->classCat1_find;
        // 規格2が設定されている
        $this->tpl_classcat_find2 = $objProduct->classCat2_find;

        $this->tpl_stock_find       = $objProduct->stock_find;
        $this->tpl_product_class_id = $objProduct->product_class_id;
        $this->tpl_product_type     = $objProduct->product_type;

        // 商品ステータスを取得
        $this->productStatus = $this->arrProducts['productStatus'];
        unset($this->arrProducts['productStatus']);
        if($arrEcVersion[1] >= '13') {
            $this->tpl_javascript .= 'eccube.productsClassCategories = ' . SC_Utils_Ex::jsonEncode($objProduct->classCategories) . ';';
        } else {
            $this->tpl_javascript .= 'var productsClassCategories = ' . SC_Utils_Ex::jsonEncode($objProduct->classCategories) . ';';
        }
        if (SC_Display_Ex::detectDevice() === DEVICE_TYPE_PC) {
            //onloadスクリプトを設定. 在庫ありの商品のみ出力する
            foreach ($this->arrProducts as $arrProduct) {
                if ($arrProduct['stock_unlimited_max'] || $arrProduct['stock_max'] > 0) {
                    $js_fnOnLoad .= "fnSetClassCategories(document.product_form{$arrProduct['product_id']});";
                    //読みこむJSを追加する。
                    $js_fnOnLoad .= "fnSetClassCategoriesimage(document.product_form{$arrProduct['product_id']});";
                }
            }
        }

        //カート処理
        $target_product_id = intval($this->arrForm['product_id']);
        if ($target_product_id > 0) {
            // 商品IDの正当性チェック
            if (!SC_Utils_Ex::sfIsInt($this->arrForm['product_id'])
                || !SC_Helper_DB_Ex::sfIsRecord('dtb_products', 'product_id', $this->arrForm['product_id'], 'del_flg = 0 AND status = 1')) {
                SC_Utils_Ex::sfDispSiteError(PRODUCT_NOT_FOUND);
            }

            // 入力内容のチェック
            if($arrEcVersion[1] >= '13') {
                $arrErr = $this->lfCheckError($objFormParam);
            } else {
                $arrErr = $this->lfCheckError($target_product_id, $this->arrForm, $this->tpl_classcat_find1, $this->tpl_classcat_find2);
            }
            if (empty($arrErr)) {
                $this->lfAddCart($this->arrForm);

                if($arrEcVersion[1] >= '13') {
                    // 開いているカテゴリーツリーを維持するためのパラメーター
                    $arrQueryString = array(
                        'category_id' => $this->arrForm['category_id'],
                    );

                    if($arrEcVersion[2] >= '1') {
                        SC_Response_Ex::sendRedirect(CART_URL, $arrQueryString);
                    } else {
                        SC_Response_Ex::sendRedirect(CART_URLPATH, $arrQueryString);
                    }
                } else {
                    SC_Response_Ex::sendRedirect(CART_URLPATH);
                }
                SC_Response_Ex::actionExit();
            }
            $js_fnOnLoad .= $this->lfSetSelectedData($this->arrProducts, $this->arrForm, $arrErr, $target_product_id);
        } else {
            // カート「戻るボタン」用に保持
            $netURL = new Net_URL();
            //該当メソッドが無いため、$_SESSIONに直接セット
            $_SESSION['cart_referer_url'] = $netURL->getURL();
        }

        $this->tpl_javascript   .= 'function fnOnLoad() {' . $js_fnOnLoad . '}';
        $this->tpl_onload       .= 'fnOnLoad(); ';
    }

}
