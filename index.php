<?php
include 'oops.php';
include 'connection.php';
$cnt=new dbconnection();
$con=$cnt->getConneciton();
$oops = new oops($con);

if(isset($_POST['submit']))
{     
   
      $email=$_POST['email'];
       $pass=$_POST['password'];
       $suc=$oops->signin($email,$pass);
       if($suc)
       {   session_start();
           $user=$oops->user($email);
           $_SESSION['email']=$user['Email'];
           $_SESSION['isPremium']=$user['isPremium'];
           $_SESSION['name']=$user['Name'];
           header("location:dashboard.php");
       } else {
           header('location:index.php?login=fail');
       }
}
?>

<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body style="background-color: lightyellow;">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: lightgreen;">
  <a class="navbar-brand a" href=''>Photo album</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<?php 
if(isset($_GET['login']) && $_GET['login'] == 'fail') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry</strong> Login Failed. Invalid credentials....
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>
<div id="container" >
<form id="login-form" style="width: 500px; margin-left:450px; margin-top:100px" action="" method="post" autocomplete="off">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript" >
  jQuery("#login-form").validate({
    rules: {
        email:{
            required:true,
            email:true
        },
        password:{
            required:true,
        }
      },
        messages:{
            email:{
                required:"** Please enter email address **",
                email:"** Please enter a valid email address **"
            },
            password:{
            
                required:"** Please enter password. **",
                
            }
        }
    
})

</script>
<style>
  .error{
   color: red;
  }
  </style>