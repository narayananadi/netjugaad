<?php

 session_start();


$conn = mysqli_connect('localhost', 'root', '', 'netjugaad');
 $conn2 = mysqli_connect('localhost', 'root', '', 'namelist');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($conn2->connect_error) {
  die("Connection failed: " . $conn2->connect_error);
}
$t=array(0,0,0,0,0,0);

if(isset($_POST['busbtn'])){

$fname=$_POST['name']; 
$mail=$_POST['email'];
$pass=$_POST['password'];
$rent=$_POST['renter'];
$cont=$_POST['contact'];
$ser=$_POST['service'];
$addr=$_POST['city'];
$dob=$_POST['dob'];
$exist = "SELECT email FROM serpro WHERE email = '$mail' UNION SELECT email FROM customer WHERE email = '$mail'";
$ifexist = mysqli_query($conn,$exist);
$data = mysqli_fetch_assoc($ifexist);
$existcontact = "SELECT contact FROM serpro WHERE contact = '$cont' UNION SELECT contact FROM customer WHERE contact = '$cont'";
$ifexistcontact = mysqli_query($conn,$existcontact);
$datap = mysqli_fetch_assoc($ifexistcontact);
if(($data)||($datap)||($pass!=$rent)){
if ($data!="")
{
  $t[0]=1; 
}
if($pass!=$rent){
  $t[1]=1;
}
if ($datap!="")
{
  $t[2]=1;
}
echo "<script> sessionStorage.clear();
sessionStorage.setItem('trigg', '2');</script>";
}
else
{
       $insertintodb = "INSERT INTO serpro(name,email,pass,service,contact,city,dob)  VALUES('$fname','$mail','$pass','$ser','$cont','$addr','$dob')";
       mysqli_query($conn,$insertintodb);
      

$namelistdb="CREATE TABLE `$mail` ( `name` VARCHAR(20) NOT NULL , `email` VARCHAR(40) NOT NULL PRIMARY KEY , `contact` INT(11) NOT NULL , `city` VARCHAR(20) NOT NULL )";
       $conn2->query($namelistdb);
        echo "<script>
        alert('Registered Successfully');
        window.location.href = 'login.html';
        </script>";

}

  }




