<?php
/*
 * @package Sj K2 Ajax Tabs
 * @version 3.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined('_JEXEC') or die;

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}


//check the exist of k2 component on the site?

if(file_exists(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php') && file_exists(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php')){

	require_once dirname( __FILE__ ).'/core/helper.php';

	$layout = $params->get('layout', 'default');
	$cacheid = md5(serialize(array ($layout, $module->id)));
	$cacheparams = new stdClass;
	$cacheparams->cachemode = 'id';
	$cacheparams->class = 'SjK2AjaxTabsHelper';
	$cacheparams->method = 'getList';
	$cacheparams->methodparams =array($params,$module);
	$cacheparams->modeparams = $cacheid;
	$list = JModuleHelper::moduleCache($module, $params, $cacheparams);

	if(!empty($list)) {
		$is_ajax_request = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
		$is_ajax_request = $is_ajax_request || JRequest::getInt('sj_module_k2ajax_request', 0);
		if($is_ajax_request) {
			$category_id	= JRequest::getVar('sj_k2category_id', null);
			$sj_module_id	= JRequest::getVar('sj_module_id', null);
			$sj_module		= JRequest::getVar('sj_module', null);

			if ($sj_module == $module->module && $sj_module_id==$module->id){
				$category_items = SjK2AjaxTabsHelper::getK2Items($category_id, $params);
				ob_start();
				include JModuleHelper::getLayoutPath($module->module, $layout.'_items');
				$ajax_respond = ob_get_contents();
				ob_end_clean();
				die($ajax_respond);
			}

		}else{
			require JModuleHelper::getLayoutPath($module->module, $params->get('position', $layout));
		}
	} else {
		echo JText::_('NO_CONTENT');
	}	

}else{
	echo JText::_('PLEASE_INSTALL_K2_COMPONENT_FIRST');
}