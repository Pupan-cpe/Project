<?php

include '../db/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM product_type WHERE prodTypeID='$id'";

$result = mysqli_query($link, $sql);

if($result){


    header("Location: product_type.php");
}