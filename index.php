<?php

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
    echo htmlentities($xml_manager->toString());
  }else{
    echo "FAIL !";
  }
  unlink($file_name);

?>
