<?php

    session_start();

    $taskArray = $_SESSION['task'];
    $dateStart = $_SESSION['startDate'];
    $dateEnd = $_SESSION['endDate'];
    $id = $_SESSION['id'];
    $process = $_SESSION['process'];
    $color = $_SESSION['color'];
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel = "stylesheet" href = "animate.css">
        <title></title>
        <style>

            body{
              background-image: url('bghomepage.png');
              height:100%;
              background-position: center;
              background-size:cover;
              background-attachment:fixed;
              background-repeat:no-repeat;
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
            th
            {
                background-color: #0066ff;
                color: white;
                text-align: center;
                border:2px solid black;
            }
            th#days
            {
              padding:4px;
              font-size:12px;
            }
            td
            {
               background-color: white;
                border:0.5px solid black;
                border-right-color: green;
            }
            td#days
            {
                width:100px;
                padding:4px;
                background-color: #0066ff;
            }
            tr
            {
                border:2px solid green;
                border-bottom-color:black;
            }
            label
            {
              color:white;
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

            button
            {
              background-color:#0066ff;
              color:white;
              border: none;
              opacity:0.8;

            }

            button:hover
            {
              opacity: 1;
            }

                img#logo {
                opacity: 0.8;
                filter: alpha(opacity=70); /* For IE8 and earlier */
            }

            img#logo:hover {
                opacity: 1.0;
                filter: alpha(opacity=100); /* For IE8 and earlier */

                }

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
                    height:50px;
                    color: black;
                }

                .next {
                    background-color: blue;
                    height:50px;
                    color: white;
                }

                .round {
                    border-radius: 50%;
                }

        </style>
    </head>
    <body>
<center><a href = "home.php"><img src = "logo.png" class="container rubberBand animated" id = "logo" ></a></center>

<button onclick = "goBack()" class="previous" style ="width:auto;">&laquo; Previous</button>
<button onclick = "goNext()" class="next" style ="width:auto;" >Next &raquo; </button>

        <form method="POST">

            <center>
            <br/>
            <br/>
            <label>From: </label><input type="date" name="txt_date_from"> <label>To:</label>
                  <input type="date" name="txt_date_to">
            <br/>
            <br/>

            <input type="submit" name="btn_submit" value="View Gantt Chart" style="width:auto">

            <br/>
            <br/>
            </center>


            <table style="border:2px solid green">

<?php

if(isset($_POST['btn_submit']))
{
    $date_from = $_POST['txt_date_from'];
    $date_to = $_POST['txt_date_to'];

    $start    = (new DateTime($date_from))->modify('first day of this month');
    $end      = (new DateTime($date_to))->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period   = new DatePeriod($start, $interval, $end);
    $numOfDays = 30;




    $year = substr($date_from, -8,4);

    $i = 0;
    foreach ($period as $dt)
        {
                    $monthNum = $dt->format("Y-m-d");
                    $month = substr($monthNum, -5,2);
                    $monthObj = DateTime::createFromFormat('!m', $month);
                    $monthArray[$i] = $monthObj->format('F');

                    $i++;
        }

    $dateRange = getDays($date_from, $date_to);
    $rangeSize = sizeof($dateRange);
    $daysInAMonth = array();
              for($y =0;$y <= sizeof($monthArray);$y++)
              {
                  $daysInAMonth[$y] = 0;
              }
              $temp1 = 0;

                  for($x = 0; $x <= sizeof($monthArray)-1; $x++)
                  {
                      for($i = $temp1; $i <= $rangeSize-1;$i++)
                      {
                         if($dateRange[$i] == monthLimit($monthArray[$x],$year))
                         {
                             $temp1 = $i+1;
                             $daysInAMonth[$x]++;
                             break;
                         }

                          $daysInAMonth[$x]++;
                      }

                  }
              $days = $numOfDays + 1;
              echo "<th>Month/s</th>";
                  for($i = 0; $i <= sizeof($monthArray)-1; $i++)
                  {
                      echo "<th colspan='$daysInAMonth[$i]'>".$monthArray[$i]."</th>";

                  }


                  echo "<tr><th><center><b>Days</b></center></th>";
                  $tempDay = 0;
                                for($x = 0; $x <= sizeof($monthArray)-1; $x++)
                                {
                                    for($i = $tempDay; $i <= $rangeSize-1;$i++)
                                    {
                                       if($dateRange[$i] == monthLimit($monthArray[$x],$year))
                                       {
                                            echo "<th align='center' id=\"days\">". $dateRange[$i] ."</th>";
                                            $tempDay = $i+1;
                                            break;
                                       }
                                        echo "<th align='center' id=\"days\">". $dateRange[$i] ."</th>";
                                    }

                                }
                                echo "</tr>";



                for($x = 0; $x < sizeof($taskArray);$x++)
                    {
                        $taskRange[$x] = getDates($dateStart[$x],$dateEnd[$x]);

                        echo "<tr>";
                        echo "<td id=\"days\"><button name=\"btn_scene$x\">".$taskArray[$x]."</button></td>";

                        $tempDay = 0;
                        $a = 0;

                        for($j = 0; $j < sizeof($monthArray);$j++)
                        {
                            for($i = $tempDay; $i < $daysInAMonth[$j]; $i++)
                              {
                                  if(checkRange($taskRange[$x],$dateRange[$a],$monthArray[$j]))
                                    {
                                         echo "<td style=\"background-color:$color[$x]; border-color:$color[$x];\""
                                          . "align='center'></td>";
                                    }
                                    else {
                                      echo "<td style=\"background-color:white;\""
                                       . "align='center'></td>";
                                    }
                                    $a++;

                             }


                        }
               }

}

 ?>
