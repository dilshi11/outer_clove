<?php

$conn = mysqli_connect('localhost', 'root', '', 'user_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $select = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];
        $user_type = $row['user_type']; 

        if (password_verify($password, $hashed_password)) {

            if ($user_type === 'admin') {
                header('Location: Admin.html');
                exit();
            } else if ($user_type === 'user') {
                header('Location: Index.html');
                exit();
            }
        } else {
            // Incorrect password
            $error = 'Incorrect password!';
        }
    } else {
        // User not found
        $error = 'User not found!';
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/Register_Login.css">
    <style>
        @charset "utf-8";
/* CSS Document */
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,900&display=swap');

*{
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  

}


.header {
  color: #fff;
  padding: 0px 20px;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1;
}


.nav-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0px 50px 5px 0px;
      background-color: rgb(61, 61, 61);
      width: 100%;
}


.nav-bar .title {
  color: #fff;
  font-size: 50px;
  font-weight: 600;
  padding: 0px 30px;
}

span {
  color: orange;
  font-weight: bold;
  border-radius: 2px;
}


.page li {
  list-style: none;
  display: inline-block;
}


.page li a {
  text-decoration: none;
  color: #fff;
  font-size: 150%;
  font-weight: 600;
  margin-left: 25px;
  transition: .4s ease;
}


.page li a:hover {
  color: orange;
  cursor: pointer;
}

.container {
  height: calc(100vh - 40px);
  width: 100%;
  margin-top: 0px;
  margin-bottom: 0px;
  background-color: whitesmoke;;
  position: relative;
  overflow: auto;
}

.container::before {
  content: "";
  display: block;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-image: url("../img/Index_Wallpaper.jpg");
  background-size: cover;
  background-position: center;
  opacity: 0.1;
  pointer-events: none; 
  z-index: -1;
}


.page-title {
  text-align: center;
  font-size: 32px;
  color: #fff;
  margin-bottom: 30px;
}

.filter-wrapper {
  margin-top: 150px;
  display: flex;
  justify-content: center;
}


.filter_button{
	display: flex;
	align-items: center;
	flex-wrap: wrap;
	gap: 10px;
    justify-content: center; 
}


button{
	padding: 10px 20px;
	font-size: 15px;
	background:rgb(255, 51, 51);
    color: whitesmoke;	
    border: none;
    border-radius: 10px;
}

button:hover{
    color: crimson;
	cursor: pointer;
}

.filter_button button.filter-active {
  background: orange;
  color: #fff;
}


.menu{
	padding: 20px 20px;
	margin-top: 0px;
	display: flex;
	gap: 20px;
	flex-wrap: wrap;
}

.menu .itemBox{
	flex-grow: 1;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    border: 1px solid rgb(204, 204, 204);
	flex-basis: 300px;
	background-color:rgb(215, 215, 215);
	padding: 3px;
	border-radius: 8px;
	cursor: pointer;
	transition: 0.2s ease;
    text-align: center;
    padding: 1rem;
}
.itemBox:hover{

    background-color: orange;
}

.menu .itemBox img{
	width: 80%;
	height: 170px;
	object-fit: cover;
	border-radius: 70px; 

}


.itemBox.hide{
	display: none;
}




.item-body{
	padding: 15 20 20;
	
}

.item-title {
    font-size: 20px;
    margin-bottom: 0px;
    font-weight: bold;
}


.item-price {
    font-size: 17px;
}

.basket{
    margin: 20px;
    background-color: #fff;
    padding: 1px 10px;
    border-radius: 5px;
    font-size: 19px;
}



    </style>
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3 style="color: orange;">Login Now</h3>
            <?php
            if (isset($error)) {
                echo '<p>' . $error . '</p>';
            }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input style="background-color: orange; color  :whitesmoke" type="submit" name="submit" value="Login" class="form-btn">
            <p>Don't have an account? <a style="background-color: orange; color:whitesmoke" href="Register.php">Register now</a></p>
        </form>
    </div>
</body>
</html>

