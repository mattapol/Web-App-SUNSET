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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        div.welcome {
            margin-top: 10px;
            text-align: start;
            position: absolute;
            width: 1390px;
            height: 780px;
            left: 510px;
            top: 100px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            background: #DDBB3D;
        }

        h1 {
            margin-top: 3%;
            margin-left: 3%;
        }

        div.mana-edit-add {
            margin-top: 3%;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        td.title {
            font-size: 25px;
            text-align: end;
        }

        td.box-text {
            width: 50%;
            padding: 1%;
            font-size: 25px;
            text-align: center;
            border: 1px solid black;
            background-color: white;
        }

        td.spanser {
            height: 50px;
        }

        hr {
            border: 4px solid black;
            color: black;
        }

        input.text-box {
            width: 100%;
            border: 0px;
            height: 35px;
        }

        button.btn-PN {
            width: 100%;
            border-radius: 100px;
            height: 30px;
            text-align: center;
        }

        td.frame-add {
            text-align: center;
        }

        button.va-add {
            margin-top: 4%;
            height: 50px;
            width: 10%;
            border-radius: 50px;
        }

        input.btn-accan {
            margin-top: 10px;
            height: 50px;
            width: 35%;
            border-radius: 50px;
        }

        td.btn-down {
            text-align: center;
        }
    </style>

    <script>
        var x = 0;
    </script>
</head>
<!--ยังไม่เสร็จ-->
<?php
session_start();
require("connect.php");
$sql_manager = "SELECT * FROM manager WHERE Manager_id ='" . $_SESSION["MamagerID"] . "'";
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
                </ul>
            </div>
        </div>
        <?php
        $courseID = $_GET['CourseID'];

        $sql_menu = "SELECT * FROM course_menu, course, menu WHERE  course_menu.Menu_id = menu.Menu_id AND course_menu.Course_id = '" . $courseID . "'";
        $result_menu = $conn->query($sql_menu);


        $sql_course_name = "SELECT * FROM course WHERE course.Course_id = '" . $courseID . "'";
        $result_course_name = $conn->query($sql_course_name);
        $row_course_name = $result_course_name->fetch_assoc();
        ?>

        <div class="welcome">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $courseID = $_GET['CourseID'];

                $sql_course_name = "SELECT * FROM course WHERE course.Course_id = '" . $courseID . "'";
                $result_course_name = $conn->query($sql_course_name);
                $row_course_name = $result_course_name->fetch_assoc();

                $Name_course = $_POST["name-course"];
                $Price_course = (double)$_POST["name-price"];

                while ($row_menu = $result_menu->fetch_assoc()){
                    $items = 0;
                    if ($row_menu['Course_id'] == $row_course_name['Course_id']) {
                        $num_of_menu = (int)$_POST["Number".$items.""];
                        
                        //Update to Number menu
                        $conn->query("UPDATE course_menu SET course_menu.Number = '".$num_of_menu."' WHERE course_menu.Course_id = '".$row_menu['Course_id']."'") or die($conn->error);

                        //Update to Course_name and Course_price
                        $conn->query("UPDATE course SET course.Course_name = '".$Name_course."', course.Course_price = '".$Price_course."' WHERE course.Course_id = '".$row_course_name['Course_id']."'") or die($conn->error);

                        $items++;
                    }
                }
            }
            ?>
            <h1>แก้ไขหรือเพิ่มคอร์สอาหาร</h1>
            <hr>
            <form action="manager_courseAddEdit.php?CourseID=<?php echo $courseID;?>" method="post">
                <div class="mana-edit-add">
                    <table style="width: auto;">
                        <tr>
                            <td class="title">ชื่อคอร์ส : </td>
                            <td class="box-text">
                                <input class="text-box" type="text" name="name-course" id="name-course" value="<?php echo $row_course_name['Course_name']; ?>">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="spanser" colspan="3">
                                </th>
                        </tr>
                        <tr>
                            <td class="title">ราคา : </td>
                            <td class="box-text">
                                <input class="text-box" type="text" name="name-price" id="name-price" value="<?php echo $row_course_name['Course_price']; ?>">
                            </td>
                            <td style="font-size: 25px;">บาท</td>
                        </tr>
                        <tr>
                            <td class="spanser" colspan="3">
                            </td>
                        </tr>
                        <?php
                        $count = 0;
                        while ($row_menu = $result_menu->fetch_assoc()) {
                            if ($row_menu['Course_id'] == $row_course_name['Course_id']) {
                                if ($count == 0) {
                                    echo '<tr>
                                        <td class="title">รายการอาหาร : </td>
                                        <td class="box-text">
                                            <input class="text-box" type="text" name="list-food' . $count . '" id="list-food" value="' . $row_menu['Menu_name'] . '">
                                        </td>
                                        <td>
                                            <div id="field'.$count.'">
                                                <button type="button" id="sub' . $count . '" class=sub>
                                                    <img src="./Assets/baseline_remove_circle_outline_black_18dpx2.png">
                                                </button>

                                                <input type="text" id="' . $count . '" name="Number' . $count . '" value="' . $row_menu['Number'] . '" class="field">

                                                <button type="button" id="add' . $count . '" class=add>
                                                    <img src="./Assets/baseline_add_circle_outline_black_18dpx2.png">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>';
                                } else {
                                    echo '<tr>
                                        <td></td>
                                        <td class="box-text">
                                            <input class="text-box" type="text" name="list-food' . $count . '" id="list-food" value="' . $row_menu['Menu_name'] . '">
                                        </td>
                                        <td>
                                            <div id="field'.$count.'">
                                                <button type="button" id="sub' . $count . '" class=sub>
                                                    <img src="./Assets/baseline_remove_circle_outline_black_18dpx2.png">
                                                </button>

                                                <input type="text" id="' . $count . '" name="Number' . $count . '" value="' . $row_menu['Number'] . '" class="field">

                                                <button type="button" id="add' . $count . '" class=add>
                                                    <img src="./Assets/baseline_add_circle_outline_black_18dpx2.png">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>';
                                }
                                $count++;
                            }
                        }
                        ?>
                        <!---->
                        <Script>
                            $('.add').click(function() {
                                $(this).prev().val(+$(this).prev().val() + 1);
                            });
                            $('.sub').click(function() {
                                if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
                            });
                        </Script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                        <!---->
                        <!-- <tr>
                            <td class="frame-add" colspan="3">
                                <button class="va-add">เพิ่ม</button>
                            </td>
                        </tr> -->
                        <tr>
                            <td class="btn-down" colspan="3">
                                <input class="btn-accan" type="submit" value="ตกลง" style="margin-right: 20%;">
                                <input class="btn-accan" type="reset" value="ยกเลิก">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>