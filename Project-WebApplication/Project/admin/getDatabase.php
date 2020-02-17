<?php
include '../db/database.php';
?>



<?php
$id = $_POST['id'];
$sql = "SELECT * FROM customer WHERE custID = $id";
$result = mysqli_query($link, $sql);
// $row = mysqli_fetch_row($result);
while ($row = mysqli_fetch_row($result))
echo json_encode($row);
?>