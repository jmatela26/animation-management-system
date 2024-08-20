<?php

  session_start();
  $current_user = $_SESSION['user'];
  $access = $_SESSION['access'];


    if(strtoupper($access) != 'ADMIN')
    {
       echo "<script>alert('Login as admin to access this page');</script>";
       echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
    }

  $host = "localhost";
  $user = "root";
  $pass = "";
  $port = 3306;
  $database = "AMS_DB";

  $dataArray = getUserData($host,$port,$user,$pass,$database);

  $username = array(); $fname = array(); $lname = array(); $mname = array(); $access = array();
  $position = array(); $gender = array();

  $username = $dataArray[0];
  $fname = $dataArray[1];
  $lname = $dataArray[2];
  $mname = $dataArray[3];
  $access = $dataArray[4];
  $position = $dataArray[5];
  $gender = $dataArray[6];


 ?>

<!DOCTYPE html>
<html>
<title>Manage Users</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel = "stylesheet" href = "animate.css">
<style>
/* Full-width input fields */
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

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,.signupbtn {float:left;width:50%}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 35px;
    top: 15px;
    color: #000;
    font-size: 40px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
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
table
        {

             border-collapse: collapse;
             width: 100%;
         }

         th, td
         {
             padding: 8px;
             text-align: center;
             border-right: 1px solid #ddd;
             border-bottom: 1px solid #ddd;

         }
         td{
           background-color: white;
         }
         th
         {
             background-color: #0066ff;
             color: white;
             text-align: center;

         }
         h2{
           color:white;
           margin-top: 100px;
           font-style: italic;
           font-size: 40px;
         }


         tr:hover{background-color:#f5f5f5}





</style>
<body>
<center><a href = "home.php"><img class="container rubberBand animated" src = "logo.png" id = "logo" ></a></center>

  <br/>
  <br/>
  <h2 class="container fadeInRight animated" style = "margin-top: -50px"> Manage Users </h2>

        <?php
        echo "<button  class=\"container bounceIn animated\"
        onclick=\"document.getElementById('id01').style.display='block'\" style=\"width:auto;\">Add User</button>  ";
            AddUser();


            if(isset($_POST['btn_signup']))
            {
                $fname = $_POST['txt_fname'];
                $lname = $_POST['txt_lname'];
                $mname = $_POST['txt_mname'];
                $position = $_POST['txt_position'];
                $access = $_POST['cmb_access'];
                $gender = $_POST['rb_gender'];
                $username = $_POST['txt_username'];
                $password = $_POST['txt_password'];
                $rePassword = $_POST['txt_rePassword'];

                if($password == $rePassword)
                {
                    $isSaved = signUp($host,$port,$user,$pass,$database,$fname,$lname,$mname,$position,$access,$gender,$username,$password);

                    if($isSaved)
                    {
                      echo "<script>alert('Sign Up Successfull!');</script>";
                      echo '<meta http-equiv="refresh" content="0; URL=manageusers.php" />';
                    }
                    else
                    {
                      echo "<script>alert('Sign Up Failed!');</script>";
                    }

                }
                else
                {
                  echo "<script>alert('Password and Repeat Password must be the same');</script>";
                }

            }


        ?>

  </form>


<table class="container lightSpeedIn animated">
  <th> Username </th>
  <th> Name </th>
  <th> Access </th>
  <th> Position </th>
  <th> Gender </th>
  <th> Edit/Delete </th>
<form method="POST">
  <?php
  $counter = 0;
      for($i = 0; $i < sizeOf($username); $i++)
      {
        $name = strtoupper($lname[$i] . ", " . $fname[$i] . " " . "$mname[$i]");
          echo "<tr>
                <td><p> $username[$i] </p></td>
                <td><p>$name </p></td>
                <td><p>".strtoupper($access[$i])." </p></td>
                <td><p> $position[$i]</p> </td>
                <td><p> $gender[$i] </p></td>
                <td>  <button name=\"btn_edit$i\">Edit</button>
                      <button name=\"btn_delete$i\">Delete</button> </td>
                </tr>";
          $counter = $i;
      }

      for($i = 0; $i <= sizeOf($counter)+1; $i++)
      {
          if(isset($_POST['btn_edit'.$i]))
          {
             $_SESSION['username'] = $username[$i];
             $_SESSION['password'] = $password[$i];
             $_SESSION['lname'] = $lname[$i];
             $_SESSION['fname'] = $fname[$i];
             $_SESSION['mname'] = $mname[$i];
             $_SESSION['gender'] = $gender[$i];
             $_SESSION['$userPrivilege'] = $access[$i];
             $_SESSION['position'] = $position[$i];

              echo '<meta http-equiv="refresh" content="0; URL=manageusers_edit.php" />';
          }

          if(isset($_POST['btn_delete'.$i]))
          {
            if(DeleteUser($host,$port,$user,$pass,$database,$username[$i]))
            {
               echo "<script>alert('User Deleted');</script>";
               echo '<meta http-equiv="refresh" content="0; URL=manageusers.php" />';
             }
          }
      }


  ?>
</table>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

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

function signUp($host,$port,$user,$pass,$database,$fname,$lname,$mname,$position,$access,$gender,$username,$password)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "INSERT INTO AMS_USERS(USERNAME,PASSWORD,USER_FNAME,USER_LNAME,USER_MNAME,USER_PRIVILAGE,USER_POSITION,USER_GENDER)
                      VALUES('$username','$password','$fname','$lname','$mname','$access','$position','$gender')";


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

function getUserData($host,$port,$user,$pass,$database)
{
  $dataArray = array();
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_USERS";
  $username = array();
  $fname = array();
  $lname = array();
  $mname = array();
  $userPrivileges = array();
  $position = array();
  $gender = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $username[$counter] = $row['USERNAME'];
                   $fname[$counter] = $row['USER_FNAME'];
                   $lname[$counter]= $row['USER_LNAME'];
                   $mname[$counter] = $row['USER_MNAME'];
                   $userPrivileges[$counter] = $row['USER_PRIVILAGE'];
                   $position[$counter] = $row['USER_POSITION'];
                   $gender[$counter] = $row['USER_GENDER'];

                   $counter++;
                }
            }

  $dataArray[0] = $username;
  $dataArray[1] = $fname;
  $dataArray[2] = $lname;
  $dataArray[3] = $mname;
  $dataArray[4] = $userPrivileges;
  $dataArray[5] = $position;
  $dataArray[6] = $gender;

