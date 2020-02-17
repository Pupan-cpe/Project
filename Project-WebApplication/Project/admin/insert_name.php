<?php
include '../db/database.php';
?>


<?php
$sql1 = "SELECT `scale01`.`order_id`, `customer`.`custName` FROM scale01 INNER JOIN customer ON scale01.custID = customer.custID";
$result1 = mysqli_query($link, $sql1);
echo json_encode($result1);

?>