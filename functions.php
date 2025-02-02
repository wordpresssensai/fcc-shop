<?php

add_action( 'after_setup_theme', 'foundation_wooocommerce_setup' );

if ( ! function_exists ( 'foundation_wooocommerce_setup' ) ) {

    function foundation_wooocommerce_setup () {

        add_theme_support( 'automatic-feed-links' );

        load_theme_textdomain( 'foundation-woocommerce' );

        add_theme_support( 'title-tag' );

        register_nav_menu ( 'primary', __( 'Primary', 'foundation-woocommerce' ) );

    }

}

add_action ( 'admin_enqueue_scripts', 'woocommerce_scripts' );

if ( ! function_exists ( 'woocommerce_scripts' ) ) {

    function woocommerce_scripts ( $hook ) {

        if ( $hook != 'toplevel_page_custompage' ) {

            return;

        }

        wp_enqueue_media();

        wp_enqueue_style ( 'cl-woocommerce-foundation', get_template_directory_uri () . '/css/foundation.min.css', array(), '5.0.0' );

        wp_enqueue_style ( 'cl-woocommerce-app-admin', get_template_directory_uri () . '/css/app-admin.css', array(), '5.0.0' );

        wp_enqueue_script ( 'cl-woocommerce-jquery', get_template_directory_uri () . '/js/vendor/jquery.js', array(), '5.0.0', true );

        wp_enqueue_script ( 'cl-woocommerce-what-input', get_template_directory_uri () . '/js/vendor/what-input.js', array(), '5.0.0', true );

        wp_enqueue_script ( 'cl-woocommerce-foundation-js', get_template_directory_uri () . '/js/vendor/foundation.min.js', array(), '5.0.0', true );

        wp_enqueue_script ( 'cl-woocommerce-app-admin', get_template_directory_uri () . '/js/app-admin.js', array(), '5.0.0', true );

    }

}

if ( !function_exists ( 'search' ) ) {

    function search ( $search ) {

        global $wpdb;

        $query = "SELECT * FROM " . $wpdb->prefix . "posts WHERE post_title LIKE '%" . $search . "%'";

        $results = $wpdb->get_results ( $query );

        return $results;

    }

}

if ( ! function_exists ( 'createMmenu' ) ) {

    function createMmenu ( $menu ) {

        $html = '';

        foreach ( $menu as $key => $value ) {

            $html .= '<li>';

            $html .= '<a href="' . $value['url'] . '">' . $key . '</a>';

            if ( ! empty ( $value['children'] ) ) {

                $html .= '<ul class="menu">';

                $html .= createMmenu ( $value['children'] );

                $html .= '</ul>';

            }

            $html .= '</li>';

        }

        return $html;

    }

}

add_action( 'wp_ajax_hubspot_lists', 'ajax_hubspot_lists_handler' );

if ( !function_exists ( 'ajax_hubspot_lists_handler' ) ) {

    function ajax_hubspot_lists_handler () {
        
        update_option ( 'hubspot_list_id', $_POST['hubspot_list_id'] );

        echo 'Hubspot list ID ' . $_POST['hubspot_list_id'] . ' has been updated successfully';

        wp_die();
    }

}

add_action( 'wp_ajax_hubspot_access_token', 'ajax_hubspot_access_token_handler' );

if ( !function_exists ( 'ajax_hubspot_access_token_handler' ) ) {

    function ajax_hubspot_access_token_handler () {
        
        update_option ( 'hubspot_access_token', $_POST['hubspot_access_token'] );

        echo 'Hubspot access token has been updated successfully';

        wp_die();
    }

}

add_action( 'wp_ajax_instagram_url', 'ajax_instagram_url_handler' );

if ( !function_exists ( 'ajax_instagram_url_handler' ) ) {

    function ajax_instagram_url_handler () {
        
        update_option ( 'instagram_url', $_POST['instagram_url'] );

        echo 'Instagram URL has been updated successfully';

        wp_die();
    }

}

