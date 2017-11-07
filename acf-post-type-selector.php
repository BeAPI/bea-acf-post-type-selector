<?php
/*
Plugin Name: Advanced Custom Fields: Post type selector
Description: Add a post type selector field
Version: 2.0.0
Author: BeApi
Author URI: www.beapi.fr
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


class AcfFieldPostTypeSelectorPlugin {
	/**
	*  Construct
	*
	*  @description:
	*  @since: 3.6
	*  @created: 1/04/13
	 * @author Nicolas Juen
	*/

	function __construct() {
		// version 4+
		add_action( 'acf/register_fields', array( __CLASS__, 'register_v4_fields' ) );

		// version 5+
		add_action( 'acf/include_field_types', array( __CLASS__, 'register_v5_fields' ) );
	}

	/**
	*  register_fields for ACF 4
	*
	*  @description:
	*  @since: 3.6
	*  @created: 1/04/13
	 * @author Nicolas Juen
	*/
	public static function register_v4_fields() {
		include_once( 'post-type-selector-v4.php' );
	}

	/**
	 * Register ACF 5 fields
	 */
	public static function register_v5_fields() {
		include_once( 'post-type-selector-v5.php' );
	}
}

add_action( 'plugins_loaded', 'acf_field_post_type_selector_load' );
function acf_field_post_type_selector_load() {
	new AcfFieldPostTypeSelectorPlugin();
}
