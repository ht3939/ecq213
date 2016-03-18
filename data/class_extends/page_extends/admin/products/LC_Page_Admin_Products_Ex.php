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

require_once CLASS_REALDIR . 'pages/admin/products/LC_Page_Admin_Products.php';

/**
 * 商品管理 のページクラス(拡張).
 *
 * LC_Page_Admin_Products をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Admin_Products_Ex extends LC_Page_Admin_Products
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
    }

    /**
     * 商品を検索する.
     *
     * @param  string     $where      検索条件の WHERE 句
     * @param  array      $arrValues  検索条件のパラメーター
     * @param  integer    $limit      表示件数
     * @param  integer    $offset     開始件数
     * @param  string     $order      検索結果の並び順
     * @param  SC_Product $objProduct SC_Product インスタンス
     * @return array      商品の検索結果
     */
    public function findProducts($where, $arrValues, $limit, $offset, $order, &$objProduct)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        // 読み込む列とテーブルの指定
        $col = 'product_id, name, main_list_image, status, product_code_min, product_code_max, price02_min, price02_max, stock_min, stock_max, stock_unlimited_min, stock_unlimited_max, update_date,maker_name
        ,data_speed_down
        ,data_speed_up
        ,init_price
        ,y1_price
        ,y2_price
        ,cp_price
        ,adj_price
        ,total_price
        ,datasize
        ,rank1_order
        ,rank2_order
        ,rank3_order
        ,rank4_order
        ,rank5_order
        ';
        $from = $objProduct->alldtlSQL();

        $objQuery->setLimitOffset($limit, $offset);
        $objQuery->setOrder($order);

        return $objQuery->select($col, $from, $where, $arrValues);
    }    
}
