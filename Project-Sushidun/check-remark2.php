<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบการจอง2</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        div.welcome {
            margin-top: 10px;
            text-align: center;
            position: absolute;
            width: 1400px;
            height: 800px;
            left: 500px;
            top: 110px;
        }
    </style>
</head>
<?php
session_start();
require("connect.php");
$userId = $_SESSION["userId"];
$sql_user = "SELECT * FROM user WHERE User_id ='" .$userId. "'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();

if (isset($_GET['Queue_id'])) {
    $queue_id = $_GET['Queue_id'];
}
?>

<body style="background-color: #FAF9B0; position: fixed; overflow: hidden;">
    <div class="header" style="width: 1920px; height: 100px;">
        <nav class="navbar bg-gray" style="width: 1920px; height: 110px;">
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
                </ul>
            </div>
        </div>

        <div class="welcome">
            <!--content-->
            <?php
            $sql = "SELECT * FROM (queue INNER JOIN course ON queue.Course_id = course.Course_id) INNER JOIN chief ON queue.Chief_id = chief.Chief_id WHERE Queue_id = '" . $queue_id . "'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <table style="width: 100%;background-color:white;" border="6" height="450px">
                <tr>
                    <th style="text-align:left;font-size:250%;">รายการจองที่</th>
                    <td style="text-align:left;font-size:200%;"><?php echo $row['Queue_id']; ?></td>
                </tr>
                <tr>
                    <th style="text-align:left;font-size:250%;">คอร์ส</th>
                    <td style="text-align:left;font-size:200%;"><?php echo $row['Course_name']; ?></td>
                </tr>
                <tr>
                    <th style="text-align:left;font-size:250%;">เชฟ</th>
                    <td style="text-align:left;font-size:200%;"><?php echo $row['Name-chief']; ?></td>
                </tr>
                <tr>
                    <th style="text-align:left;font-size:250%;">วันที่</th>
                    <td style="text-align:left;font-size:200%;"><?php echo $row['Date']; ?></td>
                </tr>
                <tr>
                    <th style="text-align:left;font-size:250%;">เวลา</th>
                    <td style="text-align:left;font-size:200%;"><?php echo $row['Time']; ?></td>
                </tr>
                <tr>
                    <th style="text-align:left;font-size:250%;">จำนวน</th>
                    <td style="text-align:left;font-size:200%;"><?php echo $row['Number_of_user']; ?> คน</td>
                </tr>
            </table>
            <!-- <input type="submit" value="ย้อนกลับ" style="background-color:white; margin-top: 200px; width: 200px; height: 60px; box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);"> -->
            <button style="background-color:white; margin-top: 200px; width: 200px; height: 60px; box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);">
                <?php
                echo "<a href='check-remark.php' style='text-decoration: none;'>ย้อนกลับ</a>";
                ?>
            </button>
            <button onclick="getfunc()" style="background-color:white; 
            margin-top: 200px; width: 200px; height: 60px; box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);">
                <?php
                    echo "<a href='check-remark.php?Queue_id=".$row['Queue_id']."' style='text-decoration: none;'>ยกเลิกการจอง</a>";
                ?>
            </button>

            <!-- </form> -->
        </div>
    </div>
    <script>
        function getfunc() {
            alert('คุณต้องการยกเลิกการจอง หากยกเลิกการจองต้องเสียค่าปรับตามกฎของร้าน')
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>