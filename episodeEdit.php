<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $port  = 3306;
    $database = 'AMS_DB';

    $id = $_SESSION['episode_id'];
    $ep_name = $_SESSION['ep_name'];
    $projectName = $_SESSION['projectName'];
    $scene_count = $_SESSION['scene_count'];
    $asset_count = $_SESSION['asset_count'];
    $status = $_SESSION['status'];
    $checker = $_SESSION['checker'];

 ?>
 <!DOCTYPE HTML>
<html>
<head>
  <style>
  input[type=text], input[type=password],input[type=number] {
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

      textarea{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      height: 100px;
      }

  </style>
</head>
<body>
  <center><a href = "home.php"><img class="container rubberBand animated" src = "logo.png" id = "logo" ></a></center>

    <br/>
    <br/>
    <h2 class="container fadeInRight animated" style = "margin-top: -50px"> Edit Episode: <?php echo $ep_name?></h2>
  <div id="kahon">
    <form method="POST">

       <label><b>Episodes Name</b></label>
       <input type="text" placeholder="Scene/Asset Name" name="txt_epName"
       value="<?php echo $ep_name;?>" required>

       <label><b>Episodes Checker</b></label>
       <select name="cmb_checker">
         <?php
              if(sizeOf($checker) > 0)
              {echo "<option value=\"$checker\">$checker</option>";}
              else {echo " <option value='' disabled selected>-- Choose Episode Checker -- </option>";}
              displayComboBox($host,$port,$user,$pass,$database);
         ?>
       </select>



       <label><b>Scene Count</b></label>
       <input type="number" placeholder="Number of Scenes" name="txt_sceneCount"
       value="<?php echo $scene_count;?>" required>

       <label><b>Asset Count</b></label>
       <input type="number" placeholder="Number of Assets" name="txt_assetCount"
       value="<?php echo $asset_count;?>" required>

       <label><b>Episode Status</b></label>
       <select name="cmb_status">
         <?php
              if(sizeOf($status) > 0)
              {echo "<option value=\"$status\">$status</option>";}
              else {echo " <option value='' disabled selected>-- Choose Status -- </option>";}
         ?>
         <option value="Approved">Approved</option>
         <option value="Revise">Revise</option>
         <option value="On Going">On Going</option>
       </select>



       <div class="clearfix">

          <button name="btn_update">Update</button>
          <button name="btn_cancel">Cancel</button>

          <?php

            if(isset($_POST['btn_update']))
            {
              $task = $_POST['txt_epName'];
              $scene_count = $_POST['txt_sceneCount'];
              $assetCount = $_POST['txt_assetCount'];
              $status = $_POST['cmb_status'];
              $checker = $_POST['cmb_checker'];

                if(editEpisode($host,$database,$user,$pass,$port,$id,$ep_name,$scene_count,$status,$assetCount,
                               $checker))
                         {
                           echo "<script>alert('$ep_name updated');</script>";
                           echo '<meta http-equiv="refresh" content="0; URL=episode.php" />';
                         }
            }

            if(isset($_POST['btn_cancel']))
            {
                echo '<meta http-equiv="refresh" content="0; URL=episode.php" />';
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

function editEpisode($host,$database,$user,$pass,$port,$id,$emp_name,$scene_count,$status,$asset_count,$checker)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "UPDATE AMS_EPISODE
          SET EPISODE_NAME = '$emp_name',
          SCENE_COUNT = '$scene_count',
          ASSET_COUNT = '$asset_count',
          STATUS = '$status',
          EPISODE_CHECKER = '$checker'
          WHERE EPISODE_ID = $id";

  if($conn->query($sql) === TRUE)
  {
    $isSaved = true;
    $conn->close();
  }
  else
  {
    echo "<scipt>alert('Error: \" . $sql . \"<br>\". $conn->error');</script>";
    $conn->close();
  }

  return $isSaved;
}

function ViewUsers($host,$port,$user,$pass,$database)
{

  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_USERS WHERE UPPER(USER_PRIVILAGE) = 'CHECKER'";
  $name = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                 {
                   $fname[$counter] = $row['USER_FNAME'];
                   $lname[$counter] = $row['USER_LNAME'];
                   $mname[$counter]= $row['USER_MNAME'];

                   $name[$counter] = $fname[$counter] . ' ' . $mname[$counter] . ' ' . $lname[$counter];

                   $counter++;
                }
            }

return $name;
}

function displayComboBox($host,$port,$user,$pass,$database)
{
  $employeeArray = ViewUsers($host,$port,$user,$pass,$database);
  $numOfEmployee = sizeOf($employeeArray);

  for($i = 0 ; $i < $numOfEmployee; $i++)
  {
    $name = strtoupper($employeeArray[$i]);
    echo "<option value=\"$employeeArray[$i]\">$name</option>";
  }

}
?>

<script>
function goBack() {
  window.location = "layoutprojectreport.php";
}
function goNext()
{
 	window.history.forward();
}
</script>
