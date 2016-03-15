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

require_once CLASS_REALDIR . 'db/SC_DB_DBFactory.php';

/**
 * DBに依存した処理を抽象化するファクトリークラス(拡張).
 *
 * SC_DB_DBFactory をカスタマイズする場合はこのクラスを編集する.
 *
 * @package DB
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class SC_DB_DBFactory_Ex extends SC_DB_DBFactory
{
    /**
     * DB_TYPE に応じた DBFactory インスタンスを生成する.
     *
     * @param string $db_type 任意のインスタンスを返したい場合は DB_TYPE 文字列を指定
     * @return mixed DBFactory インスタンス
     */
    function getInstance($db_type = DB_TYPE)
    {
        switch ($db_type) {
            case 'mysql':
                return new SC_DB_DBFactory_MYSQL_Ex();

            case 'pgsql':
                return new SC_DB_DBFactory_PGSQL_Ex();

            default:
                return new SC_DB_DBFactory_Ex();
        }
    }

    /**
     * 商品詳細の SQL を取得する.
     *
     * @param  string $where_products_class 商品規格情報の WHERE 句
     * @return string 商品詳細の SQL
     */
    public function alldtlSQL($where_products_class = '')
    {
        if (!SC_Utils_Ex::isBlank($where_products_class)) {
            $where_products_class = 'AND (' . $where_products_class . ')';
        }
        /*
         * point_rate, deliv_fee は商品規格(dtb_products_class)ごとに保持しているが,
         * 商品(dtb_products)ごとの設定なので MAX のみを取得する.
         */
        $sql = <<< __EOS__
            (
                SELECT
                     dtb_products.*
                    ,T4.product_code_min
                    ,T4.product_code_max
                    ,T4.price01_min
                    ,T4.price01_max
                    ,T4.price02_min
                    ,T4.price02_max
                    ,T4.stock_min
                    ,T4.stock_max
                    ,T4.stock_unlimited_min
                    ,T4.stock_unlimited_max
                    ,T4.point_rate
                    ,T4.deliv_fee
                    ,dtb_maker.name AS maker_name
                FROM dtb_products
                    INNER JOIN (
                        SELECT product_id
                            ,MIN(product_code) AS product_code_min
                            ,MAX(product_code) AS product_code_max
                            ,MIN(price01) AS price01_min
                            ,MAX(price01) AS price01_max
                            ,MIN(price02) AS price02_min
                            ,MAX(price02) AS price02_max
                            ,MIN(stock) AS stock_min
                            ,MAX(stock) AS stock_max
                            ,MIN(stock_unlimited) AS stock_unlimited_min
                            ,MAX(stock_unlimited) AS stock_unlimited_max
                            ,MAX(point_rate) AS point_rate
                            ,MAX(deliv_fee) AS deliv_fee
                        FROM dtb_products_class
                        WHERE del_flg = 0 $where_products_class
                        GROUP BY product_id
                    ) AS T4
                        ON dtb_products.product_id = T4.product_id
                    LEFT JOIN dtb_maker
                        ON dtb_products.maker_id = dtb_maker.maker_id
            ) AS alldtl
__EOS__;

        return $sql;
    }
}
