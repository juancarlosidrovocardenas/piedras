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
?>
	<div class="item-first" style="width: <?php echo $params->get('imgcfg_width'); ?>px;">
		
		<?php
		$img = K2MegaNewsHelper::getK2Image($item0, $params);
		if ($img) {
			?>
			<div class="item-image">
				<a href="<?php echo $item0->link; ?>"
				   title="<?php echo $item0->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
					<?php echo K2MegaNewsHelper::imageTag($img); ?>
				</a>
			</div>
		<?php } ?>

		<?php if ($params->get('item_title_display') == 1) { ?>
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

	</div> <!-- end intem-first -->
<?php if (!empty($other_items) && $params->get('item_more_display',1)) { ?>
	<div class="item-other">
		<ul class="other-link">
			<?php foreach ($other_items as $item) { ?>
				<li>
					<a href="<?php echo $item->link; ?>"
					   title="<?php echo $item->name ?>" <?php echo K2MegaNewsHelper::parseTarget($params->get('link_target')); ?>  >
						<?php echo $item->name; ?>
					</a>
					<?php if ($options->item_desc_display == 1) { ?>
						<div class="item-description">
							<?php echo K2MegaNewsHelper::truncate($item->displayIntrotext, 40,''); ?>
						</div>
					<?php } ?>
				</li>
			<?php } ?>
		</ul>
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