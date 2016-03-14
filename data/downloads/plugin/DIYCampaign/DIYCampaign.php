<?php
/*
 * DIYCampaign
 *
 * Copyright(c) 2009-2012 SUNATMARK CO.,LTD. All Rights Reserved.
 *
 * http://www.sunatmark.co.jp/
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


/* 
 * カテゴリ毎にコンテンツを設定する事ができます。
 */
class DIYCampaign extends SC_Plugin_Base {

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

        // DB判定を保存
        $is_db_mysql    = strcasecmp(DB_TYPE, "mysql") === 0;

        // 必要なテーブルの追加
        $objQuery   =& SC_Query_Ex::getSingletonInstance();

        $objQuery->begin();

        if ($is_db_mysql) {

            /* MySQL */

            // キャンペーンテーブル
            $sql        =<<<SQL
CREATE TABLE plg_diycampaign_campaigns (
     campaign_id serial
    ,page_id integer UNIQUE NOT NULL
    ,campaign_comment text
    ,layout_json text
    ,create_date timestamp DEFAULT CURRENT_TIMESTAMP
    ,update_date timestamp DEFAULT '0000-00-00 00:00:00'
    ,member_flg tinyint
    ,hidden_flg tinyint DEFAULT 1
);
SQL;
            $objQuery->query($sql);

            // 一時テーブル
            $sql        =<<<SQL
CREATE TABLE plg_diycampaign_campaigns_temp (
     campaign_id serial
    ,campaign_name text NOT NULL
    ,layout_json text
    ,create_date timestamp DEFAULT CURRENT_TIMESTAMP
    ,display_key varchar(255) UNIQUE NOT NULL
);
SQL;
            $objQuery->query($sql);
        } else {

            /* PostgreSQL */

            // キャンペーンテーブル
            $sql        =<<<SQL
CREATE TABLE plg_diycampaign_campaigns (
     campaign_id serial
    ,page_id integer UNIQUE NOT NULL
    ,campaign_comment text
    ,layout_json text
    ,create_date timestamp DEFAULT CURRENT_TIMESTAMP
    ,update_date timestamp DEFAULT CURRENT_TIMESTAMP
    ,member_flg smallint
    ,hidden_flg smallint DEFAULT 1
    ,primary key (campaign_id)
);
SQL;
            $objQuery->query($sql);

            // 一時テーブル
            $sql        =<<<SQL
CREATE TABLE plg_diycampaign_campaigns_temp (
     campaign_id serial
    ,campaign_name text NOT NULL
    ,layout_json text
    ,create_date timestamp DEFAULT CURRENT_TIMESTAMP
    ,display_key text UNIQUE NOT NULL
    ,primary key (campaign_id)
);
SQL;
            $objQuery->query($sql);
        }

        // パーツテーブル
        $sql        =<<<SQL
CREATE TABLE plg_diycampaign_parts (
     parts_user_id smallint
    ,parts_content text
    ,primary key (parts_user_id)
);
SQL;
        $objQuery->query($sql);

        // 必要なファイル群のコピー
        $arrCopiedFiles   = array(
            "logo.png"
           ,"campaign.php"
        );
        $from_dir  = PLUGIN_UPLOAD_REALDIR . $arrPlugin["plugin_code"] . "/";
        $to_dir  = PLUGIN_HTML_REALDIR . $arrPlugin["plugin_code"] . "/";
        foreach ($arrCopiedFiles as $filename) {
            if (copy($from_dir . $filename, $to_dir . $filename) === false) {
                SC_Utils_Ex::sfDispSiteError(FREE_ERROR_MSG, "", false, "{$filename} のコピーに失敗しました。{$to_dir} のパーミッションをご確認ください。");
            }
        }

