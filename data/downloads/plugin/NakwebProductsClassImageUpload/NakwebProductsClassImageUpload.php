<?php
/*
 * NakwebProductsClassImageUpload
 * Copyright (C) 2015 NAKWEB CO.,LTD. All Rights Reserved.
 * http://www.nakweb.com/
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

//今後読み込む内容を変更するには此処で
require_once "plg_NakwebProductsClassImageUpload_LC_Page_Admin_Products_ProductClass.php";
require_once "plg_NakwebProductsClassImageUpload_LC_Page_Products_List.php";
require_once "plg_NakwebProductsClassImageUpload_LC_Page_Products_Detail.php";
require_once "plg_NakwebProductsClassImageUpload_LC_Page_Cart.php";
require_once "plg_NakwebProductsClassImageUpload_LC_Page_Shopping_Multiple.php";
require_once "plg_NakwebProductsClassImageUpload_LC_Page_Shopping_Confirm.php";
require_once "plg_NakwebProductsClassImageUpload_SC_Product.php";



/**
 * プラグインのメインクラス
 *
 * @package NakwebProductsClassImageUpload
 * @author NAKWEB CO.,LTD.
 * @version $1.0 Id: $ProductsClassImageUpload01
 */
class NakwebProductsClassImageUpload extends SC_Plugin_Base {

    // 静的定数(CONSTはPHP5.3以降)
    protected static $nakweb_plgin_individual = 'plg_nakweb_00007';    // nakweb プラグイン番号

    /**
     * コンストラクタ
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
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
        /** トランザクション開始 ******************************************************/
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();
        //データベースに規格商品画像登録用のカラムを追加で用意する。
       /*******************************************************************************
        * dtb_products_classについて
        *******************************************************************************/
        //dtb_products_classに新規カラムとして3つ画像登録用のカラムを追加する。
        $col_check = $objQuery -> listTableFields('dtb_products_class');

        switch(DB_TYPE) {
            case 'pgsql':
                //plg_NakwebProductsClassImageUpload_main_list_imageの追加
                //不正な削除によってテーブルにカラムが残っていないかチェック
                if(!(in_array("plg_nakwebproductsclassimageupload_main_list_image", $col_check))) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE dtb_products_class ADD plg_nakwebproductsclassimageupload_main_list_image text');
                }

