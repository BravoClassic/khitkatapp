<?php
include_once "header.php";
session_start();
if(isset($_SESSION['unique_id'])){
    header('Location:users.php');
}
?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Yotes Chat</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-text">This is the error messages! Hehe!</div>
                <div class="name-details" >
                    <div class="field input">
                        <label for="">First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label for="">Last Name</label required>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="Enter Email" required>
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter new Password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label for="">Profile Image</label>
                    <input type="file" name="profile" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Register">
                </div>
                <div class="link">Already signed up? <a href="login.php">Login now</a></div>
            </form>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/register.js"></script>
</body>

</html>