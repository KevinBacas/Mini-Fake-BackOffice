<?php

  function curPageURL() {
    $pageURL = 'http';
    if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";

    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/',$url);
    $dir = '';
    for ($i = 0; $i < count($parts) - 1; $i++) {
      $dir .= $parts[$i] . '/';
    }

    if (@$_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$dir;
    } else {
      $pageURL .= $_SERVER["SERVER_NAME"].$dir;
    }
    return $pageURL;
  }

  // !!! GLOBAL VARS
  // - GET params names
  define('BASE_URL', curPageURL());
  define('CONTROLLER_URL', BASE_URL . 'index.php');
  define('ACTION_GET', 'action');
  define('FIELDNAME_GET', 'fieldname');
  define('FIELDCONTENT_GET', 'fieldcontent');
  define('CONNECTION_ERROR_GET', 'connection_error');
  define('USERNAME_GET', 'username');
  define('PASSWORD_GET', 'password');
  define('OLD_USERNAME_GET', 'old_username');
  // - Actions
  define('TEST_ACTION_NAME', 'test');
  define('GET_FIELD_ACTION_NAME', 'get_field_content');
  define('AUTH_ACTION_NAME', 'auth');
  define('CONNECT_ACTION_NAME', 'connect');
  define('EDIT_FIELD_ACTION_NAME', 'edit_field');
  define('CREATE_USER_ACTION_NAME', 'create_user');
  define('UPDATE_USER_ACTION_NAME', 'update_user');
  define('DELETE_USER_ACTION_NAME', 'delete_user');
  // - Filenames
  define('XML_TEST_FILENAME', 'qq.xml');
  define('XML_PRODUCTION_FILENAME', 'data.xml');

?>
