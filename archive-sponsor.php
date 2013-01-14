<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Archive sponsor template
 *
 *
 * @file           archive-sponsor.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

<div id="contentbox" class="grid col-620">
<div id="content">
<h1>Our Sponsors</h1>
<?php 
echo sponsors_in(explode(",","Diamond,Platinum,Gold,Silver,Bronze,Supporter"),True);
?>
</div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
