<?php

  session_start();
  error_reporting(0);
  
  $current_user = $_SESSION['user'];
  

  if(empty($current_user))
  {
      echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
  }

  $host = "localhost";
  $user = "root";
  $pass = "";
  $port = 3306;
  $database = "AMS_DB";


 ?>

<!DOCTYPE html>
<html>
<title>My Assets</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

input[type=submit] {
    background-color: #0066ff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;

}

input[type=submit]:hover{
  background-color: #6699ff;
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

         a {
             text-decoration: none;
             display: inline-block;
             padding: 8px 16px;
             opacity 0.9;
         }

         a:hover {
             opacity 1;
             color: black;
         }

         .previous {
             background-color: #f1f1f1;
             color: black;
         }

         .next {
             background-color: blue;
             color: white;
         }

         .round {
             border-radius: 50%;
         }

         #myImg {
             border-radius: 5px;
             cursor: pointer;
             transition: 0.3s;
         }

         #myImg:hover {opacity: 0.7;}

         /* The Modal (background) */
         .modal2 {
             display: none; /* Hidden by default */
             position: fixed; /* Stay in place */
             z-index: 1; /* Sit on top */
             padding-top: 100px; /* Location of the box */
             left: 0;
             top: 0;
             width: 100%; /* Full width */
             height: 100%; /* Full height */
             overflow: auto; /* Enable scroll if needed */
             background-color: rgb(0,0,0); /* Fallback color */
             background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
         }

         /* Modal Content (image) */
         .modal-content2 {
             margin: auto;
             display: block;
             width: 80%;
             max-width: 700px;
         }

         /* Caption of Modal Image */
         #caption2 {
             margin: auto;
             display: block;
             width: 80%;
             max-width: 700px;
             text-align: center;
             color: #ccc;
             padding: 10px 0;
             height: 150px;
         }

         /* Add Animation */
         .modal-content2, #caption {
             -webkit-animation-name: zoom;
             -webkit-animation-duration: 0.6s;
             animation-name: zoom;
             animation-duration: 0.6s;
         }

         @-webkit-keyframes zoom {
             from {-webkit-transform:scale(0)}
             to {-webkit-transform:scale(1)}
         }

         @keyframes zoom {
             from {transform:scale(0)}
             to {transform:scale(1)}
         }

         /* The Close Button */
         .close2 {
             position: absolute;
             top: 15px;
             right: 35px;
             color: #f1f1f1;
             font-size: 40px;
             font-weight: bold;
             transition: 0.3s;
         }

         .close2:hover,
         .close2:focus {
             color: #bbb;
             text-decoration: none;
             cursor: pointer;
         }

         /* 100% Image Width on Smaller Screens */
         @media only screen and (max-width: 700px){
             .modal-content {
                 width: 100%;
             }
         }


</style>
<body>
<center><a href = "home.php"><img src = "logo.png" id = "logo" ></a></center>
  <br/>
  <br/>
  <h2 style = "margin-top:-60px"> My Assets </h2>

  <form method="POST">

  <select name = "cmb_sort1">
      <option value='' disabled selected>Sort</option>
      <option value='ASSET_ID'>Sort by ID</option>
      <option value='ASSET_Type'>Sort by Type</option>
      <option value='ASSET_PROJECT'>Sort by Project</option>
      <option value='ASSET_NAME'>Sort by Name</option>
      <option value='ASSET_STATUS'>Sort by Status</option>
   </select>
   <select name = "cmb_sort2">
     <option value='' disabled selected>Sort by Type</option>
     <option value='Default'>Default</option>
     <option value='Character'>Characters only</option>
     <option value='Place'>Backgrounds only</option>
     <option value='Props'>Props only</option>
   </select>
   <select name = "cmb_sort3">
       <option value='' disabled selected>Sort by Status</option>
       <option value='Default'>Default</option>
       <option value="Waiting to Start">Waiting to Start</option>
       <option value="Ready to Start">Ready to Start</option>
       <option value="In Progress">In Progress</option>
       <option value="Pending Review">Pending Review</option>
       <option value="Final">Final</option>
       <option value="On Hold">On Hold</option>
       <option value="N/A">N/A</option>
   </select>
   <button name = 'btn_sort'> SORT TABLE </button>
   <?php

     $whereClause = "";
     $orderbyClause = "";

       if (isset($_POST['btn_sort']))
       {
         if(isset($_POST['cmb_sort1']))
         {
           $sort1 = $_POST['cmb_sort1'];
           $orderbyClause = "ORDER BY $sort1";
         }
         if(isset($_POST['cmb_sort2']))
         {
           $sort2 = $_POST['cmb_sort2'];
           $whereClause = "WHERE ASSET_TYPE = '$sort2'";
           if($sort2 == 'Default')
           {
             $whereClause = '';
           }
         }
         if(isset($_POST['cmb_sort3']))
         {
           $sort3 = $_POST['cmb_sort3'];
           if(sizeof($whereClause) > 0)
           {
             if($sort3 != 'Default')
             {
               $whereClause .= "AND ASSET_STATUS = '$sort3'";
             }
           }
           else
           {
              $whereClause = "WHERE ASSET_STATUS = '$sort3'";
              if($sort3 == 'Default')
              {
                $whereClause = '';
              }
           }
         }



       }
       $dataArray = getUserData($host,$port,$user,$pass,$database,$orderbyClause,$whereClause);

       $asset_id = array(); $asset_name = array(); $asset_type = array(); $asset_thumbnail = array(); $asset_project = array();
       $asset_description = array(); $asset_status = array();

       $asset_id = $dataArray[0];
       $asset_name = $dataArray[1];
       $asset_type = $dataArray[2];
       $asset_thumbnail = $dataArray[3];
       $asset_project = $dataArray[4];
       $asset_description = $dataArray[5];
       $asset_status = $dataArray[6];

    ?>
