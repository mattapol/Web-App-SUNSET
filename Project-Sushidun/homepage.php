<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>หน้าหลัก</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        div.welcome {
            margin-top: 10px;
            text-align: center;
            position: absolute;
            width: 1400px;
            height: 800px;
            left: 550px;
            top: 110px;
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
        <div class="welcome">
            <table>
                <?php
                $sql_course = "SELECT * FROM course";
                $result_course = $conn->query($sql_course);
                $count = array();
                while ($row_course = $result_course->fetch_assoc()) {
                    array_push($count, $row_course['Course_id']);
                }
                echo "<tr>";
                echo '<td><a href="homepageCheckMenu.php?CouseID=' . urlencode($count[0]) . '"><img src="Assets/c1.jpg" style="width:650px;height:400px;"></a></td>';
                echo '<td colspan="2"><a href="homepageCheckMenu.php?CouseID=' . urlencode($count[1]) . '"><img src="Assets/c2.jpg" style="width:650px;height:400px;"></a>';
                echo "</tr>";

                echo "<tr>";
                echo '<td><a href="homepageCheckMenu.php?CouseID=' . urlencode($count[2]) . '"><img src="Assets/c3.jpg" style="width:650px;height:350px;"></a></td>';
                echo '<td><a href="homepageCheckMenu.php?CouseID=' . urlencode($count[3]) . '"><img src="Assets/c4.jpg" style="width:320px;height:350px;"></a></td>';
                echo '<td><a href="homepageCheckMenu.php?CouseID=' . urlencode($count[4]) . '"><img src="Assets/c5.jpg" style="width:320px;height:350px;"></a></td>';
                echo "</tr>";
                ?>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>