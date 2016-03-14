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

require_once CLASS_EX_REALDIR . 'page_extends/shopping/LC_Page_Shopping_Confirm_Ex.php';

/**
 * プラグインのメインクラス
 *
 * @package NakwebProductsClassImageUpload
 * @author NAKWEB CO.,LTD.
 * @version $1.0 Id: $ProductsClassImageUpload01:
 */
class plg_NakwebProductsClassImageUpload_LC_Page_Shopping_Confirm extends LC_Page_Shopping_Confirm_Ex
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
     * Page のAction.
     *
     * @return void
     */
    function action()
    {
        parent::action();
        // 画像を読み込めるよう処理
        foreach($this->arrCartItems as $product_key => $value) {
            if($value['productsClass']['plg_nakwebproductsclassimageupload_main_list_image'] != "") {
                $this->arrCartItems[$product_key]['productsClass']['main_list_image'] = $value['productsClass']['plg_nakwebproductsclassimageupload_main_list_image'];
            }

            if($value['productsClass']['plg_nakwebproductsclassimageupload_main_image'] != "") {
                $this->arrCartItems[$product_key]['productsClass']['main_image'] = $value['productsClass']['plg_nakwebproductsclassimageupload_main_image'];
                $this->arrShipping[$product_key]['shippingItem']['productsClass']['main_image'] = $value['productsClass']['plg_nakwebproductsclassimageupload_main_image'];
            }
        }

        foreach($this->arrShipping as $shipping_num => $value) {
            foreach($value['shipment_item'] as $products_num => $p_val) {
                if($p_val['productsClass']['plg_nakwebproductsclassimageupload_main_list_image'] != "") {
                    $this->arrShipping[$shipping_num]['shipment_item'][$products_num]['productsClass']['main_list_image'] = $p_val['productsClass']['plg_nakwebproductsclassimageupload_main_list_image'];
                }
                if($p_val['productsClass']['plg_nakwebproductsclassimageupload_main_image'] != "") {
                    $this->arrShipping[$shipping_num]['shipment_item'][$products_num]['productsClass']['main_image'] = $p_val['productsClass']['plg_nakwebproductsclassimageupload_main_image'];
                }
            }
        }

    }



}
