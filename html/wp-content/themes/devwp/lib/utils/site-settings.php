<?php

function get_site_settings() {

	$settings_pages = query_posts([
		'post_type' => POSTTYPE_SETTINGS,
		'post_status' => array( 'publish', 'private' ),
	]);

	$settings = [];

	foreach ($settings_pages as $setting_page) {
		$cur_settings = get_fields($setting_page->ID, false);

		if (!is_array($cur_settings)) {
			continue;
		}

		$settings = array_merge($settings, $cur_settings);
	}

	wp_reset_query();

	return (object) $settings;
}

function get_site_setting($key, $data, $filter = '', $default = null, $field_object = true) {
	if (!isset($data->$key) || empty($data->$key)) {
		return $default;
	}

	if ($field_object && is_array($data->$key) && preg_match('#^field_#', key($data->$key))) {
		return get_value_from_field_array($data->$key);
	}
	
	if ($filter == 'the_content') {
		$data->$key = apply_filters('the_content', $data->$key);
	}

	return $data->$key;
}

function get_value_from_field_array(
	$array, 
	$remove_key_string = '',
	$escapeFilters = []
) {
	$data = [];
	foreach ($array as $key => $value) {
		if (preg_match('#^field#', $key)) {
			$editor = get_field_object($key)['type'] == 'wysiwyg';
			$prop = get_field_object($key)['name'];
			$prop = str_replace($remove_key_string, '', $prop);

			// if (is_array($value)) {
			// 	$data[$prop] = get_value_from_field_array($value);
			// } else {
			$data[$prop] = ($editor && !in_array($prop, $escapeFilters)) 
				? apply_filters('the_content', $value)
				: $value;
			// }
		} else {

			// if (is_array($value)) {
			// 	$data[$prop] = get_value_from_field_array($value);
			// } else {
				$data[$key] = $value;
			// }

		}
	}
	return $data;
}