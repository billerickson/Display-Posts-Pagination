<?php
/**
 * Plugin Name: Display Posts - Pagination
 * Plugin URI: https://github.com/billerickson/Display-Posts-Pagination
 * Description: Allow results of Display Posts to be paginated
 * Version: 1.0.0
 * Author: Bill Erickson
 * Author URI: https://www.billerickson.net
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Display Posts -  Pagination Links
 */
function be_dps_pagination_links( $output, $atts, $listing ) {
	if ( empty( $atts['pagination'] ) || ! empty( $atts['offset'] ) ) {
		return $output;
	}

	global $wp;
	$base = home_url( $wp->request );

	$format = 'dps_paged';
	if ( intval( $atts['pagination'] ) > 1 ) {
		$format .= '_' . intval( $atts['pagination'] );
	}
	$format = '?' . $format . '=%#%';

	$current = ! empty( $listing->query['paged'] ) ? $listing->query['paged'] : 1;

	$args = array(
		'base'      => trailingslashit( $base ) . $format,
		'format'    => $format,
		'current'   => $current,
		'total'     => $listing->max_num_pages,
		'prev_text' => __( 'Previous' ),
		'next_text' => __( 'Next' ),
	);

	$nav_output = '';
	$navigation = paginate_links( apply_filters( 'display_posts_shortcode_paginate_links', $args, $atts ) );
	if ( $navigation ) {
		$nav_output     .= '<nav class="display-posts-pagination" role="navigation">';
			$nav_output .= '<h2 class="screen-reader-text">Navigation</h2>';
			$nav_output .= '<div class="nav-links">' . $navigation . '</div>';
		$nav_output     .= '</nav>';
	}

	if ( ! empty( $atts['pagination_inside'] ) && filter_var( $atts['pagination_inside'], FILTER_VALIDATE_BOOLEAN ) ) {
		$output = $nav_output . $output;
	} else {
		$output .= $nav_output;
	}

	return $output;
}
add_filter( 'display_posts_shortcode_wrapper_close', 'be_dps_pagination_links', 10, 3 );

/**
 * Display Posts - Pagination Args
 */
function be_dps_pagination_args( $args, $atts ) {
	if ( empty( $atts['pagination'] ) ) {
		return $args;
	}

	$format = 'dps_paged';
	if ( intval( $atts['pagination'] ) > 1 ) {
		$format .= '_' . intval( $atts['pagination'] );
	}

	if ( ! empty( $_GET[ $format ] ) ) {
		$args['paged'] = intval( $_GET[ $format ] );
	}

	return $args;
}
add_filter( 'display_posts_shortcode_args', 'be_dps_pagination_args', 10, 2 );
