<?php
/**
 * The file Contains all metaboxes used in the 'Reveal' Theme using Metabox Plugin
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );


add_filter( 'rwmb_meta_boxes', 'codexin_register_meta_boxes' );
/**
 * Function to register all the metaboxes
 *
 * @since 1.0
 */
function codexin_register_meta_boxes( $meta_boxes ) {
    $prefix = 'codexin_';

    // Retrieving the created slider names and ids from Smart Slider
    if ( class_exists( 'SmartSlider3' ) ) {
        global $wpdb; 
        $a = array();
        $b = array();
        $smartsliders = $wpdb->get_results( "SELECT id, title FROM ".$wpdb->prefix."nextend2_smartslider3_sliders" );
        foreach( $smartsliders as $slide ) {
            $a[] = $slide->id;
            $b[] = $slide->title;
        }
        $sliders = array_combine( $a, $b );

    } else {
        $sliders = array();
    }

    /**
     * Metabox for 'Testimonial' Custom Post
     *
     */
    
    // Testimonial Author Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_testimonial_meta',
        'title'         => esc_html__( 'Author Information', 'codexin' ),
        'post_types'    => array( 'testimonial' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Name', 'codexin' ),
                'desc'  => esc_html__( 'Enter Name', 'codexin' ),
                'id'    => $prefix . 'author_name',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Designation', 'codexin' ),
                'desc'  => esc_html__( 'Enter Designation', 'codexin' ),
                'id'    => $prefix . 'author_desig',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),

            array(
                'name'  => esc_html__( 'Company', 'codexin' ),
                'desc'  => esc_html__( 'Enter Company Name', 'codexin' ),
                'id'    => $prefix . 'author_company',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            ),
        ) // End fields
    ); // End codexin_testimonial_meta

    /**
     * Metabox for Pages
     *
     */

    // Page Title Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_page_background_meta_common',
        'title'         => esc_html__( 'Page Title Settings', 'codexin' ),
        'post_types'    => array( 'page', 'portfolio' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'      => esc_html__( 'Disable Page Title Area?', 'codexin' ),
                'desc'      => esc_html__( 'Checking this will disable the Page Title Section', 'codexin' ),
                'id'        => $prefix . 'disable_page_titlesdf',
                'type'      => 'checkbox',
                'clone'     => false,
            ),

            // array(
            //     'name'      => esc_html__( 'Page Title Background Image', 'codexin' ),
            //     'desc'      => esc_html__( 'Upload Page Header Background Image. The Image will be functional for all page templates except \'Page - Home\'. This image will override the page title background image set from theme options ', 'codexin' ),
            //     'id'        => $prefix . 'page_background',
            //     'type'      => 'image_advanced',
            //     'max_file_uploads' => 1,
            //     'max_status'       => true,
            //     'clone'     => false,
            // ),

            array(
                'name'      => esc_html__( 'Page Title Background Image', 'codexin' ),
                'desc'      => esc_html__( 'Upload Page Header Background Image. The Image will be functional for all page templates except \'Page - Home Page\'. This image will override the page title background image set from theme options ', 'codexin' ),
                'id'        => $prefix . 'page_background',
                'type'      => 'background',
            ),

            array(
                'name'      => esc_html__( 'Page Title Alignment', 'codexin' ),
                'desc'      => esc_html__( 'Please Select the Page title alignment to override. If you want default settings, choose \'Global Settings\'', 'codexin' ),
                'id'        => $prefix . 'page_title_alignment',
                'type'      => 'select',
                'options'   => array(
                        'global' => esc_html__( 'Global Settings', 'codexin' ),
                        'left'   => esc_html__( 'Left', 'codexin' ),
                        'center' => esc_html__( 'Center', 'codexin' ),
                        'right'  => esc_html__( 'Right', 'codexin' ),
                    ),

                'std'       => '0',
                'size'  => 95,
            ),

            array(
                'name'      => esc_html__( 'Breadcrumbs Alignment', 'codexin' ),
                'desc'      => esc_html__( 'Please Select the Breadcrumbs alignment to override. If you want default settings, choose \'Global Settings\'', 'codexin' ),
                'id'        => $prefix . 'page_breadcrumb_alignment',
                'type'      => 'select',
                'options'   => array(
                        'global' => esc_html__( 'Global Settings', 'codexin' ),
                        'left'   => esc_html__( 'Left', 'codexin' ),
                        'center' => esc_html__( 'Center', 'codexin' ),
                        'right'  => esc_html__( 'Right', 'codexin' ),
                    ),

                'std'       => '0',
                'size'  => 95,
            ),
        ) // End fields
    ); // End codexin_page_background_meta_common

    // Page Slider Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_page_background_meta',
        'title'         => esc_html__( 'Page Slider Settings', 'codexin' ),
        'post_types'    => array( 'page' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'          => esc_html__( 'Select a Page Slider', 'codexin' ),
                'desc'          => empty( array_filter( $sliders ) ) ? esc_html__( 'Smart Slider is not Activated. Please Activate Smart Slider and try again.', 'codexin' ) : esc_html__( 'Select Slider Name to show on Page header, Please note that, Slider will be functional for \'Page - Home Page\' template only  ', 'codexin' ),
                'id'            => $prefix . 'page_slider',
                'type'          => 'select',
                'options'       => $sliders,
                'placeholder'   => esc_html__( 'Select a Slider', 'codexin' ),
                'clone'         => false,
            ),
        ) // End fields
    ); // End codexin_page_background_meta

    /**
     * Metabox for Posts Formats for 'Posts'
     *
     */

    // Gallery Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'codexin-gallery-meta',
        'title'         => esc_html__( 'Gallery', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Create Gallery', 'codexin' ),
                'desc'  => esc_html__( 'Add images to create a slideshow', 'codexin' ),
                'id'    => $prefix . 'gallery',
                'type'  => 'image_advanced',
            ),
        )
    );

    // Video Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'codexin-video-meta',
        'title'         => esc_html__( 'Video', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Embed Video', 'codexin' ),
                'desc'  => sprintf( '%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Insert Video Links from Youtube, Vimeo and ', 'codexin' ), esc_url( '//codex.wordpress.org/Embeds' ), esc_html__( 'all Video supported sites by WordPress.', 'codexin' ) ),
                'id'    => $prefix . 'video',
                'type'  => 'oembed',
                'size'  => 95
            ),
        )
    );

    // Audio Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'codexin-audio-meta',
        'title'         => esc_html__( 'Audio', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Embed Audio', 'codexin' ),
                'desc'  => sprintf( '%1$s<a href="%2$s" target="_blank">%3$s</a>', esc_html__( 'Insert Audio Links from Soundcloud, Spotify and ', 'codexin' ), esc_url( '//codex.wordpress.org/Embeds' ), esc_html__( 'all Music supported sites by WordPress.', 'codexin' ) ),
                'id'    => $prefix . 'audio',
                'type'  => 'oembed',
                'size'  => 95
            ),
        )
    );

    // Quote Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'codexin-quote-meta',
        'title'         => esc_html__( 'Quote', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Quote Text', 'codexin' ),
                'desc'  => esc_html__( 'Insert The Quote Text', 'codexin' ),
                'id'    => $prefix . 'quote_text',
                'type'  => 'textarea',
                'rows'  => '5'
            ),

            array(
                'name'  => esc_html__( 'Name', 'codexin' ),
                'desc'  => esc_html__( 'Author Name', 'codexin' ),
                'id'    => $prefix . 'quote_name',
                'type'  => 'text',
                'size'  => 80,
            ),

            array(
                'name'  => esc_html__( 'Source', 'codexin' ),
                'desc'  => esc_html__( 'Source URL', 'codexin' ),
                'id'    => $prefix . 'quote_source',
                'type'  => 'url',
                'size'  => 80,
            ),
        )
    );

    // Link Metabox for 'Posts'
    $meta_boxes[] = array(
        'id'            => 'codexin-link-meta',
        'title'         => esc_html__( 'Link', 'codexin' ),
        'post_types'    => array( 'post' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'  => esc_html__( 'Link URL', 'codexin' ),
                'desc'  => esc_html__( 'Insert Link URL', 'codexin' ),
                'id'    => $prefix . 'link_url',
                'type'  => 'text',
                'size'  => 95,
            ),

            array(
                'name'  => esc_html__( 'Link Text', 'codexin' ),
                'desc'  => esc_html__( 'Insert Link Text', 'codexin' ),
                'id'    => $prefix . 'link_text',
                'type'  => 'text',
                'size'  => 95,
            ),

            array(
                'name'    => esc_html__( 'Open link in a new window?', 'codexin' ),
                'desc'    => esc_html__( 'Select "yes" to open link in a new window', 'codexin' ),
                'id'      => $prefix . 'link_target',
                'type'    => 'select',
                'options' => array(
                    '_blank' => esc_html__( 'Yes', 'codexin' ),
                    '_self'  => esc_html__( 'No', 'codexin' ),
                ),

                'std'     => '_blank',
                'size'    => 95,
            ),

            array(
                'name'  => esc_html__( 'Link Relation (Optional)', 'codexin' ),
                'desc'  => esc_html__( 'Set the link "rel" attribute(ex: nofollow, dofollow, etc.)', 'codexin' ),
                'id'    => $prefix . 'link_rel',
                'type'  => 'text',
                'size'  => 95,
            ),
        )
    );

    /**
     * Metabox for 'Clients' Custom Post
     *
     */

    // Client Information Metabox
    $meta_boxes[] = array(
        'id'            => 'codexin_client_logo_meta',
        'title'         => esc_html__( 'Client Information', 'codexin' ),
        'post_types'    => array( 'clients' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'      => esc_html__( 'Client Logo', 'codexin' ),
                'desc'      => esc_html__( 'Upload Client Logo', 'codexin' ),
                'id'        => $prefix . 'client_logo',
                'type'      => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status'       => true,
                'clone'     => false,
            ),

            array(
                'name'  => esc_html__( 'Client Site URL (Optional)', 'codexin' ),
                'desc'  => esc_html__( 'Enter client site URL. Leave blank if you don\'t need it.', 'codexin' ),
                'id'    => $prefix . 'clients_surl',
                'type'  => 'text',
                'clone' => false,
                'size'  => 95
            )
        ) // End fields
    ); // End codexin_client_logo_meta

    return $meta_boxes;
}


