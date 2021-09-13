<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .welcome {
            margin-top: 10px;
            text-align: center;
            position: absolute;
            width: 900px;
            height: 790px;
            left: 550px;
            top: 95px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            background: #DDBB3D;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        td {
            height: 20px;
        }

        td.td-text,
        td.td-box {
            border: 2px solid black;
            padding: 0.5%;
        }

        td.td-text {
            background-color: #C4C4C4;
            width: 30%;
        }

        td.td-box {
            font-size: 25px;
            background-color: white;
        }

        input {
            border: 0px;
        }

        div.imge-sushidun {
            margin-top: 4%;
            margin-left: 80%;
            width: auto;
            height: 700px;
        }
    </style>
</head>
<?php
session_start();
require("connect.php");
$sql_user = "SELECT * FROM user WHERE User_id = '" . $_SESSION["userId"] . "'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();
$f_and_l_name = explode(" ", $row_user['Name']);
?>

<body style="background-color: #FAF9B0; position: fixed;">
    <div class="header" style="width: 1920px; height: 100px;">
        <nav class="navbar bg-gray" style="width: 100%; height: 110px;">
            <ul>
                <li>
                    <div class="point">
                        <img src="./Assets/icon.jpg" style="width: 101px; height: 61px;">
                        <img src="./Assets/sushidun.png" style="width: 101px; height: 81px;">
                    </div>
                </li>
                <li>
                    <div class="point" style="background-color: #C4C4C4; margin-right: 270px; height: 110px;">
                        <h5>คะแนนสะสม : <span><?php echo $row_user['Point']; ?></span></h5>
                    </div>
                </li>
                <li>
                    <div class="point">
                        <img src="./Assets/user.png" style=" width: 50px; height: 50px; border-radius: 50px; margin-right: 20px;">
                        <h5><?php echo $row_user['Name']; ?></h5>
                    </div>
                </li>
                <li style="align-items: right; background-color: #191918;">
                    <a href="logout.php" style="text-decoration: none;">
                        <div class="point" style="color:aliceblue; text-decoration: underline; height: 110px;">
                            <h4>ออกจากระบบ</h4>
                        </div>
                    </a>
                </li>
            </ul>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-3" style="background-color: #DDBB3D; width: 500px; height: 1820px; position: fixed;">
                <div class=" container">
                    <ul>
                        <li>
                            <a href="homepage.php" style="text-decoration: none;">
                                <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                    <button>
                                        <h3>
                                            หน้าหลัก
                                        </h3>
                                    </button>
                                </div>
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="book_a_queue.php" style="text-decoration: none;">
                                <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                    <button>
                                        <h3>
                                            จองคิว
                                        </h3>
                                    </button>
                                </div>
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="check-remark.php" style="text-decoration: none;">
                                <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                    <button>
                                        <h3>
                                            ตรวจสอบการจองคิว
                                        </h3>
                                    </button>
                                </div>
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="Score.php" style="text-decoration: none;">
                                <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                    <button>
                                        <h3>
                                            ให้คะแนน
                                        </h3>
                                    </button>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--content -->
            <div class="welcome">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $Name = $_POST['fname'] . " " . $_POST['lname'];
                    $Age = $_POST['Age-user'];
                    $Tel = $_POST['telnumber'];
                    $Email_hats = $_POST['email-user'];
                    $newPW = $_POST['pw-user'];
                    $newPWac = $_POST['pw-user-accep'];

                    // กรณีแก้ email ใหม่ จะทำการ hash 
                    $UserID_id = "U_" . substr(hash('sha256', $Email_hats), strlen(hash('sha256', $Email_hats)) - 2);

                    $sql_update = "SELECT * FROM user"; // เอาไว้เช็คให้ while เช็ค email ว่ามี email ซ้ำมั้ย
                    $result_update = $conn->query($sql_update);// เอาไว้เช็คให้ while เช็ค email ว่ามี email ซ้ำมั้ย

                    while ($row_update = $result_update->fetch_assoc()) {
                        if (!empty($Email_hats) && !empty($Name) && !empty($Age) && !empty($Tel) && !empty($newPW) && !empty($newPWac)) {

                            if(($newPW === $newPWac) && ($row_update['User_id'] == $_SESSION["userId"])){
                                // Update ข้อมูลที่ได้แก้ไขไปแล้ว
                                $sql_update_user = "UPDATE user 
                                SET User_id = '" . $UserID_id . "',Name = '" . $Name . "', Phone_number = '" . $Tel . "', Email = '" . $Email_hats . "', Age = '" . $Age . "', Password = '" . $newPW . "'
                                WHERE User_id = '" . $_SESSION["userId"] . "'";
                                if($conn->query($sql_update_user) === FALSE){
                                    echo "<h1 style = 'color:red'>Email นี้ถูกใช้ไปแล้ว..!</h1>";
                                    break;
                                }else{
                                    echo "<h1 style = 'color:green'>แก้ไขข้อมูลสำเร็จ!</h1>";
                                    $_SESSION["userId"] = $UserID_id;
                                    break;
                                }

                            } elseif($newPW != $newPWac) {
                                echo "<h1 style = 'color:red'>ยืนยันรหัสผ่านไม่ถูกต้อง!</h1>";
                                break;
                            }else{
                                continue;
                            }
                        }else{
                            echo "<h1 style = 'color:red'>กรุณากรอกข้อมูลให้ครบ..</h1>";
                            break;
                        }
                    }
                }
                ?>
                <form action="editMember.php" method="POST">
                    <table style="width: 80%;">
                        <tr>
                            <th colspan="2">
                                <hr style="border: 2px solid black;">
                                <h1 style="text-align: center;">แก้ไขข้อมูลส่วนตัว</h1>
                                <hr style="border: 2px solid black;">
                            </th>
                        </tr>

                        <tr>
                            <td class="td-text">
                                <h4>ชื่อ</h4>
                            </td>
                            <td class="td-box">
                                <input type="text" id="fname" name="fname" style="height: 50px; width: 100%;" value="<?php echo $f_and_l_name[0]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="td-text">
                                <h4>นามสกุล</h4>
                            </td>
                            <td class="td-box">
                                <input type="text" id="lname" name="lname" style="height: 50px; width: 100%;" value="<?php echo $f_and_l_name[1]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="td-text">
                                <h4>อายุ</h4>
                            </td>
                            <td class="td-box">
                                <input type="text" id="Age-user" name="Age-user" style="height: 50px; width: 100%;" value="<?php echo $row_user['Age']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="td-text">
                                <h4>เบอร์โทรศัพท์</h4>
                            </td>
                            <td class="td-box">
                                <input type="text" id="telnumber" name="telnumber" style="height: 50px; width: 100%;" value="<?php echo $row_user['Phone_number']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="td-text">
                                <h4>อีเมลล์</h4>
                            </td>
                            <td class="td-box">
                                <input type="email" id="email-user" name="email-user" style="height: 50px; width: 100%;" value="<?php echo $row_user['Email']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="td-text">
                                <h4>รหัสผ่าน</h4>
                            </td>
                            <td class="td-box">
                                <input type="password" id="pw-user" name="pw-user" style="height: 50px; width: 100%;">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="td-text">
                                <h4>ยืนยันรหัสผ่าน</h4>
                            </td>
                            <td class="td-box">
                                <input type="password" id="pw-user-accep" name="pw-user-accep" style="height: 50px; width: 100%;">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                    <input type="submit" value="ยืนยัน" style="
                    background: green; 
                    text-align: center; 
                    color: white; 
                    width: 30%; 
                    height: 50px; 
                    border-radius: 50px;
                    box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);">

                    <input type="reset" value="ยกเลิก" style="
                    background:red; 
                    text-align: center; 
                    color: white; 
                    width: 30%; 
                    height: 50px; 
                    border-radius: 50px;
                    box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);">
                </form>
            </div>
            <div class="imge-sushidun">
                <img src="Assets/sushidunRegis.JPG">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>