<?php
include '../Config.php';

$title = $_POST['title'];
$thumb = $_POST['thumbnail'];
$content = json_encode($_POST['content']);
$query = mysqli_query($conn, "INSERT INTO blog ( title, thumbnail, content) VALUES ('$title', '$thumb', '$content')");
header("Location: ../view/list.php");
?>