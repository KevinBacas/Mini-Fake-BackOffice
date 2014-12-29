<?php

/**
 * View representation of data
 * Allow full managing with Web user-interface
 *
 * @author Kévin BACAS
 * @copyright APLICAEN
 */

class CBackOfficeView {

  private $m_XMLManager;

  public function __construct($xml_manager) {
    $this->m_XMLManager = $xml_manager;
  }

  private function getHeader(){
    return "
    <!DOCTYPE html>
    <head>
      <title>Back Office</title>
      <link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
      <div class='container'>
    ";
  }

  private function getFooter(){
    return "
      </div>
      <script src='http://code.jquery.com/jquery.min.js'></script>
      <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
    </body>
    </html>
    ";
  }

  private function listFieldsAsBoostrapTab(){
    $res = "
    <table width='600' cellpadding='5' class='table table-hover table-bordered'>
      <thead>
        <tr>
          <th scope='col'>Name</th>
          <th scope='col'>Content</th>
          <th scope='col'>Action</th>
        </tr>
      </thead>

      <tbody>
    ";

    $fields = $this->m_XMLManager->getAllFields();
    if($fields){
      foreach($fields as $field){
        $name = $field->getId();
        $content = $field->getContent();
        $res .= "
          <tr>
            <td>$name</td>
            <td>$content</td>
            <td>
              <a href='#' class='btn btn-primary'>
                Editer
              </a>
              <a href='#' class='btn btn-danger'>
                Supprimer
              </a>
            </td>
          </tr>
        ";
      }
    }

    $res .= "
      </tbody>
    </table>
    ";

    return $res;
  }

  private function editFieldBootstrap($field){
    $name = $field->getId();
    $content = $field->getContent();
    $res = "
    <form action='' method='get' class='form-horizontal'>
      <div class='input-group'>
        <span class='input-group-addon' id='name_label'>Nom du champs</span>
        <input type='text' id='name' name='name' value='$name' class='form-control' disabled/>
      </div>
      <br/>
      <div class='input-group'>
        <span class='input-group-addon'>Contenu</span>
        <input type='text' id='content' name='content' value='$content' class='form-control'/>
      </div>
      <br/>
      <div class='control-group'>
        <button type='submit' class='btn btn-primary'>Modifier</button>
      </div>
    </form>
    ";
    return $res;
  }

  public function listAllFieldsView(){
    $res = $this->getHeader();
    $res .= $this->listFieldsAsBoostrapTab();
    $res .= $this->getFooter();
    return $res;
  }

  public function editFieldView($field){
    $res = $this->getHeader();
    $res .= $this->editFieldBootstrap($field);
    $res .= $this->getFooter();
    return $res;
  }

}

?>
