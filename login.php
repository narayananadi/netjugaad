<?php 
session_start();
$_SESSION["gemail"]='';
$conn = new mysqli('localhost', 'root', '', 'netjugaad');
// Check connection
if ($conn->connect_error) 
{
	die("Connection failed: " . $conn->connect_error);
}
$t=array(0,0,0,0,0);
if(isset($_POST["subbtn"])){
	$mail = $_POST["email"];
	$passw = $_POST["pass"];
	$sql="SELECT email FROM customer WHERE email = '$mail' UNION SELECT email FROM serpro WHERE email = '$mail' ";
	$result=mysqli_query($conn,$sql);
	$data = mysqli_fetch_assoc($result);
	if($data==0)
	{
		$t[0]=1;
	}else{
		$sqlp="SELECT pass FROM customer WHERE email = '$mail' UNION SELECT pass FROM serpro WHERE email = '$mail' ";
		$resultp=mysqli_query($conn,$sqlp);
		$datap=mysqli_fetch_assoc($resultp);
		if($passw != implode($datap)){
			$t[1]=1;
		}else{
			$_SESSION["gemail"]=$mail;
			$cus="SELECT email FROM customer WHERE email = '$mail'";
			$cusres=mysqli_query($conn,$cus);
			$cusdata= mysqli_fetch_assoc($cusres);
			$bus="SELECT email FROM serpro WHERE email = '$mail'";
			$busres=mysqli_query($conn,$bus);
			$busdata = mysqli_fetch_assoc($busres);
			if($cusdata){
				echo "<script> window.location.href='customer/indexcus.php';</script>";
			}
			if($busdata){
				echo "<script> window.location.href='service/indexser.php';</script>";
			}
		}
	}   
}


if(isset($_POST["reset"])){
	echo "<script> sessionStorage.clear();
	sessionStorage.setItem('forg', '2');</script>";
	$mail=$_POST["email2"];
	$dob=$_POST["dob"];
	$newpass= $_POST["newpass"];
	$renter=$_POST["renter2"];
	$sql=$conn->query("SELECT pass,dob FROM customer WHERE email='$mail'");
	$sql2=$conn->query("SELECT pass,dob FROM serpro WHERE email='$mail'");
	$result=mysqli_fetch_assoc($sql);
	$result2=mysqli_fetch_assoc($sql2);
	if($result){
		if(($result["dob"]==$dob) && ($newpass==$renter)){
			$conn->query("UPDATE customer SET pass='$newpass' WHERE email='$mail'");
			echo " echo <script> alert('password updated, please login');
			window.location.href='login.html'</script>";
		}else{
			if($result["dob"]!=$dob){
				$t[2]=1;
			}
			if($newpass!=$renter){
				$t[3]=1;
			}
		}
	}
	if($result2){
		if(($result2["dob"]==$dob) && ($newpass==$renter)){
			$conn->query("UPDATE serpro SET pass='$newpass' WHERE email='$mail'");
			echo "<script> alert('password updated, please login');
			window.location.href='login.html'</script>";
		}else{
			if($result2["dob"]!=$dob)
			{
				$t[2]=1;
			}
			if($newpass!=$renter)
				{
					$t[3]=1;
				}
			}
		}
}
?>


<!DOCTYPE HTML>
<html lang="en" >
<html>
<head>
<script>
function check(){
var x = document.forms["logn"]["email"].value;
var y = document.forms["logn"]["pass"].value;
if (x =="") {
document.getElementById("email").style.border = "3px solid red";}
if (y=="") {
document.getElementById("pass").style.border = "3px solid red";
}
}

function check2(){

if (document.forms["forpas"]["email2"].value=="") {
document.getElementById("email2").style.border = "3px solid red";
}
if (document.forms["forpas"]["city"].value=="") {
document.getElementById("city").style.border= "3px solid red";
}
if (document.forms["forpas"]["newpass"].value=="") {
document.getElementById("newpass").style.border = "3px solid red";
}
if (document.forms["forpas"]["renter2"].value=="") {
document.getElementById("renter2").style.border = "3px solid red";
}
}
function change(element){
element.style.border="3px solid #f2f2f2";
}

