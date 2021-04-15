<?php
session_start();
if(isset($_SESSION['unique_id'])){
    header('Location:users.php');
}
include_once "header.php";
?>

<body data-new-gr-c-s-check-loaded="8.872.0" data-gr-ext-installed="">
    <div class="wrapper">
        <section class="form login">
            <header>Khitkhat</header>
            <form action="#">
                <div class="error-text">This is the error messages! Hehe!</div>
                <div class="field input">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="Enter Email">
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter new Password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Register">
                </div>
                <div class="link">Not registered? <a href="index.php">Register now</a></div>
            </form>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
</body>

</html>