<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
  header('location:login.php');
}


include_once "header.php";
?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <?php
        include_once "includes/db.inc.php";
        $row='';
        $sql_query = mysqli_query($conn, "SELECT * FROM khaters where unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql_query) > 0) {
          $row = mysqli_fetch_assoc($sql_query);
        }
        ?>
        <div class="content">
          <img src="images/users/<?php echo $row['profile']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname'] ." ".$row['lname']; ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="#" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" value="" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
        <!-- <a href="#">
          <div class="content">
            <img src="img.jpg" alt="">
            <div class="details">
              <span>Mom</span>
              <p>This is from mom!</p>
            </div>
          </div>
          <div class="status-dot"><i class="fas fa-circle"></i></div>
        </a> -->
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>