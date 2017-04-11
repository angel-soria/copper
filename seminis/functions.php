<?php
add_theme_support( 'post-thumbnails' ); 
add_image_size( '300x189', 300, 189, true );
add_image_size( '585x375', 585, 375, true );
add_image_size( '570x182', 570, 182, true );
add_image_size( '263x292', 263, 292, true );
add_image_size( '750x530', 750, 530, true );
add_image_size( '360x366', 360, 366, true );
add_image_size( '360x251', 360, 251, true );
add_image_size( '458x300', 458, 350, false );
add_image_size( '45x45', 100, 100, true );


add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );
function register_plugin_styles() {
	wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap' );



wp_register_script( 'script', 'https://code.jquery.com/jquery-2.2.4.min.js' );
	wp_enqueue_script( 'script' );
    

	wp_register_script( 'bootstrap-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' );
	wp_enqueue_script( 'bootstrap-script' );
    if ( is_singular('product') || is_front_page() ){
        wp_register_style( 'slide-style', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css' );
	    wp_enqueue_style( 'slide-style' );
        wp_register_script( 'slide-script', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js' );
	    wp_enqueue_script( 'slide-script' );
    }

     if ( is_page( 'contacto' ) ) {
        wp_register_script( 'fancy-script', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js' );
        wp_enqueue_script( 'fancy-script' );
    wp_register_style( 'fancy', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css' );
    wp_enqueue_style( 'fancy' );
    wp_register_script( 'validate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js' );
        wp_enqueue_script( 'validate-script' );

  }

	wp_register_script( 'global-script', get_template_directory_uri().'/assets/js/script-global.js' );
	wp_enqueue_script( 'global-script' );

	wp_register_style( 'globals-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700' );
	wp_enqueue_style( 'globals-fonts' );
  wp_register_style( 'icons-fonts', 'https://file.myfontastic.com/JzCvqPHMS2Hv8wvUpfoBxe/icons.css' );
  wp_enqueue_style( 'icons-fonts' );
  wp_register_style( 'icons2-fonts', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  wp_enqueue_style( 'icons2-fonts' );
  
  

    wp_register_style( 'globals-style', get_template_directory_uri().'/stylesheets/screen.css' );
    wp_enqueue_style( 'globals-style' );
}

// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '|';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
    }
}

remove_shortcode('gallery');
add_shortcode('gallery', 'my_new_gallery_function');

function my_new_gallery_function($atts) {
    
    global $post;
    $pid = $post->ID;
    $gallery = "";

    if (empty($pid)) {$pid = $post['ID'];}

    if (!empty( $atts['ids'] ) ) {
        $atts['orderby'] = 'post__in';
        $atts['include'] = $atts['ids'];
    }

    extract(shortcode_atts(array('orderby' => 'menu_order ASC, ID ASC', 'include' => '', 'id' => $pid, 'itemtag' => 'dl', 'icontag' => 'dt', 'captiontag' => 'dd', 'columns' => 3, 'size' => 'large', 'link' => 'file'), $atts));
        
    $args = array('post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image', 'orderby' => $orderby);

    if (!empty($include)) {$args['include'] = $include;}
    else {
        $args['post_parent'] = $id;
        $args['numberposts'] = -1;
    }

    if ($args['include'] == "") { $args['orderby'] = 'date'; $args['order'] = 'asc';}

    $images = get_posts($args);
    
    $gallery.='<div class="carrusel">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner">';
    $i=0;
    foreach ( $images as $image ) {
        //print_r($image); /*see available fields*/
        $mensaje = ($i==0) ? 'active' : '';
        $i++;
        $thumbnail = wp_get_attachment_image_src($image->ID, 'large');
        $thumbnail = $thumbnail[0];
        $gallery.='<div class="item '.$mensaje.'"> 
                      <img src="'.$thumbnail.'" class="attachment-ideas-slider size-ideas-slider wp-post-image"  />
                    </div>';
    }
    $gallery .='</div> 
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> 
                                    <i class="copp-chevron-left" aria-hidden="true"></i> 
                                    <span class="sr-only">Previous</span> 
                                </a> 
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> 
                                    <i class="copp-chevron-right" aria-hidden="true"></i> 
                                    <span class="sr-only">Next</span> 
                                </a>
                            </div>
                        </div>';
    return $gallery;
}

function codex_custom_init(){
    register_taxonomy(
        'product_category',
        'product',
        array(
            'rewrite' => array( 'slug' => 'productos', 'with_front' => false ),
            'label' => __( 'Categoria' ),
            'hierarchical' => true,
            'public' => true,
    'show_in_nav_menus' => true,
    'show_ui' => true,
    'show_tagcloud' => true,
            // your other args...
        ) 
    );
    register_post_type(
        'product',
        array(
            'public' => true,
            'rewrite' => array( 'slug' => 'productos/%product_category%', 'with_front' => false ),
            'has_archive' => 'productos',
            'label'  => 'Productos',
            'supports' => array(  'thumbnail', 'title', 'editor','excerpt'),
            'register_meta_box_cb' => 'add_events_metaboxes'

            // your other args...
        )
    );
    register_post_type(
        'slider',
        array(
            'public' => true,
            'has_archive' => false,
            'label'  => 'Slider',
            'supports' => array(  'thumbnail', 'title', 'excerpt'),
            'register_meta_box_cb' => 'add_slider_metaboxes'

            // your other args...
        )
    );
    
}
add_action( 'init', 'codex_custom_init' );

function codex_custom_init_() {
    $args = array(
      'public' => true,
      'label'  => 'Books'
    );
    register_post_type( 'book', $args );
}
//add_action( 'init', 'codex_custom_init_' );




function wpa_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'product' ){
        $terms = wp_get_object_terms( $post->ID, 'product_category' );
        if( $terms ){
            return str_replace( '%product_category%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 2 );

function set_posts_per_page_for_towns_cpt( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'product' ) ) {
    $query->set( 'posts_per_page', '1' );
  }
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_towns_cpt' );

function banners_categories($myterms){
    if ( ! empty( $myterms ) && ! is_wp_error( $myterms ) ){
?>
    <div class="row special-row">
			<div class="col-xs-12 col-sm-6 cols">
				<div class="categoria-place">
					<a href="<?php echo  get_term_link($myterms[0]); ?>">
                        <?php echo get_term_thumbnail( $myterms[0]->term_id, '585x375', array( 'class' => 'img-responsive' ) ); ?>
						<h3><?php echo $myterms[0]->name; ?></h3>
						<div class="opacity"></div>						
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 cols-2">
				<div class="row s-margin">
					<div class="col-xs-12">
						<div class="categoria-place">
							<a href="<?php echo  get_term_link($myterms[1]); ?>">
								<?php echo get_term_thumbnail( $myterms[1]->term_id, '570x182', array( 'class' => 'img-responsive' ) ); ?>
								<h3 class="secondary-title"><?php echo $myterms[1]->name; ?></h3>
								<div class="opacity"></div>						
							</a>
						</div>
					</div>
				</div>
				<div class="row s-row">
					<div class="col-xs-6 cols">
						<div class="categoria-place">
							<a href="<?php echo  get_term_link($myterms[2]); ?>">
								<?php echo get_term_thumbnail( $myterms[2]->term_id, '300x189', array( 'class' => 'img-responsive' ) ); ?>
								<h3 class="secondary-title"><?php echo $myterms[2]->name; ?></h3>
								<div class="opacity"></div>						
							</a>
						</div>
					</div>
					<div class="col-xs-6 cols-2">
						<div class="categoria-place">
							<a href="<?php echo  get_term_link($myterms[3]); ?>">
								<?php echo get_term_thumbnail( $myterms[3]->term_id, '300x189', array( 'class' => 'img-responsive' ) ); ?>
								<h3 class="secondary-title"><?php echo $myterms[3]->name; ?></h3>
								<div class="opacity"></div>						
							</a>
						</div>
					</div>
				</div>	
			</div>
		</div>
<?php
    }
}

add_action( 'add_meta_boxes', 'add_events_metaboxes' );
function add_events_metaboxes() {
	add_meta_box('wpt_events_location', 'Caracteristicas', 'wpt_events_location', 'product', 'side', 'default');
}
add_action( 'add_meta_boxes', 'add_slider_metaboxes' );
function add_slider_metaboxes() {
    add_meta_box('wpt_slider_location', 'Boton', 'wpt_slider_location', 'slider', 'side', 'default');
}
function wpt_slider_location() {
    global $post;
    
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
    // Get the location data if its already been entered
    $text = get_post_meta($post->ID, '_text_button_es', true);
    $text2 = get_post_meta($post->ID, '_text_button_en', true);
    $text2 = get_post_meta($post->ID, '_link_', true);
    
    // Echo out the field
    echo '<p>Texto Boton</p>';
    echo '<input type="text" name="_text_button_es" value="' . $text  . '" class="widefat" />';
    echo '<br /> <br />';
    echo '<input type="text" name="_text_button_en" value="' . $text2  . '" class="widefat" />';
     echo '<p>Link</p>';
    echo '<input type="text" name="_link_" value="' . $link  . '" class="widefat" />';

}
function wpt_events_location() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$location = get_post_meta($post->ID, '_price_es', true);
    $location2 = get_post_meta($post->ID, '_price_en', true);
    $_quantity = get_post_meta($post->ID, '_quantity', true);
    $_id = get_post_meta($post->ID, '_id', true);
	
	// Echo out the field
     echo '<p>Disponibles</p>';
    echo '<input type="text" name="_quantity" value="' . $_quantity  . '" class="widefat" />';
    echo '<p>ID</p>';
    echo '<input type="text" name="_id" value="' . $_id  . '" class="widefat" />';
    echo '<p>Precio México</p>';
	echo '<input type="text" name="_price_es" value="' . $location  . '" class="widefat" />';
    echo '<p>Precio USA</p>';
	echo '<input type="text" name="_price_en" value="' . $location2  . '" class="widefat" />';

}

function wpse82477_add_meta_boxes_page() {
    global $post;
    if ( 'template-contacto.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
       add_meta_box('product_meta', // $id
                 'Product Information', // $title
                 'display_product_information', // $callback
                 'page', // $page
                 'normal', // $context
                 'high');
    }
}
add_action( 'add_meta_boxes_page', 'wpse82477_add_meta_boxes_page' );

function display_product_information() {
    global $post;
    
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
    // Get the location data if its already been entered
    $lat = get_post_meta($post->ID, '_lat', true);
    $long = get_post_meta($post->ID, '_long', true);
    $direccion = get_post_meta($post->ID, '_direccion', true);

?>
  <div id="latlong">
    <input size="20" type="hidden" id="latbox" name="_lat"  value="<?php echo $lat;?>">
    <input size="20" type="hidden" id="lngbox" name="_long" value="<?php echo $long;?>">
  </div>
  <div id="map_canvas" style="width:100%; height:400px"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCziOtxzjmnNtgvDp7JHzh_bsRwzOooV7U&callback=initialize"
        async defer></script>
<script type="text/javascript">
  var map;
  function initialize() {
  var myLatlng = new google.maps.LatLng(19.702839,-101.1942387);
  var myLatlngPin = new google.maps.LatLng(19.702839,-101.1942387);
  <?php if($long) {?>
    myLatlngPin = new google.maps.LatLng(<?php echo $lat;?>,<?php echo $long;?>);
    myLatlng = new google.maps.LatLng(<?php echo $lat;?>,<?php echo $long;?>);
  <?php } ?>
  var myOptions = {
     zoom: 15,
     center: myLatlng,
     mapTypeId: google.maps.MapTypeId.ROADMAP
     }
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 
  var marker = new google.maps.Marker({
      draggable: true,
      position: myLatlngPin, 
      map: map,
      title: "Ubicación"
      }
      );
google.maps.event.addListener(marker, 'dragend', function (event) {
    document.getElementById("latbox").value = this.getPosition().lat();
    document.getElementById("lngbox").value = this.getPosition().lng();
});
google.maps.event.addListener(marker, 'click', function (event) {
    document.getElementById("latbox").value = this.getPosition().lat();
    document.getElementById("lngbox").value = this.getPosition().lng();
});
}
</script> 


<?php
    
    // Echo out the field
    echo '<p>Dirección</p>';
    echo '<textarea name="_direccion">' . $direccion  . '</textarea>';
}


function wpt_save_events_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	if(isset($_POST['_price_es'])){
       $events_meta['_price_es'] = $_POST['_price_es'];
        $events_meta['_price_en'] = $_POST['_price_en']; 
         $events_meta['_quantity'] = $_POST['_quantity']; 
          $events_meta['_id'] = $_POST['_id']; 
    }
	if(isset($_POST['_text_button_es'])){
       $events_meta['_text_button_es'] = $_POST['_text_button_es'];
        $events_meta['_text_button_en'] = $_POST['_text_button_en']; 
        $events_meta['_link_'] = $_POST['_link_']; 
    }
    if(isset($_POST['_lat'])){
       $events_meta['_lat'] = $_POST['_lat'];
        $events_meta['_long'] = $_POST['_long']; 
        $events_meta['_direccion'] = $_POST['_direccion']; 
    }
	
	// Add values of $events_meta as custom fields
	
	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fields


add_action( 'admin_menu','addPageAdminMenu' );

function addPageAdminMenu()
{
	
    add_menu_page( 
        __( 'Mejores Ofertas', 'textdomain' ),
        'Mejores Ofertas',
        'manage_options',
        'cuadros-sociales',
        'cuadrosSociales',
         'dashicons-admin-tools',
        6
    ); 
}


function cuadrosSociales()
{
	if(isset($_POST['bloque'])){
        update_option( 'ofertas', serialize($_POST['bloque']) );
	}
    if(isset($_POST['facebook'])){
        update_option( 'facebook', $_POST['facebook'] );
	}
    if(isset($_POST['youtube'])){
        update_option( 'youtube', $_POST['youtube'] );
	}
    if(isset($_POST['telefono'])){
        update_option( 'telefono', $_POST['telefono'] );
	}
    if(isset($_POST['correo'])){
        update_option( 'correo', $_POST['correo'] );
	}
    if(isset($_POST['correo'])){
        update_option( 'correo', $_POST['correo'] );
	}
    if(isset($_POST['titulo_banner_es'])){
        update_option( 'titulo_banner_es', $_POST['titulo_banner_es'] );
	}
    if(isset($_POST['titulo_banner_en'])){
        update_option( 'titulo_banner_en', $_POST['titulo_banner_en'] );
	}
    if(isset($_POST['contenido_banner_es'])){
        update_option( 'contenido_banner_es', $_POST['contenido_banner_es'] );
	}
    if(isset($_POST['contenido_banner_en'])){
        update_option( 'contenido_banner_en', $_POST['contenido_banner_en'] );
	}
     if(isset($_POST['contenido_boton_es'])){
        update_option( 'contenido_boton_es', $_POST['contenido_boton_es'] );
	}
     if(isset($_POST['contenido_boton_en'])){
        update_option( 'contenido_boton_en', $_POST['contenido_boton_en'] );
	}
     if(isset($_POST['url_banner'])){
        update_option( 'url_banner', $_POST['url_banner'] );
	}
     if(isset($_POST['url_banner_boton'])){
        update_option( 'url_banner_boton', $_POST['url_banner_boton'] );
	}
     if(isset($_POST['aux_one_es'])){
        update_option( 'aux_one_es', $_POST['aux_one_es'] );
	}
     if(isset($_POST['aux_one_en'])){
        update_option( 'aux_one_en', $_POST['aux_one_en'] );
	}
    if(isset($_POST['aux_two_es'])){
        update_option( 'aux_two_es', $_POST['aux_two_es'] );
	}
     if(isset($_POST['aux_two_en'])){
        update_option( 'aux_two_en', $_POST['aux_two_en'] );
	}
    if(isset($_POST['aux_three_es'])){
        update_option( 'aux_three_es', $_POST['aux_three_es'] );
	}
     if(isset($_POST['aux_three_en'])){
        update_option( 'aux_three_en', $_POST['aux_three_en'] );
	}
    if(isset($_POST['aux_four_es'])){
        update_option( 'aux_four_es', $_POST['aux_four_es'] );
	}
     if(isset($_POST['aux_four_en'])){
        update_option( 'aux_four_en', $_POST['aux_four_en'] );
	}
    if(isset($_POST['aux_five_es'])){
        update_option( 'aux_five_es', $_POST['aux_five_es'] );
	}
     if(isset($_POST['aux_five_en'])){
        update_option( 'aux_five_en', $_POST['aux_five_en'] );
	}
    if(isset($_POST['aux_six_es'])){
        update_option( 'aux_six_es', $_POST['aux_six_es'] );
	}
     if(isset($_POST['aux_six_en'])){
        update_option( 'aux_six_en', $_POST['aux_six_en'] );
	}
    if(isset($_POST['aux_seven_es'])){
        update_option( 'aux_seven_es', $_POST['aux_seven_es'] );
	}
     if(isset($_POST['aux_seven_en'])){
        update_option( 'aux_seven_en', $_POST['aux_seven_en'] );
	}
    if(isset($_POST['aux_eight_es'])){
        update_option( 'aux_eight_es', $_POST['aux_eight_es'] );
	}
     if(isset($_POST['aux_eight_en'])){
        update_option( 'aux_eight_en', $_POST['aux_eight_en'] );
	}
    
    

?>
<div id="SocialesGeneralesConfig">
	<h2>Configuraciones</h2>
	<div id="configuracion-automate" >
		<?php 
			$option = array();
			$lastposts = get_posts( array(
			    'posts_per_page' => -1,
                'post_type' => 'product',

			) );
			$optionPost="";

			if ( $lastposts ) {
			    foreach ( $lastposts as $post ) :
			        setup_postdata( $post ); 
			    	$optionPost.='<option value="'.$post->ID.'">'.get_the_title($post->ID ).'</option>';
			    endforeach; 
			    wp_reset_postdata();
			}

            $ofertas = unserialize(get_option( 'ofertas' ));
		?>
		<form method="post" id="formAutomate">
			<table>	
                <tr>
                    <td>Mejores Ofertas</td>
                </tr>
                <?php $i=1; foreach($ofertas as $oferta){ ?>
				<tr>
					<td>Bloque <?php echo $i; ?></td>
					<td>
						<select name="bloque[]" class="block-change">
                            <?php echo '<option value="'.$oferta.'">'.get_the_title( $oferta ).'</option>'; ?>
							<?php echo $optionPost;  ?>
						</select>
					</td>
				</tr>
                <?php $i++; } ?>
                <tr>
                    <td>Redes Sociales</td>
                </tr>
                <tr>
					<td>Facebook</td>
					<td>
						<input type="text" name="facebook" value="<?php echo get_option( 'facebook' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Youtube</td>
					<td>
						<input type="text" name="youtube" value="<?php echo get_option( 'youtube' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Telefono</td>
					<td>
						<input type="text" name="telefono" value="<?php echo get_option( 'telefono' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Correo electronico</td>
					<td>
						<input type="text" name="correo" value="<?php echo get_option( 'correo' ); ?>">
					</td>
				</tr>
                <tr>
                    <td>Banner</td>
                </tr>
                <tr>
					<td>Titulo</td>
					<td>
						<input type="text" name="titulo_banner_es" value="<?php echo get_option( 'titulo_banner_es' ); ?>"><br/>
                        <input type="text" name="titulo_banner_en" value="<?php echo get_option( 'titulo_banner_en' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Contenido</td>
					<td>
						<input type="text" name="contenido_banner_es" value="<?php echo get_option( 'contenido_banner_es' ); ?>"> <br/>
						<input type="text" name="contenido_banner_en" value="<?php echo get_option( 'contenido_banner_en' ); ?>">
                        
					</td>
				</tr>
                <tr>
					<td>Boton</td>
					<td>
						<input type="text" name="contenido_boton_es" value="<?php echo get_option( 'contenido_boton_es' ); ?>"> <br/>
						<input type="text" name="contenido_boton_en" value="<?php echo get_option( 'contenido_boton_en' ); ?>">
                        
					</td>
				</tr>
                 <tr>
					<td>Url boton</td>
					<td>
						<input type="text" name="url_banner_boton" value="<?php echo get_option( 'url_banner_boton' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Url Imágen</td>
					<td>
						<input type="text" name="url_banner" value="<?php echo get_option( 'url_banner' ); ?>">
					</td>
				</tr>
                <tr>
                    <td>Textos auxiliares</td>
                </tr>
                <tr>
					<td>Linea de productos</td>
					<td>
						<input type="text" name="aux_one_es" value="<?php echo get_option( 'aux_one_es' ); ?>"><br/>
                        <input type="text" name="aux_one_en" value="<?php echo get_option( 'aux_one_en' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Mejores ofertas</td>
					<td>
						<input type="text" name="aux_two_es" value="<?php echo get_option( 'aux_two_es' ); ?>"><br/>
                        <input type="text" name="aux_two_en" value="<?php echo get_option( 'aux_two_en' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Ver más</td>
					<td>
						<input type="text" name="aux_three_es" value="<?php echo get_option( 'aux_three_es' ); ?>"><br/>
                        <input type="text" name="aux_three_en" value="<?php echo get_option( 'aux_three_en' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Ver detalles</td>
					<td>
						<input type="text" name="aux_four_es" value="<?php echo get_option( 'aux_four_es' ); ?>"><br/>
                        <input type="text" name="aux_four_en" value="<?php echo get_option( 'aux_four_en' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Productos</td>
					<td>
						<input type="text" name="aux_five_es" value="<?php echo get_option( 'aux_five_es' ); ?>"><br/>
                        <input type="text" name="aux_five_en" value="<?php echo get_option( 'aux_five_en' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Productos contenido</td>
					<td>
						<input type="text" name="aux_six_es" value="<?php echo get_option( 'aux_six_es' ); ?>"><br/>
                        <input type="text" name="aux_six_en" value="<?php echo get_option( 'aux_six_en' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Más barato</td>
					<td>
						<input type="text" name="aux_seven_es" value="<?php echo get_option( 'aux_seven_es' ); ?>"><br/>
                        <input type="text" name="aux_seven_en" value="<?php echo get_option( 'aux_seven_en' ); ?>">
					</td>
				</tr>
                <tr>
					<td>Más caro</td>
					<td>
						<input type="text" name="aux_eight_es" value="<?php echo get_option( 'aux_eight_es' ); ?>"><br/>
                        <input type="text" name="aux_eight_en" value="<?php echo get_option( 'aux_eight_en' ); ?>">
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Guardar ajustes"></td>
				</tr>

			</table>
		</form>
	</div>
</div> 
<?php 


}

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );
function call_to_action(){
?>
<div class="call-to-action" style="background: url('<?php echo get_option( 'url_banner' ); ?>') no-repeat; ">
	<div class="overlay"></div>
	<div class="container"> 
		<div class="row">
			<div class="col-xs-12">
				<h3><?php echo get_option( 'titulo_banner_'.qtranxf_getLanguage() ); ?></h3>
				<p><?php echo get_option( 'contenido_banner_'.qtranxf_getLanguage() ); ?></p>
				<a href="<?php echo get_option( 'url_banner_boton' ); ?>" target="_blank"><?php echo get_option( 'contenido_boton_'.qtranxf_getLanguage() ); ?></a>
			</div>
		</div>
	</div>
</div>
<?php
}


add_action( 'pre_get_posts', function ( $q ) 
{
    if (    !is_admin() // VERY important, targets only front end queries
         && $q->is_main_query() // VERY important, targets only main query
         && $q->is_post_type_archive( 'product' ) // Which post type archive page to target
    ) {

        //$q->set( 'meta_key', 'META_KEY_NAME' );
        //$q->set( 'meta_value', 'META_VALUE_VALUE');
        // Rest of your arguments to se
        if($_GET['by']){
            switch ($_GET['by']) {
                case 'mprice':
                    $q->set( 'meta_key', '_price_es' );
                    $q->set( 'orderby', 'meta_value title' );
                    $q->set( 'order', 'ASC' );                    
                    break;
                case 'lprice':
                    $q->set( 'meta_key', '_price_es' );
                    $q->set( 'orderby', 'meta_value title' );
                    $q->set( 'order', 'DESC' );
                    break;
                case 'alpha':
                    $q->set( 'orderby', 'title' );
                    $q->set( 'order', 'ASC' );
                    break;
                case 'zalpha':
                    $q->set( 'orderby', 'title' );
                    $q->set( 'order', 'DESC' );
                    break;
            }
        }
    }
    if (    !is_admin() // VERY important, targets only front end queries
         && $q->is_main_query() // VERY important, targets only main query
         && $q->is_tax( 'product_category' ) // Which post type archive page to target
    ) {

        //$q->set( 'meta_key', 'META_KEY_NAME' );
        //$q->set( 'meta_value', 'META_VALUE_VALUE');
        // Rest of your arguments to se
        if($_GET['by']){
            switch ($_GET['by']) {
                case 'mprice':
                    $q->set( 'meta_key', '_price_es' );
                    $q->set( 'orderby', 'meta_value title' );
                    $q->set( 'order', 'ASC' );                    
                    break;
                case 'lprice':
                    $q->set( 'meta_key', '_price_es' );
                    $q->set( 'orderby', 'meta_value title' );
                    $q->set( 'order', 'DESC' );
                    break;
                case 'alpha':
                    $q->set( 'orderby', 'title' );
                    $q->set( 'order', 'ASC' );
                    break;
                case 'zalpha':
                    $q->set( 'orderby', 'title' );
                    $q->set( 'order', 'DESC' );
                    break;
            }
        }
    }
});