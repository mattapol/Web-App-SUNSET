<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบการจอง</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css%22%3E">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js%22%3E"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js%22%3E"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js%22%3E"></script>
    <style>
        div.welcome {
            margin-top: 10px;
            text-align: start;
            position: absolute;
            width: 1380px;
            height: 800px;
            left: 510px;
            top: 100px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            background: #DDBB3D;
        }

        div.frame-out {
            margin-left: 3%;
            margin-right: 3%;
            margin-top: 2%;
        }
        div.Ingredient{
            width: 100%;
            height: 100px;
            padding-left: 10px;
            border: 2px solid black;
            background: #DDBB3D;
            overflow: scroll;
        }
        hr {
            padding: 3px;
            background-color: black;
            opacity: 100%;
        }

        div.table-book-queue {
            width: 100%;
            height: 500px;
            border: 2px solid black;
            background-color: white;
            overflow: scroll;
        }

        table,
        th,
        td {
            text-align: center;
            border: 2px solid black;
            padding: 10px;
        }

        th {
            font-size: 20px;
        }

        button.btn-to-cancel,
        button.btn-to-edit {
            border-radius: 20px;
            padding: 5px;
            width: 60%;
        }
    </style>
</head>
<?php
session_start();
require("connect.php");
$sql_manager = "SELECT * FROM manager WHERE Manager_id ='" . $_SESSION["MamagerID"] . "'";
$result_manager = $conn->query($sql_manager);
$row_manager = $result_manager->fetch_assoc();

//Delete queue
if (isset($_GET['DeleteQ'])) {
    $queue_id = $_GET["DeleteQ"];
    $conn->query("DELETE FROM queue WHERE queue.Queue_id ='" . $queue_id . "'") or die($conn->error);
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
                    <li>
                        <a href="check-chef.php" style="text-decoration: none;">
                            <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                <button>
                                    <h3>
                                        ตรวจสอบเชฟ
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
            <div class="frame-out">

                <?php
                // Update สถานะเช็คอิน และ Cut stock
                if (isset($_GET['CheckINq'])) {
                    $Queue_id = $_GET['CheckINq'];
                    // Update สถานะเช็คอิน
                    $conn->query("UPDATE queue SET check_in = 'เช็คอินแล้ว' WHERE Queue_id = '" . $Queue_id . "'") or die($conn->error);

                    // ? process cut stock
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
                    $sql_Ingredients = "SELECT * FROM ingredients WHERE Ingredients_id IN 
                                            (SELECT Ingredients_id FROM menu_ingredients WHERE Menu_id IN
                                            (SELECT Menu_id FROM course_menu WHERE Course_id='$Course_id'))";
                    $result_Ingredients = $conn->query($sql_Ingredients);

                    $sum = 0;
                    $Ss = 0;
                    echo '<div class="Ingredient">';
                    while ($row_Ingredients = $result_Ingredients->fetch_assoc()) {
                        for ($i = 0; $i <= count(array_keys($array_ing, intval(substr($row_Ingredients['Ingredients_id'], -2)))); $i++) {
                            $sum += $array_sum[array_keys($array_ing, intval(substr($row_Ingredients['Ingredients_id'], -2)))[$i]];
                        }

                        $sum = $row_Ingredients['Ingredients_value'] - $sum;
                        $Ingredients = $row_Ingredients['Ingredients_id'];

                        $sql_Ingredients2 = "SELECT * FROM ingredients WHERE Ingredients_id = '" . $Ingredients . "'";
                        $result_Ingredients2 = $conn->query($sql_Ingredients2);
                        $row_Ingredients2 = $result_Ingredients2->fetch_assoc();

                        if ($sum < 0) {
                            echo '<h4 style="color: red;">
                                    วัถุดิบ "'.$row_Ingredients2['Ingredients_name'].'" ไม่เพียงพอขาดทั้งหมด '.($sum*(-1)).' กรัม หรือ '.($sum/1000)*(-1).' กิโลกรัม และใน stock เหลืออยู่เพียง '.$sum = $row_Ingredients2['Ingredients_value'].' กรัม
                                  </h4>';
                        } else {
                            $conn->query("UPDATE ingredients SET Ingredients_value = '$sum' WHERE Ingredients_id='$Ingredients' ") or die($conn->error);

                            if($Ss==0){
                                echo '<h4 style="color: green;">เช็คอินสำเร็จ!!</h4>';
                            }
                            $Ss++;
                        }
                        $sum = 0;
                    }
                    echo '</div>';
                }
                ?>

                <h1>ตรวจสอบการจอง</h1>
                <hr>
                <h3>รายการที่จอง</h3>
                <div class="table-book-queue">
                    <table style="width: 100%;">
                        <tr>
                            <th>
                                <h5>รายการจอง</h5>
                            </th>
                            <th>
                                <h5>ชื่อลูกค้าที่จอง</h5>
                            </th>
                            <th>
                                <h5>จำนวนคน</h5>
                            </th>
                            <th>
                                <h5>โต๊ะที่</h5>
                            </th>
                            <th>
                                <h5>คอร์ส</h5>
                            </th>
                            <th>
                                <h5>วันที่</h5>
                            </th>
                            <th>
                                <h5>เวลา</h5>
                            </th>
                            <th>
                                <h5>เชฟ</h5>
                            </th>
                            <th colspan="2">
                                <h5>แก้ไขข้อมูล</h5>
                            </th>
                            <th>
                                <h5>สถานะเช็คอิน</h5>
                            </th>
                        </tr>
                        <?php
                        $sql_queue = "SELECT * FROM queue, course, user, chief 
                            WHERE queue.User_id = user.User_id AND queue.Course_id = course.Course_id AND queue.Chief_id = chief.Chief_id";
                        $result_queue = $conn->query($sql_queue);

                        //---------------------------------------------------//
                        while ($row_queue = $result_queue->fetch_assoc()) {
                            echo '
                                <tr>
                                <td>' . $row_queue['Queue_id'] . '</td>
                                <td>' . $row_queue['Name'] . '</td>
                                <td>' . $row_queue['Number_of_user'] . ' ท่าน</td>
                                <td>โต๊ะ ' . $row_queue['Tables'] . '</td>
                                <td>' . $row_queue['Course_name'] . '</td>
                                <td>' . $row_queue['Date'] . '</td>
                                <td>' . $row_queue['Time'] . '</td>
                                <td>' . $row_queue['Name-chief'] . '</td>
                                <td colspan="2">
                                    <a href="check_table_Book_a_queue.php?DeleteQ=' . $row_queue['Queue_id'] . '" style="text-decoration: none;">
                                        <button class="btn-to-cancel" type="button">ยกเลิกการจอง</button>
                                    </a>
                                    <a href="check_edit_queue.php?EditQ=' . $row_queue['Queue_id'] . '" style="text-decoration: none;">
                                        <button class="btn-to-edit" type="button">แก้ไขข้อมูลการจอง</button>
                                    </a>
                                </td>';
                            if ($row_queue['check_in'] == 'ยังไม่ได้เช็คอิน') {
                                echo '<td><a href="check_table_Book_a_queue.php?CheckINq=' . $row_queue['Queue_id'] . '" style="color: red;">' . $row_queue['check_in'] . '</a></td>';
                            } else {
                                echo '<td><a href="check_table_Book_a_queue.php?CheckINq=' . $row_queue['Queue_id'] . '" style="color: green; opacity: 0.5; pointer-events: none;">' . $row_queue['check_in'] . '</a></td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>