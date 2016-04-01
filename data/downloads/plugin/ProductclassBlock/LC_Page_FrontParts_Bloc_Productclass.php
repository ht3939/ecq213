<?php
/*
 * MakerBlock
 * Copyright (C) 2013 BLUE STYLE All Rights Reserved.
 * http://bluestyle.jp/
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
 * メーカー のページクラス.
 *
 * @package Page
 * @author BLUE STYLE
 * @version $Id: $
 */
class LC_Page_FrontParts_Bloc_Productclass extends LC_Page_FrontParts_Bloc {

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $bloc_file = 'productclass.tpl';
        $this->setTplMainpage($bloc_file);
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {

    // 基本情報を渡す
    $objSiteInfo = SC_Helper_DB_Ex::sfGetBasisData();

        // メーカーの読込
        $this->arrProductclass = $this->lfGetProductclass();
    }


   /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        // parent::destroy();
    }

    function lfGetProductclass() {
        $objView = new SC_SiteView();
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objDb = new SC_Helper_DB_Ex();

        $col = '*';
        $from = 'dtb_classcategory ';
        $where = "del_flg <> 1";
        $objQuery->setorder("class_id,rank DESC");
        $this->arrProductclass = $objQuery->select($col, $from, $where);

        $objView->assignobj($this);
//var_dump($this->arrProductclass);

        $objSubView = new SC_SiteView(false);
        $objSubView->assignobj($this);
        $objSubView->display($this->tpl_mainpage);

    }

}
?>
