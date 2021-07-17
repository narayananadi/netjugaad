<?php 
session_start();
$conn = new mysqli('localhost', 'root', '', 'netjugaad');
$connn = mysqli_connect("localhost", "root", "", "namelist");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($connn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SESSION["gemail"]==""&&isset($_SESSION["gemail"])){
        echo"<script>
        alert('login to access this content');
        window.location.href = 'login.html';
        </script>";
    }else{
    $mailname=$_SESSION["gemail"];
$sql = $conn->query("SELECT * FROM customer WHERE email = '$mailname'");
$result=mysqli_fetch_assoc($sql);

$list=" SELECT DISTINCT service FROM serpro ";
$listres = $conn->query($list);
$list2=" SELECT DISTINCT city FROM serpro ";
$listres2 = $conn->query($list2);

if(isset($_POST["subsearch"])){
  $ser=$_POST["service"];
  $city=$_POST["city"];
  $sercitysql = "SELECT * FROM serpro WHERE service='$ser' AND city='$city'";
  $sercityresult = $conn->query($sercitysql);
  $res=$sercityresult->num_rows;
  
}
if(isset($_POST['submitbtn'])){
$submit=$_POST['submitbtn'];
$subsql=$connn->query("INSERT INTO `namelist`.`$submit` (name,email,contact,city)
SELECT name,email,contact,city FROM `netjugaad`.`serpro` WHERE email='$mailname'");
echo"<script>alert('Done. You may proceed.');</script>";
}


//------------------------------------------------DND------------------------------------------//
 

    }
?>
<html>
    <head>
        <title>service page </title>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/indexxx.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <script src="https://kit.fontawesome.com/54ffc117cf.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    </head>
    <body class="body">
    <ul>
         <li><a href="../index.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="../login.php"><i class="fas fa-home"></i> login</a></li>
        <li><a href="../signin.php"><i class="fas fa-search"></i> Signup</a></li>
        <li><a href="../index.html #dev"></i> Developer details</a></li>
   <li style="float : right"><a href="../query/logout.php">logout</a></li>
      </ul><br>

<div class="margin">
<p style="font-size:20px"> Welcome to your dashboard, <?php echo $result["name"]; ?>! <br><br>
You can manage your customer interactions here, You can search for the services by clicking search button below and select the desired service and city and also you can manage, update your personal data<br> reminder : dont forgot to fill data after your first login. <br>CONTINUE...<br><br><br><br></p>
<button class="butt tooltip" onclick="window.location.href='cusprofile.php';">Profile <i class="fas fa-external-link-alt"></i><span class="tooltiptext">About your profile</span></button>
<button class="butt tooltip" onclick="showsearch(0)">Search<span class="tooltiptext" >Search for the services</span> </button>
</div>

      <br><br>
      <form id="search" name="input" action='indexcus.php' method='post' class="form"> 
        <select id="service" name="service"required>
          <option value="">Choose service...</option>
        <?php while($imp = mysqli_fetch_assoc($listres)) {
         echo '<option value= "'.$imp["service"].'"> ' .$imp["service"]. ' </option> ' ;
        }
          ?>
        </select> 
        <select id="city" name="city"required>
        <option value="">Select City... </option>
        <?php while($imp2 = mysqli_fetch_assoc($listres2)) {
         echo '<option value= "'.$imp2["city"].'"> ' .$imp2["city"]. ' </option> ' ;
        }
          ?>
        </select> 
        <button type='submit' value='yes' name="subsearch">Submit</button>
        </form>
              <?php
                   if(isset($_POST['subsearch'])){
                  if (@$res > 0) {
                   echo "<br><br><br><br><br><br><table class='Rtabular' id='sertable'><tr>
                    <th> S No. </th>
                   <th> Name </th>
                   <th> Rating</th>
                   <th> Contact </th>
                   <th> Company/shop address </th>
                   <th> City </th> 
                   <th> Email </th>
                   <th> Description </th>
                   <th> Current status </th>
                   ";
                  while($row = $sercityresult->fetch_assoc()) {
                 @$count++;
                  echo " <tr>
                  <td>". $count ."</td>
        
                  <td> " . $row["name"] . "</td>
                  
                  <td> ". $row["rating"]. "</td>
                  
                  <td> ". $row["contact"]. "</td>
                  
                  <td> ". $row["compaddress"]."</td>
                  
                  <td> ". $row["city"]. "</td>
                  
                  <td> ". $row["email"]. "</td>
        
                  <td> ". $row["des"]. "</td>
        
                  <td> <form method='post' name='submitbutton' action='indexcus.php'>
                  <button name='submitbtn' type='submit' value='".$row['email']."'>Request</button></form></td>";
                  
            }
            echo "</tr></table>";
        
            }else{
             echo "<table class='Rtabular'> <th>No results found for this city and service refine your selection ar tell us here at :</th><th><a href='contact.html'>Developer Contact</a></th></table>";
            }
                 }
                  ?>
    </body>


    <script>
  function showsearch(a){
         if(a==1){
            document.getElementById("search").style.visibility="hidden";
            document.getElementById('request').style.visibility='visible';
            document.getElementById("sertable").style.visibility="hidden";
         }else{
            document.getElementById("search").style.visibility="visible";
            document.getElementById('request').style.visibility='hidden';
            document.getElementById("sertable").style.visibility="visible"; 
         }

            }


        </script>
</html>
