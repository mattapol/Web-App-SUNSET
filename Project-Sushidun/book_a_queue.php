<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองคิว</title>
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
            margin-bottom: 150px;
        }
    </style>

</head>

<?php
    session_start();
    require("connect.php");
    $user_id = $_SESSION["userId"];
    $sql_user = "SELECT * FROM user WHERE User_id ='".$_SESSION["userId"]."'";
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
            <hr style="border: 5px solid black;">
            <h1>จองคิว</h1>
            <hr style="border: 5px solid black;">
            <form action="payment.php?userID=<?php echo $user_id; ?>" method="post">
                <table style="width: 100%;">
                    <tr>
                        <th>
                            <input type="date" name="date-of-mount" id="date-of-mount" style="width: 50%; height: 50px; margin-top: 100px;">
                        </th>
                        <th>
                            <select name="num-of-queue" id="num-of-queue" style="width: 70%; height: 50px; margin-top: 100px;">
                                <option>จำนวนคนที่จอง</option>
                                <option value="1">1 ท่าน</option>
                                <option value="2">2 ท่าน</option>
                                <option value="3">3 ท่าน</option>
                                <option value="4">4 ท่าน</option>
                                <option value="5">5 ท่าน</option>
                            </select>
                        </th>
                        <th>
                            <select name="chef" id="chef" style="width: 60%; height: 50px; margin-top: 100px;">
                                <option>เลือกเซฟ</option>
                                <?php
                                $sql = "SELECT * FROM chief";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=" . $row['Chief_id'] . ">เซฟ : " . $row['Name-chief'] . ", คะแนนอาหาร " . number_format(($row['Score_food']/$row['Number_of_users_chief']),1) . " ดาว, คะแนนบริการ " . number_format(($row['Score_service']/$row['Number_of_users_chief']),1) . " ดาว</option>";
                                    }
                                } else {
                                    echo "<option>not response</option>";
                                }
                                ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <select name="t-time" id="t-time" style="width: 50%; height: 50px; margin-top: 200px;">
                                <option>เลือกเวลา</option>
                                <option value="10:00:00-12:00:00">10:00:00-12:00:00</option>
                                <option value="12:05:00-14:00:00">12:05:00-14:00:00</option>
                                <option value="14:05:00-16:00:00">14:05:00-16:00:00</option>
                                <option value="16:05:00-18:00:00">16:05:00-18:00:00</option>
                                <option value="18:05:00-20:00:00">18:05:00-20:00:00</option>
                            </select>
                        </th>
                        <th>
                            <select name="t-table" id="t-table" style="width: 70%; height: 50px; margin-top: 200px;">
                                <option>เลือกโต๊ะ</option>
                                <option value="1">โต๊ะ 1</option>
                                <option value="2">โต๊ะ 2</option>
                            </select>
                        </th>
                        <th>
                            <select name="t-course" id="t-course" style="width: 60%; height: 50px; margin-top: 200px;">
                                <option>เลือกคอร์ส</option>
                                <?php
                                $sql = "SELECT * FROM course";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=" . $row['Course_id'] . ">" . $row['Course_name'] . " " . $row['Course_price'] . "-บาท " . number_format(($row['Course_score']/$row['Number_of_users_course']),1) . "-ดาว</option>";
                                    }
                                } else {
                                    echo "<option>not response</option>";
                                }
                                ?>
                            </select>
                        </th>
                    </tr>
                </table>
                <input type="submit" value="ชำระเงิน" style="background-color:white; margin-top: 170px; width: 200px; height: 60px; box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);">
            </form>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>