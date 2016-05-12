<?php

class Settings {

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


  public function get_settings()
  {
      $this->database->select("SELECT * FROM settings");
      return $this->database->fetch();
  }

  public function edit_settings()
  {
      $admin_email    = $this->input->post('admin_email');
      $paypal_account = $this->input->post('paypal_account');
      $paypal_status  = $this->input->post('paypal_status');

      $settings_array = array(
        'admin_email'    => $admin_email,
        'paypal_account' => $paypal_account,
        'paypal_status'  => $paypal_status
      );

      $this->database->update('UPDATE settings SET admin_email = ?, paypal_account = ?, paypal_status = ?', $settings_array);
      $this->session->set_flashdata('success', '<div class="update-nag">Settings Updated</div>');
      $this->general->redirect('settings');
  }

}