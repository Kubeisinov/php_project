<?php
require "app.php";

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $res = mysqli_query($mysqli, "select * from posts where id=$id");
    while($row = mysqli_fetch_array($res)){
        $img = $row["img"];
    }
    unlink($img);
    $mysqli->query("DELETE FROM posts WHERE id=$id") ;

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("Location: index.php");
}