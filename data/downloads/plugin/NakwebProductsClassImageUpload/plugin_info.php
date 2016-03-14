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
 * プラグイン の情報クラス.
 *
 * @package NakwebProductsClassImageUpload
 * @author NAKWEB CO.,LTD.
 * @version $1.0 Id: $ProductsClassImageUpload01
 */
class plugin_info{
    /** プラグインコード(必須)：プラグインを識別する為キーで、他のプラグインと重複しない一意な値である必要があります。*/
    static $PLUGIN_CODE       = "NakwebProductsClassImageUpload";
    /** プラグイン名(必須)：EC-CUBE上で表示されるプラグイン名. */
    static $PLUGIN_NAME       = "商品規格画像アップロード プラグイン";
    /** クラス名(必須)：プラグインのクラス（拡張子は含まない） */
    static $CLASS_NAME        = "NakwebProductsClassImageUpload";
    /** プラグインバージョン(必須)：プラグインのバージョン. */
    static $PLUGIN_VERSION    = "1.1.1";
    /** 対応バージョン(必須)：対応するEC-CUBEバージョン. */
    static $COMPLIANT_VERSION = "2.12.2～2.13.5";
    /** 作者(必須)：プラグイン作者. */
    static $AUTHOR            = "株式会社ナックウェブ";
    /** 説明(必須)：プラグインの説明. */
    static $DESCRIPTION       = "規格商品毎に商品画像をアップロードでき、商品一覧、商品詳細画面等にて規格毎に画像が変化するようになります。";
    /** プラグインURL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $PLUGIN_SITE_URL   = "http://www.nakweb.com/";
    /** プラグイン作者URL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $AUTHOR_SITE_URL   = "http://www.nakweb.com/";
    /** フックポイント：フックポイントとコールバック関数を定義します */
    static $HOOK_POINTS       = array(
        array("LC_Page_Admin_Products_ProductClass_action_before", 'plg_admin_productsclass_action'),
        array("LC_Page_Products_List_action_before", 'plg_products_list_action'),
        array("LC_Page_Products_Detail_action_before", 'plg_products_detail_action'),
        array("LC_Page_Cart_action_before", 'plg_cart_index_action'),
        array("LC_Page_Shopping_Multiple_action_before", 'plg_shopping_multiple_action'),
        array("LC_Page_Shopping_Confirm_action_before", 'plg_shopping_confirm_action')
    );
    /** ライセンス */
    static $LICENSE           = "LGPL";
}
?>
