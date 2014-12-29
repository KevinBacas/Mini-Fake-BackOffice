<?php

require_once("CCrypt.php");

/**
 * Represent a Field
 * Can be serialized in XML
 *
 * @author Kévin BACAS
 * @copyright APLICAEN
 */

class CFieldModel implements Serializable {

  private $m_id;
  private $m_content;

  public function __construct($id, $content) {
    $this->m_id = $id;
    $this->m_content = $content;
  }

  public function setId($id){
    $this->m_id = $id;
  }

  public function setContent($content){
    $this->m_content = $content;
  }

  public function getId(){
    return $this->m_id;
  }

  public function getContent(){
    return $this->m_content;
  }

  public function serialize() {
    return CCrypt::crypt(serialize(
      array(
        'id' => $this->m_id,
        'content' => $this->m_content
      )
    ));
  }

  public function unserialize($data) {
    $data = unserialize(CCrypt::decrypt($data));

    $this->m_id = $data['id'];
    $this->m_content = $data['content'];
  }
}

?>
