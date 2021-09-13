<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        div.welcome {
            text-align: center;
            position: absolute;
            width: 1300px;
            height: 750px;
            left: 550px;
            top: 150px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            background: #DDBB3D;
        }

        table,
        td {
            padding: 6px;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }
        td.user-name-text,
        td.user-lastname-text,
        td.user-age-text,
        td.user-tel-text,
        td.user-email-text,
        td.user-password-text,
        td.user-acceppw-text {
            background-color: #C4C4C4;
            font-size: 18px;
            border: 2px solid black;
        }

        td.user-name-box,
        td.user-lastname-box,
        td.user-age-box,
        td.user-tel-box,
        td.user-email-box,
        td.user-password-box,
        td.user-acceppw-box {
            background-color: white;
            border: 2px solid black;
        }

        input.btn-submit,
        input.btn-reset {
            width: 40%;
            height: 50px;
            font-size: 20px;
            border: 1px solid black;
            border-radius: 50px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            background-color: #C4C4C4;
            color: white;
        }
        input.btn-submit {
            background-color: #0AAA06;
        }
        input.btn-reset {
            background-color: #FF0000;
        }
    </style>
</head>
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
                session_start();
                require('connect.php');
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $Email_hats = $_POST["user-email"];
                $UserID_id = "U_" . substr(hash('sha256', $Email_hats), strlen(hash('sha256', $Email_hats)) - 2);
                $Name = $_POST['user-name']." ".$_POST['user-lastname'];
                $Age = (int)$_POST['user-age'];
                $user_tel = $_POST['user-tel'];
                $Point = 0;
                $Passwrods = $_POST['user-password'];
                $Agian_prasswrod = $_POST['user-acceppw'];
                    if($Passwrods === $Agian_prasswrod){
                        if(!empty($Passwrods)){
                            $sql = "INSERT INTO user (User_id, Name, Phone_number, Email, Point, Password, Age)
                            VALUES ('".$UserID_id."','".$Name."','".$user_tel."','".$Email_hats."',0,'".$Passwrods."', '".$Age."') ";
                            if ($conn->query($sql) === TRUE) {
                                header("location:login.php");
                            } else {
                                echo "<h1 style='color:red;'>Email นี้ถูกใช้ไปแล้วไม่สามารถใช้ซ้ำได้</h1>";
                            }
                        }
                    }else{
                        echo "<h1 style='color:red;'>ยืนยันรหัสผ่านไม่ถูกต้อง</h1>";
                    }
                }
            ?>
            <!--content-->
            <hr style="width: 30%; margin-left: auto; margin-right: auto; border: 5px solid black;">
            <h1>สมัครสมาชิก</h1>
            <hr style="width: 30%; margin-left: auto; margin-right: auto; border: 5px solid black;">
            <!--link php register member-->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table style="width: 50%;">
                    <tr>
                        <td class="user-name-text">ชื่อ</td>
                        <td class="user-name-box">
                            <input type="text" name="user-name" id="user-name" value="<?php echo $_POST['user-name']; ?>"
                                style="width: 100%; height: 40px; border: 0px;">
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="user-lastname-text">นามสกุล</td>
                        <td class="user-lastname-box">
                            <input type="text" name="user-lastname" id="user-lastname" value="<?php echo $_POST['user-lastname']; ?>"
                                style="width: 100%; height: 40px; border: 0px;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="user-age-text">อายุ</td>
                        <td class="user-age-box">
                            <input type="text" name="user-age" id="user-age" value="<?php echo $_POST['user-age']; ?>"
                                style="width: 100%; height: 40px; border: 0px;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="user-tel-text">เบอร์โทรศัพท์</td>
                        <td class="user-tel-box">
                            <input type="text" name="user-tel" id="user-tel" value="<?php echo $_POST['user-tel']; ?>"
                                style="width: 100%; height: 40px; border: 0px;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="user-email-text">อีเมลล์</td>
                        <td class="user-email-box">
                            <input type="email" name="user-email" id="user-email" value="<?php echo $_POST['user-email']; ?>"
                                style="width: 100%; height: 40px; border: 0px;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="user-password-text">รหัสผ่าน</td>
                        <td class="user-password-box">
                            <input type="password" name="user-password" id="user-password"
                                style="width: 100%; height: 40px; border: 0px;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="user-acceppw-text">ยี่นยันรหัสผ่าน</td>
                        <td class="user-acceppw-box">
                            <input type="password" name="user-acceppw" id="user-acceppw"
                                style="width: 100%; height: 40px; border: 0px;">
                        </td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <td colspan="2">
                            <input class="btn-submit" type="submit" value="ยืนยัน">
                            <input class="btn-reset" type="reset" value="ยกเลิก">
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