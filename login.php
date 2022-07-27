<?php
require "app.php";

if (isset($_SESSION['user'])) {
    header("Location:index.php");
    exit();
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $password = md5($_POST['password']);

    $sql = "Select * from users where name='" . $name . "'AND password='" . $password . "' limit 1";

    $result = mysqli_query($mysqli, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "surname" => $user['surname'],
            "password" => $user['password']
        ];

        $_SESSION['message'] = "You have successfully logged in!";
        $_SESSION['msg_type'] = "success";
        
        header("Location:index.php");
        exit();
    } else {
        echo '<h1>You have entered incorrect password</h1>';
    }

    if(isset($_SESSION["name"])){
        header("Locatiom:index.php");
    }
    
}
?>
<?php include "head.php";
include "header.php"  
?>
<?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php }
?>
<div class="signup-form" >
    <img src="https://icon-library.com/images/user-icon-png/user-icon-png-27.jpg" alt="">
    <form action="" method="POST">
        <h1 style="color: white;">Log In</h1>
        <input type="text" placeholder="Name" class="txt" name="name">
        <input type="password" placeholder="Password" class="txt" name="password">
        <input type="submit" value="Log In" class="btn" name="btn-save">
        <h6 style="color: white;">Doт't have an account?</h6><a href="register.php" style="color: white;">Register</a>
    </form>
</div>
<?php include "footer.php" ?>