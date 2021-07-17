<?php 
session_start();
$conn = new mysqli('localhost', 'root', '', 'netjugaad');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$mailname=$_SESSION["gemail"];
if($mailname){
if(isset($_POST['prsnlsub'])){
$fname=$_POST['name'];
$cont=$_POST['contact'];
$city=$_POST['city'];
$addr=$_POST['address'];
if($fname!=""){
  $conn->query("UPDATE customer SET name='$fname'  WHERE email='$mailname'");
}
if($city!=""){
  $conn->query("UPDATE customer SET city='$city'  WHERE email='$mailname'");
}
if($cont){
  $conn->query("UPDATE customer SET contact='$cont' WHERE email='$mailname'");
}
if($addr!=""){
  $conn->query("UPDATE customer SET address='$addr'  WHERE email='$mailname'");
}
 echo "  <script>
window.location.href='cusprofile.php'</script>";
   
       
}


if(isset($_POST['passup'])){
	$oldpass=$_POST['oldpass'];
 $newpass= $_POST["newpass"];
  $renter=$_POST["renter"];
  if($newpass==$oldpass){ 
	echo "<script>alert('old password and new password are same,try another!'); window.location.href='serprofile.php';</script> ";
}else{

$sql=$conn->query("SELECT pass FROM customer WHERE email='$mailname' ");
$row = $sql -> fetch_assoc();
if($row['pass']==$oldpass){
	if($newpass==$renter){
$conn->query("UPDATE customer SET pass='$newpass' WHERE email='$mailname' ");
echo "  <script> alert('password updated');
window.location.href='cusprofile;'</script>";
}else{
        echo "<script> alert('re-entered password doesnot match');
        window.location.href='cusprofile.php'</script>";
    }

    }else{

    	 echo "<script> alert('old password is incorrect');
         window.location.href='cusprofile.php'</script>";
    }
}
}
}else{
    echo "login";
}

?>