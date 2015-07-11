<!DOCTYPE html>
<html>
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
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$sql="SELECT * FROM Candidates WHERE NAME='$name'
          AND USERNAME='$username2' AND PASSWORD='$password2'";
 $result = mysqli_query($conn,$sql)or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error("myDB"), E_USER_ERROR);;
    $row = mysqli_fetch_array($result);
echo "<table>
<tr>
<th>NAME:</th>
<th>USERNAME:</th>
<th>CURRENT SCORE:</th>

</tr>";
 echo "<tr>";
 echo "<td>" . $row['NAME'] . "</td>";
 echo "<td>" . $row['USERNAME'] . "</td>";
 echo "<td>" . $row['MARKS'] . "</td>";
 echo "</tr>";

echo "</table>";
mysqli_close($conn);
?>
</body>
</html>