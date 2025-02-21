<?php
function register_nmf_shortcodes()
{
  add_shortcode("place-map", "showMap");  
}
add_action("init", "register_nmf_shortcodes");

function showMap()
{
    // Get the path to the PHP file (adjust path as needed)
    $template_path =  NEIGHBORHOOD_ATTRACTIONS_FILTER_DIR . "/template/placemap/show-map.php";    
    // Include the PHP file
    ob_start();  // Start output buffering
    include($template_path);
    return ob_get_clean();  // Return the content of the included PHP file
}