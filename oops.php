<?php
class oops
{
    function __construct($con)
    {
        $this->con=$con;
    }
    function signin($email,$pass)
    {
    $stmt="Select * from `u_type` where email='$email' and password='$pass'";
    $res=mysqli_query($this->con,$stmt);
    $num=mysqli_num_rows($res);
    if($num>0)
    {
        return true;
    }
    else{
        return false;
    }
    }
   
    function user($email)
    {
        $stmt="select * from `u_type` where email='$email'";
        $res=mysqli_query($this->con,$stmt);
        $detail=mysqli_fetch_assoc($res);
        return $detail;

    }

    function getpalbum()
    {
        $albumdetail=array();
        if(isset($_SESSION['email']) && $_SESSION['email']=="admin@gmail.com"){
            $qry="select * from `a_type` where isPremium='1'";
        }  elseif (isset($_SESSION['isPremium']) && $_SESSION['isPremium'] == '1'){
            $qry = "select * from `a_type` where isPremium = '1' and isPublish = '1'";
        }
        $result=mysqli_query($this->con,$qry);
        while($row=mysqli_fetch_assoc($result))
        {
            array_push($albumdetail,$row);
            
        }
        return $albumdetail;
    }
    function getnalbum()
    {

        $albumdetail=array();
        if(isset($_SESSION['email']) && $_SESSION['email']=="admin@gmail.com"){
            $qry="select * from `a_type` where isPremium='0'";
        } elseif (isset($_SESSION['isPremium']) && $_SESSION['isPremium'] == '0'){

            $qry = "select * from `a_type` where isPremium = '0' and isPublish = '1'";
        } 
        $result=mysqli_query($this->con,$qry);
        while($row=mysqli_fetch_assoc($result))
        {
            array_push($albumdetail,$row);
            
        }
        return $albumdetail;
    }
    function insertAlbum($title,$description,$filename,$albumType)
    {
        $qry="INSERT INTO `a_type` ( `albumimage`, `Title`, `Description`, `isPremium`) VALUES ( '$filename', '$title', '$description', '$albumType')"; 
        $result=mysqli_query($this->con,$qry);
        return true;
    }
    public function ualbum($curr,$albumid)
    {
        $qry="update `a_type` set isPublish='$curr' where id='$albumid'";
        $result=mysqli_query($this->con,$qry);
        return true;
    }

    public function getImagesToThisAlbum($albumid)
    {
        $photos = array();
        $qry = "select * from photos where albumid = '$albumid'";
        $rst = mysqli_query($this->con, $qry);
        while($row = mysqli_fetch_assoc($rst)) {
            array_push($photos, $row);
        }
        return $photos;

    }

    public function addImageToThisAlbum($imageName, $albumId)
    {
        $qry = "INSERT INTO `photos` (`name`, `albumid`) VALUES ('$imageName', '$albumId')";
        $rst = mysqli_query($this->con, $qry);
        return true;
    }
}

?>