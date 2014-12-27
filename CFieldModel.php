<?php

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

  public function __construct($id = "", $content = "") {
    $this->m_id = $id;
    $this->m_content = $content;
  }

  public function setId($id){
    $this->m_id = $id;
  }

  public function setContent($id){
    $this->m_content = $content;
  }

  public function serialize() {
    return serialize(
      array(
        'id' => $this->m_id,
        'content' => $this->m_content
      )
    );
  }

  public function unserialize($data) {
    $data = unserialize($data);

    $this->m_id = $data['id'];
    $this->m_content = $data['content'];
  }
}

?>