add_action( 'wp_ajax_twitter_url', 'ajax_twitter_url_handler' );

if ( !function_exists ( 'ajax_twitter_url_handler' ) ) {

    function ajax_twitter_url_handler () {
        
        update_option ( 'twitter_url', $_POST['twitter_url'] );

        echo 'Twitter URL has been updated successfully';

        wp_die();
    }

}

add_action( 'wp_ajax_youtube_url', 'ajax_youtube_url_handler' );

if ( !function_exists ( 'ajax_youtube_url_handler' ) ) {

    function ajax_youtube_url_handler () {
        
        update_option ( 'youtube_url', $_POST['youtube_url'] );

        echo 'Youtube URL has been updated successfully';

        wp_die();
    }

}

add_action( 'wp_ajax_left_footer', 'ajax_left_footer_handler' );

if ( !function_exists ( 'ajax_left_footer_handler' ) ) {

    function ajax_left_footer_handler () {
        
        update_option ( 'left_footer', $_POST['left_footer'] );

        echo 'Left footer has been updated successfully';

        wp_die();
    }

}

add_action( 'wp_ajax_logo_url', 'ajax_logo_url_handler' );

if ( !function_exists ( 'ajax_logo_url_handler' ) ) {

    function ajax_logo_url_handler () {
        
        update_option ( 'logo_url', $_POST['logo_url'] );

        echo 'Logo URL has been updated successfully';

        wp_die();
    }

}


if ( ! function_exists ( 'fwct_menu' ) ) {

    function fwct_menu () {

    	add_menu_page (

    		__( 'Foundation WC Theme', 'foundation-woocommerce' ),

    		'Foundation WC Theme',

    		'manage_options',

    		'custompage',

            'fwct_menu_page',

            get_template_directory_uri () . '/images/fwct_icon.png'

    	);

    }

}

add_action ( 'admin_menu', 'fwct_menu' );

