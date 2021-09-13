<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขการจองของลูกค้า</title>
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
            margin-left: 5%;
            margin-right: 5%;
            margin-top: 2%;
        }
        
        h3.title-t-in {
            margin-left: 10%;
            font-size: 32px;
        }
        
        hr {
            padding: 3px;
            background-color: black;
            opacity: 100%;
        }
        
        table {
            margin-left: auto;
            margin-right: auto;
        }
        
        th,
        td {
            padding: 10px;
            border: 2px solid black;
        }
        
        th {
            text-align: center;
            background-color: #C4C4C4;
        }
        
        td {
            text-align: start;
            background-color: white;
        }
        
        td.btn-two {
            text-align: center;
            padding-top: 50px;
            border: 0px;
            background-color: #DDBB3D;
        }
        
        input.btn-to-accep,
        input.btn-to-reset {
            font-size: 20px;
            border-radius: 50px;
            padding: 10px;
            width: 20%;
        }
        
        input.btn-to-accep {
            margin-right: 100px;
        }
    </style>
</head>

<?php 
    session_start();
    require("connect.php");
    $sql_manager = "SELECT * FROM manager WHERE Manager_id ='".$_SESSION["MamagerID"]."'";
    $result_manager = $conn->query($sql_manager);
    $row_manager = $result_manager->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        //เป็นการสร้างตัวแปรเอาไว้รับค่าที่จะทำการแก้
        $Qid = (string)$_POST['QID'];
        $iduser = (string)$_POST['userID'];
        $Course = $_POST['edit-course'];
        $chef = $_POST['edit-chef'];
        $date = $_POST['edit-date'];
        $time = $_POST['e-time'];
        $number_of_user = (int)$_POST['e-num-queue'];

        // update ข้อมูลที่ได้แก้ไขแล้ว
        $conn->query("UPDATE queue SET 
        Date = '".$date."', 
        Time = '".$time."', 
        Number_of_user = '".$number_of_user."', 
        Chief_id = (SELECT Chief_id FROM chief WHERE `Name-chief` = '".$chef."'), 
        Course_id = (SELECT Course_id FROM course WHERE Course_name = '".$Course."')
        WHERE Queue_id = '".$Qid."'") or die($conn->error);
        
        header("location:check_table_Book_a_queue.php");
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
                    $IDQ = $_GET['EditQ'];

                    //ใช้สำหลับอ้างอิงคิวที่ต้องการแก้ไข
                    $sql_queue = "SELECT * FROM queue, course, user, chief 
                    WHERE queue.Queue_id = '".$IDQ."' 
                    AND queue.User_id = user.User_id 
                    AND queue.Course_id = course.Course_id 
                    AND queue.Chief_id = chief.Chief_id";
                    $result_queue = $conn->query($sql_queue);
                    $row_queue = $result_queue->fetch_assoc();

                    //ใช้สำหลับอ้างอิง user ที่ต้องการแก้ไข เพื่อแสดงชื่อของ user เอง
                    $sql_user = "SELECT * FROM user WHERE user.User_id = '".$row_queue['User_id']."'";
                    $result_user = $conn->query($sql_user);
                    $row_user = $result_user->fetch_assoc();
                ?>
                <h1>ตรวจสอบการจอง</h1>
                <hr>
                <h3 class="title-t-in">ข้อมูลการจอง</h3>
                <form action="check_edit_queue.php" method="post">
                    <table style="width: 80%;">
                        <tr>
                            <th>
                                <h4>รายการที่จอง</h4>
                            </th>
                            <td>
                                <?php
                                    echo '<input type="hidden" name="QID" value="'.$row_queue['Queue_id'].'">';
                                    echo '<h4>'.$row_queue['Queue_id'].'</h4>';
                                ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h4>ชื่อลูกค้า</h4>
                            </th>
                            <td>
                                <?php
                                    echo '<input type="hidden" name="userID" value="'.$row_queue['User_id'].'">';
                                    echo '<h4>'.$row_user['Name'].'</h4>';
                                ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h4>คอร์ส</h4>
                            </th>
                            <td>
                                <h4>
                                    <select name="edit-course" id="edit-course">
                                        <option value="<?php echo $row_queue['Course_name']; ?>"><?php echo $row_queue['Course_name']; ?></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h4>เชฟ</h4>
                            </th>
                            <td>
                                <h4>
                                    <select name="edit-chef" id="edit-chef">
                                        <option value="<?php echo $row_queue['Name-chief']; ?>"><?php echo $row_queue['Name-chief']; ?></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h4>วันที่</h4>
                            </th>
                            <td>
                                <h4>
                                    <input class="e-date" type="date" name="edit-date" id="edit-date" value="<?php echo $row_queue['Date']; ?>">
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h4>เวลา</h4>
                            </th>
                            <td>
                                <h4>
                                    <select name="e-time" id="e-time">
                                        <option value="<?php echo $row_queue['Time']; ?>"><?php echo $row_queue['Time']; ?></option>
                                        <option value="10:00:00 - 12:00:00">10:00:00 - 12:00:00</option>
                                        <option value="12:00:00 - 14:05:00">12:05:00 - 14:00:00</option>
                                        <option value="14:00:00 - 16:05:00">14:05:00 - 16:00:00</option>
                                        <option value="16:00:00 - 18:05:00">16:05:00 - 18:00:00</option>
                                        <option value="18:00:00 - 20:05:00">18:05:00 - 20:00:00</option>
                                    </select>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h4>จำนวน</h4>
                            </th>
                            <td>
                                <h4>
                                    <select name="e-num-queue" id="e-num-queue">
                                        <option value="<?php echo $row_queue['Number_of_user']; ?>"><?php echo $row_queue['Number_of_user']." ท่าน"; ?></option>
                                        <option value="1">1 ท่าน</option>
                                        <option value="2">2 ท่าน</option>
                                        <option value="3">3 ท่าน</option>
                                        <option value="4">4 ท่าน</option>
                                        <option value="5">5 ท่าน</option>
                                    </select>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="btn-two" colspan="2">
                                <input class="btn-to-accep" type="submit" value="ยืนยันการแก้ไข">
                                <input class="btn-to-reset" type="reset" value="ยกเลิกการแก้ไข">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>