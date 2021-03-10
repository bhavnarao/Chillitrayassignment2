<?php 
$conn = mysqli_connect('localhost', 'root', '','chillitray'); 
if( !empty($conn->connect_errno)) 
{
    die("Error " . mysqli_error($conn));
}
$sql1 = "SELECT SINo, Title, ParentID FROM test";
$result1 = mysqli_query($conn, $sql1);

//for printing the table
if (mysqli_num_rows($result1) > 0) {
    echo "<b><u>The values fetched from MySQL are mentioned below</u></b>";
    echo nl2br("\n\n ");  
    echo "<table border='2'>
    <tr>
    <th>SI No.</th>
    <th>Title</th>
    <th>Parent Id</th>
    </tr>";
  while($row = mysqli_fetch_assoc($result1)) {
    echo "<tr>";
    echo "<td>" . $row['SINo'] . "</td>";
    echo "<td>" . $row['Title'] . "</td>";
    echo "<td>" . $row['ParentID'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";

} else {
  echo "0 results";
}


//Algorithm for heirarchy

echo nl2br("\n\n "); 
echo "<b><u>The Heirarchy Tree using Recursive Algorithm is</u></b>";
category_tree(0);
function category_tree($catid){
global $conn;
 
$sql = "select * from test where ParentID ='".$catid."'";
$result = mysqli_query($conn, $sql);
 
while($row = mysqli_fetch_assoc($result)):
$i = 0;
if ($i == 0) echo '
<ul>';
 echo '
<li>' . $row["Title"];
 category_tree($row["SINo"]);
 echo '</li>
 
';
$i++;
 if ($i > 0) echo '</ul>
 
';
endwhile;
}
//close the connection
mysqli_close($conn);
?>