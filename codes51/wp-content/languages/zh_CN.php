<?php
// 优化字体
function admin_area_beautifier() { ?>
	<style type="text/css">
		.wrap h2,
		#footer,
		#footer a,
		#dashboard_right_now p.sub,
		.tablenav .displaying-num,
		.inline-edit-row fieldset span.title,
		.inline-edit-row fieldset span.checkbox-title,
		.setting-description,
		.form-wrap p,
		#utc-time,
		#local-time,
		.howto,
		#media-upload p.help,
		#media-upload label.help
		{
			font-style: normal !important;
		}
		
		#screen-meta a.show-settings,
		#favorite-actions a,
		#adminmenu .wp-submenu a,
		.submit input,
		.button,
		.button-primary,
		.button-secondary,
		.button-highlighted,
		#postcustomstuff .submit input,
		#the-comment-list .comment-item p.comment-actions,
		.hndle a,
		#dashboard_quick_press #media-buttons,
		.subsubsub,
		#wpcontent select,
		.widefat td, .widefat th,
		.inline-edit-row fieldset ul.cat-checklist label,
		.inline-edit-row .catshow,
		.inline-edit-row .cathide,
		.inline-edit-row #bulk-titles div,
		.form-wrap p,
		.form-wrap label,
		.widefat td p,
		#poststuff .inside,
		#poststuff .inside p,
		.form-table td,
		#wpbody-content .describe td,
		kbd,
		code,
		#edithead .inside,
		#edithead .inside input,
		ul#widget-list li.widget-list-item div.widget-description,
		.widget-control-edit,
		li.widget-list-control-item div.widget-control,
		.postbox p,
		.postbox ul,
		.postbox ol,
		.postbox blockquote,
		#wp-version-message
		{
			font-size:12px !important;
		}
		
		#wphead h1 a span
		{
			font-size:12px !important;
		}
		
		a {
			text-decoration:none;
		}
		
		#active-plugins-table .num, #posts-filter #author, #posts-filter #tags {
			min-width:50px !important;
		}
		
		.inline-editor .date input[name="aa"], #posts-filter #comments,#posts-filter #description{
			min-width:35px !important;
		}
		
		.tablenav select#cat {
			width:135px !important;
		}
		
		#adv-settings label,#posts-filter #name {
			min-width:10em !important;
		}

		#dashboard_right_now td.first {
			width:40px;
		}

		#dashboard_right_now td.last {
			width:60px;
		}
	</style>
<?php
}
add_action('admin_head', 'admin_area_beautifier');

function login_area_beautifier() {
?>
<style type="text/css">
p.forgetmenot label,
p.message,
#nav a,
#backtoblog {
	font-style: normal !important;
	font-size:12px !important;
}
</style>
<?php
}
add_action('login_head', 'login_area_beautifier');

function wp_version_check_mod() {
	if ( defined('WP_INSTALLING') )
		return;

	global $wp_version, $wpdb;
	$php_version = phpversion();

	$current = get_option( 'update_core' );
	if ( ! is_object($current) )
		$current = new stdClass;

	$locale = 'en_US';
	if (
		isset( $current->last_checked ) &&
		43200 > ( time() - $current->last_checked ) &&
		$current->version_checked == $wp_version &&
		$locale == $current->updates[0]->locale
	)
		return false;

	// Update last_checked for current to prevent multiple blocking requests if request hangs
	$current->last_checked = time();
	update_option( 'update_core', $current );

	if ( method_exists( $wpdb, 'db_version' ) )
		$mysql_version = preg_replace('/[^0-9.].*/', '', $wpdb->db_version($wpdb->users));
	else
		$mysql_version = 'N/A';
	$local_package = isset( $wp_local_package )? $wp_local_package : '';
	$url = "http://api.wordpress.org/core/version-check/1.3/?version=$wp_version&php=$php_version&locale=$locale&mysql=$mysql_version&local_package=$local_package";

	$options = array('timeout' => 3);
	$options['headers'] = array(
		'Content-Type' => 'application/x-www-form-urlencoded; charset=' . get_option('blog_charset'),
		'User-Agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
	);

	$response = wp_remote_request($url, $options);

	if ( is_wp_error( $response ) )
		return false;

	if ( 200 != $response['response']['code'] )
		return false;

	$body = trim( $response['body'] );
	$body = str_replace(array("\r\n", "\r"), "\n", $body);
	$new_options = array();
	foreach( explode( "\n\n", $body ) as $entry) {
		$returns = explode("\n", $entry);
		$new_option = new stdClass();
		$new_option->response = attribute_escape( $returns[0] );
		if ( isset( $returns[1] ) )
			$new_option->url = clean_url( $returns[1] );
		if ( isset( $returns[2] ) )
			$new_option->package = clean_url( $returns[2] );
		if ( isset( $returns[3] ) )
			$new_option->current = attribute_escape( $returns[3] );
		if ( isset( $returns[4] ) )
			$new_option->locale = attribute_escape( $returns[4] );
		$new_options[] = $new_option;
	}

	$updates = new stdClass();
	$updates->updates = $new_options;
	$updates->last_checked = time();
	$updates->version_checked = $wp_version;
	update_option( 'update_core',  $updates);
}
remove_action('init', 'wp_version_check', 12);
add_action('init', 'wp_version_check_mod', 13);
?>