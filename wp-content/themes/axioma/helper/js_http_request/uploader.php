<?php

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0] . 'wp-load.php';
require_once($wp_load);
wp();
// Load JsHttpRequest backend.
require_once "JsHttpRequest.php";
// Create main library object. You MUST specify page encoding!
$JsHttpRequest = & new JsHttpRequest("utf-8");
//***
$md5 = md5(file_get_contents($_FILES['file']['tmp_name']));
mkdir(TMM_Helper::get_tmp_folder() . $md5 . '/', 0777);
$new_file_path = TMM_Helper::get_tmp_folder() . $md5 . '/' . $_FILES['file']['name'];
copy($_FILES['file']['tmp_name'], $new_file_path);

// Below is stream data (will appear in req.responseText).
$res = array();
if (is_file($new_file_path)) {
	$res = array(
		'name' => $_FILES['file']['name'],
		'file_path' => $new_file_path
	);
}
echo json_encode($res);
exit;


