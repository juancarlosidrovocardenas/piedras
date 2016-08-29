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
jimport('joomla.filesystem.file');

require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php');

include_once dirname(__FILE__).'/helper_base.php';


abstract class SjK2AjaxTabsHelper extends SjK2AjaxTabsBaseHelper {

	public static function getList($params, $module)
	{
		
		$mainframe = JFactory::getApplication();	
		$catid_preload = $params->get('category_preload');
		$items = array();
		$cats = array();
		
		if ($params->get('catfilter')){
			$catids = $params->get('category_id', NULL);
		} else{
			$itemListModel = K2Model::getInstance('Itemlist', 'K2Model');
			$catids = $itemListModel->getCategoryTree(0);
		}
	
		if(!empty($catids)) {
		
			//remove the category with id = 0
			
			if($catids[0] == 0){
				array_shift($catids);		
			}
			
		/* 	$preload_cookie = $module->module . '_' . $module->id;
			if( JRequest::getInt($preload_cookie, -1, 'cookie') != -1){
				$preload_cookie_value = JRequest::getInt($preload_cookie, -1, 'cookie');
				if ( in_array($preload_cookie_value, $catids) ){
					$catid_loadfirst = $preload_cookie_value;
				}
			} else if(isset($catid_preload[0]) && in_array($catid_preload[0], $catids)) {
				$catid_loadfirst = (int)$catid_preload[0];
			} */
			
			if(isset($catid_preload[0]) && in_array($catid_preload[0], $catids)) {
				$catid_loadfirst = (int)$catid_preload[0];
			}else{
				$catid_loadfirst = $catids[0];
			}
		
		
			foreach($catids as $cid){
				$cats[0] = self::getCategoryInfo($cid);					
				$cats[1] = self::getK2Items($catid_loadfirst, $params);
				$items[$cid] = $cats;				
			}
			
			
		}
		
		return $items;
	}
	
	
	public static function getK2Items($cid, &$params)
	{
		
			$mainframe = JFactory::getApplication();
			$limit = $params->get('itemCount', 5);
			$ordering = $params->get('itemsOrdering', '');
			$componentParams = JComponentHelper::getParams('com_k2');

			$user = JFactory::getUser();
			$aid = $user->get('aid');
			$db = JFactory::getDBO();

			$jnow = JFactory::getDate();
			$now =  K2_JVERSION == '15'?$jnow->toMySQL():$jnow->toSql();
			$nullDate = $db->getNullDate();


			$query = "SELECT i.*, CASE WHEN i.modified = 0 THEN i.created ELSE i.modified END as lastChanged, c.name AS categoryname,c.id AS categoryid, c.alias AS categoryalias, c.params AS categoryparams";

			if ($ordering == 'best')
				$query .= ", (r.rating_sum/r.rating_count) AS rating";

			if ($ordering == 'comments')
				$query .= ", COUNT(comments.id) AS numOfComments";

			$query .= " FROM #__k2_items as i RIGHT JOIN #__k2_categories c ON c.id = i.catid";

			if ($ordering == 'best')
				$query .= " LEFT JOIN #__k2_rating r ON r.itemID = i.id";

			if ($ordering == 'comments')
				$query .= " LEFT JOIN #__k2_comments comments ON comments.itemID = i.id";

			if (K2_JVERSION != '15')
			{
				$query .= " WHERE i.published = 1 AND i.access IN(".implode(',', $user->getAuthorisedViewLevels()).") AND i.trash = 0 AND c.published = 1 AND c.access IN(".implode(',', $user->getAuthorisedViewLevels()).")  AND c.trash = 0";
			}
			else
			{
				$query .= " WHERE i.published = 1 AND i.access <= {$aid} AND i.trash = 0 AND c.published = 1 AND c.access <= {$aid} AND c.trash = 0";
			}

			$query .= " AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )";
			$query .= " AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )";

			if ($params->get('getChildren'))
			{
				$itemListModel = K2Model::getInstance('Itemlist', 'K2Model');
				$categories = $itemListModel->getCategoryTree($cid);
				$sql = @implode(',', $categories);
				$query .= " AND i.catid IN ({$sql})";
			}
			else
			{
				$query .= " AND i.catid=".(int)$cid;
			}

			if ($params->get('FeaturedItems') == '0')
				$query .= " AND i.featured != 1";

			if ($params->get('FeaturedItems') == '2')
				$query .= " AND i.featured = 1";

			if ($params->get('videosOnly'))
				$query .= " AND (i.video IS NOT NULL AND i.video!='')";

			if ($ordering == 'comments')
				$query .= " AND comments.published = 1";

			if (K2_JVERSION != '15')
			{
				if ($mainframe->getLanguageFilter())
				{
					$languageTag = JFactory::getLanguage()->getTag();
					$query .= " AND c.language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") AND i.language IN (".$db->Quote($languageTag).", ".$db->Quote('*').")";
				}
			}

