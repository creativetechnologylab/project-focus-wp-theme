<?php

$single = __( 'Project', '' );
$plural = __( 'Projects', '' );

$labels = array(
  "name" => $plural,
  "singular_name" => $single,
  "all_items" => "All $plural",
  "add_new_item" => "Add New $single",
  "edit" => "Edit",
  "edit_item" => "Edit $single",
  "new_item" => "New $single",
  "view" => "View",
  "view_item" => "View $single",
);

$args = array(
  "label" => __( 'Projects', '' ),
  "labels" => $labels,
  "public" => true,
  "hierarchical" => false,
  "label" => "Projects",
  "show_ui" => true,
  "show_in_menu" => true,
  "show_in_nav_menus" => true,
  "query_var" => true,
  "rewrite" => array( 'slug' => 'project', 'with_front' => true, ),
  "show_admin_column" => true,
  "show_in_rest" => false,
  "rest_base" => "",
  "show_in_quick_edit" => true,
);
register_taxonomy( "project", array( "post" ), $args );

