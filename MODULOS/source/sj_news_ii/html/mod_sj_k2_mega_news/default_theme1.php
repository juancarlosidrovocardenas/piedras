<?php
/**
 * @package SJ Mega News for K2
 * @version 3.1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined('_JEXEC') or die;
?>
<?php
$item0 = array_shift($_items);
$other_items = $_items;
	$first_image_config = array(
								'type' => $params->get('imgcfgfirst_type'),
								'width' => $params->get('imgcfgfirst_width'),
								'height' => $params->get('imgcfgfirst_height'),
								'quality' => 90,
								'function' => ($params->get('imgcfgfirst_function') == 'none') ? null : 'resize',
								'function_mode' => ($params->get('imgcfgfirst_function') == 'none') ? null : substr($params->get('imgcfgfirst_function'), 7),
								'transparency' => $params->get('imgcfgfirst_transparency', 1) ? true : false,
								'background' => $params->get('imgcfgfirst_background'));
?>
	<div class="item-first">
		<div class="item-wrap">
		
		<?php
		$img0 = K2MegaNewsHelper::getK2Image($item0, $params);
		if ($img0) {
			?>
			<div class="item-image">
				<a href="<?php echo $item0->link;?>"
				   title="<?php echo $item0->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
					<?php echo K2MegaNewsHelper::imageTag($img0,$first_image_config);?>
				</a>
			</div>
		<?php } ?>
		<div class="item-custom">

		<?php if ($params->get('item_title_display') == 1) { ?>
			<div class="item-category">
				<a href="<?php echo $item0->cat_link; ?>"
				   title="<?php echo $item0->categoryname; ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  ><span class="item-category-name"><?php echo $item0->categoryname; ?></span>

				</a>
				<?php if ($item0->video) echo '<i class="fa fa-play"></i>'; else echo '<i class="fa fa-image"></i>'; ?>
			</div>

			<div class="item-title">
				<a href="<?php echo $item0->link; ?>"
				   title="<?php echo $item0->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
					<?php echo K2MegaNewsHelper::truncate($item0->name, $params->get('item_title_max_characs')); ?>
				</a>
			</div>
			<div class="item-author"><?php echo JText::_('K2_AUTHOR_TEMPLATE'),' ' ?><span><?php echo $item0->author; ?></span></div>
			<div class="item-date"><?php  echo  JHTML::_('date', $item0->created,JText::_('DATE_FORMAT_TEMPLATE'));?></div>

		<?php
		} ?>

		<?php if ($options->item_desc_display == 1 && $item0->displayIntrotext != '') { ?>
			<div class="item-description">
				<?php echo $item0->displayIntrotext; ?>
			</div>
		<?php } ?>

		<?php if ($item0->tags != '' && !empty($item0->tags)) { ?>
			<div class="item-tags">
				<div class="tags">
					<?php $hd = -1;
					foreach ($item0->tags as $tag): $hd++; ?>
						<span class="tag-<?php echo $tag->id . ' tag-list' . $hd; ?>">
							<a class="label label-info" href="<?php echo $tag->link; ?>"
							   title="<?php echo $tag->name; ?>" target="_blank">
								<?php echo $tag->name; ?>
							</a>
						</span>
					<?php endforeach; ?>
				</div>
			</div>
		<?php } ?>

		<?php if ($params->get('item_readmore_display') == 1) { ?>
			<div class="item-readmore">
				<a href="<?php echo $item0->link; ?>"
				   title="<?php echo $item0->title; ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('item_link_target')); ?> >
					<?php echo $params->get('item_readmore_text'); ?>
				</a>
			</div>
		<?php } ?>
		</div>
		</div>
	</div> <!-- end intem-first -->
<?php if (!empty($other_items) && $params->get('item_more_display',1)) { ?>
	<div class="item-other">
		<div class="item-wrap">
		<ul class="other-link">
			<?php foreach ($other_items as $item) { ?>
				<li>
					<div class="item-wrap-inner">
					<?php
						$img = K2MegaNewsHelper::getK2Image($item, $params);
						if ($img) { ?>
					<div class="item-image">
						<a href="<?php echo $item->link; ?>" title="<?php echo $item->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
							<?php echo K2MegaNewsHelper::imageTag($img); ?>
						</a>
					</div>
					<?php } ?>
					<div class="item-custom">
						<?php if ($params->get('item_title_display') == 1) { ?>
					<div class="item-category">
						<a href="<?php echo $item->cat_link; ?>" title="<?php echo $item->categoryname; ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
							<span class="item-category-name"><?php echo $item->categoryname; ?></span>
						</a>
						<?php if ($item->video) echo '<i class="fa fa-play"></i>'; else echo '<i class="fa fa-image"></i>'; ?>
					</div>
					<div class="item-title">
						<a href="<?php echo $item->link; ?>" title="<?php echo $item->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
							<?php echo $item->name; ?>
						</a>
						<div class="item-author"><?php echo JText::_('K2_AUTHOR_TEMPLATE'),' ' ?><span><?php echo $item0->author; ?></span></div>
						<div class="item-date"><?php  echo  JHTML::_('date', $item->created,JText::_('DATE_FORMAT_TEMPLATE'));?></div>
					</div>
						<?php } ?>
					<?php if ($options->item_desc_display == 1) { ?>
						<div class="item-description">
							<?php echo K2MegaNewsHelper::truncate($item->displayIntrotext, 40,''); ?>
						</div>
					<?php } ?>
					</div>
					</div>
				</li>
			<?php } ?>
		</ul>
		</div>
	</div>
<?php
}
if ((int)$params->get('item_viewall_display', 1)) {
	?>
	<div class="meganew-viewall">
		<a href="<?php echo $items->link; ?>"
		   title="<?php echo $items->name; ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?> >
			<?php echo $params->get('item_viewall_text', 'View') . ' ' . $items->name; ?>
		</a>
	</div>
<?php } ?>