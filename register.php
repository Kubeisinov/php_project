<?php
require "app.php";
if(isset($_SESSION['user'])){

    header("Location:index.php");
}

?>
<?php


if (isset($_POST['btn-save'])) {
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $surname = mysqli_real_escape_string($mysqli, $_POST['surname']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $cpass = mysqli_real_escape_string($mysqli, $_POST['cpass']);

    if (empty($name) || empty($surname) || empty($password) || empty($cpass)) {
        echo 'Please Fill in the Blanks!';
    }
    if ($password != $cpass) {
        echo 'Password Not Matched!';
    } else {
        $pass = md5($password);
        $sql = "Insert into users (name, lname, password) values
        ('$name','$surname','$pass')";
        $result = mysqli_query($mysqli, $sql);

        if ($result) {
            header("Location:login.php");
            echo 'Your record has been saved in the Database!';
        } else {
            echo 'Please check your query';
        }
    }
}?>
<?php include "head.php" ?>
<header class="p-3 bg-dark text-white">
    <div class="container">

        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <h4><img src="https://www.youlead.lk/mentoring/uploads/default.png" alt="mdo" width="50" height="50" class="rounded-circle" style="margin-bottom: 2px;">
                        <?= $_SESSION['user']['name'] ?></h4>

                </li>
            </ul>

            <div class="text-end">
                <a href="index.php" class=" btn btn-outline-light">Home</a>
            </div>
        </div>
    </div>
</header>
<div class="signup-form">
    <img src="https://icon-library.com/images/user-icon-png/user-icon-png-27.jpg" alt="">
    <form action="" method="POST">
        <input type="text" placeholder="Name" class="txt" name="name">
        <input type="text" placeholder="Surname" class="txt" name="surname">
        <input type="password" placeholder="Password" class="txt" name="password">
        <input type="password" placeholder="Confirm password" class="txt" name="cpass">
        <input type="submit" value="Register" class="btn" name="btn-save">
        <h6 style="color: white;">Do you already have an account?</h6><a href="login.php" style="color: white;">Log In</a>
    </form>
</div>
<?php include "footer.php" ?>