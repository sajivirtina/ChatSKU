<?php
/**
 * ACF Options Page Registration
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_options_page' ) ) return;

// Main ChatSKU Settings page
acf_add_options_page( [
    'page_title' => 'ChatSKU Settings',
    'menu_title' => 'ChatSKU Settings',
    'menu_slug'  => 'chatsku-settings',
    'capability' => 'edit_posts',
    'icon_url'   => 'dashicons-format-chat',
    'position'   => 25,
    'redirect'   => false,
] );

// Sub-pages for organization
acf_add_options_sub_page( [
    'page_title'  => 'Header & Navigation',
    'menu_title'  => 'Header & Nav',
    'parent_slug' => 'chatsku-settings',
] );

acf_add_options_sub_page( [
    'page_title'  => 'Footer Settings',
    'menu_title'  => 'Footer',
    'parent_slug' => 'chatsku-settings',
] );

acf_add_options_sub_page( [
    'page_title'  => 'Global Links & URLs',
    'menu_title'  => 'Global Links',
    'parent_slug' => 'chatsku-settings',
] );
