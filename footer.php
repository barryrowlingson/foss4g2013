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
    </div><!-- end of #wrapper -->
    <?php responsive_wrapper_end(); // after wrapper hook ?>
</div><!-- end of #container -->
<?php responsive_container_end(); // after container hook ?>

<div id="footer" class="clearfix">

    <div id="footer-wrapper">
 
<div class="grid col-940" >
<h3>Sponsors</h3>
<?php

$levels = Conferencer::get_posts('sponsor_level');
foreach ($levels as $id => $level) {
  $levels[$id]->sponsors = array();
}
		
foreach (Conferencer::get_posts('sponsor') as $sponsor) {
  Conferencer::add_meta($sponsor);
  $levels[$sponsor->level]->sponsors[$sponsor->ID] = $sponsor;
}

foreach ($levels as $id => $level) {
  shuffle($levels[$id]->sponsors);
}
		
/* $title = apply_filters( */
/* 		       'widget_title', */
/* 		       empty($instance['title']) ? 'Sponsors' : $instance['title'], */
/* 		       $instance, */
/* 		       $this->id_base */
/* 		       ); */

foreach ($levels as $level) { 
  echo '<h4>'.$level->post_title.'</h4><ul>';
  foreach ($level->sponsors as $sponsor){ 
    $html = get_the_post_thumbnail(
				   $sponsor->ID,
				   array(75,75),
				   array(
					 'alt' => $sponsor->post_title,
					 'title' => $sponsor->post_title,
					 'style' => "display:inline"
					 )
				   );
    echo $html;
    //echo '<li>'.$sponsor->post_title.'</li>'; 
  }; 
  echo '</ul>';
};
?>
</div>
   
        <div class="grid col-940">
        
        <div class="grid col-540">
<h4>FOSS4G is an OSGeo Production</h4>
<div id="osgeo">FOSS4G is an OSGeo Conference</div>
<!-- end of col-540 -->
</div>
         
         <div class="grid col-380 fit">
         <?php $options = get_option('responsive_theme_options');
					
            // First let's check if any of this was set
		
                echo '<ul class="social-icons">';
					
                if (!empty($options['twitter_uid'])) echo '<li class="twitter-icon"><a href="' . $options['twitter_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/twitter-icon.png" width="24" height="24" alt="Twitter">'
                    .'</a></li>';

                if (!empty($options['facebook_uid'])) echo '<li class="facebook-icon"><a href="' . $options['facebook_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/facebook-icon.png" width="24" height="24" alt="Facebook">'
                    .'</a></li>';
  
                if (!empty($options['linkedin_uid'])) echo '<li class="linkedin-icon"><a href="' . $options['linkedin_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/linkedin-icon.png" width="24" height="24" alt="LinkedIn">'
                    .'</a></li>';
					
                if (!empty($options['youtube_uid'])) echo '<li class="youtube-icon"><a href="' . $options['youtube_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/youtube-icon.png" width="24" height="24" alt="YouTube">'
                    .'</a></li>';
					
                if (!empty($options['stumble_uid'])) echo '<li class="stumble-upon-icon"><a href="' . $options['stumble_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/stumble-upon-icon.png" width="24" height="24" alt="StumbleUpon">'
                    .'</a></li>';
					
                if (!empty($options['rss_uid'])) echo '<li class="rss-feed-icon"><a href="' . $options['rss_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/rss-feed-icon.png" width="24" height="24" alt="RSS Feed">'
                    .'</a></li>';
       
                if (!empty($options['google_plus_uid'])) echo '<li class="google-plus-icon"><a href="' . $options['google_plus_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/googleplus-icon.png" width="24" height="24" alt="Google Plus">'
                    .'</a></li>';
					
                if (!empty($options['instagram_uid'])) echo '<li class="instagram-icon"><a href="' . $options['instagram_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/instagram-icon.png" width="24" height="24" alt="Instagram">'
                    .'</a></li>';
					
                if (!empty($options['pinterest_uid'])) echo '<li class="pinterest-icon"><a href="' . $options['pinterest_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/pinterest-icon.png" width="24" height="24" alt="Pinterest">'
                    .'</a></li>';
					
                if (!empty($options['yelp_uid'])) echo '<li class="yelp-icon"><a href="' . $options['yelp_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/yelp-icon.png" width="24" height="24" alt="Yelp!">'
                    .'</a></li>';
					
                if (!empty($options['vimeo_uid'])) echo '<li class="vimeo-icon"><a href="' . $options['vimeo_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/vimeo-icon.png" width="24" height="24" alt="Vimeo">'
                    .'</a></li>';
					
                if (!empty($options['foursquare_uid'])) echo '<li class="foursquare-icon"><a href="' . $options['foursquare_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/foursquare-icon.png" width="24" height="24" alt="foursquare">'
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
            <a href="<?php echo esc_url(__('http://themeid.com/responsive-theme/','responsive')); ?>" title="<?php esc_attr_e('Responsive Theme', 'responsive'); ?>">
                    <?php printf('Responsive Theme'); ?></a>
            <?php esc_attr_e('powered by', 'responsive'); ?> <a href="<?php echo esc_url(__('http://wordpress.org/','responsive')); ?>" title="<?php esc_attr_e('WordPress', 'responsive'); ?>">
                    <?php printf('WordPress'); ?></a>
        </div><!-- end .powered -->
        
    </div><!-- end #footer-wrapper -->
    
</div><!-- end #footer -->

<?php wp_footer(); ?>
</body>
</html>
