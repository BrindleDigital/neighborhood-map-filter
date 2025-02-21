<?php
$activeType ='';
$map_filter_types =  get_option('nmf_map_filter_types');
if($map_filter_types ==''){
    $map_filter_types = 'restaurant,cafe,gym';
}
$map_filter_types_array = explode(',', $map_filter_types);
for($t=0;$t<count($map_filter_types_array);$t++){
     $type =$map_filter_types_array[$t];
     $type = strtolower($type);
    if($t==0){ 
        $activeType =$type;                
    }
}

$button_color = '#F2F2F2';
if(get_option('nmf_default_color')){
    $button_color = get_option('nmf_default_color');  
}
$button_color_active = '#EE695A';
if(get_option('nmf_default_active_color')){
    $button_color_active = get_option('nmf_default_active_color');  
}
$grid_color = '#F2F2F2';
if(get_option('nmf_grid_default_color')){
    $grid_color = get_option('nmf_grid_default_color');  
}
$grid_active_color = '#EE695A';
if(get_option('nmf_grid_default_active_color')){
    $grid_active_color = get_option('nmf_grid_default_active_color');  
}
?>
<style>
    :root {
      --button-color: <?php echo $button_color;?>;
      --button-text-color: #000;
      --button-color-active: <?php echo $button_color_active;?>;
      --button-text-color-active: #fff;

      --grid-bg-color:<?php echo $grid_color;?>;
      --info-content-bgcolor:#fff; 
      --info-content-color:#000; 
      --info-content-h3-size:22px; 
      --info-content-hover: <?php echo $grid_active_color;?>;  
      --info-content-color-active:#fff;        
    }


    /* Style the map container */
    #map {
        height: 500px;
        width: 100%;
        margin-bottom: 0px;
    }

    
</style>
<link rel="stylesheet" type="text/css" href="<?php echo NEIGHBORHOOD_ATTRACTIONS_FILTER_URL;?>/template/placemap/show-map.css">
<script>
window.initMapDup = function () {
    //...
};
//jQuery(document).ready(function ($) {


        var options = {"json_style":[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#dde6e8"},{"visibility":"on"}]}]};

        var mapStyle = options.json_style;

        let map;
        let service;
        let infowindow;
        let markers = [];  // Store markers here
        let currentPlaces = [];  // Store places for the grid
        const fixedLocation = { lat: <?php echo get_option('nmf_map_center_latitude');?>, lng: <?php echo get_option('nmf_map_center_longitude');?> };  // Static location (Kochi, India)

        const mapzoom = <?php echo get_option('nmf_map_zoom');?>;

        // Initialize the map with a fixed location (for example, a location in Kochi)
        function initMapPlace() {
            

           


            map = new google.maps.Map(document.getElementById("map"), {
                center: fixedLocation,  // Use fixed location for the map center
                zoom: mapzoom,
                styles: mapStyle,  // Apply custom styles
                disableDefaultUI: false, // removes the satellite/map selection (might also remove other stuff)
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_TOP,
                },
            fullscreenControl: true,
                mapId: '<?php echo get_option('nmf_map_id');?>'    // Use your Map ID here
            });

            infowindow = new google.maps.InfoWindow();
            service = new google.maps.places.PlacesService(map);
            //Call default one to show it places
            //findNearbyPlaces('<?php echo $activeType;?>','0');

            jQuery(document).ready(function ($) {                
                findNearbyPlaces('<?php echo $activeType;?>','0');
            });  

            // Create a custom marker (logo) at the center of the map
            const logoMarker = new google.maps.Marker({
                position: fixedLocation,
                map: map,
                title: 'Lola',  // Title that appears when hovering over the marker
                icon: {
                    url: '<?php echo get_option('nmf_map_center_image_url');?>',  // Replace with the URL of your custom logo
                    //size: new google.maps.Size(50, 50),  // Logo size
                    //scaledSize: new google.maps.Size(50, 50),  // Scaled size of the logo
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(25, 25)  // Anchoring the logo at the center
                }
            });

            // Add event listener to open InfoWindow on logo click
            logoMarker.addListener("click", function() {

                const content = `
                    <div class="info-window-content">
                        <div class="close-btn" onclick="closeInfoWindow()">X</div>
                        <h3><?php echo get_option('nmf_map_center_info_box_title');?></h3>
                        <p><?php echo get_option('nmf_map_center_info_box_contents');?></p>
                    </div>
                `;

                infowindow.setContent(content);
                infowindow.open(map, logoMarker);  // Open InfoWindow near the logo marker
            });

        }


        //initMap();

//}); // End jQuery ready   


jQuery(document).ready(function ($) {
    //initMap();
   // findNearbyPlaces('<?php echo $activeType;?>','0');
});     
</script>
<script type="text/javascript" src="<?php echo NEIGHBORHOOD_ATTRACTIONS_FILTER_URL;?>/template/placemap/show-map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('nmf_google_api_key');?>&libraries=places,marker&callback=initMapPlace" async defer></script>


    


<h1>Nearby Search Example</h1>
    <div id="map"></div>
    <div class="button_outer">
        <?php
        $activeType ='';
        $map_filter_types =  get_option('nmf_map_filter_types');
        if($map_filter_types ==''){
            $map_filter_types = 'restaurant,cafe,gym';
        }
        $map_filter_types_array = explode(',', $map_filter_types);
        for($t=0;$t<count($map_filter_types_array);$t++){
             $type =$map_filter_types_array[$t];
             $type = strtolower($type);
             if($type==''){
                continue;
             }
            if($t==0){ 
                $activeType =$type;                
            }
        ?>
        <button class="btn_type btn_<?php echo $t;?> <?php if($t==0){?>active <?php }?>" onclick="findNearbyPlaces('<?php echo $type;?>','<?php echo $t;?>')"><?php echo $type;?></button>
        <?php }?>        
    </div>
    <div id="places-list" class="places-grid"></div>
    

    

