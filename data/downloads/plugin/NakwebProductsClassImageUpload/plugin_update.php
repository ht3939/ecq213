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

/**
 * プラグイン のアップデート用クラス.
 *
 * @package NakwebProductsClassImageUpload
 * @author NAKWEB CO.,LTD.
 * @version $1.0 Id: $ProductsClassImageUpload01
 */
class plugin_update{
   /**
     * アップデート
     * updateはアップデート時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function update($arrPlugin) {
        switch($arrPlugin['plugin_version']){
        // バージョン1.0からのアップデート
        case("1.0"):
            plugin_update::updatever1-1($arrPlugin);
        case("1.1"):
            plugin_update::updatever1-1-1($arrPlugin);
            plugin_update::insertFookPoint($arrPlugin);
            break;
        default:
            break;
        }
    }

    /**
     * 1.0以下のアップデートを実行します.
     * @param type $param 
     */
    function updatever1-1($arrPlugin) {
        // 更新のあったファイルをコピーする。
        //// プログラムファイル
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/NakwebProductsClassImageUpload.php", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/NakwebProductsClassImageUpload.php");
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/plg_NakwebProductsClassImageUpload_LC_Page_Admin_Products_ProductClass.php", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/plg_NakwebProductsClassImageUpload_LC_Page_Admin_Products_ProductClass.php");
        
        // HTMLディレクトリ以下のファイル
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/upload-page/plg_NakwebProductsClassImageUpload_LC_Page_Admin_Products_ProductsClassImage.php", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/upload-page/plg_NakwebProductsClassImageUpload_LC_Page_Admin_Products_ProductsClassImage.php");

    }

    /**
     * 1.1のアップデートを実行します.
     * @param type $param 
     */
    function updatever1-1-1($arrPlugin) {
        // 更新のあったファイルをコピーする。
        //// プログラムファイル
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/NakwebProductsClassImageUpload.php", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/NakwebProductsClassImageUpload.php");
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/templates/plg_NakwebProductsClassImageUpload_products-list.tpl", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/templates/plg_NakwebProductsClassImageUpload_products-list.tpl");
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/templates/plg_NakwebProductsClassImageUpload_products-list-js.tpl", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/templates/plg_NakwebProductsClassImageUpload_products-list-js.tpl");
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/templates/plg_NakwebProductsClassImageUpload_products-list-js12.tpl", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/templates/plg_NakwebProductsClassImageUpload_products-list-js12.tpl");
        
        // dtb_pluginを更新します.
        plugin_update::updateDtbPluginData($arrPlugin, $plugin_data);
    }


    /**
     * dtb_pluginを更新します.
     * 各バージョンに対するアップデートです
     *
     * @param int $arrPlugin プラグイン情報
     * @return void
     */
    function updateDtbPluginData($arrPlugin, $plugin_data = '') {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();

        $sqlval = array();
        $table = "dtb_plugin";
        if (strlen($plugin_data) > 0) {
            // データが存在している場合は更新する（シリアライズ化を事前に行なっておくこと）
            $sql_conf['free_field1']    = $plugin_data;
        }
        $sql_conf['plugin_name']        = '商品規格画像アップロード プラグイン';
        $sql_conf['plugin_description'] = '規格商品毎に商品画像をアップロードでき、商品一覧、商品詳細画面等にて規格毎に画像が変化するようになります。';
        $sql_conf['plugin_version']     = '1.1.1';
        $sql_conf['compliant_version']  = '2.12.2 ～ 2.13.5';
        $sql_conf['update_date']        = 'CURRENT_TIMESTAMP';
        $where = "plugin_id = ?";
        $objQuery->update($table, $sql_conf, $where, array($arrPlugin['plugin_id']));

        $objQuery->commit();
    }

    /**
     * バージョン1.0では登録されていなかったフックポイントを登録する。
     * 
     * @param int $arrPlugin プラグイン情報
     * @return void
     */
    function insertFookPoint($arrPlugin) {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        // フックポイントをDB登録.
        $hook_point = array(
            array("LC_Page_Admin_Products_ProductClass_action_before", 'plg_admin_productsclass_action'),
            array("LC_Page_Products_List_action_before", 'plg_products_list_action'),
            array("LC_Page_Products_Detail_action_before", 'plg_products_detail_action'),
            array("LC_Page_Cart_action_before", 'plg_cart_index_action'),
            array("LC_Page_Shopping_Multiple_action_before", 'plg_shopping_multiple_action'),
            array("LC_Page_Shopping_Confirm_action_before", 'plg_shopping_confirm_action')
        );
        /**
         * FIXME コードが重複しているため、要修正
         */
        // フックポイントが配列で定義されている場合
        if (is_array($hook_point)) {
            foreach ($hook_point as $h) {
                $arr_sqlval_plugin_hookpoint = array();
                $id = $objQuery->nextVal('dtb_plugin_hookpoint_plugin_hookpoint_id');
                $arr_sqlval_plugin_hookpoint['plugin_hookpoint_id'] = $id;
                $arr_sqlval_plugin_hookpoint['plugin_id'] = $arrPlugin['plugin_id'];
                $arr_sqlval_plugin_hookpoint['hook_point'] = $h[0];
                $arr_sqlval_plugin_hookpoint['callback'] = $h[1];
                $arr_sqlval_plugin_hookpoint['update_date'] = 'CURRENT_TIMESTAMP';
                $objQuery->insert('dtb_plugin_hookpoint', $arr_sqlval_plugin_hookpoint);
            }
        // 文字列定義の場合
        } else {
            $array_hook_point = explode(',', $hook_point);
            foreach ($array_hook_point as $h) {
                $arr_sqlval_plugin_hookpoint = array();
                $id = $objQuery->nextVal('dtb_plugin_hookpoint_plugin_hookpoint_id');
                $arr_sqlval_plugin_hookpoint['plugin_hookpoint_id'] = $id;
                $arr_sqlval_plugin_hookpoint['plugin_id'] = $arrPlugin['plugin_id'];
                $arr_sqlval_plugin_hookpoint['hook_point'] = $h;
                $arr_sqlval_plugin_hookpoint['update_date'] = 'CURRENT_TIMESTAMP';
                $objQuery->insert('dtb_plugin_hookpoint', $arr_sqlval_plugin_hookpoint);
            }
        }
        
        $objQuery->commit();
    }

}
?>
