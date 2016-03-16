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

require_once CLASS_REALDIR . 'SC_Product.php';

class SC_Product_Ex extends SC_Product
{

    /**
     * SC_Query インスタンスに設定された検索条件を使用して商品規格を取得する.
     *
     * @param  SC_Query $objQuery SC_Queryインスタンス
     * @param  array    $params   検索パラメーターの配列
     * @return array    商品規格の配列
     */
    public function getProductsClassByQuery(&$objQuery, $params)
    {
        // 末端の規格を取得
        $col = <<< __EOS__
            T1.product_id,
            T1.stock,
            T1.stock_unlimited,
            T1.sale_limit,
            T1.price01,
            T1.price02,
            T1.point_rate,
            T1.product_code,
            T1.product_class_id,
            T1.del_flg,
            T1.product_type_id,
            T1.down_filename,
            T1.down_realfilename,
            T3.name AS classcategory_name1,
            T3.rank AS rank1,
            T4.name AS class_name1,
            T4.class_id AS class_id1,
            T1.classcategory_id1,
            T1.classcategory_id2,
            T1.pc_url,
            T1.pc_color,

            dtb_classcategory2.name AS classcategory_name2,
            dtb_classcategory2.rank AS rank2,
            dtb_class2.name AS class_name2,
            dtb_class2.class_id AS class_id2
__EOS__;
        $table = <<< __EOS__
            dtb_products_class T1
            LEFT JOIN dtb_classcategory T3
                ON T1.classcategory_id1 = T3.classcategory_id
            LEFT JOIN dtb_class T4
                ON T3.class_id = T4.class_id
            LEFT JOIN dtb_classcategory dtb_classcategory2
                ON T1.classcategory_id2 = dtb_classcategory2.classcategory_id
            LEFT JOIN dtb_class dtb_class2
                ON dtb_classcategory2.class_id = dtb_class2.class_id
__EOS__;

        $objQuery->andWhere(' T3.classcategory_id is not null AND dtb_classcategory2.classcategory_id is not null ');
        $objQuery->setOrder('T3.rank DESC, dtb_classcategory2.rank DESC'); // XXX
        $arrRet = $objQuery->select($col, $table, '', $params);

        return $arrRet;
    }	
}
