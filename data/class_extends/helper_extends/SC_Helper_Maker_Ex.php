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

require_once CLASS_REALDIR . 'helper/SC_Helper_Maker.php';

/**
 * メーカーを管理するヘルパークラス(拡張).
 *
 * LC_Helper_Maker をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Helper
 * @author pineray
 * @version $Id:$
 */
class SC_Helper_Maker_Ex extends SC_Helper_Maker
{
    //put your code here

    /**
     * メーカー一覧の取得.
     *
     * @param  boolean $has_deleted 削除されたメーカーも含む場合 true; 初期値 false
     * @return array
     */
    public function getList($has_deleted = false)
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $col = 'maker_id, name,mk_img_url1,mk_img_url2,mk_site_url,mk_image';
        $where = '';
        if (!$has_deleted) {
            $where .= 'del_flg = 0';
        }
        $table = 'dtb_maker';
        $objQuery->setOrder('rank DESC');
        $arrRet = $objQuery->select($col, $table, $where);

        return $arrRet;
    }

}
