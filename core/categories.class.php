<?php

class Categories {

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


  public function get_all_categories()
  {
      $this->database->selectAll("SELECT * FROM categories ORDER BY id DESC");
      return $this->database->fetch();
  }

  public function get_category_by_id()
  {
      $cat_id = $this->input->get('id');
      $cat_array = array('id' => $cat_id);
      $this->database->select('SELECT * FROM categories WHERE id = ?', $cat_array);
      return $this->database->fetch();
  }

  public function get_subcategory_by_id()
  {
      $cat_id = $this->input->get('id');
      $cat_array = array('id' => $cat_id);
      $this->database->select('SELECT * FROM subcategories WHERE id = ?', $cat_array);
      return $this->database->fetch();
  }

  public function get_all_subcategories()
  {
      $this->database->selectAll("SELECT * FROM subcategories ORDER BY id DESC");
      return $this->database->fetch();
  }

  public function delete_category()
  {
      $category_id = $this->input->get('id');
      $category_array = array('id' => $category_id);
      $this->database->delete('DELETE FROM categories WHERE id = ?', $category_array);
      $this->session->set_flashdata('category-deleted', '<div class="update-nag">Category Deleted</div>');
      $this->general->redirect('../categories/1');
  }

  public function delete_sub_category()
  {
      $subcategory_id = $this->input->get('id');
      $subcategory_array = array('id' => $subcategory_id);
      $this->database->delete('DELETE FROM subcategories WHERE id = ?', $subcategory_array);
      $this->session->set_flashdata('sub-category-deleted', '<div class="update-nag">Sub Category Deleted</div>');
      $this->general->redirect('../sub-categories/1');
  }

  public function add_new_category()
  {
      $category = $this->input->post('category');
      $url      = str_replace(' ', '-', $category);
      $url      = strtolower($url); 
      if(!empty($category))
      {
          $category_array = array('category' => $category, 'url' => $url);
          $this->database->insert('INSERT INTO categories (category, url) VALUES (?, ?)', $category_array);
          $this->session->set_flashdata('category-added', '<div class="update-nag">Category Added</div>');
          $this->general->redirect('blog/categories/1');
      }
  }

  public function add_new_subcategory()
  {
      $category    = $this->input->post('category');
      $subcategory = $this->input->post('subcategory');
      if(!empty($category))
      {
          $subcategory_array = array('category' => $category, 'subcategory' => $subcategory);
          $this->database->insert('INSERT INTO subcategories (category, subcategory) VALUES (?, ?)', $subcategory_array);
          $this->session->set_flashdata('sub-category-added', '<div class="update-nag">Sub Category Added</div>');
          $this->general->redirect('blog/sub-categories/1');
      }
  }

  public function edit_category()
  {
      $cat_id       = $this->input->post('id');
      $category     = $this->input->post('category');
      $old_category = $this->input->post('old_category');
      $url          = str_replace(' ', '-', $category);
      $url          = strtolower($url); 

      if(!empty($category))
      {
          $post_array = array('category' => $category, 'old_category' => $old_category);
          $this->database->update('UPDATE posts SET post_category = ? WHERE post_category = ?', $post_array);
          
          $cat_array = array(
            'category' => $category,
            'url'      => $url, 
            'id'       => $cat_id
          );
        
          $this->database->update('UPDATE categories SET category = ?, url = ? WHERE id = ?', $cat_array);

          $this->session->set_flashdata('category-saved', '<div class="update-nag">Category Saved</div>');
          $this->general->redirect("blog/edit-category/$cat_id");
      }
      else
      {
          $this->session->set_flashdata('errors', '<div class="update-nag">Category cannot be empty</div>');
          $this->general->redirect("blog/edit-category/$cat_id");
      }
  }

  public function edit_subcategory()
  {
      $cat_id      = $this->input->post('id');
      $category    = $this->input->post('category');
      $subcategory = $this->input->post('subcategory');

      if(!empty($category))
      {
          $cat_array = array(
            'category'    => $category,
            'subcategory' => $subcategory,
            'id'          => $cat_id
          );

          $this->database->update('UPDATE subcategories SET category = ?, subcategory = ? WHERE id = ?', $cat_array);
          $this->session->set_flashdata('sub-category-saved', '<div class="update-nag">Sub Category Saved</div>');
          $this->general->redirect("blog/edit-sub-category/$cat_id");
      }
      else
      {
          $this->session->set_flashdata('errors', '<div class="update-nag">Sub Category cannot be empty</div>');
          $this->general->redirect("blog/edit-sub-category/$cat_id");
      }
  }

  public function count_categories()
  {
      $this->database->select('SELECT id FROM categories');
      return $this->database->rowCount();
  }

  public function count_subcategories()
  {
      $this->database->select('SELECT id FROM subcategories');
      return $this->database->rowCount();
  }


}