        $arrCopiedFiles   = array(
            "plg_DIYCampaign.php"
           ,"plg_DIYCampaign_Edit.php"
        );
        $from_dir   = PLUGIN_UPLOAD_REALDIR . $arrPlugin["plugin_code"] . "/admin/contents/";
        $to_dir     = HTML_REALDIR . ADMIN_DIR . "contents/";
        foreach ($arrCopiedFiles as $filename) {
            if (copy($from_dir . $filename, $to_dir . $filename) === false) {
                SC_Utils_Ex::sfDispSiteError(FREE_ERROR_MSG, "", false, "{$filename} のコピーに失敗しました。{$to_dir} のパーミッションをご確認ください。");
            }
        }

        if (SC_Utils_Ex::sfCopyDir(PLUGIN_UPLOAD_REALDIR . $arrPlugin["plugin_code"] . "/media/", PLUGIN_HTML_REALDIR . $arrPlugin["plugin_code"] . "/media/") === false) {
            SC_Utils_Ex::sfDispSiteError(FREE_ERROR_MSG, "", false, "/media/フォルダのコピーに失敗しました。");
        }

        // テンプレートディレクトリがなければ作成する。作れなければエラー
        $template_dir   = TEMPLATE_REALDIR . USER_DIR;
        if (!is_writable($template_dir) && !mkdir($template_dir)) {
            SC_Utils_Ex::sfDispSiteError(FREE_ERROR_MSG, "", false, "ディレクトリ {$template_dir} が存在しないか、書き込みできません。同じ名前で、かつ同じ場所に、書き込み可能なディレクトリを作成してください。");
        }
        $objQuery->commit();
    }

    /**
     * 削除時に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function uninstall($arrPlugin) {

        // DB判定を保存
        $is_db_mysql    = strcasecmp(DB_TYPE, "mysql") === 0;

        // ファイルの削除
        $dirs   = array(
             TEMPLATE_REALDIR . USER_DIR
            ,HTML_REALDIR . ADMIN_DIR . "contents"
        );
        foreach ($dirs as $dirname) {
            if (is_writable($dirname)) {
                $dir    = dir($dirname);
                while (false !== ($file = $dir->read())) {
                    if (
                        strpos($file, "plg_DIYCampaign") === 0
                    ) {
                        unlink($dir->path . DIRECTORY_SEPARATOR . $file);
                    }
                }

                // 専用のディレクトリは削除する
                if ($dir->path == TEMPLATE_REALDIR . USER_DIR) {
                    rmdir($dir->path);
                }
                $dir->close();
            }
        }

        // 不要なデータの削除
        $objQuery   =& SC_Query_Ex::getSingletonInstance();

        $plg_diycampaign_campaigns_exists   = false;
        if ($is_db_mysql) {
            $tables = $objQuery->listTables();
            foreach ($tables as $table) {
                if (strpos($table, "plg_diycampaign_campaigns") === 0) {
                    $plg_diycampaign_campaigns_exists   = true;
                    break;
                }
            }
        } else {
            $plg_diycampaign_campaigns_exists   = $objQuery->exists("pg_class", "relkind = 'r' AND relname = 'plg_diycampaign_campaigns'");
        }

        if ($plg_diycampaign_campaigns_exists) {
            $objQuery->delete("dtb_pagelayout", "page_id IN (SELECT page_id FROM plg_diycampaign_campaigns)");
        }

        // 不要なテーブルの削除
        $tables = array(
             "plg_diycampaign_parts"
            ,"plg_diycampaign_campaigns_temp"
            ,"plg_diycampaign_campaigns"
            ,"plg_diycampaign_campaigns_campaign_id_seq"
        );
        if ($is_db_mysql) {
            foreach ($tables as $table) {
                $objQuery->query("DROP TABLE IF EXISTS {$table}");
            }
        } else {
            foreach ($tables as $table) {
                if ($objQuery->exists("pg_class", "relkind = 'r' AND relname = '{$table}'")) {
                    $objQuery->query("DROP TABLE {$table}");
                }
            }
        }
    }

    /**
     * 有効にした際に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function enable($arrPlugin) {
        // 特になし
    }

    /**
     * 無効にした際に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function disable($arrPlugin) {
        // 特になし
    }

    /**
     * 処理の介入箇所とコールバック関数を設定
     * registerはプラグインインスタンス生成時に実行されます
     *
     * @param SC_Helper_Plugin $objHelperPlugin
     * @return void
     */
    function register(SC_Helper_Plugin $objHelperPlugin) {
        $objHelperPlugin->addAction("prefilterTransform", array($this, "prefilterTransform"), $this->arrSelfInfo['priority']);
        $objHelperPlugin->addAction("outputfilterTransform", array($this, "outputfilterTransform"), $this->arrSelfInfo['priority']);
        $objHelperPlugin->setHeadNavi(PLUGIN_UPLOAD_REALDIR . $this->arrSelfInfo['plugin_code'] . "/templates/admin/header.tpl");
    }

    function outputfilterTransform(&$source, LC_Page_Ex $objPage) {
 
        // デザイン管理＞＊＞レイアウト設定 のプレビューボタンを消す
        switch ($objPage->tpl_mainpage) {
            case "design/index.tpl":
            case "design/main_edit.tpl":

                if (array_key_exists("page_id", $_GET)) {

                    $objQuery   =& SC_Query_Ex::getSingletonInstance();
                    $campaign   = $objQuery->getRow("campaign_id, page_id", "plg_diycampaign_campaigns", "page_id = ?", (array)$_GET["page_id"]);
                    $is_campaign_page   = array_key_exists("campaign_id", $campaign);

                    if ($objPage->tpl_mainpage == "design/index.tpl" && $is_campaign_page) {
                        $source = str_replace(
                            '<li><a class="btn-action" href="javascript:;" name=\'preview\' onclick="doPreview();"><span class="btn-prev">プレビュー</span></a></li>',
                            '<li><a href="/admin/contents/plg_DIYCampaign_Edit.php?campaign_id=' . $campaign["campaign_id"] . '">キャンペーン編集画面</a>にてプレビュー可能です</li>',
                            $source
                        );
                    }

                    if ($objPage->tpl_mainpage == "design/main_edit.tpl" && $is_campaign_page) {
                        $objTransform = new SC_Helper_Transform($source);
                        $objTransform->select("div.btn-area")->replaceElement('<div class="btn-area"><a href="/admin/contents/plg_DIYCampaign_Edit.php?campaign_id=' . $campaign["campaign_id"] . '">キャンペーン編集画面</a>にてご編集ください</div>');
                        $source = $objTransform->getHTML();
                    }
                }
                break;

            default:
        }
    }

    /**
     * prefilterコールバック関数
     * テンプレートの変更処理を行います.
     *
     * @param string &$source テンプレートのHTMLソース
     * @param LC_Page_Ex $objPage ページオブジェクト
     * @param string $filename テンプレートのファイル名
     * @return void
     */
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
        // SC_Helper_Transformのインスタンスを生成.
        $objTransform = new SC_Helper_Transform($source);

        // 呼び出し元テンプレートを判定します.
        switch($objPage->arrPageLayout["device_type_id"]){
            case DEVICE_TYPE_MOBILE: // モバイル
            case DEVICE_TYPE_SMARTPHONE: // スマホ
            case DEVICE_TYPE_PC: // PC
            case DEVICE_TYPE_ADMIN: // 管理画面
                break;

            default:
                // メニューのコンテンツ管理のところに登録
                if (strpos($filename, "admin/contents/subnavi.tpl") !== false) {
                    $template_dir = PLUGIN_UPLOAD_REALDIR . $this->arrSelfInfo["plugin_code"] . "/templates/admin/";
                    $objTransform->select("li#navi-contents-recommend")->insertAfter(file_get_contents($template_dir . "plg_DIYCampaign_snip_admin_contents_subnavi.tpl"));
                }
        }

        $source = $objTransform->getHTML();
    }
}

?>