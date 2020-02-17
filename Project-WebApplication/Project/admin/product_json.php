<?php
include '../db/database.php';

$sql =  "SELECT
scale01.order_id,
customer.custName,
product_type.prodTypeName,
scale01.wieght,
Sum(prodPrice * wieght),
scale01.pt_date,
product_type.prodPrice
FROM
scale01
INNER JOIN customer ON scale01.custID = customer.custID
INNER JOIN product_type ON scale01.prodTypeID = product_type.prodTypeID
GROUP BY
scale01.order_id,
customer.custName,
product_type.prodTypeName,
scale01.wieght,
scale01.pt_date";
$result = mysqli_query($link, $sql);

$productArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $productArray[] = $row;
}

echo json_encode($productArray);
// scale 02