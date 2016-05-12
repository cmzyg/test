<?php

class Pages {

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


  public function get_page($page)
  {
      $page_array = array('page_title' => $page);
      $this->database->select("SELECT * FROM pages WHERE page_title = ?", $page_array);
      return $this->database->fetch();
  }

  public function edit_page()
  {
      $page_title   = strtolower($this->input->post('title'));
      $page_intro   = $this->input->post('intro');
      $page_url     = strtolower($this->input->post('page_url'));
      $page_content = $this->input->post('page_content');
      $page_id      = $this->input->post('page_id'); 
      $page_array   = array('page_content' => $page_content, 'page_intro' => $page_intro, 'page_id' => $page_id);
      $this->database->update("UPDATE pages SET page_content = ?, page_intro = ? WHERE page_id = ?", $page_array);
      $this->session->set_flashdata('page-updated', '<div class="update-nag">Page Updated</div>');
      $this->general->redirect("pages/$page_url");
  }


}