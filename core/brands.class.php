<?php
error_reporting(E_ALL);
class Brands {

  private $db;

  public function __construct($db)
  {
      require_once('lib/input.class.php');
      require_once('lib/session.class.php');
      require_once('lib/general.class.php');
      require_once('lib/database.class.php');
      require_once('lib/file.class.php');
      $this->database = new Database($db);
      $this->input    = new Input;
      $this->session  = new Session;
      $this->general  = new General;
      $this->file     = new File;
  }


  public function get_all_brands()
  {
      $this->database->selectAll("SELECT * FROM brands ORDER BY brand_id DESC");
      return $this->database->fetch();
  }

  public function get_brand_by_id()
  {
      $brand_id = $this->input->get('id');
      $brand_array = array('id' => $brand_id);
      $this->database->select('SELECT * FROM brands WHERE brand_id = ?', $brand_array);

      $this->file->make_folder(array('assets/img/' . $brand_id));

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

  public function delete_brand()
  {
      $brand_id = $this->input->get('id');
      $brand_array = array('id' => $brand_id);
      $this->database->delete('DELETE FROM brands WHERE brand_id = ?', $brand_array);
      $this->session->set_flashdata('brand-deleted', '<div class="update-nag">Brand Deleted</div>');
      $this->general->redirect('../brands');
  }

  public function delete_sub_category()
  {
      $subcategory_id = $this->input->get('id');
      $subcategory_array = array('id' => $subcategory_id);
      $this->database->delete('DELETE FROM subcategories WHERE id = ?', $subcategory_array);
      $this->session->set_flashdata('sub-category-deleted', '<div class="update-nag">Sub Category Deleted</div>');
      $this->general->redirect('../sub-categories/1');
  }

  public function add_new_brand()
  {
      $brand             = $this->input->post('brand');
      $brand_city        = $this->input->post('brand_city');
      $brand_description = $this->input->post('brand_description');
      $in_stock          = $this->input->post('in_stock');

      if(!empty($brand))
      {
          $brand_array = array('brand_name' => $brand, 'brand_city' => $brand_city, 'brand_description' => $brand_description, 'in_stock' => $in_stock);
          $this->database->insert('INSERT INTO brands (brand_name, brand_city, brand_description, in_stock) VALUES (?, ?, ?, ?)', $brand_array);
          $lastID = $this->database->lastInsertId();
          
          mkdir('assets/img/' . $lastID);
          chmod('assets/img/' . $lastID, 0777);
          if(move_uploaded_file($_FILES["file"]["tmp_name"], 'assets/img/' . $lastID . '/' . $_FILES['file']['name']))
          {
              echo 'Upload success';
          }



          die;

          $this->session->set_flashdata('brand-added', '<div class="update-nag">Brand Added</div>');
          $this->general->redirect('brands');
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

  public function edit_brand()
  {
      $brand_id           = $this->input->post('id');
      $brand_name         = $this->input->post('brand_name');
      $brand_city         = $this->input->post('brand_city');
      $brand_description  = $this->input->post('brand_description');
      $in_stock           = $this->input->post('in_stock');
 

      if(!empty($brand_name))
      {
          $post_array = array(
            'brand_name'        => $brand_name,
            'brand_city'        => $brand_city,
            'brand_description' => $brand_description,
            'in_stock'          => $in_stock, 
            'brand_id'          => $brand_id
          );

          $this->database->update('UPDATE brands SET brand_name = ?, brand_city = ?, brand_description = ?, in_stock = ? WHERE brand_id = ?', $post_array);
          
          $this->session->set_flashdata('saved', '<div class="update-nag">Brand Saved</div>');
          $this->general->redirect("edit-brand/$brand_id");
      }
      else
      {
          $this->session->set_flashdata('errors', '<div class="update-nag">Brand name cannot be empty</div>');
          $this->general->redirect("edit-brand/$brand_id");
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