if ( ! function_exists ( 'fwct_menu_page' ) ) {

    function fwct_menu_page () {

    	$accordion = '

            <div class="grid-container fluid">

                <ul class="accordion" data-responsive-accordion-tabs="accordion medium-tabs large-accordion">
                
                    <li class="accordion-item is-active" data-accordion-item>
                
                        <a href="#" class="accordion-title">Header Settings</a>

                        <div class="accordion-content" data-tab-content>

                            <div id="logo-url-message"></div>

                            <label>Logo Url</label>
                                <input 
                                
                                    id="img-upload-url" 
                                    
                                    type="text" name="logo-url" 
                                    
                                    placeholder="Logo URL" 

                                    value="' . wp_unslash ( get_option ( 'logo_url' ) ) . '"
                                
                                />

                            <a id="img-upload" class="button primary" href="javascript:void(0);">Upload</a>

                            <button id="save-logo-url" class="submit success button">Save</button>
                
                        </div>
                
                    </li>
            
                    <li class="accordion-item" data-accordion-item>
                
                        <a href="#" class="accordion-title">Footer Settings</a>

                        <div class="accordion-content" data-tab-content>

                            <div class="grid-x">

                                <div class="large-6 cell">

                                    <div id="left-footer-message"></div>

                                    <label>Left Footer</label>

                                    <textarea id="left-footer" name="left-footer" rows="10">' . 
                                    
                                        wp_unslash ( get_option ( 'left_footer' ) )
                                    
                                    . '</textarea>

                                    <button id="save-left-footer" class="submit success button">Save</button>
                            
                                </div>
                            
                                <div class="large-6 cell">

                                    <div id="youtube-url-message"></div>

                                    <label>Youtube URL</label>

                                    <input 
                                
                                        id="youtube-url" 
                                        
                                        type="text" name="youtube-url" 
                                        
                                        placeholder="Youtube URL" 

                                        value="' . wp_unslash ( get_option ( 'youtube_url' ) ) . '"
                                
                                    />

                                    <button id="save-youtube-url" class="submit success button">Save</button>

                                    <br/><br/>

                                    <div id="twitter-url-message"></div>

                                    <label>Twitter URL</label>

                                    <input 
                                
                                        id="twitter-url" 
                                        
                                        type="text" name="twitter-url" 
                                        
                                        placeholder="Twitter URL" 

                                        value="' . wp_unslash ( get_option ( 'twitter_url' ) ) . '"
                                
                                    />

                                    <button id="save-twitter-url" class="submit success button">Save</button>

                                    <br/><br/>

                                    <div id="instagram-url-message"></div>

                                    <label>Instagram URL</label>

                                    <input 
                                
                                        id="instagram-url" 
                                        
                                        type="text" name="instagram-url" 
                                        
                                        placeholder="Instagram URL" 

                                        value="' . wp_unslash ( get_option ( 'instagram_url' ) ) . '"
                                
                                    />

                                    <button id="save-instagram-url" class="submit success button">Save</button>

                                    <br/><br/>

                                    <div id="hubspot-access-token-message"></div>

                                    <label>Hubspot Access Token (Private App)</label>

                                    <input 
                                
                                        id="hubspot-access-token" 
                                        
                                        type="text" name="hubspot-access-token" 
                                        
                                        placeholder="Hubspot Access Token" 

                                        value="' . wp_unslash ( get_option ( 'hubspot_access_token' ) ) . '"
                                
                                    />

                                    <button id="save-hubspot-access-token" class="submit success button">Save</button>

                                    <br/><br/>

                                    <div id="hubspot-lists-message"></div>

                                    <label>Hubspot Subscriber List</label>

                                    ' . get_hubspot_lists() . '
                            
                                </div>
                        
                            </div>
                    
                
                        </div>
                
                    </li>

                </ul>
                
            </div>
            
        ';

        _e ( $accordion );

    }

}

if ( ! function_exists ( 'get_woocommerce_image' ) ) {

    function get_woocommerce_image ( $product_id, $image_size = 'single-post-thumbnail' ) {

        return wp_get_attachment_image_src (

            get_post_thumbnail_id ( $product_id ),

            $image_size ) [0];

    }

}

if ( ! function_exists ( 'get_images_gallery' )) {

    function get_images_gallery ( $attachment_ids, $image_size = 'thumbnail' ) {

        $attachments = [];

        sort ( $attachment_ids );

        foreach ( $attachment_ids as $attachment_id ) {

            $attachments [ $attachment_id ] = wp_get_attachment_image ( $attachment_id, $image_size );

        }

        return $attachments;

    }

}

if ( ! function_exists ( 'get_product_attachment_ids' ) ) {

    function get_product_attachment_ids ( $product ) {

        return $product->get_gallery_image_ids ();

    }

}


add_action ( 'add_meta_boxes', 'create_product_specs_meta_box' );

if ( ! function_exists ( 'create_product_specs_meta_box' ) ) {

    function create_product_specs_meta_box () {

        add_meta_box (

            'custom_product_specs_meta_box',

            __( 'Specification', 'foundation-woocommerce' ),

            'add_specs_meta_box',

            'product',

            'normal',

            'default'

        );

    }

}

if ( ! function_exists ( 'add_specs_meta_box' ) ) {

    function add_specs_meta_box ( $post ) {

        $product = wc_get_product ( $post->ID );

        $content = wp_unslash ( $product->get_meta ( 'specs' ) );

        _e ( '<div class="product_specs">', 'foundation-woocommerce' );

        wp_editor ( $content, 'specs', ['textarea_rows' => 10]);

        _e ( '</div>', 'foundation-woocommerce' );

    }

}

add_action ( 'woocommerce_admin_process_product_object', 'save_product_specs_wysiwyg_field', 10, 1 );


