=== Quick Drafts Access ===
Contributors: coffee2code
Donate link: http://coffee2code.com/donate
Tags: draft, drafts, admin, menu, post, page, post_type, shortcut, coffee2code
Requires at least: 3.0
Tested up to: 3.0.1
Stable tag: 1.0
Version: 1.0

Adds a link to Drafts under the Posts, Pages, and other custom post type sections in the admin menu.


== Description ==

Adds a link to Drafts under the Posts, Pages, and other custom post type sections in the admin menu.

By default in WordPress, in order to access the drafts of any given post type (including posts and pages) in the admin, you'd have to:

* Go to (or start from) the admin dashboard and then click "View all" in the "Recent Drafts" dashboard widget.
    * Assumes you have the "Recent Drafts" dashboard widget set to display.  Add a step if you have to expand the widget.
    * The "Recent Drafts" dashboard widget only lists drafts of posts (not of pages or other post types)
    * "View All" link only takes you to the drafts of posts (not of pages or other post types)

_or_

* Use the main admin menu to go to the section you want (i.e. "Posts"), then click the "Draft" link to list the drafts.

This plugin allows you one click access to the drafts of each post type, via the main admin menu.

In addition, the plugin provides a count of the number of current drafts for that post type in the link (i.e. the link could read "Drafts (3)" to indicate there are three drafts for that post type).

The plugin hides the "Drafts" link when no drafts for that post type are present.  See the Filters section for how to override this behavior.

Also, the menu item only appears for users who have the capability to edit posts of that post type.


== Installation ==

1. Unzip `quick-drafts-access.zip` inside the `/wp-content/plugins/` directory (or install via the built-in WordPress plugin installer)
1. Activate the plugin through the 'Plugins' admin menu in WordPress


== Screenshots ==

1. A screenshot of the main admin menu (with the menu expanded) showing the Drafts link (with pending draft counts for both posts and pages).
2. A screenshot of the main admin menu (collapsed) showing the Drafts link (with count) when hovering over "Posts"


== Frequently Asked Questions ==

= Why don't I see a "Drafts" link in my menu after activating the plugin? =

Does that post type have any drafts?  By default, the plugin does NOT display the drafts link if no drafts are present for that post type.  This behavior can be overridden (see the Filters section).

= Why don't you show the "Drafts" link for post types that don't have any drafts? =

Like the Posts and Pages admin tables in WordPress, the default behavior of the plugin is to not show the drafts link if none are present for the post type since there isn't anything meaningful to link to.  Bear in mind that the behavior can be overridden (see the Filters section).


== Filters ==

The plugin is further customizable via two filters. Typically, these customizations would be put into your active theme's functions.php file, or used by another plugin.

= c2c_quick_drafts_access_post_types =

The 'c2c_quick_drafts_access_post_types' filter allows you to customize the list of post_types for which a 'Drafts' link will be shown.  By default, a 'Drafts' link will be shown for all public post types, which includes the default post types of 'post' and 'page'.  If other post types have been added to your site, they will also automatically be taken into consideration.  If you want to explicitly add or remove particular post types, use this filter.

Arguments:

* $post_types (array): Array of post type objects

Example:

`add_filter( 'c2c_quick_drafts_access_post_types', 'my_qda_mods' );
function my_qda_mods( $post_types ) {
    $acceptable_post_types = array();
    foreach ( $post_types as $post_type ) {
        // Don't show the Drafts link for 'event' post type
        if ( !in_array( $post_type->name, array( 'event' ) ) ) // More post types can be added to this array
            $acceptable_post_types[] = $post_type;
    }
    return $acceptable_post_types;
}`

= c2c_quick_drafts_access_show_if_empty =

The 'c2c_quick_drafts_access_show_if_empty' filter allows you to customize whether the 'Drafts' link will appear for a post type _when that post type currently has no drafts_.

Arguments:

* $show (bool): The default boolean indicating if the Drafts link should be shown if the post type does not have any drafts. Default is false.
* $post_type_name (string): The post_type name
* $post_type (object): The post_type object

Example:

`
// Show the link to Drafts even if no drafts exist for the post type.
add_filter( 'c2c_quick_drafts_access_show_if_empty', '__return_true' );
`


== Changelog ==

= 1.0 =
* Initial release