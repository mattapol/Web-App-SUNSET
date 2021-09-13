<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css%22%3E">
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
    </style>
</head>

<?php
session_start();
require("connect.php");

$sql_user = "SELECT * FROM user WHERE Email ='" . $_SESSION["Email"] . "' AND Password = '" . $_SESSION["Passwrod"] . "'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$Queue_id = "Q-" . generateRandomString(strlen(substr(hash('sha256', $user_id), strlen(hash('sha256', $user_id)) - 6)));
$user_id = $_SESSION["userId"];
$date = $_SESSION['date'];
$time = $_SESSION['time'];
$number_of_users = $_SESSION['number_of_users'];
$chef = $_SESSION['chef'];
$table = $_SESSION['table'];
$course = $_SESSION['course'];
$_SESSION['point'] = $_POST["point_use"];
if ($_SESSION['point'] > $row_user["Point"]) {
    $point = 0;
} else {
    $point = $_SESSION['point'];
}

// echo $user_id . "<br>";
// echo $chef . "<br>";
// echo $course . "<br>";
//  TODO  check date, time, table for full queue

$conn->query("INSERT INTO queue (`Queue_id`, `User_id`, `Chief_id`, `Course_id`, `Tables`, `Number_of_user`, `Date`, `Time`, `Score_queue`, `check_in`)
VALUES ('$Queue_id', (SELECT `User_id` FROM user WHERE `User_id` = '" . $user_id . "'), (SELECT `Chief_id` FROM chief WHERE `Chief_id` = '" . $chef . "'), (SELECT `Course_id` FROM course WHERE `Course_id` = '" . $course . "'), '$table', '$number_of_users', '$date', '$time', 'ยังไม่ให้คะแนน', 'ยังไม่ได้เช็คอิน')") or
    die($conn->error);

?>

<body style="background-color: #FAF9B0; position: fixed;">
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
                </ul>
            </div>
        </div>

        <div class="welcome">
            <!--content-->
            <br>
            <h1>สรุปผลการชำระ</h1>
            <!-- <h2 style="text-align:left">รายการที่จอง</h2> -->
            <form action="homepage.php" method="post"><br>
                <div class="row">
                    <div class="col">
                        <tr>
                            <td>
                                <h4>จองวันที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $date; ?></h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <h4>เวลา &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $times = explode(":", $time);
                                    $len0 = intval($times[0]) + 2;
                                    $len1 = intval($times[1]) * 0;
                                    $time_start = "$times[0]:$times[1]";
                                    $time_end = "$len0:0$len1";
                                    echo "$time_start - $time_end";
                                    ?>
                                </h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <h4>จำนวนคน x<?php echo $number_of_users ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $sql = "SELECT * FROM course WHERE Course_id='" . $course . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $number_of_users * $row['Course_price'];
                                        }
                                    }
                                    ?>.- บาท </h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <h4>เชฟ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $sql = "SELECT * FROM chief WHERE Chief_id='" . $chef . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['Name-chief'];
                                        }
                                    }
                                    ?>
                                </h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <h4>โต๊ะ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $table; ?> </h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <h4>คอร์ส &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $sql = "SELECT * FROM course WHERE Course_id='" . $course . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['Course_name'];
                                        }
                                    }
                                    ?> </h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <h4>ส่วนลดจากแต้ม &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="text"></span> บาท </h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <h4>รวม &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $sql = "SELECT * FROM course WHERE Course_id='" . $course . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $sum = $number_of_users * $row['Course_price'];
                                        }
                                    } ?>
                                    <span id="value"></span>.- บาท
                                </h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <h4>แต้มที่ได้ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="point_add"></span>.- แต้ม</h4>
                            </td>
                        </tr>
                        <br>
                        <input type="submit" value="กลับหน้าหลัก" style="background-color:white; width: 200px; height: 60px; box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);">
                        <script>
                            window.onload = change();

                            function change() {
                                var strUser = setvalue(<?php echo $point; ?>);
                                change_text()
                                change_value()
                                change_add_point()

                                function setvalue(value = 0) {
                                    return value;
                                }

                                function change_text() {
                                    return document.getElementById("text").innerHTML = strUser / 10;
                                }

                                function change_value() {
                                    var value = <?php echo $sum; ?> - (strUser / 10);
                                    return document.getElementById("value").innerHTML = value;
                                }

                                function change_add_point() {
                                    var value = <?php echo $sum; ?> - (strUser / 10);
                                    return document.getElementById("point_add").innerHTML = parseInt(value / 100);
                                }
                            }
                        </script>
                        <?php
                        $sql = "SELECT Point FROM user WHERE user_id='" . $user_id . "'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $cut_point = $point;
                        $add_point = intval(($sum - ($point / 10)) / 100);
                        $current_point = $row['Point'] - $cut_point + $add_point;
                        if ($current_point >= 0) {
                            $conn->query("UPDATE user SET Point = '" . $current_point . "' WHERE User_id = '" . $user_id . "'") or
                                die($conn->error);
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js%22%3E"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js%22%3E"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js%22%3E"></script>
</body>

</html>