if ( ! function_exists ( 'save_product_specs_wysiwyg_field' ) ) {

    function save_product_specs_wysiwyg_field ( $product ) {

        if (  isset( $_POST['specs'] ) )

             $product->update_meta_data ( 'specs', wp_kses_post ( $_POST['specs'] ) );

    }

}

add_filter ( 'woocommerce_product_tabs', 'add_specs_product_tab', 10, 1 );

if ( ! function_exists ( 'add_specs_product_tab' ) ) {

    function add_specs_product_tab ( $tabs ) {

        $tabs ['specs_tab'] = array (

            'title'         => __( 'Specification', 'foundation-woocommerce' ),

            'priority'      => 50,

            'callback'      => 'display_specs_product_tab_content'

        );

        return $tabs;

    }

}

if ( ! function_exists ( 'display_specs_product_tab_content' ) ) {

    function display_specs_product_tab_content () {

        global $product;

        _e ( wp_unslash ( $product->get_meta ( 'specs' ) ), 'foundation-woocommerce' );

    }

}

add_action ( 'add_meta_boxes', 'create_product_warranty_meta_box' );

if ( ! function_exists ( 'create_product_warranty_meta_box' ) ) {

    function create_product_warranty_meta_box () {

        add_meta_box (

            'custom_product_warranty_meta_box',

            __( 'Warranty Info', 'foundation-woocommerce' ),

            'add_warranty_meta_box',

            'product',

            'normal',

            'default'

        );

    }

}

if ( ! function_exists ( 'add_warranty_meta_box' ) ) {

    function add_warranty_meta_box ( $post ) {

        $product = wc_get_product ( $post->ID );

        $content = wp_unslash ( $product->get_meta ( 'warranty' ) );

        _e ( '<div class="product_warranty">', 'foundation-woocommerce' );

        wp_editor ( $content, 'warranty', ['textarea_rows' => 10]);

        _e ( '</div>', 'foundation-woocommerce' );

    }

}

add_action ( 'woocommerce_admin_process_product_object', 'save_product_warranty_wysiwyg_field', 10, 1 );

if ( !function_exists ( 'save_product_warranty_wysiwyg_field' ) ) {

    function save_product_warranty_wysiwyg_field ( $product ) {

        if (  isset( $_POST['warranty'] ) )

             $product->update_meta_data ( 'warranty', wp_kses_post ( $_POST['warranty'] ) );

    }

}

add_filter ( 'woocommerce_product_tabs', 'add_warranty_product_tab', 10, 1 );

if ( ! function_exists ( 'add_warranty_product_tab' ) ) {

    function add_warranty_product_tab ( $tabs ) {

        $tabs ['warranty_tab'] = array (

            'title'         => __( 'Warranty Info', 'foundation-woocommerce' ),

            'priority'      => 50,

            'callback'      => 'display_warranty_product_tab_content'

        );

        return $tabs;
    }

}

if ( ! function_exists ( 'display_warranty_product_tab_content' ) ) {

    function display_warranty_product_tab_content () {

        global $product;

        _e ( wp_unslash ( $product->get_meta ( 'warranty' ) ), 'foundation-woocommerce' );

    }

}

add_action ( 'add_meta_boxes', 'create_product_shipping_meta_box' );

if ( ! function_exists ( 'create_product_shipping_meta_box' ) ) {

    function create_product_shipping_meta_box () {

        add_meta_box (

            'custom_product_shipping_meta_box',

            __( 'Shipping Info', 'foundation-woocommerce' ),

            'add_shipping_meta_box',

            'product',

            'normal',

            'default'

        );

    }

}

if ( ! function_exists ( 'add_shipping_meta_box' ) ) {

    function add_shipping_meta_box ( $post ) {

        $product = wc_get_product ( $post->ID );

        $content = wp_unslash ( $product->get_meta ( 'shipping' ) );

        _e ( '<div class="product_shipping">', 'foundation-woocommerce' );

        wp_editor ( $content, 'shipping', ['textarea_rows' => 10]);

        _e ( '</div>', 'foundation-woocommerce' );
    }

}

