<?php
session_start();
?>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</head>
<body style="background-color: lightyellow;" >

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: lightgreen;">
  <a class="navbar-brand a" href='<?php echo ($_SESSION['email']) ? "dashboard.php":"index.php" ?>'>Photo album</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
       <?php  
    if((isset($_SESSION['email']) && $_SESSION['email'] == "admin@gmail.com") || (isset($_SESSION['isPremium']) && $_SESSION['isPremium'] == 0))
  { ?>
      <li class="nav-item active">
        <a class="nav-link a" href="typenormal.php">Normal</a>
      </li>
      <?php }
      if((isset($_SESSION['email']) && $_SESSION['email'] == "admin@gmail.com") || (isset($_SESSION['isPremium']) && $_SESSION['isPremium'] == 1)){ ?>
      <li class="nav-item active">
        <a class="nav-link a" href="typepremium.php">Premium</a>
      </li>
      <?php } ?>
      
    </ul>
    <?php if(isset($_SESSION['email'])) { ?>
    <a class="a" href="logout.php">logout</a>
    <?php } ?>
  </div>
</nav>
<h3 style="float: right"> <?php echo $_SESSION['name'] ?></h3>
<style>
.a:hover{

    text-decoration: underline;
}
</style>
