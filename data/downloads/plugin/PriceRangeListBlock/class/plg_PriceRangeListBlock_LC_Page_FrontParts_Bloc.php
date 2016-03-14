<?php
/*
 * PriceRangeListBlock
 * Copyright(c) C-Rowl Co., Ltd. All Rights Reserved.
 * http://www.c-rowl.com/
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

// {{{ requires
require_once CLASS_REALDIR . 'pages/frontparts/bloc/LC_Page_FrontParts_Bloc.php';

/**
 * 価格帯一覧ブロック
 *
 * @author C-Rowl Co., Ltd.
 */
class plg_PriceRangeListBlock_LC_Page_FrontParts_Bloc extends LC_Page_FrontParts_Bloc {

    /**
     * 初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
    }

    /**
     * プロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        // 一覧の取得
        $this->arrPriceRage = $this->lfDisp();

        // IDの正当性のチェック
        if ((!empty($_REQUEST['pr_id'])) && (!SC_Utils_Ex::sfIsInt(intval($_REQUEST['pr_id'])) )) {
            $_REQUEST['pr_id'] = ''; // 何も指定しない
        }

        // 一覧の時だけ
        switch($_SERVER['PHP_SELF']){
            case ROOT_URLPATH . 'products/list.php':
                $this->plg_pr_id = $_REQUEST['pr_id'];
                break;
            default:
        }

    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        if (method_exists('LC_Page','destroy')) {
            parent::destroy();
        }
    }

    /**
     * 情報表示.
     *
     * @return array $arrPriceRage 情報
     */
    function lfDisp() {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        $objQuery->setOrder('rank');
        $arrPriceRage = array();

        $arrPriceRage = $objQuery->select('*', 'plg_pricerangelistblock_price_range', $where);
        return $arrPriceRage;
    }

}
?>
