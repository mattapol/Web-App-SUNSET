<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        div.welcome {
            margin-top: 10px;
            text-align: center;
            position: absolute;
            width: 1300px;
            height: 700px;
            left: 550px;
            top: 150px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            background: #DDBB3D;
        }

        table,
        td {
            padding: 10px;
            margin-left: 33%;
            border-collapse: collapse;
        }

        td.in-email,
        td.in-password {
            background-color: #C4C4C4;
            font-size: 18px;
            border: 2px solid black;
        }

        td.slod-email,
        td.slod-password {
            background-color: white;
            border: 2px solid black;
        }

        input.btn-log-in,
        button.btn-member {
            width: 40%;
            height: 50px;
            font-size: 20px;
            border: 1px solid black;
            border-radius: 50px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            background-color: #C4C4C4;
        }
    </style>
</head>

<?php
session_start();
require('connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql_user = "SELECT * FROM user WHERE Email ='".$_POST["user-enail"]."' AND Password = '".$_POST["user-password"]."'";
    $sql_chef = "SELECT * FROM chief WHERE Email ='".$_POST["user-enail"]."' AND Password = '".$_POST["user-password"]."'";
    $sql_manager = "SELECT * FROM manager WHERE Email ='".$_POST["user-enail"]."' AND Password = '".$_POST["user-password"]."'";

    #go to homepage customer.
    $result_user = $conn->query($sql_user);
    $row_user = $result_user->fetch_assoc();
    if($_POST["user-enail"] === $row_user['Email'] && $_POST["user-password"] === $row_user['Password'])
	{
        $_SESSION["userId"] = $row_user["User_id"];
        $_SESSION["Email"] = $row_user["Email"];
        $_SESSION["Passwrod"] = $row_user["Password"];
		header("location:homepage.php");
	}

    #go to homepage chef.
    $result_chef = $conn->query($sql_chef);
    $row_chef = $result_chef->fetch_assoc();
    if($_POST["user-enail"] === $row_chef['Email'] && $_POST["user-password"] === $row_chef['Password'])
    {
        $_SESSION["ChiefID"] = $row_chef["Chief_id"];
        $_SESSION["Email"] = $row_chef["Email"];
        $_SESSION["Passwrod"] = $row_chef["Password"];
        header("location:home_page_chef.php");
    }

    #go to homepage manager.
    $result_manager = $conn->query($sql_manager);
    $row_manager = $result_manager->fetch_assoc();
    if($_POST["user-enail"] === $row_manager['Email'] && $_POST["user-password"] === $row_manager['Password'])
    {
        $_SESSION["MamagerID"] = $row_manager["Manager_id"];
        $_SESSION["Email"] = $row_manager["Email"];
        $_SESSION["Passwrod"] = $row_manager["Password"];
        header("location:homepage_manager.php");
    }
}
?>

<body style="background-color: #FAF9B0; position: fixed;">
    <div class="header" style="width: 100%; height: 100px;">
        <nav class="navbar bg-gray" style="width: 1920px; height: 110px;">
            <ul>
                <li>
                    <div class="point">
                        <img src="./Assets/icon.jpg" style="width: 101px; height: 61px;">
                        <img src="./Assets/sushidun.png" style="width: 101px; height: 81px;">
                    </div>
                </li>
            </ul>
    </div>
    <div class="row">
        <div class="col-3" style="background-color: #FAF9B0; width: 500px; height: 1820px; position: fixed;">
            <div class=" container">
                <ul><br>
                    <center><img src="./Assets/Logo.jpg" style="width: 400px; height: 800px;"></center>
                </ul>
            </div>
        </div>

        <div class="welcome">
            <?php
                if(($_POST["user-enail"] != $row_user['Email'] || $_POST["user-password"] != $row_user['Password']) || ($_POST["user-enail"] != $row_chef['Email'] || $_POST["user-password"] != $row_chef['Password']) || ($_POST["user-enail"] != $row_manager['Email'] || $_POST["user-password"] != $row_manager['Password'])){
                    echo "<br><h1 style='color:red;'>! Email หรือ รหัสผ่านไม่ถูกต้อง !</h1>";
                }
            ?>
            <!--content-->
            <img src="./Assets/sushidun.png" style="width: 400px; height: 250px;">
            <h1>เข้าสู่ระบบ</h1><br>
            <!-- <h2 style="text-align:left">รายการที่จอง</h2> -->
            <form action="login.php" method="post">
                <table style="width: 35%;">
                    <tr>
                        <td class="in-email">Email</td>
                        <td class="slod-email">
                            <h4>
                                <input type="email" name="user-enail" id="user-email"
                                style="width: 100%; height: 40px; border: 0px;">
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="in-password">Password</td>
                        <td class="slod-password">
                            <h4>
                                <input type="password" name="user-password" id="user-password"
                                style="width: 100%; height: 40px; border: 0px;">
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input class="btn-log-in" type="submit" value="เข้าสู่ระบบ">
                            <button class="btn-member">
                                <a href="register_member.php" style="text-decoration: none; color: black;">
                                    สมัครสมาชิก
                                </a>
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

</html>