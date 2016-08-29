<?php
/*
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2013 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/
// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );


/****************************
*  Google Font & Body Font
****************************/

// Function YT Font
function ytfont($font, $selectors){
	$doc = JFactory::getDocument();
	if (trim($font)!='0' ){
		if (strpos($font, ',') ) {
			$doc->addStyleDeclaration($selectors.'{font-family:'.$font.'}');
		}else{
			$doc->addStyleSheet('http://fonts.googleapis.com/css?family='.$font);
			$font = str_replace("+"," ",(explode(':',$font)));
			$fontweight = isset($font[1]) ? $font[1] : null;;
			$fontitalic = strpos($fontweight, "italic");
			
			if ($fontitalic == true) {
				$fontweight_italic = substr($fontweight,0,$fontitalic );
				$doc->addStyleDeclaration($selectors.'{font-style:italic;font-weight:'.$fontweight_italic.'}');
			}
			if(trim($selectors)!=""){
				$doc->addStyleDeclaration($selectors.'{font-family:'.$font[0].';font-weight:'.$fontweight.'}');
			}
			
		}
	}
}

// Global Font & Menu Font & Heading Font & Other Font
ytfont($bodyFont,$bodySelectors);
ytfont($menuFont,$menuSelectors);
ytfont($headingFont,$headingSelectors);
ytfont($otherFont,$otherSelectors);

// Show Sidebar Menu Desktop
?>



<?php if($yt->getParam('typelayout') == 'boxed') {?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		/* Begin: add class pattern for element */
		var bodybgimage = '<?php echo $yt->getParam('bgimage');?>';
		if(bodybgimage) $('#bd').addClass(bodybgimage);
		
	});
</script>
<?php }; ?>

<?php
// Include cpanel
if($showCpanel) {
	include_once (J_TEMPLATEDIR.J_SEPARATOR.'includes'.J_SEPARATOR.'cpanel.php');
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		
		<?php if($yt->getParam('typelayout') == 'boxed') {?>
			patternClick('.body-bg .pattern', 'bgimage', Array('#bd'));
		<?php } ?>
		
		var array 				= Array('bgimage');
		var array_blue          = Array('pattern8');
		var array_red 	        = Array('pattern8');
		var array_green 	    = Array('pattern8');
		var array_chartreuse 	    = Array('pattern8');
		var array_pink	    = Array('pattern8');
		var array_purple 	    = Array('pattern8');
		var array_brown 	    = Array('pattern8');
		var array_oranges 	    = Array('pattern8');
		
		
		//1.Color Blue
		$('.theme-color.blue').click(function(){
			$($(this).parent().find('.active')).removeClass('active'); $(this).addClass('active');
			createCookie(TMPL_NAME+'_'+'themecolor', $(this).html().toLowerCase(), 365);
			setCpanelValues(array_blue);
			onCPApply();
		});
		
		//2.Color Red
		$('.theme-color.red').click(function(){
			$($(this).parent().find('.active')).removeClass('active'); $(this).addClass('active');
			createCookie(TMPL_NAME+'_'+'themecolor', $(this).html().toLowerCase(), 365);
			setCpanelValues(array_red);
			onCPApply();
		});
		
		//3.Color Green
		$('.theme-color.green').click(function(){
			$($(this).parent().find('.active')).removeClass('active'); $(this).addClass('active');
			createCookie(TMPL_NAME+'_'+'themecolor', $(this).html().toLowerCase(), 365);
			setCpanelValues(array_green);
			onCPApply();
		});
		
		//4.Color Chartreuse
		$('.theme-color.chartreuse').click(function(){
			$($(this).parent().find('.active')).removeClass('active'); $(this).addClass('active');
			createCookie(TMPL_NAME+'_'+'themecolor', $(this).html().toLowerCase(), 365);
			setCpanelValues(array_chartreuse);
			onCPApply();
		});
		
		//5.Color Pink
		$('.theme-color.pink').click(function(){
			$($(this).parent().find('.active')).removeClass('active'); $(this).addClass('active');
			createCookie(TMPL_NAME+'_'+'themecolor', $(this).html().toLowerCase(), 365);
			setCpanelValues(array_pink);
			onCPApply();
		});
		
		//6.Color Purple
		$('.theme-color.purple').click(function(){
			$($(this).parent().find('.active')).removeClass('active'); $(this).addClass('active');
			createCookie(TMPL_NAME+'_'+'themecolor', $(this).html().toLowerCase(), 365);
			setCpanelValues(array_purple);
			onCPApply();
		});
		//7.Color Brown
		$('.theme-color.brown').click(function(){
			$($(this).parent().find('.active')).removeClass('active'); $(this).addClass('active');
			createCookie(TMPL_NAME+'_'+'themecolor', $(this).html().toLowerCase(), 365);
			setCpanelValues(array_brown);
			onCPApply();
		});
		//8.Color Oranges
		$('.theme-color.oranges').click(function(){
			$($(this).parent().find('.active')).removeClass('active'); $(this).addClass('active');
			createCookie(TMPL_NAME+'_'+'themecolor', $(this).html().toLowerCase(), 365);
			setCpanelValues(array_oranges);
			onCPApply();
		});
						   
		
		
		/* miniColorsCPanel */
		function miniColorsCPanel(elC, elT, selector){
			$(elC).miniColors({
				change: function(hex, rgb) {
					if(typeof(elT)!='string'){
						for(i=0;i<elT.length;i++){
							$(elT[i]).css(selector, hex);
						}
					}else{
						$(elT).css(selector, hex); 
					}
					createCookie(TMPL_NAME+'_'+($(this).attr('name').match(/^ytcpanel_(.*)$/))[1], hex, 365);
				}
			});
		}
		/* Begin: Set click pattern */
		function patternClick(elC, paramCookie, elT){
			$(elC).click(function(){
				oldvalue = $(this).parent().find('.active').html();
				$(elC).removeClass('active');
				$(this).addClass('active');
				value = $(this).html();
				if(elT.length > 0){
					for($i=0; $i < elT.length; $i++){
						$(elT[$i]).removeClass(oldvalue);
						$(elT[$i]).addClass(value);
					}
				}
				if(paramCookie){
					$('input[name$="ytcpanel_'+paramCookie+'"]').attr('value', value);
					createCookie(TMPL_NAME+'_'+paramCookie, value, 365);
				}
			});
		}
		function setCpanelValues(array){
			
			if(array['0']){
				$('.body-backgroud-image .pattern').removeClass('active');
				$('.body-backgroud-image .pattern.'+array['3']).addClass('active');
				$('input[name$="ytcpanel_bgimage"]').attr('value', array['3']);
			}
			
		}
	});
	</script>
	<?php
}
 ?>
	



