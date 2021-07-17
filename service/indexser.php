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
$sql = $conn->query("SELECT * FROM serpro WHERE email = '$mailname'");
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
 

$req = "SELECT * FROM `".$mailname."`";
$resultreq = $connn->query($req);
$resreq = $resultreq->num_rows;
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
        <li><a href="../help.php"><i class="fas fa-clipboard"></i> Help </a></li>
        <li><a href="../index.html #dev"><i class="fas fa-address-book"></i> Developer details</a></li>
        <li><a href="serprofile.php"> My Profile</a></li>
   <li style="float : right"><a href="../query/logout.php">logout</a></li>
      </ul><br>
 

<div class="margin">
<p style="font-size:20px"> Welcome to your dashboard, <?php echo $result["name"]; ?>! <br><br>
You can manage your customer interactions here and keep a record of your work status.<br><br><br><br></p>
<button class="butt tooltip" onclick="window.location.href='serprofile.php';">Profile <i class="fas fa-external-link-alt"></i><span class="tooltiptext">About your profile</span></button>
<button class="butt tooltip" onclick="showsearch(1)">Requests<span class="tooltiptext">Requests</span></button>
<button class="butt tooltip" onclick="showsearch(0)">Search<span class="tooltiptext" >Search for the services</span> </button>
</div>


<div  id="request" style="visibility:hidden;" >
<?php
     
      if ($resreq > 0) {
       echo "<table class='tabular'>
         <tr>
          <th>S. No.</th>
          <th>Name</th>
          <th>City</th>
          <th>Status</th>
          <th>More Details</th>
        </tr>";
      while($row = $resultreq->fetch_assoc()) {
     @$count++;
     
      echo "<tr>
      <td style='text-align: center;'>".$count."</td>
      <td> " . $row["name"] . "</td>
      <td> ". $row["city"]. "</td>
      <td>Completed</td>
      <td><form method='post'  action='profile.php'>
      <button  class='butt' style='width:50%; ' name='submit' id='button' type='submit' value='".$row["email"]."'> Show Profile </button></form>
      </td>";
}
echo "</tr>
</table>";
}else{
 echo "<table class='tabular'> <th>No results found, no one requested yet </th></table>";
}
      ?>
      </div>
      <br><br>
      <form id="search" name="input" action='indexser.php' method='post' class="form"> 
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
        
                  <td> <form method='post' name='submitbutton' action='indexser.php'>
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
