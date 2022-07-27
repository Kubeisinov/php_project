<?php
require "app.php";

if (empty($_SESSION['user'])) {
    header("Location:login.php");
    exit;
}


$id = '';
$title = '';
$content = '';
$user_id = '';
$img = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM posts  WHERE id=$id LIMIT 1");
    $row = $result->fetch_array();

    if (count($row) > 0) {
        
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
        $user_id = $row['user_id'];
        $img = $row['img'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $old = $_POST['img_old'];
    $image_name = $_FILES['image']['name'];

    if ($image_name != '') {
        unlink($old);
    }

    $temp = explode(".", $image_name);
    $imagepath = "uploads/" . round(microtime(true)) . '.' . end($temp);
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagepath);

    $query = ("UPDATE posts SET title = '$title', content = '$content', img = '$imagepath' WHERE id=$id");
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "success";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['message'] = "Record hasn't updated!";
        $_SESSION['msg_type'] = "danger";
        header("Location: edit.php");
    }
}

if ($_SESSION['user']['id'] != $user_id) {

    ("Location:index.php");
    exit;
}
?>

<?php include "header.php" ?>
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
<main class="form-signin" style="width: 400px;height:500px;margin-left:36%">
    <form method="POST" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal">Update Post</h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="title" value="<?= $title ?>">
            <label for="floatingInput">Title</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="content" value="<?= $content ?>">
            <label for="floatingPassword">Content</label>
        </div>
        <div class="form-floating">
            <input type="file" class="form-control" name="image" value="">
            <input type="hidden" name="img_old" value="<?= $img ?>">
            <label for="floatingPassword">Image</label>
        </div>
        <img src="<?php echo "uploads/" . $row['image'] ?>" width="100px" height="100px" alt="">
        <div class="container">
                <a href="index.php" class="btn btn-danger">Cancel</a>
                <button type="submit" name="update" class="btn btn-primary">Update Post</button>
            </div>
    </form>
</main>
<?php include "footer.php" ?>