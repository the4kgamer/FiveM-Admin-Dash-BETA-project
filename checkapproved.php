<?php 

$conn = mysqli_connect("localhost", "root", "", "adminmanagement");

//$result = mysqli_query($conn, "SELECT * FROM sessionapproved WHERE name = '" . $_SESSION['usr_name'] . "'");
$result = mysqli_query($conn, "SELECT * FROM sessionapproved");
$data = array();

while ($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;

}

echo json_encode($data);


?> 

