<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $port  = 3306;
    $database = 'AMS_DB';

    $project_name = $_SESSION['projectName'];
    $animationDuration = $_SESSION['animationDuration'];
    $ep_count = $_SESSION['ep_count'];
    $numProcess = $_SESSION['NumberOfAnimationProcesses'];


 ?>
 <!DOCTYPE HTML>
<html>
<head>
  <style>
  input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
  }
  body{
    background-image: url('bghomepage.png');
    height:100%;
    background-position: center;
    background-size:cover;
    background-attachment:fixed;
    background-repeat:no-repeat;
  }

  select
  {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  /* Set a style for all buttons */
  button {
      background-color: #0066ff;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;

  }
  button:hover{
    background-color: #6699ff;
  }
  /* Extra styles for the cancel button */
  .cancelbtn {
      padding: 14px 20px;
      background-color: #f44336;
  }
  div#kahon
  {
    background-color:#fefefe;
    padding:20px;
    margin:50px;
    margin-top:-15px;
  }
  @media screen and (max-width: 300px) {
      .cancelbtn, .signupbtn {
         width: 100%;
      }
  }

      img#logo {
      opacity: 0.8;
      filter: alpha(opacity=70); /* For IE8 and earlier */
  }

  img#logo:hover {
      opacity: 1.0;
      filter: alpha(opacity=100); /* For IE8 and earlier */

      }

      h2{
        color:white;
        margin-top: 100px;
        font-style: italic;
        font-size: 40px;
      }


  </style>
</head>
<body>
  <center><a href = "home.php"><img class="container rubberBand animated" src = "logo.png" id = "logo" ></a></center>

    <br/>
    <br/>
    <br/>
    <h2 class="container fadeInRight animated" style = "margin-top: -50px"> Edit Project: <?php echo $project_name?></h2>
  <div id="kahon">

    <button onclick = "goBack()" class="previous" style ="width:auto;">&laquo; Back</button>

       <form class="modal-content animate" method="POST">
         <div class="container">

       <label><b>Project Name</b></label>
          <input type="text" placeholder="Project Name" name="txt_projectName" value="<?php echo $project_name;?>" required>
          <label><b>Animation Duration</b></label>
          <input type="text" placeholder="Scenes per Episode" name="txt_animationDuration" value="<?php echo $animationDuration;?>" required>
          <label><b>Episode Count</b></label>
          <input type="text" placeholder="Episode Count" name="txt_epCount" value="<?php echo $ep_count;?>" required>
          <label><b>Number of Animation Processes</b></label>
          <input type="text" placeholder="Number of Animation Processes" name="txt_numProcess" value="<?php echo $numProcess?>" required>


          <div class=\"clearfix\">

          <button name="btn_continue">Continue</button>


          <?php

              if(isset($_POST['btn_continue']))
              {
                  $_SESSION['projectName'] = $_POST['txt_projectName'];
                  $_SESSION['animationDuration'] = $_POST['txt_animationDuration'];
                  $_SESSION['ep_count'] = $_POST['txt_epCount'];
                  $_SESSION['numProcess'] = $_POST['txt_numProcess'];

                  echo '<meta http-equiv="refresh" content="0; URL=General_productionEdit2.php" />';

              }


           ?>
      </form>



</div>
</body>
</html>
<?php
function sqlConnection($host,$port,$user,$pass,$database)
{
   $conn = mysqli_connect($host, $user, $pass, $database, $port);
   if ($conn->connect_error)
         {
             die("Connection failed: " . $conn->connect_error);
         }

     return $conn;
}

function EditUser($host,$port,$user,$pass,$database,$fname,$lname,$mname,$position,$access,$gender,$username,$password,$oldUsername)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "UPDATE AMS_USERS
          SET USERNAME = '$username',
              PASSWORD = '$password',
              USER_FNAME = '$fname',
              USER_LNAME = '$lname',
              USER_MNAME = '$mname',  
              USER_PRIVILAGE = '$access',
              USER_POSITION = '$position',
              USER_GENDER = '$gender'
              WHERE USERNAME = '$oldUsername'";

  if($conn->query($sql) === TRUE)
  {
    $isSaved = true;
    $conn->close();
  }
  else
  {
    echo "Error:". $sql . $conn->error;
    $conn->close();
  }

  return $isSaved;
}
?>
<script>
function goBack() {
    window.history.back();
}
function goNext()
{
 	window.history.forward();
}
</script>
