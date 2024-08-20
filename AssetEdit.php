<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $port  = 3306;
    $database = 'AMS_DB';


    $asset_thumbnail = $_SESSION['asset_thumbnail'];
    $asset_name = $_SESSION['asset_name'];
    $asset_type = $_SESSION['asset_type'];
    $asset_project = $_SESSION['asset_project'];
    $asset_description = $_SESSION['asset_description'];
    $asset_status = $_SESSION['asset_status'];
    $oldAssetname = $asset_name;

 ?>
 <!DOCTYPE HTML>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    <h2 class="container fadeInRight animated" style = "margin-top: -50px"> Edit Asset: <?php echo $asset_name?></h2>
    <div id="kahon">
        <div class="container">
          <form method="POST" enctype="multipart/form-data">
            <script>
            function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#blah')
                                .attr('src', e.target.result)
                                .width(200)
                                .height(200);
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

     <label><b>Thumbnail</b></label>
     <br/>
     <center>
      <img id="blah" src="uploads/<?php if(empty($asset_thumbnail)){echo "Images/default_profilePic.jpg";}
      else{echo $asset_thumbnail;}; ?> " style=" margin-bottom:15px;
           width:200px; height:170px;" alt="no image" />
           <br/>
       <input type="File" name="img_pic"
            onchange="readURL(this);" style="margin-left:150px;  color:transparent;"/>
     </center>
     <br/>
         <label><b>Asset Name</b></label>
         <input type="text" placeholder="Asset Name" name="txt_asset_name" value="<?php echo $asset_name?>" required>
         <label><b>Type</b></label>
         <Select name="txt_asset_type" required>
         <option value="Character">Character</option>
         <option value="Background">Background</option>
         <option value="Props">Props</option>
         </select>


         <label><b>Project</b></label>
         <input type="text" placeholder="Project" name="txt_asset_project" value="<?php echo $asset_project?>" required>
         <label><b>Description</b></label>
         <input type="text" placeholder="Description" name="txt_asset_description" value="<?php echo $asset_description?>" required>

         <label><b>Status</b></label>
         <Select name="cmb_status">
           <?php echo "<option value=\"$asset_status\">$asset_status</option>";?>
           <option value="Waiting to Start">Waiting to Start</option>
           <option value="Ready to Start">Ready to Start</option>
           <option value="In Progress">In Progress</option>
           <option value="Pending Review">Pending Review</option>
           <option value="Final">Final</option>
           <option value="On Hold">On Hold</option>
           <option value="N/A">N/A</option>
         </select>


            <div class=\"clearfix\">
          </div></div></div>";
          <button name="btn_update">Update</button>
          <button name="btn_cancel">Cancel</button>

          <?php

              if(isset($_POST['btn_update']))
              {
                $asset_name = $_POST['txt_asset_name'];
                $asset_type = $_POST['txt_asset_type'];
                $asset_project = $_POST['txt_asset_project'];
                $asset_description = $_POST['txt_asset_description'];
                $asset_status = $_POST['cmb_status'];

                  if(isset($_FILES['img_pic'])){
                    $file = $_FILES['img_pic'];
                    $fileName = $_FILES['img_pic']['name'];
                    $fileTmpName = $_FILES['img_pic']['tmp_name'];
                    $fileSize = $_FILES['img_pic']['size'];
                    $fileError = $_FILES['img_pic']['error'];
                    $fileType = $_FILES['img_pic']['type'];

                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));

                    $allowed = array('jpg', 'jpeg', 'png');

                    $asset_thumbnail = uploadImage($fileTmpName, $fileActualExt, $allowed, $fileError, $fileSize);
                  }


                if(editData($host,$port,$user,$pass,$database,$asset_name,$asset_type, $asset_thumbnail,$asset_project,$asset_description,$asset_status,$oldAssetname))
                          {
                            echo "<script>alert('Asset $asset_name Successfully Updated!');</script>";
                            echo '<meta http-equiv="refresh" content="0; URL=viewAssets.php" />';
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

function editData($host,$port,$user,$pass,$database,$asset_name,$asset_type, $asset_thumbnail,$asset_project,$asset_description,$asset_status,$oldAssetname)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "UPDATE AMS_ASSETS
          SET ASSET_NAME = '$asset_name',
              ASSET_TYPE = '$asset_type',
              ASSET_THUMBNAIL = '$asset_thumbnail',
              ASSET_PROJECT = '$asset_project',
              ASSET_DESCRIPTION = '$asset_description',
              ASSET_STATUS = '$asset_status'
              WHERE ASSET_NAME = '$oldAssetname'";


  if($conn->query($sql) === TRUE)
  {
    $isSaved = true;
    $conn->close();
  }
  else
  {
  //echo "<scipt>alert('Error: \" . $sql . \"<br>\". $conn->error');</script>";
    $conn->close();
  }

  return $isSaved;
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


 ?>
