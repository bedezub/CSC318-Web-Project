<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<title>Home</title>
<?php include "../../views/layout/head.php"; ?>
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
</style>
<body id="page-top">
    <div id="wrapper">
        <?php include "../../views/layout/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "../../views/layout/topbar.php"; ?>
                <div class="container-fluid">
                    
                    <!-- Magic Happens Here -->
                    <!-- Header -->

  <div class="home-container" style="margin-top:80px" id="showcase">
    <h1 class="home-jumbo"><b>Welcome to</b></h1>
    <h1 class="home-xxxlarge home-text-red"><b> Home Page.</b></h1>
    <hr style="width:50px;border:5px solid red" class="home-round">
  </div>

<!-- Services -->
<div class="home-container" id="services" style="margin-top:75px">
    <h1 class="home-xxxlarge home-text-red"><b>About UiTM</b></h1>
    <hr style="width:50px;border:5px solid red" class="home-round">
    <p>Usaha, Taqwa, Mulia</p>
    <p>Universiti Teknologi MARA (UiTM ) is a public university based primarily in Shah Alam, 
    Malaysia that accepts only Bumiputera. Established with a focus to help the rural Malays
     in 1956 as RIDA (Rural & Industrial Development Authority) Training Centre (Malay: Dewan Latihan RIDA), it opened with around 50 students. It has since grown into the largest higher education institution in Malaysia by physical infrastructure, faculty and staff, and student enrollment.
    </p>
</div>
                </div>
                 <!-- Contact -->
  <div class="home-container" id="contact" style="margin-top:75px text-align:center">
    <h1 class="home-xxxlarge home-text-red"><b>Contact.</b></h1>
    <hr style="width:50px;border:5px solid red" class="home-round">
    <p>Any inquiries can directly contact us!</p>
    <form action="/action_page.php" target="_blank">
      
        <p>Name</p>
        <input class="home-input home-border" type="text" name="Name" required>
      
      <br>
        <p>Email</p>
        <input class="home-input home-border" type="text" name="Email" required>
      
      <br>
        <p>Message</p>
        <input class="home-input home-border" type="text" name="Message" style = "text-align" required>
      <br>
      <br>
      <button type="submit" class="home-button home-block home-padding-large home-red home-margin-bottom">Send Message</button>
    </form>  
            </div>
            <?php include '../../views/layout/footer.php'?>
            
  </div>
        </div>
    </div>
    <?php include '../../views/layout/scrollTop.php'?>
    <?php include '../../views/layout/modal.php'?>
    <?php include '../../views/layout/javascript.php'?>
</body>
</html>