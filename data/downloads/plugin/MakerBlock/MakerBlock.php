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

/**
 * プラグインのメインクラス
 *
 * @package NewItems
 * @author BLUE STYLE
 * @version $Id: $
 */
class MakerBlock extends SC_Plugin_Base {

    /**
     * コンストラクタ
     * プラグイン情報(dtb_plugin)をメンバ変数をセットします.
     * @param array $arrSelfInfo dtb_pluginの情報配列
     * @return void
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }

    /**
     * インストール時に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function install($arrPlugin) {

        // プラグイン
        if(copy(PLUGIN_UPLOAD_REALDIR . "MakerBlock/logo.png", PLUGIN_HTML_REALDIR . "MakerBlock/logo.png") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "MakerBlock/MakerBlock.php", PLUGIN_HTML_REALDIR . "MakerBlock/MakerBlock.php") === false);

        // ブロック
        if(copy(PLUGIN_UPLOAD_REALDIR . "MakerBlock/templates/default/maker.tpl", TEMPLATE_REALDIR . "frontparts/bloc/maker.tpl") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "MakerBlock/templates/mobile/maker.tpl", SMARTY_TEMPLATES_REALDIR . MOBILE_TEMPLATE_NAME ."/frontparts/bloc/maker.tpl") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "MakerBlock/templates/sphone/maker.tpl", SMARTY_TEMPLATES_REALDIR . SMARTPHONE_DEFAULT_TEMPLATE_NAME . "/frontparts/bloc/maker.tpl") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "MakerBlock/bloc/maker.php", HTML_REALDIR . "frontparts/bloc/maker.php") === false);

        if(mkdir(PLUGIN_HTML_REALDIR . "MakerBlock/media") === false);
        SC_Utils_Ex::sfCopyDir(PLUGIN_UPLOAD_REALDIR . "MakerBlock/media/", PLUGIN_HTML_REALDIR . "MakerBlock/media/");

    }

    /**
     * アンインストール
     * uninstallはアンインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function uninstall($arrPlugin) {

        if(SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR . "MakerBlock/media") === false);
        if(SC_Helper_FileManager_Ex::deleteFile(HTML_REALDIR  . "frontparts/bloc/maker.php") === false);
        if(SC_Helper_FileManager_Ex::deleteFile(TEMPLATE_REALDIR . "frontparts/bloc/maker.tpl") === false);
        if(SC_Helper_FileManager_Ex::deleteFile(SMARTY_TEMPLATES_REALDIR . MOBILE_TEMPLATE_NAME . "/frontparts/bloc/maker.tpl") === false);
        if(SC_Helper_FileManager_Ex::deleteFile(SMARTY_TEMPLATES_REALDIR . SMARTPHONE_DEFAULT_TEMPLATE_NAME . "/frontparts/bloc/maker.tpl") === false);
        if(SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR . "MakerBlock") === false);

    }
    
    
    /**
     * 稼働
     * enableはプラグインを有効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function enable($arrPlugin) {

        // ブロック登録
        MakerBlock::insertBloc($arrPlugin);

    }

    /**
     * 停止
     * disableはプラグインを無効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function disable($arrPlugin) {

        // ブロック削除
        MakerBlock::deleteBloc($arrPlugin);

    }

    // プラグイン独自の設定データを追加
    function insertBloc($arrPlugin) {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        // PCにdtb_blocにブロックを追加する.
        $sqlval_bloc = array();
        $sqlval_bloc['device_type_id'] = DEVICE_TYPE_PC;
        $sqlval_bloc['bloc_id'] = $objQuery->max('bloc_id', "dtb_bloc", "device_type_id = " . DEVICE_TYPE_PC) + 1;
        $sqlval_bloc['bloc_name'] = $arrPlugin['plugin_name'];
        $sqlval_bloc['tpl_path'] = "maker.tpl";
        $sqlval_bloc['filename'] = "maker";
        $sqlval_bloc['create_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['update_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['php_path'] = "frontparts/bloc/maker.php";
        $sqlval_bloc['deletable_flg'] = 0;
        $sqlval_bloc['plugin_id'] = $arrPlugin['plugin_id'];
        $objQuery->insert("dtb_bloc", $sqlval_bloc);

        // モバイルdtb_blocにブロックを追加する.
        $sqlval_bloc = array();
        $sqlval_bloc['device_type_id'] = DEVICE_TYPE_MOBILE;
        $sqlval_bloc['bloc_id'] = $objQuery->max('bloc_id', "dtb_bloc", "device_type_id = " . DEVICE_TYPE_MOBILE) + 1;
        $sqlval_bloc['bloc_name'] = $arrPlugin['plugin_name'];
        $sqlval_bloc['tpl_path'] = "maker.tpl";
        $sqlval_bloc['filename'] = "maker";
        $sqlval_bloc['create_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['update_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['php_path'] = "frontparts/bloc/maker.php";
        $sqlval_bloc['deletable_flg'] = 0;
        $sqlval_bloc['plugin_id'] = $arrPlugin['plugin_id'];
        $objQuery->insert("dtb_bloc", $sqlval_bloc);

        // スマートフォンdtb_blocにブロックを追加する.
        $sqlval_bloc = array();
        $sqlval_bloc['device_type_id'] = DEVICE_TYPE_SMARTPHONE;
        $sqlval_bloc['bloc_id'] = $objQuery->max('bloc_id', "dtb_bloc", "device_type_id = " . DEVICE_TYPE_SMARTPHONE) + 1;
        $sqlval_bloc['bloc_name'] = $arrPlugin['plugin_name'];
        $sqlval_bloc['tpl_path'] = "maker.tpl";
        $sqlval_bloc['filename'] = "maker";
        $sqlval_bloc['create_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['update_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['php_path'] = "frontparts/bloc/maker.php";
        $sqlval_bloc['deletable_flg'] = 0;
        $sqlval_bloc['plugin_id'] = $arrPlugin['plugin_id'];
        $objQuery->insert("dtb_bloc", $sqlval_bloc);

    }

    function deleteBloc($arrPlugin) {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $arrBlocId = $objQuery->getCol('bloc_id', "dtb_bloc", "device_type_id = ? AND filename = ?", array(DEVICE_TYPE_PC , "maker"));
        $bloc_id = (int) $arrBlocId[0];
        // ブロックを削除する.（PC）
        $where = "bloc_id = ? AND device_type_id = ?";
        $objQuery->delete("dtb_bloc", $where, array($bloc_id,DEVICE_TYPE_PC));
        $objQuery->delete("dtb_blocposition", $where, array($bloc_id,DEVICE_TYPE_PC));

        $arrBlocId = $objQuery->getCol('bloc_id', "dtb_bloc", "device_type_id = ? AND filename = ?", array(DEVICE_TYPE_MOBILE , "maker"));
        $bloc_id = (int) $arrBlocId[0];
        // ブロックを削除する.（モバイル）
        $where = "bloc_id = ? AND device_type_id = ?";
        $objQuery->delete("dtb_bloc", $where, array($bloc_id,DEVICE_TYPE_MOBILE));
        $objQuery->delete("dtb_blocposition", $where, array($bloc_id,DEVICE_TYPE_MOBILE));

        $arrBlocId = $objQuery->getCol('bloc_id', "dtb_bloc", "device_type_id = ? AND filename = ?", array(DEVICE_TYPE_SMARTPHONE , "maker"));
        $bloc_id = (int) $arrBlocId[0];
        // ブロックを削除する.（スマートフォン）
        $where = "bloc_id = ? AND device_type_id = ?";
        $objQuery->delete("dtb_bloc", $where, array($bloc_id,DEVICE_TYPE_SMARTPHONE));
        $objQuery->delete("dtb_blocposition", $where, array($bloc_id,DEVICE_TYPE_SMARTPHONE));
    }
}

?>
