<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
session_start();
$name=$_SESSION['NAME'];
$username2=$_SESSION['USERNAME'];
$password2=$_SESSION['PASSWORD'];
$answer= intval($_GET['q']);
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
                          } 
         $sql="SELECT * FROM Candidates WHERE NAME='$name'
          AND USERNAME='$username2' AND PASSWORD='$password2'";
         $resu = mysqli_query($conn,$sql)or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error("myDB"), E_USER_ERROR);;
         $details=$resu->fetch_assoc(); 
      $qnid1=$details['CURRENTQNID'];
         $sql3="select * from questions WHERE questionid='$qnid1'";
         $result = mysqli_query($conn,$sql3);
         $row = $result->fetch_assoc(); 
         $qnid1=$qnid1+1;        
       $answer2 =$row['answer'];
if($answer==$answer2)
{
  $details['MARKS']=$details['MARKS']+1;
  $newmark=$details['MARKS'];
  $sql5="UPDATE Candidates SET MARKS='$newmark',CURRENTQNID='$qnid1' WHERE 
  NAME='$name'  AND USERNAME='$username2' AND PASSWORD='$password2'";
  $dataupdate = mysqli_query($conn,$sql5);
}

else
{   
    $details['MARKS']=$details['MARKS']-1;
    $newmark=$details['MARKS'];
    $sql5="UPDATE Candidates SET MARKS='$newmark',CURRENTQNID='$qnid1' WHERE 
    NAME='$name'  AND USERNAME='$username2' AND PASSWORD='$password2'";
    $dataupdate = mysqli_query($conn,$sql5);
}

    echo  $row['question'] ;
    echo  $row['optiona'] ;
    echo  $row['optionb'] ;
    echo  $row['optionc'] ;
    echo $row['optiond'] ;
echo $answer;
mysqli_close($conn);
?>
</body>
</html>