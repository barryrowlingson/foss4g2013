<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Error 404 Template
 *
 *
 * @file           404.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/404.php
 * @link           http://codex.wordpress.org/Creating_an_Error_404_Page
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

        <div id="contentbox" class="grid col-940">
         <div id="content">
            <div id="post-0" class="error404">
                <div class="post-entry">
                    <h1 class="title-404"><?php _e('Page not found', 'responsive'); ?></h1>
		    <p><?php _e( 'Go back to the ', 'responsive' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'responsive' ); ?>"><?php _e( 'Home Page', 'responsive' ); ?></a>, use the menu, <?php _e( 'or search for the page you were looking for.', 'responsive' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- end of .post-entry -->
            </div><!-- end of #post-0 -->
        </div><!-- end of #content-full -->
  </div>
<?php get_footer(); ?>
