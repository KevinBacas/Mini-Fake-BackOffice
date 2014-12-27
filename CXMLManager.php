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

    // If file does not exists we create one
    if(!file_exists($this->m_XMLFileName)){
      $dom = new DOMDocument('1.0', 'utf-8');
      $users = $dom->createElement("users", "lel");
      // $fields = $dom->createElement("fields", "lel");
      $dom->appendChild($users);
      // $dom->appendChild($fields);
      $dom->save($this->m_XMLFileName);
    }

    $this->m_DOMDocument = new DOMDocument;
    $this->m_DOMDocument->load($this->m_XMLFileName);
    if (!$this->m_DOMDocument) {
      echo "Erreur lors de l'analyse du document";
      exit;
    }
    $this->SimpleXML = simplexml_import_dom($this->m_DOMDocument);

  }

  public function toString(){
    return $this->m_DOMDocument->saveXML();
  }

}

?>
