<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบคอร์สอาหาร</title>
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
            width: 1390px;
            height: 810px;
            left: 510px;
            top: 100px;

        }

        #row-one,
        #row-two {
            margin-left: 2%;
            margin-right: 2%;
            text-align: center;
        }

        #col-course1 {
            height: 350px;
            background-color: #C4C4C4;
            border: 2.5px solid black;
            padding: 10%;
        }

        #col-course2 {
            height: 370px;
            background-color: #C4C4C4;
            border: 2.5px solid black;
            padding: 10%;
        }

        .btn-solution {
            font-size: 20px;
            height: 70px;
            width: 80%;
        }
    </style>
</head>

<?php 
session_start();
require("connect.php");
    $sql_manager = "SELECT * FROM manager WHERE Manager_id ='".$_SESSION["MamagerID"]."'";
    $result_manager = $conn->query($sql_manager);
    $row_manager = $result_manager->fetch_assoc();
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
<?php
    $sql_course = "SELECT Course_id, Course_name FROM course";
    $result_course = $conn->query($sql_course);
    $courseID = array();
    $courseName = array();
    while($row_course = $result_course->fetch_assoc()){
        array_push($courseID, $row_course['Course_id']);
        array_push($courseName, $row_course['Course_name']);
    }
?>
        <div class="welcome">
            <h1>ตรวจสอบคอร์สอาหาร</h1>
            <div class="row" id="row-one">
                <div class="col-sm" id="col-course1">
                    <?php
                        echo '<a href="manager_courseAddEdit.php?CourseID='.urlencode($courseID[0]).'">
                                <button class="btn-solution">แก้ไขหรือเพิ่มคอร์ส '.$courseName[0].'</button>
                            </a>';
                    ?>
                </div>

                <div class="col-sm" id="col-course1">
                    <?php
                        echo '<a href="manager_courseAddEdit.php?CourseID='.urlencode($courseID[1]).'">
                                <button class="btn-solution">แก้ไขหรือเพิ่มคอร์ส '.$courseName[1].'</button>
                            </a>';
                    ?>
                </div>

                <div class="col-sm" id="col-course1">
                    <?php
                        echo '<a href="manager_courseAddEdit.php?CourseID='.urlencode($courseID[2]).'">
                                <button class="btn-solution">แก้ไขหรือเพิ่มคอร์ส '.$courseName[2].'</button>
                            </a>';
                    ?>
                </div>
            </div>

            <div class="row" id="row-two">
                <div class="col-sm" id="col-course2">
                    <?php
                        echo '<a href="manager_courseAddEdit.php?CourseID='.urlencode($courseID[3]).'">
                                <button class="btn-solution">แก้ไขหรือเพิ่มคอร์ส '.$courseName[3].'</button>
                            </a>';
                    ?>
                </div>
                <div class="col-sm" id="col-course2">
                    <?php
                        echo '<a href="manager_courseAddEdit.php?CourseID='.urlencode($courseID[4]).'">
                                <button class="btn-solution">แก้ไขหรือเพิ่มคอร์ส '.$courseName[4].'</button>
                            </a>';
                    ?>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>