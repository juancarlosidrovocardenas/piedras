<?php defined('_JEXEC') or die('Restricted access');
$doc->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0' );
$doc->addStyleSheet(JUri::base() . 'templates/system/css/system.css', $type = 'text/css');
$doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/template.css', $type = 'text/css');
if($websitewidth=="1060px" OR $websitewidth=="1240px") { $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/expand1060.css', $type = 'text/css'); }
if($websitewidth=="1240px") { $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/expand1240.css', $type = 'text/css'); }
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/bootstrap.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/respond.min.js', 'text/javascript');
?>