<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.2
 * @filesource     wp-content/themes/responsive/header.php
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_enqueue_style('responsive-style', get_stylesheet_uri(), false, '1.7.9');?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
                 
<?php responsive_container(); // before container hook ?>
<div id="container" class="hfeed">
         
    <?php responsive_header(); // before header hook ?>
    <div id="header">
    
        <?php if (has_nav_menu('top-menu', 'responsive')) { ?>
	        <?php wp_nav_menu(array(
				    'container'       => '',
					'fallback_cb'	  =>  false,
					'menu_class'      => 'top-menu',
					'theme_location'  => 'top-menu')
					); 
				?>
        <?php } ?>
        
    <?php responsive_in_header(); // header hook ?>
   
   <?php get_sidebar('top'); ?>
				<?php wp_nav_menu(array(
				    'container'       => '',
					'theme_location'  => 'header-menu')
					); 
				?>
            <?php if (has_nav_menu('sub-header-menu', 'responsive')) { ?>
	            <?php wp_nav_menu(array(
				    'container'       => '',
					'menu_class'      => 'sub-header-menu',
					'theme_location'  => 'sub-header-menu')
					); 
				?>
            <?php } ?>
            

   <img id="printlogo" src="<?php echo get_stylesheet_directory_uri().'/images/foss4g2013-trans-200.png'; ?>" />

        <a href="<?php echo get_home_url(); ?> "><div id="logo">
FOSS4G 2013 Nottingham
</div>
<div id="blurb">
<div id="blurbmain">Free and Open Source Software for Geospatial</div>
<div id="blurbsub">East Midlands Conference Centre, Nottingham, UK, 17th - 20th September</div>
</div></a>

    </div><!-- end of #header -->
    <?php responsive_header_end(); // after header hook ?>
    
	<?php responsive_wrapper(); // before wrapper ?>
    <div id="wrapper" class="clearfix">
    <?php responsive_in_wrapper(); // wrapper hook ?>
