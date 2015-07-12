<!DOCTYPE html>
<html>
<head>
<script>
function changeqn() 
{
var rates = document.getElementsByName('rate');
var answer;
for(var i = 0; i < rates.length; i++)
   {
    if(rates[i].checked){
        answer = rates[i].value;
                 }
  } 
 if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
       else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementsByName("rate").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","changeqn.php?q="+answer,true);
        xmlhttp.send();
    location.reload();
}
function showUser() 
{
   
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
       else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtarea").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getscore.php",true);
        xmlhttp.send();
    
}
</script>

<style>
body{
 background-image: url("einstein.jpg");
background-position: right top;
background: -webkit-radial-gradient(circle,white, rgb(255, 255, 255) , rgb(157, 230, 255)); /* For Safari 5.1 to 6.0 */
  background: -o-radial-gradient(circle,white, rgb(255, 255, 255), rgb(157, 230, 255)); /* For Opera 11.1 to 12.0 */
  background: -moz-radial-gradient(circle,white, rgb(255, 255, 255), rgb(157, 230, 255)); /* For Firefox 3.6 to 15 */
  background: radial-gradient(circle,white, rgb(255, 255, 255) , rgb(157, 230, 255)); /* Standard syntax */
} 
#qn{ width:900px; height:80px; font-size:40px;
     osition:relative;
      top:10px;
      left:40px;
     } 
  
#onee{width:80px; height:50px;
      position:relative;
      top:50px; 
    }
#one{ height:50px;
     position:relative;
       left:130px;
       top:80px;
    }
#two{ padding:0.4em;
      width:80px; height:50px;
         position:relative;
        left:70px;
        top:80px; 
     } 
#three{ padding:0.4em; height:50px;
       width:80px;
         position:relative;
          left:200px;

        top:80px; 
     } 
input[type=radio]{
      position:relative;
      top:60px;
      left:80px;
      }

input[type=text]{font-size:20px;
                 width:200px; height:50px;
                 position:relative;
                 top:60px;
                 left:80px;
  
                 }
#txtarea{position:relative;
         top:50px;
        }
</style>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
$name=$_POST['name'];
$username2=$_POST['username']; 
 $password2=$_POST['password'];
session_start();
$_SESSION['NAME']=$name;
$_SESSION['USERNAME']=$username2;
$_SESSION['PASSWORD']=$password2;


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
         $sql="SELECT * FROM Candidates WHERE NAME='$name'
          AND USERNAME='$username2' AND PASSWORD='$password2'";
         $resu = mysqli_query($conn,$sql)or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error("myDB"), E_USER_ERROR);;
         

if (mysqli_num_rows($resu) == 0)
       {
         $sql2 = "INSERT INTO Candidates (NAME, USERNAME, PASSWORD,CURRENTQNID, MARKS) 
         VALUES ('$name','$username2','$password2','1','0')";
         $sult = mysqli_query($conn,$sql2);
         $sql3="select * from questions WHERE questionid=1";
         $result = mysqli_query($conn,$sql3);
         $row = $result->fetch_assoc(); 
         }
else
     {   $sql2="SELECT * FROM Candidates WHERE NAME='$name'
          AND USERNAME='$username2' AND PASSWORD='$password2' ";
         $resul = mysqli_query($conn,$sql2);
         $ro = $resul->fetch_assoc(); 
         $qnid=$ro['CURRENTQNID'];
    if($qnid>"10")
   { header("location: task3logout.html"); 
      exit();
    }
  else{
         $sql3="SELECT * FROM questions WHERE questionid=$qnid";
         $result = mysqli_query($conn,$sql3);
         $row = $result->fetch_assoc(); 
       }    
    }
$conn->close();
?>

<form  method="post" >
<input type="text" id="qn" value="<?php echo $row['question']; ?>" ><br>
<input type="radio" name="rate" value="A" >
<input type="text" value="<?php echo $row['optiona'];?>">
<input type="radio" name="rate" value="B">
<input type="text" value="<?php echo $row['optionb'];?>">
<br><br>
<input type="radio" name="rate" value="C">
<input type="text" value="<?php echo $row['optionc'];?>">
<input type="radio" name="rate"  value="D">
<input type="text" value="<?php echo $row['optiond'];?>">
<br><br>

<input id="two" type="button" onclick="showUser()" name="score" value="score">
<input id="one" type="submit" name="logout" value="save and logout">
<input id="three" type="button" onclick="changeqn()" name="name" value="next">

</form>
<br><br><br><br><br><div id="txtarea"><p></p></div>
<?php

if(isset($_POST['logout']))
{echo '<META HTTP-EQUIV="Refresh" Content="0; URL=task3logout.html">';
}
?>

</body>
</html>