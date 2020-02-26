<?php

// Load stylesheets
function load_css()
{   
  wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
  wp_enqueue_style( 'bootstrap' );

  wp_register_style( 'main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
  wp_enqueue_style( 'main' );
}

add_action( 'wp_enqueue_scripts', 'load_css' );


// Load javascript
function load_js()
{
  wp_enqueue_script('jquery'); // already installed in Wordpress

  wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true );
  wp_enqueue_script( 'bootstrap' );
}

add_action( 'wp_enqueue_scripts', 'load_js' );


// Theme options
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'widgets' );


// Menus
register_nav_menus( 
  array(
    'top-menu' => 'Top Menu Location',
    'mobile-menu' => 'Mobile Menu Location',
    'footer-menu' => 'Footer Menu Location',
  )
);

// Custom Images Sizes
add_image_size( 'blog-large', 800, 400, false );
add_image_size( 'blog-small', 300, 200, true );


// Register Sidebars
function my_sidebars()
{
  register_sidebar(
    array(
      'name' => 'Page Sidebar',
      'id' => 'page-sidebar',
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>'
    )
  );

  register_sidebar(
    array(
      'name' => 'Blog Sidebar',
      'id' => 'blog-sidebar',
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>'
    )
  );
}

add_action('widgets_init', 'my_sidebars');


// Custom Post Types
function my_first_post_type()
{
  $args = array(
    'labels' => array('name' => 'Cars', 'singula_name', 'Car'),
    'hierarchical' => true, // true like pages false like posts
    'public' => true,
    'has_archive' => true,
    // 'supports' => array('title', 'thumbnail'),
    'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
    //'rewrite' => array('slug' => 'cars'),
    'menu_icon' => 'dashicons-images-alt2' // https://developer.wordpress.org/resource/dashicons/#images-alt2
  );

  register_post_type( 'cars', $args ); // it use single-cars.php or single.php
}

add_action('init', 'my_first_post_type');


function my_first_taxonomy()
{
  $args = array(
    'public' => true,
    'labels' => array('name' => 'Brands', 'singula_name', 'Brand'),
    'hierarchical' => true, // true like a categorie, false like a tag
  );

  register_taxonomy( 'brands', array('cars'), $args ); // you have to save permalinks to refresh them so it can work
}

add_action('init', 'my_first_taxonomy');


add_action('wp_ajax_enquiry', 'enquiry_form'); // wp_ajax is the hook and enquiry because formdata.append('action', 'enquiry');
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form'); // when not loged in
function enquiry_form()
{
  $formdata = [];

  wp_parse_str( $_POST['enquiry'], $formdata );

  $admin_email = get_option( 'admin_email' );

  // Email headers
  $headers[] = 'Content-Type: text/html; charset=UTF-8';
  $headers[] = 'From' . $admin_email;
  $headers[] = 'Reply-to' . $formdata['email']; // name of the input in the form
  
  $send_to = $admin_email;

  $subject = "Enquiry from " . $formdata['fname'] . ' ' . $formdata['lname'];

  $message = '';
  foreach ($formdata as $index => $field) {
    $message .= '<strong>' . $index . '</strong>' . $field . '<br />';
  }

  try {
    if(wp_mail($send_to, $subject, $message, $headers))
    {
      wp_send_json_success( 'Email sent');
    }
    else
    {
      wp_send_json_success( 'Email error ');
    }
  } catch (Exception $e) {
    wp_send_json_error( $e->getMessage() );
  }

  wp_send_json_success( $formdata['fname'] );
}