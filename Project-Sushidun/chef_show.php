<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef_show</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
            background: #ffffff;
        }

        div.content-table {
            width: 100%;
            height: 80%;
            border: 1px solid black;
        }

        table {
            width: 100%;
        }

        th,
        td {
            height: 40px;
            border: 2px solid black;
        }

        td {
            font-size: 16px;
        }

        th {
            font-size: 20px;
            background-color: #DDBB3D;
        }
    </style>
</head>
<?php
session_start();
require("connect.php");
$sql_manager = "SELECT * FROM manager WHERE Manager_id ='" . $_SESSION["MamagerID"] . "'";
$result_manager = $conn->query($sql_manager);
$row_manager = $result_manager->fetch_assoc();
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
                <li class="point">
                    <a href="homepage_manager.php" style="text-decoration: none;">
                        <button style="margin-top: auto; margin-bottom: auto; width: 250%;">
                            <h3>หน้าหลัก</h3>
                        </button>
                    </a>
                </li>
                <li>
                    <div class="point">
                        <img src="./Assets/user.png" style=" width: 50px; height: 50px; border-radius: 50px; margin-right: 20px;">
                        <h5>Manager : <?php echo $row_manager['Name']; ?></h5>
                    </div>
                </li>
                <li style="align-items: right; background-color: #191918;">
                    <a href="logout.php">
                        <div class="point" style="color:aliceblue; text-decoration: underline; height: 110px;">
                            <h4>ออกจากระบบ</h4>
                        </div>
                    </a>
                </li>
            </ul>
    </div>
    <div class="row">
        <div class="col-3" style="background-color: #DDBB3D; width: 500px; height: 1820px; position: fixed;">
            <div class=" container">
                <ul>
                    <li>
                        <a href="check_table_Book_a_queue.php" style="text-decoration: none;">
                            <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                <button>
                                    <h3>
                                        ตรวจสอบการจอง
                                    </h3>
                                </button>
                            </div>
                        </a>
                    </li>
                    <br>
                    <li>
                        <a href="manager_check_course.php" style="text-decoration: none;">
                            <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                <button>
                                    <h3>
                                        ตรวจสอบคอร์สอาหาร
                                    </h3>
                                </button>
                            </div>
                        </a>
                    </li>
                    <br>
                    <li>
                        <a href="EditIncentory.php" style="text-decoration: none;">
                            <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                <button>
                                    <h3>
                                        ตรวจสอบวัตถุดิบ
                                    </h3>
                                </button>
                            </div>
                        </a>
                    </li>
                    <br>
                    <!-- <li>
                        <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                            <button>
                                <h3>
                                    ตรวจสอบรายรับ-รายจ่าย
                                </h3>
                            </button>
                        </div>
                    </li>
                    <br>
                    <li>
                        <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                            <button>
                                <h3>
                                    แก้ไขข้อมูลลูกค้า
                                </h3>
                            </button>
                        </div>
                    </li>
                    <br>
                    <li>
                        <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                            <button>
                                <h3>
                                    ตรวจสอบรายการอาหาร
                                </h3>
                            </button>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>

        <?php
        $sql_chef = "SELECT * FROM chief WHERE chief.Chief_id = '" . $_GET['ChiefID'] . "'";
        $result_chef = $conn->query($sql_chef);
        $row_chef = $result_chef->fetch_assoc();
        ?>

        <div class="welcome">
            <!--content-->
            <h1>เชฟ : <?php echo $row_chef['Name-chief']; ?></h1><br>
            <div class="content-table">
                <table>
                    <tr>
                        <th>วันที่</th>
                        <th>เวลา</th>
                        <th>คอร์ส</th>
                    </tr>
                    <?php
                    $sql_dataChef = "SELECT * FROM queue, course WHERE queue.Chief_id = '" . $_GET['ChiefID'] . "' AND queue.Course_id = course.Course_id";
                    $result_dataChef = $conn->query($sql_dataChef);

                    while ($row_dataChef = $result_dataChef->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row_dataChef["Date"] . "</td>";
                        echo "<td>" . $row_dataChef["Time"] . "</td>";
                        echo "<td>" . $row_dataChef["Course_name"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>