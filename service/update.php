<?php 
session_start();
$conn = new mysqli('localhost', 'root', '', 'netjugaad');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$mailname=$_SESSION["gemail"];
if($mailname){
if(isset($_POST['compsub'])){
$comp=$_POST['compname'];
$addr=$_POST['address'];
$des=$_POST['des'];
$ser=$_POST['service'];
 if($comp!=""){
      $sql = "UPDATE serpro SET compname='$comp' WHERE email='$mailname'";
       mysqli_query($conn,$sql);
 }
 if($addr!="") {     
       $sql1 = "UPDATE serpro SET compaddress='$addr' WHERE email='$mailname'";
        mysqli_query($conn,$sql1);
   }
 if($des!=""){       
        $sql2 = "UPDATE serpro SET des='$des' WHERE email='$mailname'";
         mysqli_query($conn,$sql2);
}
 if($ser!="") {      
         $sql3 = "UPDATE serpro SET service='$ser' WHERE email='$mailname'";
          mysqli_query($conn,$sql3);
     }
      echo "  <script>
window.location.href='serprofile.php'</script>";
       }
if(isset($_POST['prsnlsub'])){
$fname=$_POST['name'];
$cont=$_POST['contact'];
$city=$_POST['city'];
if($fname!=""){
  $conn->query("UPDATE serpro SET name='$fname'  WHERE email='$mailname'");
}
if($city!=""){
  $conn->query("UPDATE serpro SET city='$city'  WHERE email='$mailname'");
}
if($cont){
  $conn->query("UPDATE serpro SET contact='$cont' WHERE email='$mailname'");
}
 echo "  <script>
window.location.href='serprofile.php'</script>";
   
       
}


if(isset($_POST['passup'])){
	$oldpass=$_POST['oldpass'];
 $newpass= $_POST["newpass"];
  $renter=$_POST["renter"];
  if($newpass==$oldpass){ 
	echo "<script>alert('old password and new password are same,try another!'); window.location.href='serprofile.php';</script> ";
}else{

$sql=$conn->query("SELECT pass FROM serpro WHERE email='$mailname' ");
$row = $sql -> fetch_assoc();
if($row['pass']==$oldpass){
	if($newpass==$renter){
$conn->query("UPDATE serpro SET pass='$newpass' WHERE email='$mailname' ");
echo "  <script> alert('password updated');
window.location.href='serprofile;'</script>";
}else{
        echo "<script> alert('re-entered password doesnot match');
        window.location.href='serprofile.php'</script>";
    }

    }else{

    	 echo "<script> alert('old password is incorrect');
         window.location.href='serprofile.php'</script>";
    }
}
}
}else{
    echo "login";
}

?>