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
$details=$oops->getnalbum();
if(isset($_GET['updated']))
{
  $value=$_GET['val'] ? "Published":"Unpublished";
  echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulations</strong> Successfully '.$value .'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> 
          ';
}
if(isset($_GET['current']))
{
    $curr=($_GET['current']=="Publish") ? "1":"0";
    $albumid=$_GET['albumid'] ;
    $uResult=$oops->ualbum($curr,$albumid);
    if($uResult)
    {
      
      header('location:typenormal.php?updated=true&val='.$curr.'');
    

    }

}
?>
<div class="container">
  
    <?php 
if(isset($_SESSION['email']) && $_SESSION['email'] == "admin@gmail.com")
{

  echo '<a class="btn btn-success my-4" href="typeadd.php?albumType=0">Add New Album</a>';
}
?>

<?php
foreach($details as $detail){
echo '<div class="row d-flex justify-content-center mx-1">
<div class="card mx-1" style="width: 15rem;">
  <img src="photos/'.$detail['albumimage'].'" height="200px" class="card-img-top" alt="">
  <div class="card-body">
    <h5 class="card-title">'.$detail['Title'].'</h5>
    <p class="card-text">'.$detail['Description'].'</p>
    <a href="typeview.php?albumId='.$detail['id'].'" class="btn btn-info ">View Album</a>'; ?>
    <?php
      if(isset($_SESSION['email']) && $_SESSION['email'] == "admin@gmail.com")
      {
        $button = $detail['isPublish']?  "Unpublish":"Publish" ;
        echo '<a href="typenormal.php?current='. $button .'&albumid='.$detail['id'].' " class="btn btn-success ">'.$button.'</a>';
      }
    ?>
    <?php
   echo '</div>
</div> ';
}
?>
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