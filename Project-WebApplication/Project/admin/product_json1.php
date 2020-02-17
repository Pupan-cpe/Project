<?php
include '../db/database.php';

$sql =  "SELECT
scale02.order_id,
customer.custName,
product_type.prodTypeName,
scale02.wieght,
Sum(prodPrice * wieght),
scale02.pt_date,
product_type.prodPrice
FROM
scale02
INNER JOIN customer ON scale02.custID = customer.custID
INNER JOIN product_type ON scale02.prodTypeID = product_type.prodTypeID
GROUP BY
scale02.order_id,
customer.custName,
product_type.prodTypeName,
scale02.wieght,
scale02.pt_date";
$result = mysqli_query($link, $sql);

$productArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $productArray[] = $row;
}

echo json_encode($productArray);
// scale 02