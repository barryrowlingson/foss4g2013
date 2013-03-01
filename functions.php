<?php
function image_shortcode($atts, $content = null) {
    extract( shortcode_atts( array(
    'name' => '',
    'align' => 'right',
    'ext' => 'png',
    'path' => '/wp-content/uploads/',
    'url' => ''
    ), $atts ) );
    $file=ABSPATH."$path$name.$ext";
    if (file_exists($file)) {
        $size=getimagesize($file);
        if ($size!==false) $size=$size[3];
        $output = "<img src='".get_option('siteurl')."$path$name.$ext' alt='$name' $size align='$align' class='align$align' />";
        if ($url) $output = "<a href='$url' title='$name'>".$output.'</a>';
        return $output;
    }
    else {
        trigger_error("'$path$name.$ext' image not found", E_USER_WARNING);
        return '';
    }
}
add_shortcode('image','image_shortcode');

function sponsorlist_shortcode($atts,$content=null){
  return sponsors_in(array("Platinum","Gold"));
}

function sponsorlist_levels($atts,$content=null){
  extract( shortcode_atts( array(
				 'levels' => 'Diamond,Platinum,Gold',
				 'widget' => 'Yes',
                                 'heading' => 'Sponsors',
				 ), $atts ) );
  $levels = explode(",",$levels);
  if($widget=="Yes"){
    $widget=True;
  }else{
    $widget=False;
  };
  return sponsors_in($levels,$widget,$heading);
}
add_shortcode("sponsorlistlevels","sponsorlist_levels");

function sponsors_in($levels,$widget,$heading){

  $tops = Foss4g::allsponsors();
  
  $output = "";
  if($widget){
    $output .= "<div class=\"sponsors\">";
  }else{
    $output .="<h4>".$heading."</h4>";
  };
  //$output .= "<div class=\"widget-title-home\"><h3>Sponsors</h3></div>";
  foreach ($levels as $level){
    $sponsorset = $tops[$level];
    if(count($sponsorset) > 0){
      if(count($sponsorset)>1){
	$word="sponsors";
      }else{
	$word="sponsor";
      }
      if($widget){
      $output .= "<div class=\"level ".$level."\">";
      $output .= "<h4>".$level." ".$word."</h4>"; 
      }
      foreach ($tops[$level] as $sponsor){
	$url = get_permalink($sponsor->ID);
	$desc = $level." sponsor, ".$sponsor->post_title;
	$html = get_the_post_thumbnail(
	       $sponsor->ID,
	       "full",
	       array(
		     'alt' => $desc,
		     'title' => $desc,
		     'style' => "display:inline",
		     'class' => $level
		     )
				       );
	$output.="<div class=\"sponsor\"><a description=\"".$desc."\" href=\"".$url."\">".$html."</a></div>";
      };
      if($widget){
        $output .= "</div>"; // end of level
      };
    };
  };
  if($widget){
    $output .="</div>";
  };

  return $output;

};
add_shortcode('sponsorlist','sponsorlist_shortcode');

new Foss4g();
class Foss4g{

  function allsponsors(){
    $levels = Conferencer::get_posts('sponsor_level');
    foreach ($levels as $id => $level) {
      $levels[$id]->sponsors = array();
    }

    $tops=array("Diamond"=>array(),"Platinum"=>array(),"Gold"=>array(),"Silver"=>array(),"Bronze"=>array(),"Supporter"=>array(), "Media"=>array());

    foreach (Conferencer::get_posts('sponsor') as $sponsor) {
      Conferencer::add_meta($sponsor);
      if (array_key_exists($levels[$sponsor->level]->post_title,$tops)){
	array_push($tops[$levels[$sponsor->level]->post_title],$sponsor);
      }
      shuffle($tops[$levels[$sponsor->level]->post_title]);
    }
    return $tops;
  }

};


// Search bar

function add_search_to_wp_menu ( $items, $args ) {
  //  $items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-999" id="menu-item-999"><form style="margin:0"><input type="text" style="height: 1em"/></form></li>';
$items .= '<li class="menu-item menu-item-search">';
$items .= '<form method="get" class="menu-search-form" action="' . get_bloginfo('home') . '/"><input class="text_input" type="text" value="Search..." name="s" id="s" onfocus="if (this.value == \'Search...\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Search...\';}" /><input type="submit" class="my-wp-search" id="searchsubmit" value="Go" /></form>';
//$items .= '<form method="get" class="menu-search-form" action="' . get_bloginfo('home') . '/"><input class="text_input" type="text" value="" name="s" id="s"  /><input type="submit" class="my-wp-search" id="searchsubmit" value="Search" /></form>';
$items .= '</li>';

return $items;
}
add_filter('wp_nav_menu_items','add_search_to_wp_menu',10,2);


