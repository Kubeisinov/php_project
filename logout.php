<?php require "app.php";

include "header.php"
?>

<?php
$result = $mysqli->query("SELECT * from posts");

if (isset($_SESSION['message'])) { ?>
  <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
  </div>
<?php }
unset($_SESSION['user']);
?>


<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
      <h4><img src="https://www.youlead.lk/mentoring/uploads/default.png" 
      alt="mdo" width="40" height="40" class="rounded-circle" style="margin-bottom: 2px;">
        User</h4>
</ul>
        
      <div class="text-end">
        <a href="login.php" class="btn btn-warning  ">Login</a>
        <a href="register.php" class="btn btn-outline-warning">Registration</a>
      </div>
    </div>
  </div>
</header>

<div class="container">
  <div class="row">
  <?php $sql = "SELECT posts.id, posts.user_id, posts.title, posts.content, posts.creates, posts.img, users.name
         from posts LEFT JOIN users on posts.user_id=users.id ";
        $result = $mysqli->query($sql);
            $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $i++;
        ?>

      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative "style="background-color: white;">
          <div class="col-6 p-4">
            <h3 class="mb-0"><?= $row['title'] ?></h3>
            <div class="mb-1 text-muted"></div>
            <p class="card-text mb-auto"><?= $row['content'] ?></p>
            <p class="card-text mb-auto">Author: <?= $row['name'] ?></p>
            <p class="card-text mb-auto">Date: <?= date("H:i d.m.Y", strtotime($row['creates']))?></p>
          </div>
          <div class="col-6">
            <div class="w-100" style="height: 240px">
              <img class="h-100" style="object-fit: cover; object-position: center" src="<?= $row['img']; ?>" alt="">
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>


<?php include "footer.php" ?>