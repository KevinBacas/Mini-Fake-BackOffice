<?php

/**
 * View representation of data
 * Allow full managing with Web user-interface
 *
 * @author Kévin BACAS
 * @copyright APLICAEN
 */

require_once('Globals.php');

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
        <meta charset='utf-8'/>
        <link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css' rel='stylesheet'>
      </head>
      <body>
        <div class='container'>
    ";
  }

  private function getTopBar(){
    $res = "
      <nav class='navbar navbar-default'>
        <div class='container-fluid'>
          <div class='navbar-header'>
            <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
              <span class='sr-only'>Toggle navigation</span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand' href='./index.php'>Back Office</a>
          </div>
        </div><!--/.container-fluid -->
      </nav>
    ";
    return $res;
  }

  private function getFooter(){
    return "
          <hr>
          <div class='row'>
            <div class='col-lg-12'>
              <ul class='nav nav-pills nav-justified'>
              <li><a href='http://www.aplicaen.fr/'>© 2015 APLICAEN, Élèves-entrepreneurs</a></li>
              <li><a href='http://www.expansion2plus1.fr/'>© 2015 Expansion2plus1</a></li>
              </ul>
            </div>
          </div>
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
        $edit_action_name = EDIT_FIELD_ACTION_NAME;
        $fieldname_get = FIELDNAME_GET;
        $res .= "
          <tr>
            <td>$name</td>
            <td>$content</td>
            <td>
              <a href='./index.php?action=$edit_action_name&$fieldname_get=$name' class='btn btn-primary'>
                Editer
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
    $fieldname_get = FIELDNAME_GET;
    $fieldcontent_get = FIELDCONTENT_GET;
    $edit_field_action_name = EDIT_FIELD_ACTION_NAME;
    $res = "
    <form action='' method='get' class='form-horizontal'>
      <div class='input-group'>
        <span class='input-group-addon' id='name_label'>Nom du champs</span>
        <input type='text' id='name' name='$fieldname_get' value='$name' class='form-control' disabled/>
      </div>
      <br/><br/>
      <div class='input-group'>
        <span class='input-group-addon'>Contenu</span>
      </div>
      <textarea type='text' name='$fieldcontent_get' class='form-control'>$content</textarea>
      <br/>
      <input type='text' name='action' value='$edit_field_action_name' hidden/>
      <input type='text' name='$fieldname_get' value='$name' hidden/>
      <div class='control-group'>
        <button type='submit' class='btn btn-primary'>Modifier</button>
      </div>
    </form>
    ";
    return $res;
  }

  private function listUsersAsBoostrapTab(){
    $create_user_action_name = CREATE_USER_ACTION_NAME;
    $res = "
    <a href='./index.php?action=$create_user_action_name' class='btn btn-default'>
      Creer un utilisateur
    </a>
    <br/>
    <table width='600' cellpadding='5' class='table table-hover table-bordered'>
      <thead>
        <tr>
          <th scope='col'>Username</th>
          <th scope='col'>Password</th>
          <th scope='col'>Action</th>
        </tr>
      </thead>

    <tbody>
    ";

    $users = $this->m_XMLManager->getAllUsers();
    if($users){
      foreach($users as $user){
        $username = $user->getUsername();
        $password = $user->getPassword();
        $res .= "
        <tr>
          <td>$username</td>
          <td>$password</td>
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

  private function createUserBootstrap(){
    $res = "
    <form action='' method='get' class='form-horizontal'>
      <div class='input-group'>
        <span class='input-group-addon' id='name_label'>Nom d'utilisateur</span>
        <input type='text' id='username' name='username' value='' placeholder='Username' class='form-control'/>
      </div>
      <br/><br/>
      <div class='input-group'>
        <span class='input-group-addon'>Mot de passe</span>
        <input type='text' id='password' name='password' value='' placeholder='Password' class='form-control'/>
      </div>
      <br/>
      <div class='control-group'>
        <button type='submit' class='btn btn-primary'>Ajouter</button>
      </div>
    </form>
    ";
    return $res;
  }

  private function editUserBootstrap($user){
    $username = $user->getUsername();
    $password = $user->getPassword();
    $res = "
    <form action='' method='get' class='form-horizontal'>
      <div class='input-group'>
        <span class='input-group-addon' id='name_label'>Nom d'utilisateur</span>
        <input type='text' id='username' name='username' value='$username' placeholder='Username' class='form-control'/>
      </div>
      <br/><br/>
      <div class='input-group'>
        <span class='input-group-addon'>Mot de passe</span>
        <input type='text' id='password' name='password' value='$password' placeholder='Password' class='form-control'/>
      </div>
      <br/>
      <div class='control-group'>
        <button type='submit' class='btn btn-primary'>Modifier</button>
      </div>
    </form>
    ";
    return $res;
  }

  public function authenticationFormBootstrap($error){
    $res = "
      <div class='row'>
        <div class='col-md-offset-4 col-md-4'>
          <div class='form-login'>
            <h4>Veuillez vous identifier.</h4>
            <form action='index.php?action=connect' method='GET' class='form-horizontal'>
              <input type='text' id='username' name='username' class='form-control input-sm chat-input' placeholder='username' />
              <input type='text' id='password' name='password' class='form-control input-sm chat-input' placeholder='password' />
              <div class='control-group'>
                <button type='submit' class='btn btn-primary'>Se connecter</button>
              </div>
              <input type='text' name='action' value='connect' hidden/>
            </form>
            <div class='alert alert-danger' role='alert'>$error</div>
          </div>
        </div>
      </div>
    ";
    return $res;
  }

  public function listAllFieldsView(){
    $res = $this->getHeader();
    $res .= $this->getTopBar();
    $res .= $this->listFieldsAsBoostrapTab();
    $res .= $this->getFooter();
    return $res;
  }

  public function editFieldView($field){
    $res = $this->getHeader();
    $res .= $this->getTopBar();
    $res .= $this->editFieldBootstrap($field);
    $res .= $this->getFooter();
    return $res;
  }

  public function listAllUsersView(){
    $res = $this->getHeader();
    $res .= $this->getTopBar();
    $res .= $this->listUsersAsBoostrapTab();
    $res .= $this->getFooter();
    return $res;
  }

  public function createUserView(){
    $res = $this->getHeader();
    $res .= $this->getTopBar();
    $res .= $this->createUserBootstrap();
    $res .= $this->getFooter();
    return $res;
  }

  public function editUserView($user){
    $res = $this->getHeader();
    $res .= $this->getTopBar();
    $res .= $this->editUserBootstrap($user);
    $res .= $this->getFooter();
    return $res;
  }

  public function authenticationView($error = ''){
    $res = $this->getHeader();
    $res .= $this->getTopBar();
    $res .= $this->authenticationFormBootstrap($error);
    $res .= $this->getFooter();
    return $res;
  }

}

?>
