<?php
include '../Config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM blog WHERE id=$id");
header("Location: ../view/list.php");
?>