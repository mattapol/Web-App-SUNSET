<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ให้คะแนน</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

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

        div.table-title,
        div.table-content {
            text-align: center;
        }
        div.table-content{
            overflow: scroll;
            height: 600px;
            background-color: white;
        }
        div.table-title {
            margin-right: 1.5%;
            background-color: #DDBB3D;
        }
        th,
        td {
            border: 2px solid black;
            padding: 1%;
        }
        th{
            width: 5%;
        }
        td {
            width: 6%;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<?php 
    session_start();
    require("connect.php");
    $user_id = $_SESSION["userId"];
    $sql = "SELECT * FROM queue, chief, user, course 
    WHERE queue.Course_id = course.Course_id AND queue.Chief_id = chief.Chief_id AND user.User_id = '".$user_id."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        # session จาก Score4.php
        $chief_id = $_SESSION['chief_ID'];
        $course_id = $_SESSION['course_ID'];
        $Q_id = $_SESSION['q_id'];

        #เอาไว้บอกว่าเราจะ อัปเดทคะแนน เชฟคนไหน คอร์สอะไร
        $sql_uptodate = "SELECT * FROM chief, course 
        WHERE chief.Chief_id = '".$chief_id."' AND course.Course_id = '".$course_id."'";
        $result_uptodate = $conn->query($sql_uptodate);
        $row_uptodate = $result_uptodate->fetch_assoc();

        #update score จากการที่ให้คะแนนใน Score4.php
        $Score_food = $_POST['rating-star'] + $row_uptodate['Score_food'];
        $Score_service = $_POST['rating-star1'] + $row_uptodate['Score_service'];
        $Course_score = $row_uptodate['Course_score'] + (($_POST['rating-star2'] + $_POST['rating-star3'])/2);
        $count_chief = $row_uptodate['Number_of_users_chief'] + 1;
        $count_course = $row_uptodate['Number_of_users_course'] + 1;
        $Score_queue = 'ให้คะแนนแล้ว';

        $conn->query("UPDATE chief SET Score_food = '".$Score_food."', Score_service = '".$Score_service."', Number_of_users_chief = '".$count_chief."' WHERE Chief_id = '".$chief_id."'") or die($conn->error);

        $conn->query("UPDATE course SET Course_score = '".$Course_score."', Number_of_users_course ='".$count_course."' WHERE Course_id = '".$course_id."'") or die($conn->error);

        $conn->query("UPDATE queue SET Score_queue = '".$Score_queue."' WHERE Queue_id = '".$Q_id."'") or die($conn->error);
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
                        <h5>คะแนนสะสม : <span><?php echo $row['Point']; ?></span></h5>
                    </div>
                </li>
                <li>
                    <div class="point">
                        <img src="./Assets/user.png"
                            style=" width: 50px; height: 50px; border-radius: 50px; margin-right: 20px;">
                        <h5><?php echo $row['Name']; ?></h5>
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
                </ul>
            </div>
        </div>

        <div class="welcome">
            <h1>ให้คะแนน</h1><br><br>
            <div class="table-title">
                <table>
                    <tr>
                        <th>เชฟ</th>
                        <th>คอร์ส</th>
                        <th>วันที่</th>
                        <th>เวลา</th>
                        <th>ให้คะแนน</th>
                    </tr>
                </table>
            </div>
            <div class="table-content">
                <table>
                    <?php
                        $sql1 = "SELECT * FROM queue, chief, user, course 
                        WHERE queue.Course_id = course.Course_id AND queue.Chief_id = chief.Chief_id AND queue.User_id = '".$_SESSION["userId"]."' AND user.User_id = '".$_SESSION["userId"]."' ";
                        $result1 = $conn->query($sql1);
                        $arrayIS = array();
                        $count = 0;
                        while ($row1 = $result1->fetch_assoc()) {
                            array_push($arrayIS, $row1["Score_queue"]);
                            echo "<tr>";
                            echo "<td>" .$row1["Name-chief"]. "</td>";
                            echo "<td>" .$row1["Course_name"]. "</td>";
                            echo "<td>" .$row1["Date"]. "</td>";
                            echo "<td>".$row1["Time"]."</td>";
                            if($arrayIS[$count]=="ให้คะแนนแล้ว"){
                                echo "<td><a style='color:green; opacity: 0.5; pointer-events: none; href='Score4.php?give=".$row1["User_id"]." ' Onclick ='ConfirmDelete()'>".$row1["Score_queue"]."</a></td>";
                            }else{
                                echo "<td><a style='color:red; id='".$count."' href='Score4.php?ChiefID=".urlencode($row1['Chief_id'])."&CourseID=".urlencode($row1['Course_id'])."&QID=".urlencode($row1['Queue_id'])." ' Onclick ='ConfirmDelete()'>".$row1["Score_queue"]."</a></td>";
                            }
                            // echo "<td><a id='".$count."' href='Score4.php?ChiefID=".urlencode($row1['Chief_id'])."&CourseID=".urlencode($row1['Course_id'])." ' Onclick ='ConfirmDelete()'>".$row1["Score_queue"]."</a></td>";
                            echo "</tr>";
                            $count+=1;
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
<!-- ยังไม่เสร็จ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

</html>