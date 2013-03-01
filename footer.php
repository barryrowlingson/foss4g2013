<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.2
 * @filesource     wp-content/themes/responsive/footer.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */
?>
    </div> <!-- end of wrapper -->
    <?php responsive_wrapper_end(); // after wrapper hook ?>


<div id="footer" class="clearfix">

    <div id="footer-wrapper">
 
<div class="grid col-940" >
   <?php if ( !array_key_exists('isSponsorlist', $GLOBALS) ) {
 echo do_shortcode('[sponsorlistlevels levels=Diamond,Platinum,Gold,Silver,Bronze,Supporter widget=No]'); 
  };
?>
</div>

<div class="grid col-940">
   <?php if ( !array_key_exists('isSponsorlist', $GLOBALS) ) {
 echo do_shortcode('[sponsorlistlevels levels=Media widget=No heading="Media Partners"]'); 
  };
?>
</div>

   
        <div class="grid col-940">
        
        <div class="grid col-540">
<h4>FOSS4G is an OSGeo Production</h4>
<a href="http://www.osgeo.org"><div id="osgeo">FOSS4G is an OSGeo Conference</div></a>
<!-- end of col-540 -->
</div>
         
         <div class="grid col-380 fit">

         <?php $options = get_option('responsive_theme_options');
                                       
            // First let's check if any of this was set
               
                echo '<ul class="social-icons">';
                                       
                if (!empty($options['twitter_uid'])) echo '<li class="twitter-icon"><a href="' . $options['twitter_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/twitter-icon.png" width="24" height="24" alt="Twitter">'
                    .'</a></li>';

      if (!empty($options['linkedin_uid'])) echo '<li class="linkedin-icon"><a href="' . $options['linkedin_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/linkedin-icon.png" width="24" height="24" alt="LinkedIn">'
                    .'</a></li>';

                echo '</ul><!-- end of .social-icons -->';
         ?>



         </div><!-- end of col-380 fit -->
         
         </div><!-- end of col-940 -->
         <?php get_sidebar('colophon'); ?>
                
        <div class="grid col-300 copyright">
            <?php esc_attr_e('&copy;', 'responsive'); ?> <?php _e(date('Y')); ?><a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </div><!-- end of .copyright -->
        
        <div class="grid col-300 scroll-top"><a href="#scroll-top" title="<?php esc_attr_e( 'scroll to top', 'responsive' ); ?>"><?php _e( '&uarr;', 'responsive' ); ?></a></div>
        
        <div class="grid col-300 fit powered">
		  FOSS4G2013 Theme (based on 'Responsive') by Barry&nbsp;Rowlingson, Logo by Naomi&nbsp;Gale.
        </div><!-- end .powered -->
        
    </div><!-- end #footer-wrapper -->
    
</div><!-- end #footer -->

</div><!-- end of container -->
<?php responsive_container_end(); // after container hook ?>



<?php wp_footer(); ?>
</body>
</html>