add_action( 'woocommerce_admin_process_product_object', 'save_product_shipping_wysiwyg_field', 10, 1 );

if ( ! function_exists ( 'save_product_shipping_wysiwyg_field' ) ) {

    function save_product_shipping_wysiwyg_field ( $product ) {

        if (  isset( $_POST['shipping'] ) )

             $product->update_meta_data ( 'shipping', wp_kses_post ( $_POST['shipping'] ) );

    }

}

add_filter ( 'woocommerce_product_tabs', 'add_shipping_product_tab', 10, 1 );

if ( ! function_exists ( 'add_shipping_product_tab' ) ) {

    function add_shipping_product_tab ( $tabs ) {

        $tabs ['shipping_tab'] = array (

            'title'         => __( 'Shipping Info', 'foundation-woocommerce' ),

            'priority'      => 50,

            'callback'      => 'display_shipping_product_tab_content'

        );

        return $tabs;
    }

}

if ( ! function_exists ( 'display_shipping_product_tab_content' ) ) {
    function display_shipping_product_tab_content () {

        global $product;

        _e ( wp_unslash ( $product->get_meta ( 'shipping' ) ), 'foundation-woocommerce' );

    }
}


add_action ( 'add_meta_boxes', 'create_product_seller_meta_box' );

if ( ! function_exists ( 'create_product_seller_meta_box' ) ) {

    function create_product_seller_meta_box () {

        add_meta_box (

            'custom_product_seller_meta_box',

            __( 'Seller Profile', 'foundation-woocommerce' ),

            'add_seller_meta_box',

            'product',

            'normal',

            'default'

        );
    }
}

if ( ! function_exists ( 'add_seller_meta_box' ) ) {
    function add_seller_meta_box ( $post ) {

        $product = wc_get_product ( $post->ID );

        $content = wp_unslash ( $product->get_meta ( 'seller' ) );

        _e ( '<div class="product_seller">', 'foundation-woocommerce' );

        wp_editor ( $content, 'seller', ['textarea_rows' => 10]);

        _e ( '</div>', 'foundation-woocommerce' );
    }
}

add_action( 'woocommerce_admin_process_product_object', 'save_product_seller_wysiwyg_field', 10, 1 );

if ( ! function_exists ( 'save_product_seller_wysiwyg_field' ) ) {

    function save_product_seller_wysiwyg_field ( $product ) {

        if (  isset( $_POST['seller'] ) )

            $product->update_meta_data ( 'seller', wp_kses_post ( $_POST['seller'] ) );
    }

}


add_filter ( 'woocommerce_product_tabs', 'add_seller_product_tab', 10, 1 );

if ( ! function_exists ( 'add_seller_product_tab' ) ) {

    function add_seller_product_tab ( $tabs ) {

        $tabs ['seller_tab'] = array (

            'title'         => __( 'Seller Profile', 'foundation-woocommerce' ),

            'priority'      => 50,

            'callback'      => 'display_seller_product_tab_content'

        );

        return $tabs;
    }

}


if ( ! function_exists ( 'display_seller_product_tab_content' ) ) {

    function display_seller_product_tab_content () {

        global $product;

        _e ( wp_unslash ( $product->get_meta ( 'seller' ) ), 'foundation-woocommerce' );

    }

}     

add_action( 'wp_ajax_nopriv_subscriber_email', 'ajax_post_subscriber_email_handler' );

