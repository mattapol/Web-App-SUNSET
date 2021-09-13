<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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
// if (isset($_GET['userID']) && !empty($_GET['userID'])) {
//     $user_id = $_GET("userID");
// }
$user_id = $_SESSION["userId"];
$_SESSION['date'] = $_POST["date-of-mount"];
$_SESSION['time'] = $_POST["t-time"];
$_SESSION['number_of_users'] = $_POST["num-of-queue"];
$_SESSION['chef'] = $_POST["chef"];
$_SESSION['table'] = $_POST["t-table"];
$_SESSION['course'] = $_POST["t-course"];
$_SESSION['point'] = $_POST["point_use"];
require("connect.php");
$sql_user = "SELECT * FROM user WHERE Email ='" . $_SESSION["Email"] . "' AND Password = '" . $_SESSION["Passwrod"] . "'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();

// สำหรับเช็คว่าวันนี้เวลานี้ซ้ำกันมั้ยถ้าซ้ำก็จะจองไม่ได้
$sql_q = "SELECT * FROM queue";
$result_q = $conn->query($sql_q);
$counter = 0;
while($row_q = $result_q->fetch_assoc()){
    if($_POST["date-of-mount"] == $row_q["Date"]){
        if($_POST["t-time"] == $row_q["Time"]){
            header("location: book_a_queue.php");
        }else{
            if($_POST["chef"] == $row_q["Chief_id"]){
                $counter++;
            }
        }

    }

}
// สำหลับเช็คว่าเชฟนี้จองได้แค่ 2 ครั้งต่อ 1 วัน ถ้ามากกว่าก็จะไม่สามารถจองได้
if($counter > 2){
    header("location: book_a_queue.php");
}
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
                </ul>
            </div>
        </div>

        <div class="welcome">
            <!--content-->
            <br>
            <h1>ชำระเงิน</h1>
            <!-- <h2 style="text-align:left">รายการที่จอง</h2> -->
            <form action="bill.php?userID=<?php echo $user_id; ?>" method="post"><br>
                <div class="row">
                    <div class="col">
                        <h3>เลือกช่องทางชำระเงิน</h3>
                        <input type="radio" id="" name="payment" value="promptpay">
                        <label for="promptpay">
                            <img src="./Assets/promptpay.jpeg" style=" width: 120px; height: 80px;">
                        </label><br>
                        <input type="radio" id="" name="payment" value="KBANK">
                        <label for="KBANK">
                            <img src="./Assets/KBANK.jpg" style=" width: 80px; height: 80px;">
                        </label><br>
                        <input type="radio" id="" name="payment" value="KRUTH">
                        <label for="KRUTH">
                            <img src="./Assets/KRUTH.jpg" style=" width: 90px; height: 80px;">
                        </label><br>
                        <input type="radio" id="" name="payment" value="SCB">
                        <label for="SCB">
                            <img src="./Assets/SCB.jpg" style=" width: 80px; height: 80px;">
                        </label><br><br>
                        <select name="point_use" id="point_use">
                            <option value="0">ใช้คะแนน</option>
                            <option value="1000">1000</option>
                            <option value="2000">2000</option>
                            <option value="3000">3000</option>
                            <option value="4000">4000</option>
                            <option value="5000">5000</option>
                        </select>
                        <button type="button" onclick="change()">ยืนยัน</button>
                    </div>
                    <div class="col">
                        <tr>
                            <td>
                                <b>จองวันที่</b>
                            </td>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <td>
                                <b><?php echo $_SESSION['date'] ?></b>
                                <br>
                            </td>
                        </tr>
                        <br>
                        <br>
                        <tr>
                            <td>
                                <b>เวลา</b>
                            </td>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <td>
                                <b>
                                    <?php
                                    $times = explode(":", $_SESSION['time']);
                                    $len0 = intval($times[0]) + 2;
                                    $len1 = intval($times[1]) * 0;
                                    $time_start = "$times[0]:$times[1]";
                                    $time_end = "$len0:0$len1";
                                    echo "$time_start - $time_end";
                                    ?>
                                </b>
                                <br>
                            </td>
                        </tr>
                        <br>
                        <br>
                        <tr>
                            <td>
                                <b>จำนวนคน</b>
                            </td>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <td>
                                <b><?php echo $_SESSION['number_of_users'] ?> คน</b>
                                <br>
                            </td>
                        </tr>
                        <br>
                        <br>
                        <tr>
                            <td>
                                <b>เชฟ</b>
                            </td>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <td>
                                <b>
                                    <?php
                                    $sql = "SELECT * FROM chief WHERE Chief_id='" . $_SESSION['chef'] . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['Name-chief'];
                                        }
                                    }
                                    ?>
                                </b>
                                <br>
                            </td>
                        </tr>
                        <br>
                        <br>
                        <tr>
                            <td>
                                <b>โต๊ะ</b>
                            </td>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <td>
                                <b><?php echo $_SESSION['table'] ?></b>
                                <br>
                            </td>
                        </tr>
                        <br>
                        <br>
                        <tr>
                            <td>
                                <b>คอร์ส</b>
                            </td>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <td>
                                <b>
                                    <?php
                                    $sql = "SELECT * FROM course WHERE Course_id='" . $_SESSION['course'] . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['Course_name'];
                                        }
                                    }
                                    ?>
                                </b>
                                <br>
                            </td>
                        </tr>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col">
                        <tr>
                            <td>
                                <b>จำนวนคน x<?php echo $_SESSION['number_of_users']; ?> &nbsp;&nbsp;
                                    <?php
                                    $sql = "SELECT * FROM course WHERE Course_id='" . $_SESSION['course'] . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $_SESSION['number_of_users'] * $row['Course_price'];
                                        }
                                    }
                                    ?>.- บาท</b>
                            </td>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <td>
                                <b>ส่วนลดจากแต้ม &nbsp;&nbsp;
                                    <span id="text"></span>
                                    <?php
                                    $sql = "SELECT * FROM course WHERE Course_id='" . $_SESSION['course'] . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $sum = $_SESSION['number_of_users'] * $row['Course_price'];
                                        }
                                    } ?>
                                    .- บาท
                                </b>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>คอร์สละ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $sql = "SELECT * FROM course WHERE Course_id='" . $_SESSION['course'] . "'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['Course_price'];
                                        }
                                    }
                                    ?>.- บาท</b>
                            </td>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <td>
                                <b>รวม &nbsp;&nbsp;
                                    <span id="value"></span>.- บาท
                                </b>
                                <br>
                            </td>
                        </tr>
                        <br>
                        <input type="submit" value="ยืนยันการจอง" 
                        style="background-color:white; width: 200px; height: 60px; box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        window.onload = change();

        function change() {
            <?php
            $sql_user = "SELECT * FROM user WHERE Email ='" . $_SESSION["Email"] . "' AND Password = '" . $_SESSION["Passwrod"] . "'";
            $result_user = $conn->query($sql_user);
            $row_user = $result_user->fetch_assoc();
            ?>
            var e = document.getElementById("point_use");
            var strUser = setvalue(e.value);
            if (strUser > <?php echo $row_user["Point"]; ?>) {
                change_text();
                change_value();
            } else {
                change_text(strUser);
                change_value(strUser);
            }

            function setvalue(value = 0) {
                return value;
            }

            function change_text(strUser = 0) {
                return document.getElementById("text").innerHTML = strUser / 10;
            }

            function change_value(strUser = 0) {
                var value = <?php echo $sum; ?> - (strUser / 10);
                return document.getElementById("value").innerHTML = value;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js%22%3E"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js%22%3E"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js%22%3E"></script>
</body>

</html>