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

?>
<div class="item-wrap ajaxtabs-item">	
	
	<?php 

		$img = SjK2AjaxTabsHelper::getK2Image($item, $params);					
		$img = ImageHelper::init($img)->src();							
		
		//$img = (strpos($img,'http://') !== false || strpos($img,'https://') !== false)?$img:(JURI::root().$img);

		if((is_file($img) && file_exists($img)) || SjK2AjaxTabsHelper::isUrl($img)){
			 ?>
			
			<div class="item-image">
				<a href="<?php echo $item->link ?>" <?php echo SjK2AjaxTabsHelper::parseTarget($params->get('item_link_target'))?> title="<?php echo $item->displaytitle?>" >
					<img alt="<?php echo $item->displaytitle;?>" src="<?php echo $img;?>"/>	
				</a>
			</div>
	<?php }?>
	
	
	<?php if($item->displaytitle != '') { ?>
		<div class="item-title">
			<a href="<?php echo $item->link ?>" <?php echo SjK2AjaxTabsHelper::parseTarget($params->get('item_link_target'));?> title="<?php echo $item->displaytitle?>" >
				<?php echo $item->displaytitle;?>
			</a>
		</div>
	<?php }?>
				
	
	
	<?php if($item->displayIntrotext != '') { ?>
		<div class="item-description">
			<?php echo $item->displayIntrotext; ?>
		</div>
	<?php }
	
	// show tags
	
	if($item->tags !=''){?>
		<div class="item-tags">
			<?php foreach ($item->tags as $tag): ?>
			<span class="tag-<?php echo $tag->id; ?>">
				<a class="label label-info" href="<?php echo $tag->link; ?>" title="<?php echo $tag->name; ?>" target="_blank"><?php echo $tag->name; ?></a>
			</span>
			<?php endforeach; ?>
		 </div>					
	<?php }	?>	
	
	<?php if( (int)$params->get('item_readmore_display', 1) && ($params->get('item_readmore_text') !='')){ ?>
		<div class="item-readmore">
			<a href="<?php echo $item->link ?>" <?php echo SjK2AjaxTabsHelper::parseTarget($params->get('item_link_target'));?> title="<?php echo $item->displaytitle?>" >
				<?php echo $params->get('item_readmore_text'); ?>
			</a>
		</div>
	<?php } ?>
</div>