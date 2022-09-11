<?php 
class dbconnection
{
    private $conn;
 
function __construct()
{      $servername = "localhost";
     $username = "root";
    $password = "";
   $database="photoalbum";   

    $this->conn = mysqli_connect($servername, $username, $password,$database);
    
}
function getConneciton()
{
    return $this->conn;
}
}

?>