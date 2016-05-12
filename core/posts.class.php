<?php

class Posts {

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


  public function get_all_posts()
  {
      $this->database->selectAll("SELECT * FROM posts ORDER BY post_id DESC");
      return $this->database->fetch();
  }

  public function get_post_by_id()
  {
      $post_id = $this->input->get('id');
      $post_array = array('post_id' => $post_id);
      $this->database->select('SELECT * FROM posts WHERE post_id = ?', $post_array);
      return $this->database->fetch();
  }

  public function delete_post()
  {
      $post_id = $this->input->get('id');
      $post_array = array('post_id' => $post_id);
      $this->database->delete('DELETE FROM posts WHERE post_id = ?', $post_array);
      $this->session->set_flashdata('post-deleted', '<div class="update-nag">Post Deleted</div>');
      $this->general->redirect('../posts/1');
  }

  public function publish_post()
  {
      $post        = $this->input->post('post');
      $title       = $this->input->post('title');
      $date        = date('Y-m-d H:i:s');
      $post        = stripslashes(strip_tags($post));
      $category    = $this->input->post('category');
      //$subcategory = $this->input->post('subcategory');

      if(!empty($post))
      {
          $post_array = array(
            'post_title'     => $title, 
            'post'           => $post, 
            'date_published' => $date,
            'category'       => $category,
            //'subcategory'    => $subcategory
          );

          $this->database->insert('INSERT INTO posts (post_title, post, date_published, post_category) VALUES (?, ?, ?, ?)', $post_array);
          $this->session->set_flashdata('post-added', '<div class="update-nag">Post Added</div>');
          $this->general->redirect('blog/posts/1');
      }
      else
      {
          $this->session->set_flashdata('errors', '<div class="update-nag">Post cannot be empty</div>');
          $this->general->redirect('blog/add-post');
      }
  }


  public function edit_post()
  {
      $post        = $this->input->post('post');
      $title       = $this->input->post('title');
      $post_id     = $this->input->post('post_id');
      $post        = stripslashes(strip_tags($post));
      $category    = $this->input->post('category');
      //$subcategory = $this->input->post('subcategory');

      if(!empty($post))
      {
          $post_array = array(
            'post_title'     => $title, 
            'post'           => $post, 
            'category'       => $category,
            //'subcategory'    => $subcategory,
            'post_id'        => $post_id
          );

          $this->database->update('UPDATE posts SET post_title = ?, post = ?, post_category = ? WHERE post_id = ?', $post_array);
          $this->session->set_flashdata('post-saved', '<div class="update-nag">Post Updated</div>');
          $this->general->redirect('blog/posts/1');
      }
      else
      {
          $this->session->set_flashdata('errors', '<div class="update-nag">Post cannot be empty</div>');
          $this->general->redirect("blog/edit-post/$post_id");
      }
  }

  public function count_posts()
  {
      $this->database->select('SELECT post_id FROM posts');
      return $this->database->rowCount();
  }


}