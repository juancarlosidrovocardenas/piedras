<?php
defined('_JEXEC') or die('Restricted access');
$doc->addStyleSheet(JUri::base() . 'templates/system/css/system.css', $type = 'text/css');
if($websitewidth=="970px") { $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/fixwidth.css', $type = 'text/css'); }
if($websitewidth=="1060px") { $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/fixwidth2.css', $type = 'text/css'); }
if($websitewidth=="1240px") { $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/fixwidth3.css', $type = 'text/css'); }
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/bootstrap.js', 'text/javascript');
?>