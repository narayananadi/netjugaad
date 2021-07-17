    <?php 
    session_start();
    $mailname=$_SESSION["gemail"];
    $conn = mysqli_connect("localhost", "root", "", "namelist");

    $row=$_POST["submit"];

    if($row){
        $sql=$conn->query("SELECT * FROM `".$mailname."` WHERE email='$row' ");
        $result=$sql->fetch_assoc();

    }

    ?>

    <html>
    <head>
        <title>profiles </title>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/serprofile.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


    </head>
    <body class="body">
<ul>
         <li><a href="#home"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="#home"><i class="fas fa-home"></i> login</a></li>
        <li><a href="#home"><i class="fas fa-search"></i> Search</a></li>
        <li><a href="#news"><i class="fas fa-clipboard"></i> Contact </a></li>
        <li><a href="#contact"><i class="fas fa-address-book"></i> Developer details</a></li>
        <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Profile</a>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </li> 
   <li style="float : right"><a href="../query/logout.php">logout</a></li>
      </ul><br>


        <table class='tabular' > <tr>
          <th> NAME :</th><td> <?php echo $result["name"] ?></td></tr>
         <tr> <th> email :</th><td> <?php echo $result["email"] ?> </td></tr>
          
         <tr> <th> city :</th><td>  <?php echo $result["city"] ?></td></tr>
         <tr> <th> contact :</th><td> <?php echo $result["contact"] ?></td></tr>
     
  </table>
  <div class="back" style=" margin-top: 700px" > <a href="indexser.php" >back to home </a></div>
<div class="tabular"  style=" height : 290px" ><table><tr> <td> For further details, Contact to the given OFFICIAL NUMBER given in the box. <br><br>as our website is till under development,<br> <br>chat box comming soon...</td></tr></table>
</body>
</html>