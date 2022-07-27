<?php
require "app.php";

if (!isset($_SESSION['user'])) {
  header("Location:login.php");
  exit();
}

if (isset($_POST['title']) && $_POST['title'] != '') {


  $image_name = $_FILES['image']['name'];

  $temp = explode(".", $image_name);

  $imagepath = "uploads/" . round(microtime(true)) . '.' . end($temp);

  move_uploaded_file($_FILES["image"]["tmp_name"], $imagepath);
  $user_id = $_SESSION['user']['id'];
  // dump($user_id);
  $title = $_POST['title'];
  $content = $_POST['content'];
  $creates = date("Y-m-d H:i:s");

  $mysqli->query("INSERT INTO posts (img, user_id, title, content, creates) 
    VALUES( '$imagepath', '$user_id', '$title', '$content', '$creates')") or
    die($mysqli->error);

  $_SESSION['message'] = "Record has been saved!";
  $_SESSION['msg_type'] = "success";

  header("Location: index.php");
}
// unset($_SESSION['user']);

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

<main class="form-signin" style="width: 400px;height:500px;margin-left:36%;margin: top 40%;">
  <form method="POST" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Create Post</h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="title">
      <label for="floatingInput">Title</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="content">
      <label for="floatingPassword">Content</label>
    </div>
    <div class="form-floating">
      <input type="file" class="form-control" name="image">
      <label for="floatingPassword">Image</label>
    </div>
    <div class="container">
      <a href="index.php" class="btn btn-danger">Cancel</a>
      <button type="submit" name="create" class="btn btn-primary">Create Post</button>
    </div>
  </form>
</main>
<?php include "footer.php" ?>