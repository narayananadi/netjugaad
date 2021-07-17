<?php 
session_start();
$conn = new mysqli('localhost', 'root', '', 'netjugaad');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SESSION["gemail"]==""){
    echo"<script>
    alert('login to access this content');
    window.location.href = 'login.html';
    </script>";
}else{
    $mailname=$_SESSION["gemail"];
$sql = $conn->query("SELECT * FROM serpro WHERE email = '$mailname'");
$row=mysqli_fetch_assoc($sql);
}
?>

<html>
  <head>
    <title> My Profile</title>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/serprofile.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

  <body class="body" >
   <ul>
         <li><a href="../index.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="../login.php"><i class="fas fa-home"></i> login</a></li>
        <li><a href="../signin.php"><i class="fas fa-search"></i> Signup</a></li>
        <li><a href="../help.php"><i class="fas fa-clipboard"></i> Help </a></li>
        <li><a href="../index.html #dev"><i class="fas fa-address-book"></i> Developer details</a></li>
   <li style="float : right"><a href="logout.php">logout</a></li>
      </ul><br>
 
  <div class="btnmargin" >
    
  
  <button style="margin-right: 10px;" class='butt' onclick="btn(1)" > Personal Details</button>
  <button style="margin-right: 10px;" class='butt' onclick="btn(0)" > Company Details </button>
  <button class='butt' onclick="btn(2)" > Update Password </button>
  </div>

<div onload ="onld()">
<form class="form" method="post" name="comp" id="comp" action="update.php" style="visibility:visible;" >
<label> Company Details </label><br>
<input id="compname" name="compname" placeholder="Company Name" />
<input id="address" name="address" placeholder="Company Address" /><br>
<input id="des" name="des" placeholder="Description"/>
<input id="service" name="service" placeholder="Service" /><br><br>
<button type="submit" name="compsub" form="comp">Submit</button> 
</form>
</div>

<div onload ="onld()">
<form class="form" method="post" name="prsnl" id="prsnl" action="update.php" style="visibility:hidden;">
<label> Personal Details</label><br>
<input type="text" name="name" onclick="change(this)"  id="name" placeholder="Full Name" />
<input type="number"  name="contact" id="contact" onclick="change(this)" placeholder="Contact Number"  /> 
<input type="text"  name="city" id="city" onclick="change(this)" placeholder="City" /> 
<br><br>
<button type="submit" name="prsnlsub" form="prsnl">Submit</button> 
</form>
</div>

<div onload ="onld()">
<form class="form" method="post" name="passupdate" id="passupdate" action="update.php" style="visibility:hidden;">
  <label>Update Password</label><br>
 <input type="password" name="oldpass" id="oldpass" placeholder="Present password" onclick ="change(this)" autocomplete="off" required/>
 
 <input type="password" name="newpass" id="newpass" placeholder="New password" onclick ="change(this)" autocomplete="off" required/>
 
 <input type="password" name="renter" id="renter" placeholder="Re-enter new password" onclick ="change(this)" autocomplete="off" required/><br><br>
 <button type ="submit" name="passup" form="passupdate" onclick = "check()">Reset</button><br>
  </form>
</div>

<div class="line"></div>
<div class="textbox"> All Details about the user :</div>
<?php  {
 echo "<table class='tabular'> <tr>
 <th> Name :</th>
 <td> " . $row["name"] . "</td></tr><tr>
 <th> Email :</th>
 <td> ". $row["email"]. "</td></tr><tr>
 <th> City :</th>
 <td> ". $row["city"]. "</td></tr><tr>
 <th> Service :</th>
 <td> ". $row["service"]. "</td></tr><tr>
 <th> Contact :</th>
 <td> ". $row["contact"]. "</td></tr><tr>
 <th> Rating :</th>
 <td> ". $row["rating"]. "/5</td></tr><tr>
 <th> Company Name :</th>
 <td> " . $row["compname"] . "</td></tr><tr>
 <th> Company Address :</th>
 <td> ". $row["compaddress"]. "</td></tr><tr>
 <th> Description :</th>
 <td> ". $row["des"]. "</td>
</tr></table>";
}
?>


<div class="back" > <a href="indexser.php" >back to home </a></div>

</body>

<script>
 


function btn(a) {
  if(a==0){
  document.getElementById('prsnl').style.visibility='hidden';
  document.getElementById('comp').style.visibility='visible';
  document.getElementById('passupdate').style.visibility='hidden';
  }else if(a==1){
    document.getElementById('prsnl').style.visibility='visible';
  document.getElementById('comp').style.visibility='hidden';
   document.getElementById('passupdate').style.visibility='hidden';
  }else if(a==2){
    document.getElementById('prsnl').style.visibility='hidden';
  document.getElementById('comp').style.visibility='hidden';
   document.getElementById('passupdate').style.visibility='visible';
  }
}
 function onld(){
document.getElementById('hideAll').style.visibility='visible';
  }
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
  }
   
  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
  }
  function show() {
          var password = document.getElementById("password");
          var icon = document.querySelector(".fas");
          if (password.type === "password") {
            password.type = "text";
          } else {
            password.type = "password";
          }
          var renter = document.getElementById("renter");
          var icon = document.querySelector(".fas");
          if (renter.type === "password") {
            renter.type = "text";
          } else {
            renter.type = "password";
          }
        }              

    </script>
</html>