</table>

<?php

  for($i = 0 ; $i < sizeof($taskArray); $i++)
  {
    if(isset($_POST['btn_scene'.$i]))
    {
      $_SESSION['id'] = $id[$i];
      $_SESSION['process'] = $process[$i];
      $_SESSION['taskName'] = $taskArray[$i];
      echo '<meta http-equiv="refresh" content="0; URL=ScenesOverview.php" />';
    }
  }

?>

</form>





</body>
</html>


<?php

function getDays($date_from,$date_to)
{
    $day_to = substr($date_to, -2,2);
    $new_date_to = substr_replace($date_to, $day_to,-2,2);

      $x = 0;
                $period = new DatePeriod(
                 new DateTime($date_from),
                 new DateInterval('P1D'),
                 new DateTime($new_date_to)
                 );

                foreach($period as $date)
                {
                    $array[] = $date->format('Y-m-d');
                    $dayArray[$x] = substr($array[$x], -2,2);
                    $x++;

                }
       return $dayArray;
}

function getDates($date_from,$date_to)
{
    $day_to = substr($date_to, -2,2);
    $new_date_to = substr_replace($date_to, $day_to,-2,2);

      $x = 0;
                $period = new DatePeriod(
                 new DateTime($date_from),
                 new DateInterval('P1D'),
                 new DateTime($new_date_to)
                 );

                foreach($period as $date)
                {
                    $dateArray[$x] = $date->format('Y-m-d');
                    $x++;

                }
       return $dateArray;
}

function monthLimit($month,$year)
{
    $limit = 0;

    switch($month)
    {
        case "January": $limit = 31;
            break;
        case "February":
        if(!checkLeapYear($year))
        {$limit = 29;}
        else{$limit = 28;}
            break;
        case "March": $limit = 31;
            break;
        case "April": $limit = 30;
            break;
        case "May": $limit = 31;
            break;
        case "June": $limit = 30;
            break;
        case "July": $limit = 31;
            break;
        case "August": $limit = 30;
            break;
        case "October": $limit = 31;
            break;
        case "November": $limit = 30;
            break;
        case "December": $limit = 31;
            break;
        case 11: $limit = 30;
            break;
        case 12: $limit = 31;
            break;
    }

        return $limit;
 }


function checkLeapYear($year)
{
   $isLeapYear = false;
    $result = $year%4;

    if($result != 0)
    {
       $result = $year%100;
         if($result != 0)
         {
           $result = $year%400;
           if($result != 0){$isLeapYear = true;}
         }
    }

return $isLeapYear;
}

function checkRange($taskRange,$day,$month)
{
  $onRange = false;

  $counter = 0;
  foreach($taskRange as $range)
  {
     $taskDay[$counter] = substr($range,-2,2);
     $taskMonth[$counter] = substr($range,-5,2);
     $monthNum[$counter]  = $taskMonth[$counter];
     $dateObj[$counter]  = DateTime::createFromFormat('!m', $monthNum[$counter]);
     $monthName[$counter] = $dateObj[$counter]->format('F');
     $counter++;
  }

  $isPresent = false;
    for($i = 0 ; $i < sizeof($taskRange);$i++)
    {
        if($day == $taskDay[$i]  && $monthName[$i] == $month)
        {
            $onRange = true;
            break;
        }
    }

   return $onRange;

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