                //plg_NakwebProductsClassImageUpload_main_imageの追加
                //不正な削除によってテーブルにカラムが残っていないかチェック
                if(!(in_array("plg_nakwebproductsclassimageupload_main_image", $col_check))) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE dtb_products_class ADD plg_nakwebproductsclassimageupload_main_image text');
                }

                //plg_NakwebProductsClassImageUpload_main_large_imageの追加
                //不正な削除によってテーブルにカラムが残っていないかチェック
                if(!(in_array("plg_nakwebproductsclassimageupload_main_large_image", $col_check))) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE dtb_products_class ADD plg_nakwebproductsclassimageupload_main_large_image text');
                }
                break;
            case 'mysql':
                //plg_NakwebProductsClassImageUpload_main_list_imageの追加
                //不正な削除によってテーブルにカラムが残っていないかチェック
                if(!(in_array("plg_nakwebproductsclassimageupload_main_list_image", $col_check))) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE `dtb_products_class` ADD `plg_nakwebproductsclassimageupload_main_list_image` TEXT CHARACTER SET utf8 COLLATE utf8_bin NULL default NULL');
                }

                //plg_NakwebProductsClassImageUpload_main_imageの追加
                //不正な削除によってテーブルにカラムが残っていないかチェック
                if(!(in_array("plg_nakwebproductsclassimageupload_main_image", $col_check))) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE `dtb_products_class` ADD `plg_nakwebproductsclassimageupload_main_image` TEXT CHARACTER SET utf8 COLLATE utf8_bin NULL default NULL');
                }

                //plg_NakwebProductsClassImageUpload_main_large_imageの追加
                //不正な削除によってテーブルにカラムが残っていないかチェック
                if(!(in_array("plg_nakwebproductsclassimageupload_main_large_image", $col_check))) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE `dtb_products_class` ADD `plg_nakwebproductsclassimageupload_main_large_image` TEXT CHARACTER SET utf8 COLLATE utf8_bin NULL default NULL');
                }
                break;
            default:
                break;
        }

       /*******************************************************************************
        * dtb_csvにて出力項目の追加設定
        *******************************************************************************/
        $max_rank = $objQuery->max('rank', 'dtb_csv', 'csv_id = ?;', array('1'));

        // 出力項目の追加(一覧-メイン画像)
        $db_sql['no']                     = $objQuery->nextVal('dtb_csv_no');
        $db_sql['csv_id']                 = '1';
        $db_sql['col']                    = 'plg_nakwebproductsclassimageupload_main_list_image';
        $db_sql['disp_name']              = '商品規格画像(一覧-メイン画像)';
        $db_sql['rank']                   = $max_rank++;
        $db_sql['rw_flg']                 = 1;
        $db_sql['status']                 = 1;
        $db_sql['create_date']            = "CURRENT_TIMESTAMP";
        $db_sql['update_date']            = "CURRENT_TIMESTAMP";
        $db_sql['mb_convert_kana_option'] = "KVa";
        $db_sql['size_const_type']        = "LTEXT_LEN";
        $db_sql['error_check_types']      = "SPTAB_CHECK,MAX_LENGTH_CHECK,FILE_EXISTS";

        // 出力項目の追加（SQLの実行）
        $objQuery->insert("dtb_csv", $db_sql);

        // 出力項目の追加(詳細-メイン画像)
        $db_sql['no']                     = $objQuery->nextVal('dtb_csv_no');
        $db_sql['csv_id']                 = '1';
        $db_sql['col']                    = 'plg_nakwebproductsclassimageupload_main_image';
        $db_sql['disp_name']              = '商品規格画像(詳細-メイン画像)';
        $db_sql['rank']                   = $max_rank++;
        $db_sql['rw_flg']                 = 1;
        $db_sql['status']                 = 1;
        $db_sql['create_date']            = "CURRENT_TIMESTAMP";
        $db_sql['update_date']            = "CURRENT_TIMESTAMP";
        $db_sql['mb_convert_kana_option'] = "";
        $db_sql['size_const_type']        = "LTEXT_LEN";
        $db_sql['error_check_types']      = "SPTAB_CHECK,MAX_LENGTH_CHECK,FILE_EXISTS";

        // 出力項目の追加（SQLの実行）
        $objQuery->insert("dtb_csv", $db_sql);

        // 出力項目の追加(詳細-拡大画像)
        $db_sql['no']                     = $objQuery->nextVal('dtb_csv_no');
        $db_sql['csv_id']                 = '1';
        $db_sql['col']                    = 'plg_nakwebproductsclassimageupload_main_large_image';
        $db_sql['disp_name']              = '商品規格画像(詳細-拡大画像)';
        $db_sql['rank']                   = $max_rank++;
        $db_sql['rw_flg']                 = 1;
        $db_sql['status']                 = 1;
        $db_sql['create_date']            = "CURRENT_TIMESTAMP";
        $db_sql['update_date']            = "CURRENT_TIMESTAMP";
        $db_sql['mb_convert_kana_option'] = "";
        $db_sql['size_const_type']        = "LTEXT_LEN";
        $db_sql['error_check_types']      = "SPTAB_CHECK,MAX_LENGTH_CHECK,FILE_EXISTS";

        // 出力項目の追加（SQLの実行）
        $objQuery->insert("dtb_csv", $db_sql);



        /** トランザクション終了 ******************************************************/
        $objQuery->commit();


        /** ファイルのコピー **********************************************************/
        // 必要なファイルをコピーします.
        //画像アップロード用テンプレート集
        copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/upload-page/plg_nakwebproductsclassimageupload_upload.tpl", SMARTY_TEMPLATES_REALDIR . ADMIN_DIR . "products/plg_nakwebproductsclassimageupload_upload.tpl");
        copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/upload-page/plg-nakwebproductsclassimageupload-upload.php", HTML_REALDIR . ADMIN_DIR . "products/plg-nakwebproductsclassimageupload-upload.php");

        //ロゴ
        copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/logo.png", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/logo.png");
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
        /** トランザクションの開始 ****************************************************/
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();


       /*******************************************************************************
        * dtb_csvにて出力項目の削除
        *******************************************************************************/
        // 商品規格画像についての項目を削除する。
        // 一覧ｰメイン画像
        $searchResultListimage = $objQuery->exists('dtb_csv', 'col = ?', array('plg_nakwebproductsclassimageupload_main_list_image'));
        if($searchResultListimage) {
            $objQuery->delete("dtb_csv", 'col = ?', array('plg_nakwebproductsclassimageupload_main_list_image'));
        }

        // 詳細-メイン画像
        $searchResultMainimage = $objQuery->exists('dtb_csv', 'col = ?', array('plg_nakwebproductsclassimageupload_main_image'));
        if($searchResultMainimage) {
            $objQuery->delete("dtb_csv", 'col = ?', array('plg_nakwebproductsclassimageupload_main_image'));
        }

        // 詳細-拡大画像
        $searchResultLargeimage = $objQuery->exists('dtb_csv', 'col = ?', array('plg_nakwebproductsclassimageupload_main_large_image'));
        if($searchResultLargeimage) {
            $objQuery->delete("dtb_csv", 'col = ?', array('plg_nakwebproductsclassimageupload_main_large_image'));
        }



       /*******************************************************************************
        * dtb_products_classのカラムの削除
        *******************************************************************************/
        //インストール時に追加したカラムの削除を行う。
        $col_check = $objQuery -> listTableFields('dtb_products_class');

        switch(DB_TYPE) {
            case 'pgsql':
                //plg_NakwebProductsClassImageUpload_main_list_imageの削除
                //不正な削除によってテーブルのカラムが消えていないかチェック
                if(in_array("plg_nakwebproductsclassimageupload_main_list_image", $col_check)) {
                //残っていればカラムの削除
                    $objQuery->query('ALTER TABLE dtb_products_class DROP plg_nakwebproductsclassimageupload_main_list_image');
                }

                //plg_NakwebProductsClassImageUpload_main_imageの削除
                //不正な削除によってテーブルのカラムが消えていないかチェック
                if(in_array("plg_nakwebproductsclassimageupload_main_image", $col_check)) {
                //残っていればカラムの削除
                    $objQuery->query('ALTER TABLE dtb_products_class DROP plg_nakwebproductsclassimageupload_main_image');
                }

                //plg_NakwebProductsClassImageUpload_main_large_imageの削除
                //不正な削除によってテーブルのカラムが消えていないかチェック
                if(in_array("plg_nakwebproductsclassimageupload_main_large_image", $col_check)) {
                //残っていればカラムの削除
                    $objQuery->query('ALTER TABLE dtb_products_class DROP plg_nakwebproductsclassimageupload_main_large_image');
                }
                break;
            case 'mysql':
                //plg_NakwebProductsClassImageUpload_main_list_imageの削除
                //不正な削除によってテーブルのカラムが消えていないかチェック
                if(in_array("plg_nakwebproductsclassimageupload_main_list_image", $col_check)) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE `dtb_products_class` DROP `plg_nakwebproductsclassimageupload_main_list_image`');
                }

                //plg_NakwebProductsClassImageUpload_main_imageの削除
                //不正な削除によってテーブルのカラムが消えていないかチェック
                if(in_array("plg_nakwebproductsclassimageupload_main_image", $col_check)) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE `dtb_products_class` DROP `plg_nakwebproductsclassimageupload_main_image`');
                }

                //plg_NakwebProductsClassImageUpload_main_large_imageの削除
                //不正な削除によってテーブルのカラムが消えていないかチェック
                if(in_array("plg_nakwebproductsclassimageupload_main_large_image", $col_check)) {
                //残っていなければカラムの追加
                    $objQuery->query('ALTER TABLE `dtb_products_class` DROP `plg_nakwebproductsclassimageupload_main_large_image`');
                }
                break;
            default:
                break;
        }


        /** トランザクション終了 *****************************************************/
        $objQuery->commit();


       /*******************************************************************************
        * ファイルの削除
        *******************************************************************************/
        SC_Helper_FileManager_Ex::deleteFile(SMARTY_TEMPLATES_REALDIR . "admin/products/plg_nakwebproductsclassimageupload_upload.tpl");
        SC_Helper_FileManager_Ex::deleteFile(HTML_REALDIR . "admin/products/plg-nakwebproductsclassimageupload-upload.php");

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
        // nop(特に挙動の変化は無し)
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
        // nop(特に挙動の変化は無し)
    }


    // // スーパーフックポイント（preProcess）
    // function preProcess() {
    //     // nop(使用せず)
    // }


    // // スーパーフックポイント（prosess）
    // function prosess() {
    //     // nop(使用せず)
    // }


    /**
     * 処理の介入箇所とコールバック関数を設定
     * registerはプラグインインスタンス生成時に実行されます
     *
     * @param $objHelperPlugin
     * @param $priority
     */
    function register($objHelperPlugin, $priority) {
        parent::register($objHelperPlugin, $priority);
        //メールテンプレートへ値の挿入をするためにＳＣクラスへ介入
        $objHelperPlugin->addAction('loadClassFileChange',array(&$this,'loadClassFileChange'));
        //テンプレートへの介入
        $objHelperPlugin->addAction('prefilterTransform', array(&$this, 'prefilterTransform'));


    }


    //==========================================================================
    // Original Function
    //==========================================================================
    // テンプレートのフック（管理画面上部のプルダウンメニュー)
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
        $arrEcVersion = explode('.',ECCUBE_VERSION,3);
        $objTransform = new SC_Helper_Transform($source);
        $template_dir = PLUGIN_UPLOAD_REALDIR . $this->arrSelfInfo['plugin_code'] . '/templates/';
        switch($objPage->arrPageLayout['device_type_id']){
            case DEVICE_TYPE_MOBILE:
            case DEVICE_TYPE_SMARTPHONE:
                break;
            case DEVICE_TYPE_PC:
                if($arrEcVersion[1] >= '13') {
                    if (strpos($filename, 'products/list.tpl') !== false) {
                        $objTransform->select('div#undercolumn')->insertBefore(file_get_contents($template_dir . 'plg_NakwebProductsClassImageUpload_products-list-js.tpl'));
                    }
                } else {
                    if (strpos($filename, 'products/list.tpl') !== false) {
                        $objTransform->select('div#undercolumn')->insertBefore(file_get_contents($template_dir . 'plg_NakwebProductsClassImageUpload_products-list-js12.tpl'));
                    }
                }
                if (strpos($filename, 'products/list.tpl') !== false) {
                    $objTransform->select('div.listphoto')->replaceElement(file_get_contents($template_dir . 'plg_NakwebProductsClassImageUpload_products-list.tpl'));
                }
                if($arrEcVersion[1] >= '13') {
                    if (strpos($filename, 'products/detail.tpl') !== false) {
                        $objTransform->select('div#undercolumn')->insertBefore(file_get_contents($template_dir . 'plg_NakwebProductsClassImageUpload_products-detail-js.tpl'));
                    }
                } else {
                    if (strpos($filename, 'products/detail.tpl') !== false) {
                        $objTransform->select('div#undercolumn')->insertBefore(file_get_contents($template_dir . 'plg_NakwebProductsClassImageUpload_products-detail-js12.tpl'));
                    }
                }
                if (strpos($filename, 'products/detail.tpl') !== false) {
                    $objTransform->select('div#detailphotobloc')->replaceElement(file_get_contents($template_dir . 'plg_NakwebProductsClassImageUpload_products-detail.tpl'));
                }
                break;
            case DEVICE_TYPE_ADMIN:
            default:
                if (strpos($filename, 'products/product_class.tpl') !== false) {
                    $objTransform->select('table.list')->replaceElement(file_get_contents($template_dir . 'plg_NakwebProductsClassImageUpload_upload-table.tpl'));
                }
                if (strpos($filename, 'products/product_class_confirm.tpl') !== false) {
                    $objTransform->select('table.list')->replaceElement(file_get_contents($template_dir . 'plg_NakwebProductsClassImageUpload_upload-table-confirm.tpl'));
                }
                break;
        }
        $source = $objTransform->getHTML();
    }


    // SC_Productへ介入
    function loadClassFileChange(&$classname,&$classpath){
        if($classname == 'SC_Product_Ex'){
            $classpath = PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/plg_NakwebProductsClassImageUpload_SC_Product.php";
            $classname = "SC_Product";
        }
    }

    // 商品規格登録画面での介入
    function plg_admin_productsclass_action($objPage) {
        switch ($objPage->mode) {
            case 'json':
                // 処理を行わない
                break;
            default:
                // 商品規格登録画面に介入
                $objAdminProduct = new plg_NakwebProductsClassImageUpload_LC_Page_Admin_Products_ProductClass();
                $objAdminProduct->init($plg_head);
                $objAdminProduct->process();
                break;
        }
    }

    // 商品一覧画面での介入
    function plg_products_list_action($objPage) {
        switch ($objPage->mode) {
            case 'json':
                // 処理を行わない
                break;
            default:
                // 商品一覧画面に介入
                $objAdminProduct = new plg_NakwebProductsClassImageUpload_LC_Page_Products_List();
                $objAdminProduct->init($plg_head);
                $objAdminProduct->process();
                break;
        }
    }

    // 商品詳細画面での介入
    function plg_products_detail_action($objPage) {
        switch ($objPage->mode) {
            case 'json':
                // 処理を行わない
                break;
            default:
                // 商品詳細画面に介入
                $objAdminProduct = new plg_NakwebProductsClassImageUpload_LC_Page_Products_Detail();
                $objAdminProduct->init($plg_head);
                $objAdminProduct->process();
                break;
        }
    }

    // カート画面での介入
    function plg_cart_index_action($objPage) {
        switch ($objPage->mode) {
            case 'json':
                // 処理を行わない
                break;
            default:
                // カート画面に介入
                $objAdminProduct = new plg_NakwebProductsClassImageUpload_LC_Page_Cart();
                $objAdminProduct->init($plg_head);
                $objAdminProduct->process();
                break;
        }
    }

    // 複数配送先選択画面での介入
    function plg_shopping_multiple_action($objPage) {
        switch ($objPage->mode) {
            case 'json':
                // 処理を行わない
                break;
            default:
                // 複数配送先選択画面に介入
                $objAdminProduct = new plg_NakwebProductsClassImageUpload_LC_Page_Shopping_Multiple();
                $objAdminProduct->init($plg_head);
                $objAdminProduct->process();
                break;
        }
    }

    // 注文確認画面での介入
    function plg_shopping_confirm_action($objPage) {
        switch ($objPage->mode) {
            case 'json':
                // 処理を行わない
                break;
            default:
                // 注文確認画面に介入
                $objAdminProduct = new plg_NakwebProductsClassImageUpload_LC_Page_Shopping_Confirm();
                $objAdminProduct->init($plg_head);
                $objAdminProduct->process();
                break;
        }
    }


}
?>
