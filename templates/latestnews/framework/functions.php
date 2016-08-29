<?php
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$selectlogo = $this->params->get('selectlogo');
$responsive = $this->params->get('responsive');
$fontfamily = $this->params->get('fontfamily');
$websitewidth = $this->params->get('websitewidth');
$copyright = $this->params->get('copyright');
$sitetitle = $app->getCfg('sitename');
$user_count = ($this->countModules('user1')>0) + ($this->countModules('user2')>0) + ($this->countModules('user3')>0);
$user_width = $user_count > 0 ? 'user' . floor(99 / $user_count) : '';
$user2_count = ($this->countModules('user4')>0) + ($this->countModules('user5')>0) + ($this->countModules('user6')>0);
$user2_width = $user2_count > 0 ? 'user' . floor(99 / $user2_count) : '';
$user3_count = ($this->countModules('user7')>0) + ($this->countModules('user8')>0) + ($this->countModules('user9')>0);
$user3_width = $user3_count > 0 ? 'user' . floor(99 / $user3_count) : '';
$bottom_count = ($this->countModules('bottom1')>0) + ($this->countModules('bottom2')>0) + ($this->countModules('bottom3')>0) + ($this->countModules('bottom4')>0) + ($this->countModules('bottom5')>0);
$bottom_width = $bottom_count > 0 ? 'bottom' . floor(99 / $bottom_count) : '';
$footer_count = ($this->countModules('footer1')>0) + ($this->countModules('footer2')>0) + ($this->countModules('footer3')>0) + ($this->countModules('footer4')>0) + ($this->countModules('footer5')>0);
$footer_width = $footer_count > 0 ? 'footer' . floor(99 / $footer_count) : '';
function getColumns ($left, $right){
if($left && !$right) { $columns = "-left-only"; }
if($right && !$left) { $columns = "-right-only"; }
if($left && $right) { $columns = "-left-right"; }
if(!$left && !$right) { $columns = "-wide"; }
return $columns;
}
$columns = getColumns($this->countModules( 'left' ),$this->countModules( 'right' ));
unset($doc->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);
if($responsive=="yes") { include dirname(__FILE__).DIRECTORY_SEPARATOR.'responsive.php'; }
elseif($responsive=="no") { include dirname(__FILE__).DIRECTORY_SEPARATOR.'fixwidth.php'; }
function check_designer(){ $file = dirname(__FILE__).DIRECTORY_SEPARATOR.'copyframe.php';
$link = '<a href="http://www.joomlasaver.com" target="_blank" title="www.joomlasaver.com">';
$filedata = fopen($file,'r'); $check = fread($filedata,filesize($file)); fclose($filedata); if(strpos($check, $link)==0){
echo '<br><center>If you want to remove our link<br />please purchase this template at <a href="http://www.joomlasaver.com" target="_blank">JoomlaSaver</a></center>'; die; } } check_designer();
?>