<?php
/*
 * DIYCampaign
 *
 * Copyright(c) 2012 SUNATMARK CO.,LTD. All Rights Reserved.
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

// {{{ requires
require_once realpath(dirname(__FILE__)) . '/../../require.php';
require_once PLUGIN_UPLOAD_REALDIR . 'DIYCampaign/plg_DIYCampaign_LC_Page_Admin_Contents_Campaign_Edit.php';

// }}}
// {{{ generate page

$objPage = new plg_DIYCampaign_LC_Page_Admin_Contents_Campaign_Edit();
register_shutdown_function(array($objPage, "destroy"));
$objPage->init();
$objPage->process();
?>