function new_nav_menu_items($items) {
	$homelink = '<li class="home"><a href="' . home_url( '/' ) . '">' . __('Home') . '</a></li>';
	$items = $homelink . $items;
	return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items' );

add_action( 'widgets_init', 'my_register_sidebars' );

function my_register_sidebars() {

	/* Register the two homepage sidebars. */
	register_sidebar(
		array(
			'id' => 'lefthome',
			'name' => __( 'Homepage Left' ),
			'description' => __( 'Left of the hero unit.' ),
			'before_widget' => '<div id="%1$s" class="widget-wrapper homepage %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		)
	);

	register_sidebar(
		array(
			'id' => 'righthome',
			'name' => __( 'Homepage Right' ),
			'description' => __( 'Right of the hero unit.' ),
			'before_widget' => '<div id="%1$s" class="widget-wrapper homepage %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		)
	);

	/* Repeat register_sidebar() code for additional sidebars. */
}

add_filter('widget_text', 'do_shortcode');

/**
 * Breadcrumb Lists
 * Allows visitors to quickly navigate back to a previous section or the root page.
 *
 * Adopted from Dimox
 *  BUG FIX!!! Wasn't closing div tags.
 */
function xresponsive_breadcrumb_lists () {
  
  $chevron = '<span class="chevron">&#8250;</span>';
  $home = __('Home','responsive'); // text for the 'Home' link
  $before = '<span class="breadcrumb-current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div class="breadcrumb-list">';
 
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $chevron . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $chevron . ' '));
      echo $before; printf( __( 'Archive for %s', 'responsive' ), single_cat_title('', false) ); echo $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $chevron . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $chevron . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $chevron . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $chevron . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $chevron . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $chevron . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before; printf( __( 'Search results for: %s', 'responsive' ), get_search_query() ); echo $after;
 
    } elseif ( is_tag() ) {
      echo $before; printf( __( 'Posts tagged %s', 'responsive' ), single_tag_title('', false) ); echo $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before; printf( __( 'View all posts by %s', 'responsive' ), $userdata->display_name ); echo $after;
 
    } elseif ( is_404() ) {
      echo $before . __('Error 404 ','responsive') . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','responsive') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} 

function remove_some_widgets(){

	unregister_sidebar( 'left-sidebar-half' );
	unregister_sidebar( 'right-sidebar-half' );
	unregister_sidebar( 'left-sidebar' );
	unregister_sidebar( 'gallery-widget' );
	unregister_sidebar( 'colophon-widget' );
	unregister_sidebar( 'top-widget' );

}
add_action( 'widgets_init', 'remove_some_widgets', 11 );

add_action('admin_head', 'wpse_13671_script_enqueuer');

function wpse_13671_script_enqueuer() {
    global $current_screen;

    /**
     * /wp-admin/edit.php?post_type=page
     */
    if('edit-page' == $current_screen->id) 
    {
        ?>
        <script type="text/javascript">         
        jQuery(document).ready( function($) {
            $("a.editinline").live("click", function () {
                var ilc_qe_id = inlineEditPost.getId(this);
                setTimeout(function() {
                        $('#edit-'+ilc_qe_id+' select[name="page_template"] option[value="sidebar-content-page.php"]').remove();  
                        $('#edit-'+ilc_qe_id+' select[name="page_template"] option[value="sidebar-content-half-page.php"]').remove();  
                        $('#edit-'+ilc_qe_id+' select[name="page_template"] option[value="content-sidebar-half-page.php"]').remove();  
                        $('#edit-'+ilc_qe_id+' select[name="page_template"] option[value="landing-page.php"]').remove();  
                        $('#edit-'+ilc_qe_id+' select[name="page_template"] option[value="sitemap.php"]').remove();  
                    }, 100);
            });

            $('#doaction, #doaction2').live("click", function () {
                setTimeout(function() {
                        $('#bulk-edit select[name="page_template"] option[value="sidebar-content-page.php"]').remove();  
                        $('#bulk-edit select[name="page_template"] option[value="sidebar-content-half-page.php"]').remove();  
                        $('#bulk-edit select[name="page_template"] option[value="content-sidebar-half-page.php"]').remove();  
                        $('#bulk-edit select[name="page_template"] option[value="landing-page.php"]').remove();  
                        $('#bulk-edit select[name="page_template"] option[value="sitemap.php"]').remove();  
                    }, 100);
            });       
        });    
        </script>
    <?php
    }

    /**
     * /wp-admin/post.php?post=21&action=edit
     */
    if( 'page' == $current_screen->id ) 
    {
        ?>
        <script type="text/javascript">
        jQuery(document).ready( function($) {
            $('#page_template option[value="sidebar-content-page.php"]').remove();
            $('#page_template option[value="sidebar-content-half-page.php"]').remove();
            $('#page_template option[value="content-sidebar-half-page.php"]').remove();
            $('#page_template option[value="landing-page.php"]').remove();
            $('#page_template option[value="sitemap.php"]').remove();
        });
        </script>
    <?php
    }
}
?>
