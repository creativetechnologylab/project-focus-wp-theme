<?php
/*
 *    Copyright (C) 2016 Project Focus Wordpress Theme
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU Affero General Public License as
 *    published by the Free Software Foundation, either version 3 of the
 *    License, or (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

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
