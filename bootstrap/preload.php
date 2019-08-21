<?php
if (!function_exists('array_merge_recursive_distinct')) {
	function array_merge_recursive_distinct(array $Original, array $Source) {
		foreach ($Source as $key => $value) {
			if (is_array($value) && isset($Original[$key]) && is_array($Original[$key])) {
				$Original[$key] = array_merge_recursive_distinct($Original[$key], $value);
			} elseif (is_numeric($key)) {
				array_push($Original, $value);
			} else {
				$Original[$key] = $value;
			}
		}

		return $Original;
	}
}
