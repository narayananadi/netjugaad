<?php 
session_start();
$mailname=$_SESSION["gemail"];
$conn = mysqli_connect("localhost", "root", "", "netjugaad");
$con = mysqli_connect("localhost", "root", "", "namelist");

if($row=$_POST["button"]){
$sql=$conn->query("SELECT * FROM serpro WHERE email= '$row'");
$result=sqli_fetch_assoc($sql);
}


if(isset($_POST["btn"])){
    $btndata=$_POST["btn"];
$conn->query("INSERT INTO namelist.`" .$btndata. "` SELECT name,contact,city,email from netjugaad.customer WHERE email='$mailname'");
echo "<script> alert('sent');</script>";
}

?>

<html>
    <head>
</head>
<body>
<table class='tabular'> <tr>
      <th> NAME :</th>
      <td> <?php $result["name"] ?></td></tr><tr>
      <th> email :</th>
      <td> <?php $result["email"] ?> </td></tr><tr>
      <th> service :</th>
      <td> <?php $result["service"] ?></td></tr><tr>
      <th> address :</th>
      <td> <?php $result["address"] ?></td></tr><tr>
      <th> city :</th>
      <td>  <?php $result["city"] ?></td></tr><tr>
      <th> contact :</th>
      <td> <?php $result["contact"] ?></td></tr><tr>
      <th> rating :</th>
      <td> <?php $result["rating"] ?></td></tr><tr>
      <th> description :</th>
      <td> <?php $result["des"] ?></td></tr>
</table>
<form method="post" name="sub" action="profile.php">
<button name="btn" form="sub" type="submit" value="<?php $result["email"]?>"> hire </button>
</from>
</body>
</html>