</form>



        <?php

        ?>

  </form>


<table>
  <th> ID </th>
  <th> Thumbnail</th>
  <th> Name </th>
  <th> Type </th>
  <th> Project </th>
  <th> Description </th>
  <th> Status </th>
<form method="POST">
  <?php

//  $headerArray = countProjects($host,$port,$user,$pass,$database);
  //$head = ;
  //for($j = 0; $j < $headerArray[1]; $j++)
  //{
      for($i = 0; $i < sizeOf($asset_id); $i++)
      {

          echo "<tr>
                <td><p> $asset_id[$i] </p></td>
                <td><p><img src=\"uploads/$asset_thumbnail[$i]\" id=\"myImg\" style=\"
                   width:200px; height:170px;\" alt=\"No image\" /> </p></td>
                <td><p>".strtoupper($asset_name[$i])." </p></td>
                <td><p> $asset_type[$i]</p> </td>
                <td><p> $asset_project[$i] </p></td>
                <td><p> $asset_description[$i]</p> </td>
                <td><p> $asset_status[$i] </p></td>
                </tr>";

      }
//  }


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

function saveData($host,$port,$user,$pass,$database,$asset_name,$asset_type, $asset_thumbnail,$asset_project,$asset_description,$asset_status)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "INSERT INTO AMS_ASSETS(asset_name,asset_type, asset_thumbnail,asset_project,asset_description,asset_status)
                VALUES('$asset_name','$asset_type', '$asset_thumbnail','$asset_project','$asset_description','$asset_status')";


  if($conn->query($sql) === TRUE)
  {
    $isSaved = true;
    $conn->close();
  }
  else
  {
  //  echo "<scipt>alert('Error: \" . $sql . \"<br>\". $conn->error');</script>";
    $conn->close();
  }

  return $isSaved;
}

function getUserData($host,$port,$user,$pass,$database,$orderbyClause,$whereClause)
{
  $dataArray = array();
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_ASSETS ". $whereClause." ".$orderbyClause.";";
  $asset_id = array();
  $asset_name = array();
  $asset_type = array();
  $asset_thumbnail = array();
  $asset_project = array();
  $asset_description = array();
  $asset_status = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $asset_id[$counter] = $row['asset_id'];
                   $asset_name[$counter] = $row['asset_name'];
                   $asset_type[$counter]= $row['asset_type'];
                   $asset_thumbnail[$counter] = $row['asset_thumbnail'];
                   $asset_project[$counter] = $row['asset_project'];
                   $asset_description[$counter] = $row['asset_description'];
                   $asset_status[$counter] = $row['asset_status'];

                   $counter++;
                }
            }
            else {
              //echo "<scipt>alert('Error: \" . $sql . \"<br>\". $conn->error');</script>";
              $conn->close();
            }

  $conn->close();
  $dataArray[0] = $asset_id;
  $dataArray[1] = $asset_name;
  $dataArray[2] = $asset_type;
  $dataArray[3] = $asset_thumbnail;
  $dataArray[4] = $asset_project;
  $dataArray[5] = $asset_description;
  $dataArray[6] = $asset_status;

return $dataArray;

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

function DeleteUser()
{

}


function checkFileError($fileActualExt,$allowed,$fileError,$fileSize)
 {
     $isValid = false;

     if(in_array($fileActualExt,$allowed))
      {
       if($fileError === 0)
       {
           $isValid = checkFileSize($fileSize);
       }
     else
        {
           echo 'there is an error uploading your file!';
        }
      }
      else
      {
         echo 'You can only upload png and jpg files (pictures)';
      }

     return $isValid;
 }


 function checkFileSize($fileSize)
 {
    $isValid = false;
       if($fileSize < 1000000)
        {
         $isValid = true;
        }
        else
           {
             echo 'your file is too big';
           }

   return $isValid;
 }

 function uploadImage($fileTmpName,$fileActualExt,$allowed,$fileError,$fileSize)
 {
     if(checkFileError($fileActualExt, $allowed, $fileError, $fileSize))
     {
            $fileNameNew = uniqid('',true) . '.' . $fileActualExt;
            $fileDestination = 'uploads/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            $img_id = $fileNameNew;
     }
     else
     {
       $img_id = null;
     }

   return $img_id;

 }

function countProjects($host,$port,$user,$pass,$database)
{
   $conn = sqlConnection($host,$port,$user,$pass,$database);

   $sql = "SELECT * FROM AMS_PROJECTS;";

   $projectName = array();

   $result = $conn->query($sql);
   if ($result->num_rows > 0)
   {
       while($row = $result->fetch_assoc())
        {
          $projectName[$counter] = row['PROJECT_NAME'];
          $counter++;
        }
  }

  $dataArray[0] = $projectName;
  $dataArray[1] = $counter;

 return $dataArray;

}

function processDrpdown($selectedVal) {
    echo "<script>alert('$selectedVal.asdasd');</script>";

}




?>

<script>
// Get the modal
<script>
function goBack() {
    window.history.back();
}
function goNext()
{
 	window.history.forward();
}
</script>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption2");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
</script>
