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
    $controller_url = CONTROLLER_URL;
    $action_get = ACTION_GET;
    $edit_action_name = EDIT_FIELD_ACTION_NAME;
    $fieldname_get = FIELDNAME_GET;
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
              <a href='./$controller_url?$action_get=$edit_action_name&$fieldname_get=$name' class='btn btn-primary'>
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
    $controller_url = CONTROLLER_URL;
    $action_get = ACTION_GET;
    $name = $field->getId();
    $content = $field->getContent();
    $fieldname_get = FIELDNAME_GET;
    $fieldcontent_get = FIELDCONTENT_GET;
    $edit_field_action_name = EDIT_FIELD_ACTION_NAME;
    $res = "
    <form action='./$controller_url' method='get' class='form-horizontal'>
      <div class='input-group'>
        <span class='input-group-addon' id='name_label'>Nom du champs</span>
        <input type='text' name='$fieldname_get' value='$name' class='form-control' disabled/>
      </div>
      <br/><br/>
      <div class='input-group'>
        <span class='input-group-addon'>Contenu</span>
      </div>
      <textarea type='text' name='$fieldcontent_get' class='form-control'>$content</textarea>
      <br/>
      <input type='text' name='$action_get' value='$edit_field_action_name' hidden/>
      <input type='text' name='$fieldname_get' value='$name' hidden/>
      <div class='control-group'>
        <button type='submit' class='btn btn-primary'>Modifier</button>
      </div>
    </form>
    ";
    return $res;
  }

  private function listUsersAsBoostrapTab(){
    $controller_url = CONTROLLER_URL;
    $create_user_action_name = CREATE_USER_ACTION_NAME;
    $edit_user_action_name = UPDATE_USER_ACTION_NAME;
    $delete_user_action_name = DELETE_USER_ACTION_NAME;
    $action_get = ACTION_GET;
    $username_get =  USERNAME_GET;
    $res = "
    <a href='./$controller_url?$action_get=$create_user_action_name' class='btn btn-default'>
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
            <a href='./$controller_url?$action_get=$edit_user_action_name&$username_get=$username' class='btn btn-primary'>
              Editer
            </a>
            <a href='./$controller_url?$action_get=$delete_user_action_name&$username_get=$username' class='btn btn-danger'>
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
    $controller_url = CONTROLLER_URL;
    $action_get = ACTION_GET;
    $create_user_action_name = CREATE_USER_ACTION_NAME;
    $username_get = USERNAME_GET;
    $password_get = PASSWORD_GET;
    $res = "
    <form action='./$controller_url' method='get' class='form-horizontal'>
      <div class='input-group'>
        <span class='input-group-addon' id='name_label'>Nom d'utilisateur</span>
        <input type='text' name='$username_get' value='' placeholder='Username' class='form-control'/>
      </div>
      <br/><br/>
      <div class='input-group'>
        <span class='input-group-addon'>Mot de passe</span>
        <input type='text' name='$password_get' value='' placeholder='Password' class='form-control'/>
      </div>
      <br/>
      <input type='text' name='$action_get' value='$create_user_action_name' hidden/>
      <div class='control-group'>
        <button type='submit' class='btn btn-primary'>Ajouter</button>
      </div>
    </form>
    ";
    return $res;
  }

  private function editUserBootstrap($user){
    $controller_url = CONTROLLER_URL;
    $action_get = ACTION_GET;
    $username_get = USERNAME_GET;
    $password_get = PASSWORD_GET;
    $old_username_get = OLD_USERNAME_GET;
    $update_user_action_name = UPDATE_USER_ACTION_NAME;
    $username = $user->getUsername();
    $password = $user->getPassword();
    $old_username = $username;
    $res = "
    <form action='./$controller_url' method='get' class='form-horizontal'>
      <div class='input-group'>
        <span class='input-group-addon' id='name_label'>Nom d'utilisateur</span>
        <input type='text' name='$username_get' value='$username' placeholder='Username' class='form-control'/>
      </div>
      <br/><br/>
      <div class='input-group'>
        <span class='input-group-addon'>Mot de passe</span>
        <input type='text' name='$password_get' value='$password' placeholder='Password' class='form-control'/>
      </div>
      <br/>
      <input type='text' name='$action_get' value='$update_user_action_name' hidden/>
      <input type='text' name='$old_username_get' value='$old_username' hidden/>
      <div class='control-group'>
        <button type='submit' class='btn btn-primary'>Modifier</button>
      </div>
    </form>
    ";
    return $res;
  }

  public function authenticationFormBootstrap($error){
    $controller_url = CONTROLLER_URL;
    $action_get = ACTION_GET;
    $username_get = USERNAME_GET;
    $password_get = PASSWORD_GET;
    $connect_action_name = CONNECT_ACTION_NAME;
    $res = "
      <div class='row'>
        <div class='col-md-offset-4 col-md-4'>
          <div class='form-login'>
            <h4>Veuillez vous identifier.</h4>
            <form action='./$controller_url' method='GET' class='form-horizontal'>
              <input type='text' name='$username_get' class='form-control input-sm chat-input' placeholder='username' />
              <input type='password' name='$password_get' class='form-control input-sm chat-input' placeholder='password' />
              <div class='control-group'>
                <button type='submit' class='btn btn-primary'>Se connecter</button>
              </div>
              <input type='text' name='$action_get' value='$connect_action_name' hidden/>
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

  public function updateUserView($user){
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
