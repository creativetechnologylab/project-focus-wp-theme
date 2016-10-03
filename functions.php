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

include 'lib/plugin-activation.php';

if ( ! class_exists( 'Timber' ) ) {
  if ( is_admin() == false ) {
	echo '<div class="error"><p>There are missing plugins that need to be installed or activated. Make sure you <a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins&plugin_status=install' ) ) . '">activate and install the required plugins</a>.</p></div>';
    die();
  }
  return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

  public $image_sizes = array(
    'thumbnail' => array(256, 256, true),
    'small'     => array(400, 300, true),
    'medium'    => array(800, 600, true),
    'large'     => array(1000, 750, true)
  );

	function __construct() {
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'init', array( $this, 'register_custom_fields' ) );
    add_action( 'pre_get_posts', array($this, 'exclude_sticky') );

    $this->add_image_sizes();

		parent::__construct();
	}

  function register_custom_fields() {
    include_once "custom-fields/post.php";
  }

	function register_taxonomies() {
    include_once "custom-taxonomies/project.php";
	}

	function add_to_context( $context ) {
    $context['projects'] = Timber::get_terms('project');
		$context['menu'] = new TimberMenu('main');
		$context['footer'] = new TimberMenu('footer');
		$context['site'] = $this;
		return $context;
	}

  public function add_image_sizes() {
    foreach($this->image_sizes as $name => $details){
      if(in_array($name, array('medium', 'large')) == true){
        update_option("${name}_size_w", $details[0]);
        update_option("${name}_size_h", $details[1]);
        update_option("${name}_crop", $details[2]);
      } else {
        add_image_size($name, $details[0], $details[1], $details[2]);
      }
    }
  }

  public function exclude_sticky( $query ) {
    $sticky = get_option('sticky_posts');
    if ( $query->is_home() && $query->is_main_query() ) {
      $query->set( 'post__not_in', $sticky );
    }
  }

}

new StarterSite();
