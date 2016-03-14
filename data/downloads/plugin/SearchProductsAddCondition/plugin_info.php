<?php
/*
 * SearchProductsAddCondition
 * @Copyright (C) 2014 aratana Inc. All Rights Reserved.
 * @link http://aratana.jp/
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
 * プラグイン情報
 *
 * @package SearchProductsAddCondition
 * @author aratana Inc.
 * @version $Id: $
 */
class plugin_info{
    static $PLUGIN_CODE       = 'SearchProductsAddCondition';
    static $PLUGIN_NAME       = 'かんたんに検索条件が増えるプラグイン';
    static $CLASS_NAME        = 'SearchProductsAddCondition';
    static $PLUGIN_VERSION    = '1.0.0';
    static $COMPLIANT_VERSION = '2.13.2';
    static $AUTHOR            = '株式会社アラタナ';
    static $DESCRIPTION       = '「欲しい商品、検索しても見つからないんですけど・・・」って言われる前にコレ！検索ブロックをグンっとパワーアップ出来ちゃうプラグイン。';
    static $PLUGIN_SITE_URL   = 'http://www.aratana.jp/';
    static $AUTHOR_SITE_URL   = 'http://www.aratana.jp/';
    static $HOOK_POINTS       =  array(
        array('prefilterTransform', 'prefilterTransform'),
        array('LC_Page_FrontParts_Bloc_SearchProducts_action_after', 'lfAddSearchProductsAddCondition'),
        array('LC_Page_Products_List_action_after', 'lfProcSearchProductsAddCondition')
    );
    static $LICENSE           = 'LGPL';
}