function forget(){
document.getElementById("forpas").style.visibility="visible";
}
</script>
<title>Login</title>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/log.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
i {
margin-left: -30px;
cursor: pointer;
}
</style>
<body class="body">
 <ul>
         <li><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="index.html #dev"><i class="fas fa-clipboard"></i> Contact </a></li>
        <li><a href="index.html #dev"><i class="fas fa-address-book"></i> Developer details</a></li>
           <li><a href="help.html"><i class="fas fa-address-book"></i> help</a></li>
   <li style="float : right"><a href="signin.php">Signup</a></li>
      </ul><br>
<div class="form">

<form name="logn" id="logn" action="login.php" method="post">
<lottie-player  src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"  background="transparent"  speed="30" stroke="#1366aa" style="justify-content: center;" loop  autoplay></lottie-player>

<input type="email" name="email" id="email" onclick ="change(this)" placeholder="Email ID" autocomplete="off" required/>

<input type="password" name="pass" id="pass"  onclick ="change(this)"  placeholder="Enter the password" required />
<i class="bi bi-eye-slash" id="togglePassword"></i>
&nbsp;
<a style="text-align:left; cursor: pointer;" onclick="forget()">Forgot password?</a><br>
<br>            
<button type ="submit" name="subbtn" form="logn" onclick = "check()">LOGIN</button><br>
<button type="button"  onclick="window.location.href='signin.php'">SIGN UP</button>

</form>
</div>

<div class="forgot" id="forpas">
<form name="forpass"  id="forpass" method="post" action="login.php" >
<label style="font-size: 24px;"> Reset password</label><br><br><br>
<label>Enter Email</label>
<input type="email" name="email2" id="email2" onclick ="change(this)" placeholder="Email ID" autocomplete="off" required/>
<label> Date of Birth</label>
<input type="date" name="dob" id="dob" onclick ="change(this)" placeholder="date of birth" autocomplete="off" required/>
<label> Enter New Password </label>
<input type="password" name="newpass" id="newpass" placeholder="Password" onclick ="change(this)" autocomplete="off" required/>
<label> Re-enter new password </label>
<input type="password" name="renter2" id="renter2" placeholder="Re-enter" onclick ="change(this)" autocomplete="off" required/>
<button type ="submit" name="reset" form="forpass" onclick = "check2()">RESET</button>
</form>
</div>
<script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#pass');

togglePassword.addEventListener('click', function (e) {
// toggle the type attribute
const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
password.setAttribute('type', type);
// toggle the eye / eye slash icon
this.classList.toggle('bi-eye');
});

var trigger1 = <?php echo $t[0] ?>;
var trigger2 = <?php echo $t[1] ?>;
var trigger3 = <?php echo $t[2] ?>;
var trigger4 = <?php echo $t[3] ?>;
console.log(trigger1,trigger2,trigger2,trigger4);
if( trigger1 == 1){
console.log("trigger 1");
document.getElementById('email').style.border='2px solid red';
alert("Username doesnot exist, try creating one");
}
if( trigger2 == 1){
console.log("trigger 2");
document.getElementById('pass').style.border='2px solid red';
alert("Password incorrect, try again");

}
if( trigger3 == 1){
console.log("trigger 3");
document.getElementById('dob').style.border='2px solid red';
alert("incorrect Date Of Birth");

}
if( trigger4 == 1){
console.log("trigger 4");
document.getElementById('newpass').style.border='2px solid red';
document.getElementById('renter2').style.border='2px solid red';
alert("Retype password correctly");
}
var x=sessionStorage.getItem("trigg");
console.log(x);
if(x==2){
console.log("forget display");
document.getElementById('forpas').style.visibility='visible';}
</script>
</body>
</html>