			switch ($ordering)
			{

				case 'date' :
					$orderby = 'i.created ASC';
					break;

				case 'rdate' :
					$orderby = 'i.created DESC';
					break;

				case 'alpha' :
					$orderby = 'i.title';
					break;

				case 'ralpha' :
					$orderby = 'i.title DESC';
					break;

				case 'order' :
					if ($params->get('FeaturedItems') == '2')
						$orderby = 'i.featured_ordering';
					else
						$orderby = 'i.ordering';
					break;

				case 'rorder' :
					if ($params->get('FeaturedItems') == '2')
						$orderby = 'i.featured_ordering DESC';
					else
						$orderby = 'i.ordering DESC';
					break;

				case 'hits' :
					if ($params->get('popularityRange'))
					{
						$datenow = JFactory::getDate();
						$date =  K2_JVERSION == '15'?$datenow->toMySQL():$datenow->toSql();
						$query .= " AND i.created > DATE_SUB('{$date}',INTERVAL ".$params->get('popularityRange')." DAY) ";
					}
					$orderby = 'i.hits DESC';
					break;

				case 'rand' :
					$orderby = 'RAND()';
					break;

				case 'best' :
					$orderby = 'rating DESC';
					break;

				case 'comments' :
					if ($params->get('popularityRange'))
					{
						$datenow = JFactory::getDate();
						$date =  K2_JVERSION == '15'?$datenow->toMySQL():$datenow->toSql();
						$query .= " AND i.created > DATE_SUB('{$date}',INTERVAL ".$params->get('popularityRange')." DAY) ";
					}
					$query .= " GROUP BY i.id ";
					$orderby = 'numOfComments DESC';
					break;

				case 'modified' :
					$orderby = 'lastChanged DESC';
					break;

				case 'publishUp' :
					$orderby = 'i.publish_up DESC';
					break;

				default :
					$orderby = 'i.id DESC';
					break;
			}

			$query .= " ORDER BY ".$orderby;
			
			$db->setQuery($query, 0, $limit);
			$items = $db->loadObjectList();


			$model = K2Model::getInstance('Item', 'K2Model');
			$show_introtext = $params->get('item_desc_display', 0);		
			$introtext_limit = $params->get('item_desc_max_characs', 100);
			$show_title = $params->get('item_title_display', 1);
			$title_limit = $params->get('item_title_max_characs', 20);
			
			$item_title_ending_char = $params->get('item_title_ending_char', '');
			$item_desc_ending_char = $params->get('item_desc_ending_char', '');
			
		
			if (count($items))
			{

				foreach ($items as $item)
				{

					//Clean title
					$item->title = JFilterOutput::ampReplace($item->title);
					
					$item->displaytitle = $show_title ? self::truncate($item->title, $title_limit, $item_title_ending_char) : '';	
					
					//Read more link
					$item->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->categoryalias))));

					//Tags
					$item->tags = '';
					if ($params->get('item_tags_display'))
					{
						$tags = $model->getItemTags($item->id);
						for ($i = 0; $i < sizeof($tags); $i++)
						{
							$tags[$i]->link = JRoute::_(K2HelperRoute::getTagRoute($tags[$i]->name));
						}
						$item->tags = $tags;
					}else{
						$item->tags = '';
					}
					// Author
					$item->author = JFactory::getUser($item->created_by)->name;
					// Restore the intotext variable after plugins execution
					self::getK2Images($item, $params);
					//Clean the plugin tags
					$item->introtext = preg_replace("#{(.*?)}(.*?){/(.*?)}#s", '', $item->introtext);
					if($item->fulltext != ''){
						$item->fulltext = preg_replace("#{(.*?)}(.*?){/(.*?)}#s", '', $item->fulltext);
						$item->_introtext = self::_cleanText($item->introtext.$item->fulltext);
					}else{
						$item->_introtext = self::_cleanText($item->introtext);
					}	
					$item->displayIntrotext = $show_introtext ? self::truncate($item->_introtext, $introtext_limit, $item_desc_ending_char) : '';	
					$rows[] = $item;
				}
			return $rows;
		}

	}

}
