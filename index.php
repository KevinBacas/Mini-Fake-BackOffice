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

  echo "<meta charset='utf-8'/>";

  echo "Testing UserModel...<br/>";
  $user = new CUserModel("Kevbac", "123456");
  $user_serialized = serialize($user);
  $user_unserialized = unserialize($user_serialized);

  echo $user_serialized;
  var_dump($user_unserialized);

  echo "Testing FieldModel...<br/>";
  $field = new CFieldModel("HomePageMainText", "Lorem ipsum tout ça...");
  $field_serialized = serialize($field);
  $field_unserialized = unserialize($field_serialized);

  echo $field_serialized;
  var_dump($field_unserialized);

  echo "Testing XMLManager...<br/>";
  $file_name = "qq.xml";
  $xml_manager = new CXMLManager($file_name);
  if(file_exists($file_name)){
    echo htmlentities($xml_manager->toString()) . "<br/>";
  }else{
    echo "FAIL !";
  }

  echo "Testing register field...<br/>";
  $field_name = "qq";
  $new_field = new CFieldModel($field_name, "lel");
  $xml_manager->registerField($new_field);
  echo htmlentities($xml_manager->toString()) . "<br/>";

  $field = $xml_manager->getField($field_name);
  var_dump($field);
  $field->setContent("QQV2 LEL");
  $xml_manager->updateField($field);
  echo htmlentities($xml_manager->toString()) . "<br/>";

  unlink($file_name);

?>
