<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบการจอง</title>
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

        div.frame-out {
            width: auto;
            height: 600px;
            background-color: white;
            border: 1px solid black;
            overflow: scroll;
        }

        th,
        td {
            background-color: white;
            border: 2px solid black;
            height: 50px;
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
$user_id = $queue_id = $_SESSION["userId"];

if (isset($_GET["Queue_id"])) {
    //point back
    $Queue_id = $_GET["Queue_id"];
    // ? process return stock
    $sql_queue = "SELECT Course_id FROM queue WHERE Queue_id = '$Queue_id' ";
    $result_queue = $conn->query($sql_queue);
    $row_queue = $result_queue->fetch_assoc();
    $Course_id = $row_queue['Course_id'];

    $sql_course_menu = "SELECT Menu_id, Number FROM course_menu WHERE Course_id in (SELECT Course_id FROM queue WHERE Course_id = '$Course_id') ";
    $result_course_menu = $conn->query($sql_course_menu);
    $array_number = array();
    while ($row_course_menu = $result_course_menu->fetch_assoc()) {
        array_push($array_number, $row_course_menu['Number']);
    }
    // print_r($array_number);
    $sql_menu_ingredients = "SELECT Ingredients_id, Menu_id, Mi_value FROM menu_ingredients WHERE Menu_id in (SELECT Menu_id FROM course_menu WHERE Course_id = '$Course_id') ";
    $result_menu_ingredients = $conn->query($sql_menu_ingredients);
    $array_ing = array();
    $array_sum = array();
    while ($row_menu_ingredients = $result_menu_ingredients->fetch_assoc()) {
        array_push($array_sum, $array_number[intval(substr($row_menu_ingredients['Menu_id'], -2)) - 1] * $row_menu_ingredients['Mi_value']);
        array_push($array_ing, intval(substr($row_menu_ingredients['Ingredients_id'], -2)));
    }
    // print_r($array_sum);
    // print_r($array_ing);
    $sql_Ingredients = "SELECT *
                                    FROM ingredients
                                    WHERE Ingredients_id IN 
                                        (SELECT Ingredients_id 
                                        FROM menu_ingredients 
                                        WHERE Menu_id IN
                                            (SELECT Menu_id 
                                            FROM course_menu WHERE Course_id='$Course_id')
                                        )";
    $result_Ingredients = $conn->query($sql_Ingredients);
    $sum = 0;
    while ($row_Ingredients = $result_Ingredients->fetch_assoc()) {
        for ($i = 0; $i <= count(array_keys($array_ing, intval(substr($row_Ingredients['Ingredients_id'], -2)))); $i++) {
            $sum += $array_sum[array_keys($array_ing, intval(substr($row_Ingredients['Ingredients_id'], -2)))[$i]];
        }
        $sum = $row_Ingredients['Ingredients_value'] + $sum;
        $Ingredients = $row_Ingredients['Ingredients_id'];
        $conn->query("UPDATE ingredients
                        SET Ingredients_value = '$sum'
                        WHERE Ingredients_id='$Ingredients' ") or
            die($conn->error);
        $sum = 0;
    }
    // ? process return stock

    // TODO เขียนแจ้งเตือนตรงนี้

    // Queue Delete
    $queue_id = $_GET["Queue_id"];
    $conn->query("DELETE FROM queue WHERE queue.Queue_id ='" . $queue_id . "'") or
        die($conn->error);
    header("location: check-remark.php");
}

$sql_user = "SELECT * FROM user WHERE User_id ='" . $user_id . "'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();
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
                </ul>
            </div>
        </div>

        <div class="welcome">
            <!--content-->
            <h1>ตรวจสอบการจอง</h1><br>
            <h2 style="text-align:left">รายการที่จอง</h2>
            <div class="frame-out">
                <table style="width: 100%;">
                    <tr>
                        <th>รายการจอง</th>
                        <th>คอร์ส</th>
                        <th>วันที่</th>
                        <th>เวลา</th>
                        <th>เชฟ</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM (queue INNER JOIN course ON queue.Course_id = course.Course_id) INNER JOIN chief ON queue.Chief_id = chief.Chief_id WHERE User_id = '" . $user_id . "'";
                    $result = $conn->query($sql);
                    // $row = $result->fetch_assoc();
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>"
                            . "<td><a href='check-remark2.php?Queue_id=" . $row['Queue_id'] . "'>" . $row['Queue_id'] . "</a></td>"
                            . "<td>" . $row['Course_name'] . "</td>"
                            . "<td>" . $row['Date'] . "</td>"
                            . "<td>" . $row['Time'] . "</td>"
                            . "<td>" . $row['Name-chief'] . "</td>"
                            . "</tr>";
                    }
                    ?>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>