<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//get copyright
$app = JFactory::getApplication();
$date		= JFactory::getDate();
$template = $app->getTemplate(true);
$params = $template->params;
$cur_year	= $date->format('Y');
$ytcopyright = $params->get('ytcopyright' );
$ytcopyright = str_replace('{year}', $cur_year, $ytcopyright);


//get language and direction
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
?>

<html  lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
		
	<link rel="stylesheet" href="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/css/error.css" type="text/css" />	
</head>
<body>
	
	
	<div class="wrapall">
		<div class="wrap-inner">
			<div class="contener">
				<div class="block-left">

				</div>
				<div class="block-main">
					<img class="img_404" src="<?php echo JURI::base() . 'templates/' . JFactory::getApplication()->getTemplate();?>/images/404/404.png" alt="" />
					
					<div class="second-block">
						<p class="title">
							<span class="title-text"><?php echo JText::_('JERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?></span><br />

						</p>
							<a class="btn" href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>">
								<?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?>
							</a>
<div class="clr"></div>
						<span><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?>.</span>
						<div id="techinfo">
						<span><?php echo $this->error->getMessage(); ?></span>
						<span>
							<?php if ($this->debug) :
								echo $this->renderBacktrace();
							endif; ?>
						</span>
						</div>
					<footer class="block-copyright" >						
				<div class="copyright"><?php echo $ytcopyright;?></div>
				<div class="designby">Designed by <a target="_blank" title="Visit SmartAddons!" href="http://www.smartaddons.com/">SmartAddons.Com</a></div>
				<div class="powered-by"><a href="http://www.joomla.org">Joomla!</a> is Free Software released under the <a href="http://www.gnu.org/licenses/gpl-2.0.html">GNU General Public License.</a></div>
			</footer>
					</div>

					
			</div>
			

		</div>
	</div>
		
</body>
</html>