if ( !function_exists ( 'ajax_post_subscriber_email_handler' ) ) {

    function ajax_post_subscriber_email_handler ( $subscriber_email ) {

        $hubspot_acess_token = get_option ( 'hubspot_access_token' );

        $hubspot_list_url = 'https://api.hubapi.com/contacts/v1/lists/' . get_option ( 'hubspot_list_id' ) . '/add';

        $body = [

            'Email' => $subscriber_email,

        ];

        $body = json_encode( $body );

        $args = [

            'body'        => $body,

            'headers'     => [

                'Authorization' => "Bearer ${hubspot_acess_token}",
    
                'Content-Type' => 'application/json'

            ],

            'timeout'     => 60,

            'redirection' => 5,

            'blocking'    => true,

            'httpversion' => '1.0',

            'sslverify'   => false,

            'data_format' => 'body',

        ];

        $response = wp_remote_post ( $hubspot_list_url, $args );

        if ( $response['response']['code'] === 200 ) {
                
            return $response;

        } else {

            return 'There was an error subscribing to the list. Please try again later';

        }

        wp_die();

    }   

}

function get_hubspot_lists ( ) {

    $hubspot_acess_token = get_option ( 'hubspot_access_token' );

    $hubspot_private_app_url = 'https://api.hubapi.com/contacts/v1/lists';
    
    $args = array (

        'headers' => array (

            'Authorization' => "Bearer ${hubspot_acess_token}",
    
            'Content-Type' => 'application/json'

        )

    );

    $response = wp_remote_get ( $hubspot_private_app_url, $args );

    if ( $response['response']['code'] === 200 ) {

        $body = json_decode($response['body']);

        $lists = $body->lists;

        $select = '<select id="hubspot-lists" name="hubspot-lists">';

        foreach ( $lists as $list ) {

            $select .= '<option value="' . $list->listId . '">' . $list->name . '</option>';

        }

        $select .= '</select>';

        return $select;

    } else {

        return 'There was an error selecting subscriber list. Please try again later';

    }

}

if ( ! function_exists ( 'getMenu' ) ) {

    function getMenu ( ) {

        if ( has_nav_menu ( 'primary' ) ) {

            $theme_location = wp_get_nav_menu_name ( 'primary' );

            $menu_items = wp_get_nav_menu_items ( $theme_location );

      	         function buildMenu ( $ID, $menu_items ) {

    	             $menu = array ();

    	             foreach ( $menu_items as $menu_item ) {

                         if ( ( int ) $menu_item->menu_item_parent === $ID )  {

                             $menu[ $menu_item->title ] = array (

    		                      'url'      => $menu_item->url,

    		                      'children' => buildMenu ( $menu_item->ID, $menu_items )

                              );

                         }

    	             }

    	             return $menu;
                 }

            return buildMenu ( 0, $menu_items );

        }

    }

}

if ( ! function_exists ( 'generateMenuHiarchy' ) ) {

  function generateMenuHiarchy () {

      $menus = getMenu ();

      function buildMenuChildren ( $menus ) {

          $menu_hiarchy = '';

          foreach ( $menus as $key => $menu ) {

              if( is_array ( $menu['children'] ) && ! empty ( $menu['children'] ) ) {

                  $menu_hiarchy .= '

                      <li class="nav-item dropdown">

                          <a class="nav-link dropdown-toggle"

                            href="' . $menu['url'] . '" role="button"

                            data-bs-hover="dropdown"

                            aria-expanded="false"

                          >
                            ' . $key . '
                          </a>

                              <ul class="dropdown-menu">';

                                  foreach ( $menu['children'] as $key => $menu ) {

                                      $menu_hiarchy .= '<li><a class="dropdown-item" href="' . $menu['url'] . '">' . $key . '</a></li>';

                                  }

                                  $menu_hiarchy .=

                              '</ul>

                        </li>';

               } else {

                   $menu_hiarchy .= '

                        <li class="nav-item">

                          <a class="nav-link" href="' . $menu['url'] . '">' . $key . '</a>

                        </li>

                      ';

               }
           }

           return $menu_hiarchy;

    }

    return buildMenuChildren ( $menus );

  }

}

?>
