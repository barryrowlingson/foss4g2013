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
				 ), $atts ) );
  $levels = explode(",",$levels);
  return sponsors_in($levels);
}
add_shortcode("sponsorlistlevels","sponsorlist_levels");

function sponsors_in($levels){

  $tops = Foss4g::topsponsors();
  
  $output = "";
  
  $output .= "<div class=\"widget-wrapper sponsors\">";
  //$output .= "<div class=\"widget-title-home\"><h3>Sponsors</h3></div>";
  foreach ($levels as $level){
    $sponsorset = $tops[$level];
    if(count($sponsorset) > 0){
      if(count($sponsorset)>1){
	$word="sponsors";
      }else{
	$word="sponsor";
      }
      $output .= "<h4>".$level." ".$word."</h4>"; 
      foreach ($tops[$level] as $sponsor){
	$url = $sponsor->url;
	$desc = $sponsor->post_title;
	$html = get_the_post_thumbnail(
	       $sponsor->ID,
	       array(75,75),
	       array(
		     'alt' => $sponsor->post_title,
		     'title' => $sponsor->post_title,
		     'style' => "display:inline",
		     'class' => $level
		     )
				       );
	$output.="<div class=\"sponsor\"><a description=\"".$desc."\" href=\"".$url."\">".$html."</a></div>";
      };
    };
  };
  
  $output .="</div>";

  return $output;

};
add_shortcode('sponsorlist','sponsorlist_shortcode');

new Foss4g();
class Foss4g{

  function topsponsors(){
    $levels = Conferencer::get_posts('sponsor_level');
    foreach ($levels as $id => $level) {
      $levels[$id]->sponsors = array();
    }

    $tops=array("Diamond"=>array(),"Platinum"=>array(),"Gold"=>array());

    foreach (Conferencer::get_posts('sponsor') as $sponsor) {
      Conferencer::add_meta($sponsor);
      if (array_key_exists($levels[$sponsor->level]->post_title,$tops)){
	array_push($tops[$levels[$sponsor->level]->post_title],$sponsor);
      }
    }
    return $tops;
  }

};


// Search bar

function add_search_to_wp_menu ( $items, $args ) {
$items .= '<li class="menu-item menu-item-search">';
$items .= '<form method="get" class="menu-search-form" action="' . get_bloginfo('home') . '/"><input class="text_input" type="text" value="search" name="s" id="s" onfocus="if (this.value == \'search\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Enter Text &amp; Click to Search\';}" /><input type="submit" class="my-wp-search" id="searchsubmit" value="Search" /></form>';
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
?>
