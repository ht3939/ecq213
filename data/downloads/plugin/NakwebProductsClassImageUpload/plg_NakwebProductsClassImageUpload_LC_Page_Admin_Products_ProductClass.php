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

require_once CLASS_EX_REALDIR . 'page_extends/admin/products/LC_Page_Admin_Products_ProductClass_Ex.php';

/**
 * プラグインのメインクラス
 *
 * @package NakwebProductsClassImageUpload
 * @author NAKWEB CO.,LTD.
 * @version $1.0 Id: $ProductsClassImageUpload01:
 */
class plg_NakwebProductsClassImageUpload_LC_Page_Admin_Products_ProductClass extends LC_Page_Admin_Products_ProductClass_Ex
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
     * Page のアクション.
     *
     * @return void
     */
    public function action()
    {
        parent::action();

    }


    /**
     * パラメーター初期化
     *
     * @param  SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    public function initParam(&$objFormParam)
    {
        parent::initParam($objFormParam); 

        $objFormParam->addParam('plg_nakwebproductsclassimageupload_main_list_image', 'plg_nakwebproductsclassimageupload_main_list_image', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('plg_nakwebproductsclassimageupload_main_image', 'plg_nakwebproductsclassimageupload_main_image', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('plg_nakwebproductsclassimageupload_main_large_image', 'plg_nakwebproductsclassimageupload_main_large_image', MTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
    }


    /**
     * 規格の登録または更新を行う.
     *
     * @param array   $arrList    入力フォームの内容
     * @param integer $product_id 登録を行う商品ID
     */
    public function registerProductClass($arrList, $product_id, $total)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objDb = new SC_Helper_DB_Ex();
        $objFormParam = new SC_FormParam_Ex();

        $objQuery->begin();

        $arrProductsClass = $objQuery->select('*', 'dtb_products_class', 'product_id = ?', array($product_id));
        $arrExists = array();
        foreach ($arrProductsClass as $val) {
            $arrExists[$val['product_class_id']] = $val;
        }

        // デフォルト値として設定する値を取得しておく
        $arrDefault = $this->getProductsClass($product_id);

        $objQuery->delete('dtb_products_class', 'product_id = ? AND (classcategory_id1 <> 0 OR classcategory_id2 <> 0)', array($product_id));

        for ($i = 0; $i < $total; $i++) {
            $del_flg = SC_Utils_Ex::isBlank($arrList['check'][$i]) ? 1 : 0;
            $price02 = SC_Utils_Ex::isBlank($arrList['price02'][$i]) ? 0 : $arrList['price02'][$i];
            // dtb_products_class 登録/更新用
            $registerKeys = array(
                'classcategory_id1', 'classcategory_id2',
                'product_code', 'stock', 'price01', 'product_type_id',
                'down_filename', 'down_realfilename',
                'plg_nakwebproductsclassimageupload_main_list_image', 'plg_nakwebproductsclassimageupload_main_image',
                'plg_nakwebproductsclassimageupload_main_large_image'
            );

            $arrPC = array();
            foreach ($registerKeys as $key) {
                $arrPC[$key] = $arrList[$key][$i];
                if($key == 'classcategory_id1') {
                    $classcategory1 = $arrList[$key][$i];
                }
                if($key == 'classcategory_id2') {
                    $classcategory2 = $arrList[$key][$i];
                }
            }
            $arrPC['product_id'] = $product_id;
            $arrPC['sale_limit'] = $arrDefault['sale_limit'];
            $arrPC['deliv_fee'] = $arrDefault['deliv_fee'];
            $arrPC['point_rate'] = $arrDefault['point_rate'];
            if ($arrList['stock_unlimited'][$i] == 1) {
                $arrPC['stock_unlimited'] = 1;
                $arrPC['stock'] = null;
            } else {
                $arrPC['stock_unlimited'] = 0;
            }
            $arrPC['price02'] = $price02;

            // 該当関数が無いため, セッションの値を直接代入
            $arrPC['creator_id'] = $_SESSION['member_id'];
            $arrPC['update_date'] = 'CURRENT_TIMESTAMP';
            $arrPC['del_flg'] = $del_flg;

            $arrPC['create_date'] = 'CURRENT_TIMESTAMP';
            // 更新の場合は, product_class_id を使い回す
            if (!SC_Utils_Ex::isBlank($arrList['product_class_id'][$i])) {
                $arrPC['product_class_id'] = $arrList['product_class_id'][$i];
            } else {
                $arrPC['product_class_id'] = $objQuery->nextVal('dtb_products_class_product_class_id');
            }

            // 商品規格画像を代入する。同時にアップロードした商品規格画像の保存処理を行う。
            $classcategory_select = $classcategory1. "-". $classcategory2;
            if(array_key_exists($classcategory_select, $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id])) {
                if(array_key_exists('save_main_list_image', $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select])) {
                    $old_main_list_image = $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['save_main_list_image'];
                    $main_list_image_flg = $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_list_image_path'];
                } else if(!(array_key_exists('save_main_list_image', $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]))){
                    $old_main_list_image = "";
                }

                if(array_key_exists('save_main_image', $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select])) {
                    $old_main_image = $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['save_main_image'];
                    $main_image_flg = $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_image_path'];
                } else if(!(array_key_exists('save_main_image', $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]))){
                    $old_main_image = "";
                }

                if(array_key_exists('save_main_large_image', $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select])) {
                    $old_main_large_image = $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['save_main_large_image'];
                    $main_large_image_flg = $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_large_image_path'];
                } else if(!(array_key_exists('save_main_large_image', $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]))){
                    $old_main_large_image = "";
                }

                $arrPC['plg_nakwebproductsclassimageupload_main_list_image']  = $this->doUploadImageComplete($objFormParam, $arrPC['product_class_id'], $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_list_image'], $old_main_list_image, $main_list_image_flg);
                $arrPC['plg_nakwebproductsclassimageupload_main_image']       = $this->doUploadImageComplete($objFormParam, $arrPC['product_class_id'], $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_image'], $old_main_image, $main_image_flg);
                $arrPC['plg_nakwebproductsclassimageupload_main_large_image'] = $this->doUploadImageComplete($objFormParam, $arrPC['product_class_id'], $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_large_image'], $old_main_large_image, $main_large_image_flg);
            } else {
                $arrPC['plg_nakwebproductsclassimageupload_main_list_image']  = "";
                $arrPC['plg_nakwebproductsclassimageupload_main_image']       = "";
                $arrPC['plg_nakwebproductsclassimageupload_main_large_image'] = "";
            }


            /*
             * チェックを入れない商品は product_type_id が NULL になるので, 0 を入れる
             */
            $arrPC['product_type_id'] = SC_Utils_Ex::isBlank($arrPC['product_type_id']) ? 0 : $arrPC['product_type_id'];

            $objQuery->insert('dtb_products_class', $arrPC);

            $arrEcVersion = explode('.',ECCUBE_VERSION,3);
            if($arrEcVersion[1] >= '13'){
                // 税情報登録/更新
                if (OPTION_PRODUCT_TAX_RULE) {
                    SC_Helper_TaxRule_Ex::setTaxRuleForProduct($arrList['tax_rate'][$i], $arrPC['product_id'], $arrPC['product_class_id']);
                }
            }

            
        }

        // 規格無し用の商品規格を非表示に
        $arrBlank['del_flg'] = 1;
        $arrBlank['update_date'] = 'CURRENT_TIMESTAMP';
        $objQuery->update('dtb_products_class', $arrBlank,
                          'product_id = ? AND classcategory_id1 = 0 AND classcategory_id2 = 0',
                          array($product_id));

        // セッションをリセット
        $_SESSION['plg_NakwebProductsClassImageUpload'] = array();

        // 件数カウントバッチ実行
        $objDb->sfCountCategory($objQuery);
        $objQuery->commit();
    }


    /**
     * 規格編集画面を表示する
     *
     * @param SC_FormParam $objFormParam
     */
    public function doPreEdit(&$objFormParam)
    {
        $product_id = $objFormParam->getValue('product_id');
        $objProduct = new SC_Product_Ex();
        $existsProductsClass = $objProduct->getProductsClassFullByProductId($product_id);

        // 規格のデフォルト値(全ての組み合わせ)を取得し, フォームに反映
        $class_id1 = $existsProductsClass[0]['class_id1'];
        $class_id2 = $existsProductsClass[0]['class_id2'];
        $objFormParam->setValue('class_id1', $class_id1);
        $objFormParam->setValue('class_id2', $class_id2);
        $this->doDisp($objFormParam);
        /*
         * 登録済みのデータで, フォームの値を上書きする.
         *
         * 登録済みデータと, フォームの値は, 配列の形式が違うため,
         * 同じ形式の配列を生成し, マージしてフォームの値を上書きする
         */
        $arrKeys = array('classcategory_id1', 'classcategory_id2', 'product_code',
            'classcategory_name1', 'classcategory_name2', 'stock',
            'stock_unlimited', 'price01', 'price02',
            'product_type_id', 'down_filename', 'down_realfilename', 'upload_index', 'tax_rate',
            'plg_nakwebproductsclassimageupload_main_list_image', 'plg_nakwebproductsclassimageupload_main_image',
            'plg_nakwebproductsclassimageupload_main_large_image'
        );
        $arrFormValues = $objFormParam->getSwapArray($arrKeys);
        // フォームの規格1, 規格2をキーにした配列を生成
        $arrClassCatKey = array();
        foreach ($arrFormValues as $formValue) {
            $arrClassCatKey[$formValue['classcategory_id1']][$formValue['classcategory_id2']] = $formValue;
        }
        
        // 登録済みデータをマージ
        foreach ($existsProductsClass as $existsValue) {
            $arrClassCatKey[$existsValue['classcategory_id1']][$existsValue['classcategory_id2']] = $existsValue;
        }

        // ここでセッションへデータを保持するための準備を行う。
        if(!(array_key_exists('plg_NakwebProductsClassImageUpload', $_SESSION))) {
            $_SESSION['plg_NakwebProductsClassImageUpload'] = array();
        } else {
            foreach($_SESSION['plg_NakwebProductsClassImageUpload'] as $session_products_id => $value) {
                if($product_id != $session_products_id) {
                    unset($_SESSION['plg_NakwebProductsClassImageUpload'][$session_products_id]);
                }
            }
        }


        // 規格のデフォルト値に del_flg をつけてマージ後の1次元配列を生成
        $arrMergeProductsClass = array();
        foreach ($arrClassCatKey as $arrC1) {
            foreach ($arrC1 as $arrValues) {
                $arrValues['del_flg'] = (string) $arrValues['del_flg'];
                if (SC_Utils_Ex::isBlank($arrValues['del_flg'])
                    || $arrValues['del_flg'] === '1') {
                    $arrValues['del_flg'] = '1';
                } else {
                    $arrValues['del_flg'] = '0';
                }

                $arrEcVersion = explode('.',ECCUBE_VERSION,3);
                if($arrEcVersion[1] >= '13'){
                    // 消費税率を設定
                    if (OPTION_PRODUCT_TAX_RULE) {
                        $arrRet = SC_Helper_TaxRule_Ex::getTaxRule($arrValues['product_id'], $arrValues['product_class_id']);
                        $arrValues['tax_rate'] = $arrRet['tax_rate'];
                    }
                }

                $arrMergeProductsClass[] = $arrValues;

                // ここでセッションへ各商品に設定された商品規格画像の保存を行う。
                $classcategory_select = $arrValues['classcategory_id1']. "-". $arrValues['classcategory_id2'];
                if($arrValues['plg_nakwebproductsclassimageupload_main_list_image'] != "" && $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_list_image_path'] == "") {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['save_main_list_image']      = $arrValues['plg_nakwebproductsclassimageupload_main_list_image'];
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_list_image_path'] = 'save';
                }
                if($arrValues['plg_nakwebproductsclassimageupload_main_image'] != "" && $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_image_path'] == "") {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['save_main_image']      = $arrValues['plg_nakwebproductsclassimageupload_main_image'];
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_image_path'] = 'save';
                }
                if($arrValues['plg_nakwebproductsclassimageupload_main_large_image'] != "" && $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_large_image_path'] == "") {
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['save_main_large_image']      = $arrValues['plg_nakwebproductsclassimageupload_main_large_image'];
                    $_SESSION['plg_NakwebProductsClassImageUpload'][$product_id][$classcategory_select]['temp_main_large_image_path'] = 'save';
                }
            }
        }
        
        // 登録済みのデータで上書き
        $objFormParam->setParam(SC_Utils_Ex::sfSwapArray($arrMergeProductsClass));

        // $arrMergeProductsClass で product_id が配列になってしまうため数値で上書き
        $objFormParam->setValue('product_id', $product_id);

        // check を設定
        $arrChecks = array();
        $index = 0;
        foreach ($objFormParam->getValue('del_flg') as $key => $val) {
            if ($val === '0') {
                $arrChecks[$index] = 1;
            }
            $index++;
        }
        $objFormParam->setValue('check', $arrChecks);

        // class_id1, class_id2 を取得値で上書き
        $objFormParam->setValue('class_id1', $class_id1);
        $objFormParam->setValue('class_id2', $class_id2);
    }


    /**
     * アップロードした一時ファイルを保存する.
     *
     * @param  SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    public function doUploadImageComplete(&$objFormParam, $product_class_id, $image_name, $old_image_name="", $image_flg)
    {
        $objImage   = new SC_Image_Ex(IMAGE_TEMP_REALDIR);
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();

        // 旧商品イメージ取得
        $old_image = $old_image_name;
        $new_image  = $image_name;
        
        
        // 一時ファイルを商品イメージとして保存する
        if($new_image != "") {
            $objImage->moveTempImage($new_image, IMAGE_SAVE_REALDIR);
            // 旧保存ファイルが変更されている場合は旧ファイルを削除
            if (strlen($old_image) > 0) {
                if ($old_image != $new_image) {
                    // 旧商品イメージが登録済みで旧商品イメージ名と今回登録商品イメージで内容が異なる場合は削除
                    $objImage->deleteImage($old_image, IMAGE_SAVE_REALDIR);
                }
            }
        } else {
            if($image_flg == 'temp') {
                if (strlen($old_image) > 0) {
                    //画像削除フラグ
                    $objImage->deleteImage($old_image, IMAGE_SAVE_REALDIR);
                }
            } else if($image_flg == 'save') {
                if (strlen($old_image) > 0) {
                    $new_image = $old_image;
                }
            }
        }

        return $new_image;
    }


    /**
     * 商品IDをキーにして, 商品規格の初期値を取得する.
     *
     * 商品IDをキーにし, デフォルトに設定されている商品規格を取得する.
     *
     * @param  integer $product_id 商品ID
     * @return array   商品規格の配列
     */
    public function getProductsClass($product_id)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $col = 'product_code, price01, price02, stock, stock_unlimited, sale_limit, deliv_fee, point_rate,
                plg_NakwebProductsClassImageUpload_main_list_image, plg_NakwebProductsClassImageUpload_main_image,
            plg_NakwebProductsClassImageUpload_main_large_image';
        $where = 'product_id = ? AND classcategory_id1 = 0 AND classcategory_id2 = 0';

        return $objQuery->getRow($col, 'dtb_products_class', $where, array($product_id));
    }

    

}
