<?php
/**
 * @package Quick_Drafts_Access
 * @author Scott Reilly
 * @version 1.1.1
 */
/*
Plugin Name: Quick Drafts Access
Version: 1.1.1
Plugin URI: http://coffee2code.com/wp-plugins/quick-drafts-access/
Author: Scott Reilly
Author URI: http://coffee2code.com
Description: Adds a link to Drafts under the Posts, Pages, and other custom post type sections in the admin menu.

Compatible with WordPress 3.0+, 3.1+, 3.2+, 3.3+.

=>> Read the accompanying readme.txt file for instructions and documentation.
=>> Also, visit the plugin's homepage for additional information and updates.
=>> Or visit: http://wordpress.org/extend/plugins/quick-drafts-access/
*/

/*
Copyright (c) 2010-2011 by Scott Reilly (aka coffee2code)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy,
modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR
IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

if ( is_admin() && ! class_exists( 'c2c_QuickDraftsAccess' ) ) :

class c2c_QuickDraftsAccess {

	function init() {
		add_action( 'admin_menu', array( __CLASS__, 'quick_drafts_access' ) );
	}

	function quick_drafts_access() {
		$post_types = (array) get_post_types( array( 'show_ui' => true ), 'object' );
		$post_types = apply_filters( 'c2c_quick_drafts_access_post_types', $post_types );
		$post_status = null;

		foreach ( $post_types as $post_type ) {
			$name = $post_type->name;
			$num_posts = wp_count_posts( $name, 'readable' );
			$num_drafts = $num_posts->draft;

			if ( ( $num_drafts > 0 ) || apply_filters( 'c2c_quick_drafts_access_show_if_empty', false, $name, $post_type ) ) {
				$path = 'edit.php';
				if ( 'post' != $name ) // edit.php?post_type=post doesn't work
					$path .= '?post_type=' . $name;

				if ( ! $post_status )
					$post_status = get_post_status_object( 'draft' );

				add_submenu_page( $path, __( 'Drafts' ),
					sprintf( translate_nooped_plural( $post_status->label_count, $num_drafts ), number_format_i18n( $num_drafts ) ),
					$post_type->cap->edit_posts, "edit.php?post_type=$name&post_status=draft" );
			}
		}
	}

}

c2c_QuickDraftsAccess::init();

endif;
?>