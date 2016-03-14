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

require_once CLASS_EX_REALDIR . 'page_extends/cart/LC_Page_Cart_Ex.php';

/**
 * プラグインのメインクラス
 *
 * @package NakwebProductsClassImageUpload
 * @author NAKWEB CO.,LTD.
 * @version $1.0 Id: $ProductsClassImageUpload01:
 */
class plg_NakwebProductsClassImageUpload_LC_Page_Cart extends LC_Page_Cart_Ex
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

        // 商品規格画像を参照できるように変更を行う。
        foreach($this->cartItems as $b_key => $b_val) {
            foreach($b_val as $s_key => $val) {
                if($val['productsClass']['plg_nakwebproductsclassimageupload_main_image'] != "") {
                    $this->cartItems[$b_key][$s_key]['productsClass']['main_list_image'] = $val['productsClass']['plg_nakwebproductsclassimageupload_main_image'];
                }
            }
        }
    }

}
