<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  Front Page
 *
 * @file           front-page.php
 * @package        foss4g2013
 * @author         Barry Rowlingson 
 */
?>
<?php get_header(); ?>

      <div id="contentbox" class="grid col-940">
        <div id="content-full">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<?php the_content(__('Read more &#8250;', 'responsive')); ?>
<?php endwhile; ?> 

<?php endif; ?>  

        </div><!-- end of #content-full -->
	</div><!-- end of contentbox -->

<div id="mybox" class="grid col-460 " style="background-color: red">
<p>This is my box</p>
<div id="inner1" class="grid col-460" style="background-color: yellow">
<img src="<?php echo get_stylesheet_directory_uri();?>/images/osgeologo.png" size="100%" />
<p>Here's 1</p>
</div>
<div id="inner2" class="grid col-460 fit" style="background-color: green">
<p>Here's another</p>
</div>
</div>
<div id="box2" class="grid col-460 fit" style="background-color: blue">
<p>Another box 2</p>
</div>

<?php get_footer(); ?>
