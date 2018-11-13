<?php

/**
 * Various helper functions definition related to Codexin Core
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );


if ( ! function_exists( 'codexin_retrieve_img_src' ) ) {
    /**
     * Helper Function for retrieving Image URL
     *
     * @param   int         $image          The ID of the image
     * @param   mixed       $image_size     The registered image size
     * @return  string
     * @since   v1.0
     */
    function codexin_retrieve_img_src( $image, $image_size ) {

       $img_src     = wp_get_attachment_image_src( $image, $image_size );
       $img_source  = $img_src[0];
       return $img_source;
    }
}


if ( ! function_exists( 'codexin_retrieve_url' ) ) {
    /**
     * Helper Function for retrieving page URL, title and target
     *
     * @param   string         $href          The string containing URL, title and target attribute
     * @return  array
     * @since   v1.0
     */
    function codexin_retrieve_url ( $href ) {

        if ( ! empty( $href ) ) {
            $link_arr = explode( "|", $href );

            ( ! empty( $link_arr[0] ) ) ? $link_url = $link_arr[0] : $link_url = '';
            ( ! empty( $link_arr[1] ) ) ? $cx_link_title = $link_arr[1] : $cx_link_title = '';
            ( ! empty( $link_arr[2] ) ) ? $link_target = $link_arr[2] : $link_target = '';

            return array( $link_url, $cx_link_title, $link_target );
        }
    }
}


if ( ! function_exists( 'codexin_retrieve_alt_tag' ) ) {
    /**
     * Helper Function for retrieving image alt tag
     *
     * @return  string
     * @since   v1.0
     */
    function codexin_retrieve_alt_tag() {

        global $post;
        $attachment_id  = get_post_thumbnail_id( $post->ID );
        $image          = wp_prepare_attachment_for_js( $attachment_id );
        $alt            = $image['alt'];
        return $alt;
    }
}


if ( ! function_exists( 'codexin_get_post_categories' ) ) {
    /**
     * Helper function to fetch all post categories
     *
     * @return  array
     * @since   v1.0
     */
    function codexin_get_post_categories() {

        $categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC'
        ) );

        $post_cat = array();
        if ( $categories ) {
            foreach ( $categories as $value ) {
                $post_cat[$value->term_id] = ucwords( strtolower( $value->name ) ) . ' (Posts Count: '. $value->category_count .' )';
            }
        } else {
            $post_cat[0] = esc_html__( 'No Categories found', 'codexin' );
        }

        return $post_cat;
    }
}


if ( ! function_exists( 'codexin_get_custom_categories' ) ) {
    /**
     * Helper function to fetch all csutom taxonomies by slug
     *
     * @param   string         $custom          The required Slug name
     * @return  array
     * @since   v1.0
     */
    function codexin_get_custom_categories( $custom ) {

        $custom_categories =  get_terms( $custom, array( 'hide_empty' => false) );

        $custom_cat = array();
        if ( $custom_categories ) {
            foreach ( $custom_categories as $value ) {
                $custom_cat[$value->term_id] = ucwords( strtolower( $value->name ) ) . ' ( Posts Count: '. $value->count .' )';
            }
        } else {
            $custom_cat[0] = esc_html__( 'No Categories found', 'codexin' );
        }

        return $custom_cat;
    }
}