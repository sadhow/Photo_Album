<?php
include 'dashboard.php';
include 'oops.php';
include 'connection.php';
$cnt=new dbconnection();
$con=$cnt->getConneciton();
$oops = new oops($con);
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
if(isset($_GET['albumId']) ){
    $albumId = $_GET['albumId'];
}

$albumImages = $oops->getImagesToThisAlbum($albumId);
if(isset($_POST['addImage'])) {
    $imageName = $_FILES['image']['name'];
    $imageTemp = $_FILES['image']['tmp_name'];
    $destination='photos/'.$imageName;
    move_uploaded_file($imageTemp, $destination);
    $addImgRst = $oops->addImageToThisAlbum($imageName, $albumId);
    if($addImgRst) {
        header('location:typeview.php?albumId='.$albumId.'');
    }
}
?>
<div class="container my-3">
    
<?php
if(isset($_SESSION['email']) && $_SESSION['email'] == "admin@gmail.com")
  {

   echo' <form action="" method="POST" id="viewId" enctype="multipart/form-data">
        <input type="file" name="image" id="fileId" required>
        <input type="submit" value="Submit" name = "addImage" id="submitId">
    </form>';
  }
  ?>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner " >
  <?php
      $a = 1;
      foreach($albumImages as $image)
      {
        $class = ($a == 1) ? "carousel-item active" : "carousel-item";
        $a = $a + 1;
        echo '<div class="'.$class.'">
        <img src="photos/'.$image['name'].'" height="400px"    class="d-block w-100 " alt="...">
        </div>';
      }
  ?>
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
  </div>

</div>
<style>
  .btnmain{
    width: 10%;
    background-color: lightcyan;
    border-radius: 20px;;
    border: none;
  }
  .btnmain:hover
  {
    background-color: green;
    color: white;
  }
  </style>