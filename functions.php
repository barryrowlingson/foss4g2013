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
  $tops = Foss4g::topsponsors();
  
  $output="<ul>";
  
  foreach (array("Diamond","Platinum","Gold") as $level){
    $output .= "<li class=\"level ".$level."\">";
    $output .= $level." Sponsors";
    $output.="<ul class=\"sponsors\">";
    foreach ($tops[$level] as $sponsor){
      $output.="<li class=\"sponsor\">".$sponsor->post_title."</li>";
    };
    $output.="</ul>";

    $output .="</li>";
  };
  

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

?>
