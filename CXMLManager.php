<?php

/**
 * Provides a high-level XML Manager for Fake Back Office data
 * Field management (CRUD)
 *   - Register
 *   - Update
 *
 * User management (CRUD)
 *   - Create
 *   - Read
 *   - Update
 *   - Delete
 *
 * @author Kévin BACAS
 * @copyright APLICAEN
 */

class CXMLManager {

  private $m_DOMDocument;
  private $m_SimpleXML;
  private $m_XMLFileName;
  private $m_FieldsNode;
  private $m_UsersNode;

  public function __construct($XMLFileName) {
    $this->m_XMLFileName = $XMLFileName;

    if(!file_exists($this->m_XMLFileName)){
      $dom = new DOMDocument('1.0', 'utf-8');
      $data = $dom->createElement("data");
      $dom->appendChild($data);
      $dom->save($this->m_XMLFileName);

      $this->m_DOMDocument = new DOMDocument;
      $this->m_DOMDocument->load($this->m_XMLFileName);
      if (!$this->m_DOMDocument) {
        echo "Erreur lors de l'analyse du document";
        exit;
      }
      $this->m_SimpleXML = simplexml_import_dom($this->m_DOMDocument);
      $this->m_SimpleXML->addChild('fields');
      $this->m_SimpleXML->addChild('users');
      $this->m_SimpleXML->saveXML($this->m_XMLFileName);
    }
    $this->m_DOMDocument = new DOMDocument;
    $this->m_DOMDocument->load($this->m_XMLFileName);
    $this->m_SimpleXML = simplexml_import_dom($this->m_DOMDocument);

  }

  public function registerField($field){
    $res = false;
    if(!$this->getField($field->getId())){
      $child = $this->m_SimpleXML->fields->addChild("field", serialize($field));
      $this->m_SimpleXML->saveXML($this->m_XMLFileName);
      $res = true;
    }
    return $res;
  }

  public function getField($field_name){
    $res = null;
    foreach($this->m_SimpleXML->fields->field as $field){
      $field = unserialize($field);
      if($field->getId() == $field_name){
        $res = $field;
      }
    }
    return $res;
  }

  public function getAllFields(){
    $res = array();
    foreach($this->m_SimpleXML->fields->field as $field){
      $res[] = unserialize($field);
    }
    return $res;
  }

  public function updateField($field){
    for($i = 0 ; $this->m_SimpleXML->fields->field[$i] != null ; $i++){
      $field_obj = unserialize($this->m_SimpleXML->fields->field[$i]);
      if($field_obj->getId() == $field->getId()){
        $this->m_SimpleXML->fields->field[$i] = serialize($field);
        $this->m_SimpleXML->saveXML($this->m_XMLFileName);
      }
    }
    return $field;
  }

  public function getAllUsers(){
    $res = array();
    foreach($this->m_SimpleXML->users->user as $user){
      $res[] = unserialize($user);
    }
    return $res;
  }

  public function createUser($user){
    $res = false;
    if(!$this->readUser($user->getUsername())){
      $child = $this->m_SimpleXML->users->addChild("user", serialize($user));
      $this->m_SimpleXML->saveXML($this->m_XMLFileName);
      $res = true;
    }
    return $res;
  }

  public function readUser($username){
    $res = null;
    foreach($this->m_SimpleXML->users->user as $user){
      $user = unserialize($user);
      if($user->getUsername() == $username){
        $res = $user;
      }
    }
    return $res;
  }

  public function updateUser($user, $old_username){
    for($i = 0 ; $this->m_SimpleXML->users->user[$i] != null ; $i++){
      $user_obj = unserialize($this->m_SimpleXML->users->user[$i]);
      if($user_obj->getUsername() == $old_username){
        $this->m_SimpleXML->users->user[$i] = serialize($user);
        $this->m_SimpleXML->saveXML($this->m_XMLFileName);
      }
    }
    return $user;
  }

  public function deleteUser($user){
    for($i = 0 ; $this->m_SimpleXML->users->user[$i] != null ; $i++){
      $user_obj = unserialize($this->m_SimpleXML->users->user[$i]);
      if($user_obj->getUsername() == $user->getUsername()){
        unset($this->m_SimpleXML->users->user[$i]);
        $this->m_SimpleXML->saveXML($this->m_XMLFileName);
      }
    }
    return $user;
  }

  public function toString(){
    return $this->m_DOMDocument->saveXML();
  }

}

?>
