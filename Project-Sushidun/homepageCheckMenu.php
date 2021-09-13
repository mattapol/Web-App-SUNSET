<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เช็คเมนู</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        div.welcome{
            margin-top: 10px;
            text-align: center; 
            position: absolute;
            width: 1400px;
            height: 750px;
            left: 500px;
            top: 110px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border: 1px solid #000000;
            box-sizing: border-box;
            background: #C4C4C4;
        }
        div.namecouse{
            text-align: center;
            margin-left: 60%;
            margin-top: 100%;
            width:100%;
        }
        div.listqueue{
            margin-top: 5%;
            margin-left: 40%;
            height: 700px;
            background:#ffffff;
            border: 1px solid #000000;
            width: 100%;
            padding-bottom: 50px;
        }

    </style>
</head>
<?php
session_start();
require("connect.php");
$sql_user = "SELECT * FROM user WHERE User_id ='" . $_SESSION["userId"] . "'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();
?>

<body style="background-color: #FAF9B0; position: fixed; overflow: hidden;">
    <div class="header" style="width: 1920px; height: 100px;">
        <nav class="navbar bg-gray" style="position: fixed; width: 1920px; height: 110px;">
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
        </nav>
    </div>

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
                    <br>
                    <li>
                    <a href="editMember.php" style="text-decoration: none;">
                        <div class="point" style="color:aliceblue; margin-top: 250px; width: 362px;height: 81px;">
                            <button>
                                <h3>
                                    แก้ไขข้อมูลส่วนตัว
                                </h3>
                            </button>
                        </div>
                    </a>
                    </li>
                </ul>
            </div>
        </div>

        <?php
            $courseID = $_GET['CouseID'];
            $sql_menu = "SELECT * FROM course_menu, course, menu WHERE  course_menu.Menu_id = menu.Menu_id AND course_menu.Course_id = '" . $courseID . "'";
            $result_menu = $conn->query($sql_menu);
            

            $sql_course_name = "SELECT * FROM course WHERE course.Course_id = '" . $courseID . "'";
            $result_course_name = $conn->query($sql_course_name);
            $row_course_name = $result_course_name->fetch_assoc();
        ?>
        <div class="welcome">
            <div class="row">
                <div class="col-3">
                    <div class="namecouse">
                        <h1>คอร์ส <?php echo $row_course_name['Course_name']; ?></h1>
                        <h1><?php echo "ราคา ".$row_course_name['Course_price']."- บาท" ?></h1>
                    </div>
                </div>
                <div class="col-4">
                    <div class="listqueue">
                        <table style="width: 100%;">
                        <br><br><br><br>
                            <tr>
                                <td><h3 style="height:50px">ชื่อเมนู</h3></td>
                                <td><h3 style="height:50px">จำนวน (ชิ้น)</h3></td>
                            </tr>
                        <?php
                            while($row_menu = $result_menu->fetch_assoc()){
                                if($row_menu['Course_id'] == $row_course_name['Course_id']){
                                    echo "<tr>";
                                    echo "<td><h4 style='height:50px'>".$row_menu['Menu_name']."</h4></td>";
                                    echo "<td><h4 style='height:50px'>".$row_menu['Number']."</h4></td>";
                                    echo "</tr>";
                                }
                            }

                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>