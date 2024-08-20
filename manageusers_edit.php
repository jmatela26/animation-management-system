<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $port  = 3306;
    $database = 'AMS_DB';


    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $mname = $_SESSION['mname'];
    $position = $_SESSION['position'];
    $userPrivilege = $_SESSION['$userPrivilege'];
    $gender = $_SESSION['gender'];


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
    <h2 class="container fadeInRight animated" style = "margin-top: -50px"> Edit User: <?php echo $username?></h2>
  <div id="kahon">
    <form method="POST">
      <label><b>First Name</b></label>
          <input type="text" placeholder="First Name" name="txt_fname" value="<?php echo $fname;?>" required>
          <label><b>Last Name</b></label>
          <input type="text" placeholder="Last Name" name="txt_lname" value="<?php echo $lname?>" required>
          <label><b>Middle Name</b></label>
          <input type="text" placeholder="Middle Name" name="txt_mname" value="<?php echo $mname?>" required>
          <label><b>Position</b></label>
          <input type="text" placeholder="Position" name="txt_position" value="<?php echo $position?>" required>

          <label><b>User Privilege</b></label>
          <Select name="cmb_access">
            <?php
              if(!empty($userPrivilege))
              {
                echo "<option value=". strtoupper($userPrivilege) . ">". strtoupper($userPrivilege) . "</option>";
              }
            ?>
            <option value="ADMIN">ADMIN</option>
            <option value="ARTIST">ARTIST</option>
            <option value="CHECKER">CHECKER</option>
          </select>

          <label><b>Gender</b></label>
          <div style="border: 1px solid #ccc; margin: 8px 0; padding: 12px 20px;">
            <label><b>Male</b></label>
            <input type="radio" name="rb_gender" value="Male" required >
            <label><b>Female</b></label>
            <input type="radio" name="rb_gender" value="Female" required>
          </div>

          <label><b>Username</b></label>
          <input type="text" placeholder="Enter Email" name="txt_username" value="<?php echo $username;?>" required>

          <label><b>Password</b></label>
          <input type="password" placeholder="Password" name="txt_password" value="<?php echo $password?>" required>

          <button name="btn_update">Update</button>
          <button type = "button" onclick="javascript:window.location='http://localhost:81/ams/manageusers.php';" name="btn_cancel">Cancel</button>
          </form>
          <?php
            $oldUsername = $username;
              if(isset($_POST['btn_update']))
              {
                $fname = $_POST['txt_fname'];
                $lname = $_POST['txt_lname'];
                $mname = $_POST['txt_mname'];
                $position = $_POST['txt_position'];
                $userPrivilege = $_POST['cmb_access'];
                $gender = $_POST['rb_gender'];
                $username = $_POST['txt_username'];
                $password = $_POST['txt_password'];

                if(EditUser($host,$port,$user,$pass,$database,$fname,$lname,$mname,$position,$userPrivilege
                          ,$gender,$username,$password,$oldUsername))
                          {
                            echo "<script>alert('User $username Successfully Updated!');</script>";
                            echo '<meta http-equiv="refresh" content="0; URL=manageusers.php" />';
                          }
                          else {
                            echo 'failed';
                          }
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
