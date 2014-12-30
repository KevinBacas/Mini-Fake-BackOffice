<?php

  /**
   * Work as a testing field.
   * Will be replaced by full engine as soon as code will be ready
   *
   * @author Kévin BACAS
   * @copyright APLICAEN
   */

  require_once('CUserModel.php');
  require_once('CFieldModel.php');
  require_once('CXMLManager.php');
  require_once('CBackOfficeView.php');
  require_once('CAuthManager.php');

  echo "<meta charset='utf-8'/>";

  echo "Testing UserModel...<hr>";
  $user = new CUserModel("Kevbac", "123456");
  $user_serialized = serialize($user);
  $user_unserialized = unserialize($user_serialized);

  echo $user_serialized;
  var_dump($user_unserialized);

  echo "Testing FieldModel...<hr>";
  $field = new CFieldModel("HomePageMainText", "Lorem ipsum tout ça...");
  $field_serialized = serialize($field);
  $field_unserialized = unserialize($field_serialized);

  echo $field_serialized;
  var_dump($field_unserialized);

  echo "Testing XMLManager...<hr>";
  $file_name = "qq.xml";
  $xml_manager = new CXMLManager($file_name);
  if(file_exists($file_name)){
    echo htmlentities($xml_manager->toString()) . "<br/>";
  }else{
    echo "FAIL !";
  }

  echo "Testing register field...<hr>";
  $field_name = "qq";
  $new_field = new CFieldModel($field_name, "lel");
  $xml_manager->registerField($new_field);
  echo htmlentities($xml_manager->toString()) . "<br/>";

  $field_name2 = "azerty";
  $new_field2 = new CFieldModel($field_name2, "lel");
  $xml_manager->registerField($new_field2);
  echo htmlentities($xml_manager->toString()) . "<br/>";

  $field = $xml_manager->getField($field_name);
  var_dump($field);
  $field->setContent("QQV2 LEL");
  $xml_manager->updateField($field);
  $field = $xml_manager->getField($field_name);
  var_dump($field);

  $back_office_view = new CBackOfficeView($xml_manager);
  var_dump($xml_manager->getAllFields());
  echo $back_office_view->listAllFieldsView();
  echo $back_office_view->editFieldView($field);

  echo "Testing user creation...<hr>";
  $new_user_username = 'kevbac';
  $new_user_password = 'azerty';
  $new_user = new CUserModel($new_user_username, $new_user_password);
  $xml_manager->createUser($new_user);
  var_dump($xml_manager->readUser($new_user_username));
  $new_user_password = $new_user_password . 'lel';
  $new_user->updatePassword($new_user_password);
  $xml_manager->updateUser($new_user);
  var_dump($xml_manager->readUser($new_user_username));
  echo htmlentities($xml_manager->toString()) . "<br/>";

  echo "Testing authentication...<hr>";
  $auth_manager = new CAuthManager($xml_manager);
  $auth_manager->connect($new_user_username, $new_user_password);
  echo 'Is connected ? ' . ($auth_manager->isConnected() ? "Yes" : "No") . '<br/>';
  $auth_manager->disconnect();
  echo 'Is connected ? ' . ($auth_manager->isConnected() ? "Yes" : "No") . '<br/>';

  unlink($file_name);

?>