return $dataArray;

}

function AddUser()
{
 displayPopUp("","","","","","","","","");
}

function EditUser($selectedIndex,$host,$port,$user,$pass,$database)
{
  $dataArray = getUserData($host,$port,$user,$pass,$database);

  $username = array(); $fname = array(); $lname = array(); $mname = array(); $access = array();
  $position = array(); $gender = array();

  $username = $dataArray[0];
  $fname = $dataArray[1];
  $lname = $dataArray[2];
  $mname = $dataArray[3];
  $access = $dataArray[4];
  $position = $dataArray[5];
  $gender = $dataArray[6];

  foreach($selectedIndex as $i )
  {

  displayPopUp($fname[$i],$lname[$i],$mname[$i],$position[$i],$access[$i],$gender[$i],$username[$i],"");
  }
}

function DeleteUser($host,$port,$user,$pass,$database,$username)
{
  $isDeleted = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "DELETE FROM AMS_USERS WHERE USERNAME = '$username';";

    if($conn->query($sql) === TRUE)
    {
      $isDeleted = true;
    }
    else
    {
      echo "<script>alert('Error: \" . $sql . \"<br>\". $conn->error');</script>";
    }

  $conn->close();

  return $isDeleted;
}

function displayPopUp($fname,$lname,$mname,$position,$access,$gender,$username,$password)
{
  echo "
   <div id=\"id01\" class=\"modal\">
     <span onclick=\"document.getElementById('id01').style.display='none'\" class=\"close\" title=\"Close Modal\">×</span>
     <form class=\"modal-content animate\" method=\"POST\">
       <div class=\"container\">";

    echo " <label><b>First Name</b></label>
        <input type=\"text\" placeholder=\"First Name\" name=\"txt_fname\" value=\"$fname\" required>
        <label><b>Last Name</b></label>
        <input type=\"text\" placeholder=\"Last Name\" name=\"txt_lname\" value=\"$lname\" required>
        <label><b>Middle Name</b></label>
        <input type=\"text\" placeholder=\"Middle Name\" name=\"txt_mname\" value=\"$mname\" required>
        <label><b>Position</b></label>
        <input type=\"text\" placeholder=\"Position\" name=\"txt_position\" value=\"$position\" required>

        <label><b>User Privilege</b></label>
        <Select name=\"cmb_access\">
          <option value=\"ADMIN\">ADMIN</option>
          <option value=\"ARTIST\">ARTIST</option>
          <option value=\"CHECKER\">CHECKER</option>
        </select>

        <label><b>Gender</b></label>
        <div style=\"border: 1px solid #ccc; margin: 8px 0; padding: 12px 20px;\">

          <label><b>Male</b></label>
          <input type=\"radio\" name=\"rb_gender\" required value=\"Male\">
          <label><b>Female</b></label>
            <input type=\"radio\" name=\"rb_gender\" required value=\"Female\">

        </div>

        <label><b>Username</b></label>
        <input type=\"text\" placeholder=\"Enter Email\" name=\"txt_username\" required>

        <label><b>Password</b></label>
        <input type=\"password\" placeholder=\"Enter Password\" name=\"txt_password\" required>

        <label><b>Repeat Password</b></label>
        <input type=\"password\" placeholder=\"Repeat Password\" name=\"txt_rePassword\" required>

        <div class=\"clearfix\">
          <button type=\"submit\" class=\"signupbtn\" name=\"btn_signup\">Sign Up</button>
          <button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">
          Cancel</button>
      </div></div></div>";
}

?>
<script>
/*$(document).ready(function(){
    $("button").click(function(){

        $("p").replaceWith("<input type=\"text\" name=\"edit_uname\">");

        return false;
    });
});*/
</script>
