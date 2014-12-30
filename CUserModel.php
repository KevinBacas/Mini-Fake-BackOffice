<?php

require_once("CCrypt.php");

/**
 * Represent a User
 * Can be serialized in XML
 *
 * @author Kévin BACAS
 * @copyright APLICAEN
 */

class CUserModel implements Serializable {

  private $m_username;
  private $m_password;

  public function __construct($username, $password) {
    $this->m_username = $username;
    $this->m_password = $password;
  }

  public function updatePassword($newPassword){
    $this->m_password = $newPassword;
  }

  public function getUsername(){
    return $this->m_username;
  }

  public function getPassword(){
    return $this->m_password;
  }

  public function serialize() {
    return CCrypt::crypt(serialize(
      array(
        'username' => $this->m_username,
        'password' => $this->m_password
      )
    ));
  }

  public function unserialize($data) {
    $data = unserialize(CCrypt::decrypt($data));

    $this->m_username = $data['username'];
    $this->m_password = $data['password'];
  }
}

?>
