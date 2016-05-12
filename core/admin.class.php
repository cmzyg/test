<?php

class Admin {

  private $db;

  public function __construct($db)
  {
      require_once('lib/input.class.php');
      require_once('lib/session.class.php');
      require_once('lib/general.class.php');
      require_once('lib/database.class.php');
      $this->database = new Database($db);
      $this->input    = new Input;
      $this->session  = new Session;
      $this->general  = new General;
  }


  public function log_in()
  {
      $user_login  = $this->input->post('user_login');
      $user_pass   = $this->input->post('user_pass');
      $login_array = array('admin_username' => $user_login, 'admin_password' => $this->hashPassword($user_pass));

      $this->database->select("SELECT * FROM admin WHERE admin_username = ? AND admin_password = ?", $login_array);

      if($this->database->rowCount() > 0)
      {
          $this->session->set_userdata('admin', $user_login);
          $this->general->redirect('brands');
      }
      else
      {
          $_SESSION['error'] = TRUE;
          $this->general->redirect('brands');
      }
  }

  private function hashPassword($password)
  {
      return sha1($password);
  }

  public function isLoggedIn()
  {
      if($this->session->userdata('admin') === NULL )
      {
          return false;
      }
      else
      {
          return true;
      }
  }


}