<?php
require_once('core/connect.php');
require_once('core/database.class.php');
require_once('core/controller.class.php');
require_once('core/settings.class.php');
$database   = new Database($db);
$controller = new Controller($db);
$settings   = new Settings($db);

$general_settings = $settings->getGeneralSettings();
$other_pages = $settings->getOtherPages();

// grab SEO
$settings->select('SELECT * FROM seo');
$seo = $settings->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic metas -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $seo['meta_title_other']; ?></title>
<meta name="keywords" content="<?php echo $seo['meta_keywords_other']; ?>" />
<meta name="description" content="<?php echo $seo['meta_description_other']; ?>">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google Web Fonts -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700&amp;subset=latin,cyrillic,latin-ext,vietnamese,greek,greek-ext,cyrillic-ext" rel="stylesheet" type="text/css">

<!-- CSS FILES -->
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/main.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/menus.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>css/responsive.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/default.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>vendor/rs-plugin/css/font-style.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/styles.css" />
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.all.css">

<!-- JS Files -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo $base_url; ?>js/uniform.js"></script>
<script src="<?php echo $base_url; ?>js/template.js"></script>
<script src="<?php echo $base_url; ?>js/responsive.js"></script>
<script src="<?php echo $base_url; ?>js/jquery.flexslider-min.js"></script>
<script src="<?php echo $base_url; ?>js/jquery.isotope.min.js"></script>
<script src="<?php echo $base_url; ?>vendor/rs-plugin/jquery.themepunch.plugins.min.js"></script>
<script src="<?php echo $base_url; ?>vendor/rs-plugin/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.ui.core.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.ui.datepicker.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.geocomplete.js"></script>
<script src="<?php echo $base_url; ?>assets/js/scripts.js"></script>
</head>

		<body>
<div id="layout-mode" class="boxed"> 
          <!-- Use classes Wide: wide, Boxed: boxed -->
          <div id="header" class="container">
    <div id="header_line" class="container header_line"> 
              <!-- features top -->
              <div class="row">
        <div class="six columns right"> 
                  <!-- Phone number -->
                  <ul>
           <ul><li class="right"> <i class='icon-phone'></i><span style="font-size:2em"><?php echo $general_settings['website_phone']; ?></span></li></ul>
          </ul>
                  <!-- End of Phone number --> 
                  <!-- Social Icons -->
                  <?php include('includes/social-media.php'); ?>
                  <!-- end of Social Icons --> 
                </div>
      </div>
              <!-- end .features top --> 
            </div>
    <div class="row">
              <div id="logo" class="four columns logo"> 
        <!-- logo & slogan --> 
        <a href="<?php echo $base_url; ?>" title="Home"> <img alt="" src="logo.png" /> </a> 
        <!-- end. logo & slogan --> 
      </div>
              <div class="eight columns"> 
        <!--Site menu-->
        <?php include('includes/navigation.php'); ?>
        <!--end of Site menu--> 
      </div>
            </div>
  </div>
          <!--Page title & breadcrumb-->
          <div id="pre-content">
    <div class="row"> 
              <!--start breadcrumb -->
              <div id="breadcrumb">
        <div class="breadcrumb"> <span class="crumbs"><a href="<?php echo $base_url; ?>">Home</a></span> <span class="crumbs-current">>
          Email Sent </span> </div>
      </div>
              <!-- end breadcrumb -->
              <div class="page-title">Success</div>
            </div>
    <div class="pre-content-overlay"></div>
  </div>
          <!--end of Page title & breadcrumb--> 
          
          <!--Content page-->
          <div id="#contact-map-wrap">
   
  </div>
          <div id="content-wrap" class="row">
    <div id="content" class="eighteen columns">
              <div class="region region-content">
       
                  <h4 class='lead'>Query Submitted</h4>
                  <p>Your query has been submitted. We will respond within the next 24 hours.</p>



      </div>
              <!-- /.region --> 
            </div>
  </div>
          
          <!-- javascript--> 
          <script src="vendor/contact-form/jquery.form.js"></script> 
          <script src="vendor/contact-form/jquery.validate.min.js"></script> 
          <script src="vendor/contact-form/custom.js"></script> 
          
          <!--End of content --> 

          <!--Footer region-->

          <?php include('includes/footer.php'); ?>
  
          <!-- /.region --> 
            </div>
  </div>
        </div>
</div>
<div class="row"></div>
<script type="text/javascript" src="js/jquery.vticker.min.js"></script> 

</body>
</html>
