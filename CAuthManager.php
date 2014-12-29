<?php

/**
 * Authentication management via user in the XML file
 *
 * @author Kévin BACAS
 * @copyright APLICAEN
 */
session_start();

class CAuthManager {

  private $m_XMLManager;

  public function __construct($xml_manager) {
    $this->m_XMLManager = $xml_manager;

  }

  public function isConnected(){
    return isset($_SESSION['isConnected']);
  }

  public function connect($username, $password){
    $res = false;
    $user = $this->m_XMLManager->getUser($username);
    if($user){
      if($password == $user->getPassword()){
        $_SESSION['isConnected'] = serialize($user);
        $res = $_SESSION['isConnected'];
      }
    }
    return $res;
  }

  public function disconnect(){
    unset($_SESSION['isConnected']);
  }

}

?>
