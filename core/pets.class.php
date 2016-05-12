<?php

class Pets {

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


  public function get_all_pets()
  {
      $this->database->selectAll("SELECT * FROM pets ORDER BY pet_id DESC");
      return $this->database->fetch();
  }


  public function delete_pet()
  {
      $id = $this->input->get('id');
      $array = array('pet_id' => $id);
      $this->database->delete('DELETE FROM pets WHERE pet_id = ?', $array);
      $this->session->set_flashdata('pet-deleted', '<div class="update-nag">Pet Deleted</div>');
      $this->general->redirect('../pets/1');
  }


  public function count_pets()
  {
      $this->database->select('SELECT pet_id FROM pets');
      return $this->database->rowCount();
  }


  public function add_new_pet()
  {
      $pet_name        = $this->input->post('pet_name');
      $pet_description = $this->input->post('pet_description');
      
      $array = array('pet_name' => $pet_name, 'pet_description' => $pet_description);
      $this->database->insert("INSERT INTO pets (pet_name, pet_description) VALUES (?, ?)", $array);
      $last_id = $this->database->lastInsertId();

      mkdir("../uploads/" . $last_id);
      mkdir("../uploads/thumbnails/" . $last_id);

      if($_FILES["pet_picture"]["name"]) 
      {
          move_uploaded_file($_FILES["pet_picture"]["tmp_name"], "../uploads/" . $last_id . "/" . $_FILES["pet_picture"]["name"]);
          $thumbnail = 'uploads/thumbnails/' . $last_id . '/' . $_FILES['pet_picture']['name'];
          $picture   = 'uploads/' . $last_id . '/' . $_FILES['pet_picture']['name'];

          $tmp = explode('.', $_FILES['pet_picture']['name']);
          $extension1 = end($tmp);
          if($extension1 == 'jpg' || $extension1 == 'jpeg') 
          {
              $imgSrc = "../uploads/" . $last_id . "/" . $_FILES["pet_picture"]["name"];
              list($width, $height) = getimagesize($imgSrc);
              $myImage = imagecreatefromjpeg($imgSrc);
              if ($width > $height) 
              {
                $y = 0;
                $x = ($width - $height) / 2;
                $smallestSide = $height;
              }
              else 
              {
                $x = 0;
                $y = ($height - $width) / 2;
                $smallestSide = $width;
              }
              $thumbSize = 125;
                $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
                imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
                imagejpeg($thumb, "../uploads/thumbnails/" . $last_id . "/" . $_FILES["pet_picture"]["name"]);
            }

            if($extension1 == 'png') 
            {
                $imgSrc = "../uploads/" . $last_id . "/" . $_FILES["pet_picture"]["name"];
                list($width, $height) = getimagesize($imgSrc);
                $myImage = imagecreatefrompng($imgSrc);
                if ($width > $height) 
                {
                    $y = 0;
                    $x = ($width - $height) / 2;
                    $smallestSide = $height;
                }
                else 
                {
                    $x = 0;
                    $y = ($height - $width) / 2;
                    $smallestSide = $width;
                }
                $thumbSize = 125;
                $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
                imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
                imagepng($thumb, "../uploads/thumbnails/" . $last_id . "/" . $_FILES["pet_picture"]["name"]);
            }

            if($extension1 == 'gif') 
            {
                $imgSrc = "../uploads/" . $last_id . "/" . $_FILES["pet_picture"]["name"];
                list($width, $height) = getimagesize($imgSrc);
                $myImage = imagecreatefromgif($imgSrc);
                if ($width > $height) 
                {
                    $y = 0;
                    $x = ($width - $height) / 2;
                    $smallestSide = $height;
                }
                else 
                {
                    $x = 0;
                    $y = ($height - $width) / 2;
                    $smallestSide = $width;
                }
                $thumbSize = 125;
                $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
                imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
                imagegif($thumb, "../uploads/thumbnails/" . $last_id . "/" . $_FILES["pet_picture"]["name"]);
            }


      }
  
      

      $array = array("picture" => $picture, "thumbnail" => $thumbnail, "id" => $last_id);

      $this->database->update("UPDATE pets SET picture = ?, thumbnail = ? WHERE pet_id = ?", $array);

      $this->session->set_flashdata('pet-inserted', '<div class="update-nag">Pet Added</div>');
      $this->general->redirect('pets/1');
  }

  public function get_pet_by_id()
  {
      $id = $this->input->get('id');
      $array = array('id' => $id);
      $this->database->select('SELECT * FROM pets WHERE pet_id = ?', $array);
      return $this->database->fetch();
  }


  public function edit_pet()
  {
      $pet_name    = $this->input->post('name');
      $description = $this->input->post('description');
      $id          = $this->input->post('id');

      $array = array('pet_name' => $pet_name, 'pet_description' => $description, 'pet_id' => $id);
      $this->database->update('UPDATE pets SET pet_name = ?, pet_description = ? WHERE pet_id = ?', $array);
         
      $this->session->set_flashdata('pet-saved', '<div class="update-nag">Pet Saved</div>');
      $this->general->redirect("edit-pet/$id");
  }


}