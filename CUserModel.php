<?php

/**
 * Represent a User
 * Can be serialized in XML
 *
 * @author Kévin BACAS
 * @copyright APLICAEN
 */

class CUserModel implements Serializable {

  //TODO: Use Encryption for m_password
  private $m_username;
  private $m_password;

  public function __construct($username = "", $password = "") {
    $this->m_username = $username;
    $this->m_password = $password;
  }

  public function updatePassword($newPassword){
    $m_password = $newPassword;
  }

  public function serialize() {
    return serialize(
      array(
        'username' => $this->m_username,
        'password' => $this->m_password
      )
    );
  }

  public function unserialize($data) {
    $data = unserialize($data);

    $this->m_username = $data['username'];
    $this->m_password = $data['password'];
  }
}

?>