if(isset($_POST['cusbtn'])){
$fname=$_POST['name2'];
$mail=$_POST['email2'];
$pass=$_POST['password2'];
$rentr=$_POST['renter2'];
$cont=$_POST['contact2'];
$addr=$_POST['city2'];
$dob=$_POST['dob2'];
$exist = "SELECT email FROM customer WHERE email = '$mail' UNION SELECT email FROM serpro WHERE email = '$mail' ";
$ifexist = mysqli_query($conn,$exist);
$num = mysqli_num_rows($ifexist);

$existcontact = "SELECT contact FROM customer WHERE contact = '$cont' UNION SELECT contact FROM serpro WHERE contact = '$cont'";

$ifexistcontact = mysqli_query($conn,$existcontact);
$num2 = mysqli_num_rows($ifexistcontact);
if(($num)||($num2)||($pass!=$rentr)){
if ($num==1)
{
  $t[3]=1; 
}
if($pass!=$rentr){
    $t[4]=1;
}
if ($num2==1)
{
  $t[5]=1;
}echo "<script> sessionStorage.clear();
sessionStorage.setItem('trigg', '1');</script>";}
else
{
       $insertindb = "INSERT INTO customer(name,email,pass,contact,city,dob)  VALUES('$fname','$mail','$pass','$cont','$addr','$dob')";
      // echo $fname." : ".$mail." : ".$pass." : ".$cont." : ".$addr." : ".$dob;
      mysqli_query($conn,$insertindb);
       echo "<script>
       alert('registered successfully!!');
       window.location.href = '../login.html';
       </script>";
}

}
?>

<!DOCTYPE html>
<html lang="en">
  <html>
    <head>
      <script>window.onload = function() 
        { document.getElementById("hideAll").style.visibility="visible";
          



      }
        
      </script>  
      
      <link rel="stylesheet" type="text/css" href="css/sign.css">

      <title>Sign Up</title>
      <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1" />
      <meta charset="utf-8" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    </head>
    <body class="body" >
    <div id="hideAll">
         <ul>
         <li><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="index.html #dev"><i class="fas fa-clipboard"></i> Contact </a></li>
        <li><a href="index.html #dev"><i class="fas fa-address-book"></i> Developer details</a></li>
   <li style="float : right"><a href="login.php">login</a></li>
      </ul><br>
<div class="margin">
<button class='butt' onclick="btn(0);" > Business Sign up </button>
<button class='butt' onclick="btn(1);" > Customer Sign up</button>
</div>


<form name = "business" id="business" action="signin.php" method="post" style="visibility: hidden;"  >
  
    <div class="form">
      <p>Business Sign-up</p> 
           <input type="text" name="name" onclick="change(this)"  id="name" placeholder="Full Name" required />
           <input type="email" name="email" onload="error(this)" onclick="change(this)" id="email" onload="err()"placeholder="Email Address" required />
           <input type="password" name="password"  id="password" onload= onclick="change(this)" onload="err()" placeholder="Set a Password" required/>
           <input type="password"  name="renter" id="renter" onclick="change(this)"onload="err()"  placeholder="Re-enter Password" required />
           <br>
           <i class="fas fa-eye" style="color: #1366aa; font-size: 25px; cursor: pointer;" onclick="show()"></i>
           <br>
           <input type="number"  name="contact" id="contact" onclick="change(this)" onload="err()" placeholder="Contact Number" required /> 
            <input type="text"  name="service" id="service" onclick="change(this)" placeholder="Service" required /> 
           <input type="text"  name="city" id="city" onclick="change(this)" placeholder="City" required /> 
           <input type="date" name="dob" onclick="change(this)"  id="dob" placeholder="Date of Birth" required />
           <button type="submit" name="busbtn" onclick="check()">Sign Up</button><br>
           If you have already signed up then, <a style="color: #16a4e6;" href="login.php" >click here to Sign In!</a> 
         </div>
       
     </form>




     <form name = "customer" id="customer" action="signin.php" method="post" style="visibility: hidden;" >
        <div class="form">
        <p>Customer Sign Up</p>
              <input type="email" name="email2" onclick="change2(this)" id="email2"  placeholder="Email Address" required />
              <input type="text" name="name2" onclick="change2(this)"  id="name2" placeholder="Full Name" required />
              <input type="password" name="password2"  id="password2" onclick="change2(this)" onload="err()" placeholder="Set a Password" required />
              <input type="password"  name="renter2" id="renter2" onclick="change2(this)" placeholder="Re-enter Password" required />
              
              <br>
              <i class="fas fa-eye" style="color: #1366aa; font-size: 25px; cursor: pointer;" onclick="show2()"></i>
              
              <br>
              <input type="number"  name="contact2" id="contact2" onclick="change2(this)"  placeholder="Contact Number" required/>
              <input type="text"  name="city2" id="city2" onclick="change2(this)" placeholder="City" required  />
              <input type="date" name="dob2" onclick="change2(this)"  id="dob2" placeholder="Date of Birth" required />
              <button type="submit" name="cusbtn" onclick="check()">
                Sign Up
              </button><br>
              If you have already signed up then, <a style="color: #16a4e6;" href="login.php" >click here to Sign In!</a>

          </div>
          
        </form>

</div>
    </body>

<script>
function btn(a) {
  if(a==0){
  document.getElementById('customer').style.visibility='hidden';
  document.getElementById('business').style.visibility='visible';
  document.title = 'Business Sign-up';

  }else{
    document.getElementById('customer').style.visibility='visible';
  document.getElementById('business').style.visibility='hidden';
  document.title = 'Customer Sign-Up';

  }
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
        function check(){
  
        var a = document.forms["business"]["name"].value;
        var b = document.forms["business"]["email"].value;
        var c = document.forms["business"]["password"].value;
        var d = document.forms["business"]["renter"].value;
        var e = document.forms["business"]["service"].value;
        var g = document.forms["business"]["contact"].value;
        var h = document.forms["business"]["city"].value;
        var i = document.forms["customer"]["name2"].value;
        var j = document.forms["customer"]["email2"].value;
        var k = document.forms["customer"]["password2"].value;
        var l = document.forms["customer"]["renter2"].value;
        var n = document.forms["customer"]["contact2"].value;
        var o = document.forms["customer"]["city2"].value;
        var p = document.forms["customer"]["dob2"].value;
        var q = document.forms["business"]["dob"].value;
    if (a == ""){ 
      document.getElementById("name").style.border = "3px solid red";                         
     }
    if (b == ""){                          
      document.getElementById("email").style.border = "3px solid red";
    }
    if (c == ""){                          
      document.getElementById("password").style.border = "3px solid red"; 
    }
    if (d==""){
      document.getElementById("renter").style.border = "3px solid red";
    }
    if (e ==""){                          
          document.getElementById("service").style.border = "3px solid red"; 
    }
    if (g == ""){                          
          document.getElementById("contact").style.border = "3px solid red";   
    }
    if (h == ""){                          
          document.getElementById("city").style.border = "3px solid red";
    }
    if (i == ""){ 
      document.getElementById("name2").style.border = "3px solid red";                         
     }
    if (j == ""){                          
      document.getElementById("email2").style.border = "3px solid red";
    }
    if (k == ""){                          
      document.getElementById("password2").style.border = "3px solid red"; 
    }
    if (l==""){
      document.getElementById("renter2").style.border = "3px solid red";
    }
    if (n ==""){                          
          document.getElementById("contact2").style.border = "3px solid red"; 
    }
    if (o ==""){                          
          document.getElementById("city2").style.border = "3px solid red"; 
    }
    if (p == ""){ 
      document.getElementById("dob2").style.border = "3px solid red";                         
     }
     if (q == ""){ 
      document.getElementById("dob").style.border = "3px solid red";                         
     }
  }
  

  function change(element){
  
  }
  

                        // Script to open and close sidebar
                  function w3_open() {
                    document.getElementById("mySidebar").style.display = "block";
                    document.getElementById("myOverlay").style.display = "block";
                  }
                   
                  function w3_close() {
                    document.getElementById("mySidebar").style.display = "none";
                    document.getElementById("myOverlay").style.display = "none";
                  }

                    
function change2(element){
element.style.background="#f2f2f2";
}
function show2() {
        var password2 = document.getElementById("password2");
        var icon = document.querySelector(".fas");
        if (password2.type === "password") {
          password2.type = "text";
        } else {
          password2.type = "password";
        }
        var renter2 = document.getElementById("renter2");
        var icon = document.querySelector(".fas");
        if (renter2.type === "password") {
          renter2.type = "text";
        } else {
          renter2.type = "password";
        }
      } 
    


var trigger1 = <?php echo $t[0] ?>;
  var trigger2 = <?php echo $t[1] ?>;
  var trigger3 = <?php echo $t[2] ?>;
  var trigger4 = <?php echo $t[3] ?>;
  var trigger5 = <?php echo $t[4] ?>;
  var trigger6 = <?php echo $t[5] ?>;
  console.log(trigger1,trigger2,trigger3,trigger4,trigger5,trigger6);
if( trigger1 == 1){
  console.log("trigger 1");
        document.getElementById('email').style.border='2px solid red';
      }
         if( trigger2 == 1){
          console.log("trigger 2");
        document.getElementById('password').style.border='2px solid red';
        document.getElementById('renter').style.border='2px solid red';
      }
      if( trigger3 == 1){
        console.log("trigger 3");
        document.getElementById('contact').style.border='2px solid red';
      }
      if(trigger4  == 1){
        console.log("trigger 4");
        document.getElementById('email2').style.border='2px solid red';
      }
      if(trigger5 == 1){
        console.log("trigger 5");
        document.getElementById('password2').style.border='2px solid red';
        document.getElementById('renter2').style.border='2px solid red';
      }
      if(trigger6 == 1){
        console.log("trigger 6");
        document.getElementById('contact2').style.border='2px solid red';
      }



 var a=sessionStorage.getItem("trigg");
 console.log(a);
         if(a==1){
          console.log("customer");
          document.getElementById('customer').style.visibility='visible';}
         if(a==2){ 
          console.log("business");
          document.getElementById('business').style.visibility='visible';} 
var b = sessionStorage.getItem("btn")
 if(b==1){
          console.log("customer");
          document.getElementById('customer').style.visibility='visible';}
         if(b==2){ 
          console.log("business");
          document.getElementById('business').style.visibility='visible';} 
      sessionStorage.clear();
</script>
    </html>


