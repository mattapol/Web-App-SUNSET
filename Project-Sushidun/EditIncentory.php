<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เช็ควัตถุดิบในคลัง</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        div.welcome{
            margin-top: 10px;
            text-align: center; 
            position: absolute;
            width: 1400px;
            height: 800px;
            left: 500px;
            top: 110px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border: 1px solid #000000;
            box-sizing: border-box;
            background: #C4C4C4;
        }
        div.namecouse{
            text-align: center;
            margin-left: 60%;
            margin-top: 100%;
            width:100%;
        }
        div.listqueue{
            margin-top: 25%;
            margin-left: 40%;
            height: 500px;
            background:#ffffff;
            border: 1px solid #000000;
            width: 100%;
            padding-bottom: 50px;
        }

        a:link, a:visited {
            text-decoration: none;
            color: white;
            text-align: center;
        }
        a:hover, a:active {
            text-decoration: underline;
            color: orange ;
        }
        tr {
            background-color: #ffffff;
        }
        th, td {
            text-align: center;
        }
        div.frame-table{
            overflow: scroll;
            width: 100%;
            height: 700px;
        }
        button.btn-to-chang{
            font-size: 20px;
            color: white;
            background-color: #1A5276;
            margin-top: 15%;
            width: 50%;
            height: 50px;
            border-radius: 50px;
        }
    </style>
</head>
<?php
session_start();
require("connect.php");
$sql_manager = "SELECT * FROM manager WHERE Manager_id ='" . $_SESSION["MamagerID"] . "'";
$result_manager = $conn->query($sql_manager);
$row_manager = $result_manager->fetch_assoc();
?>

<body style="background-color: #FAF9B0; position: fixed; overflow: hidden;">
<!-- header part -->
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
    </div>
<!-- navigator-bar : right part -->
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
                    <a href="check-chef.php" style="text-decoration: none;">
                        <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                            <button>
                                <h3>
                                    ตรวจสอบเซฟ
                                </h3>
                            </button>
                        </div>
                    </a>
                    </li>
                    <br>
                </ul>
            </div>
        </div>
<!-- contents part-->
        <div class="welcome">
            <div class="row">
            <div class="col-8" >
                <br>
            <center>
            
            <?php require_once 'process.php'; ?>
            
            <?php
                $query =  'SELECT * FROM ingredients ORDER BY Ingredients_id asc';
                $result = mysqli_query($conn,$query);
                $changT = $_GET['ChangT'];
                if ($changT == "กิโลกรัม"){
                        echo "  <div class='frame-table'>
                        <table  class='table table-hover' style='width: 100%;padding-left: 25px;'>
                        <tr>
                            <th colspan='5'><h1>แก้ไขวัตถุดิบในคลัง</h1></th>
                        </tr>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อวัตถุดิบ</th>
                            <th>ปริมาณคงเหลือ(กิโลกรัม)</th>
                            <th></th>
                            <th></th>
                        </tr>       ";
                        while ($row = $result->fetch_assoc() ) {
                            echo "<tr>";
                                echo "<td>" .$row["Ingredients_id"]. "</td>";
                                echo "<td>" .$row["Ingredients_name"]. "</td>";
                                echo "<td>" .($row["Ingredients_value"]/1000). "</td>";
                                echo "<td><a href='EditIncentory.php?edit=".$row["Ingredients_id"]."' ><h6 style='color:orange;'>แก้ไข</h6></a></td>";
                                echo "<td><a href='process.php?del=".$row["Ingredients_id"]." ' Onclick ='ConfirmDelete()'><h6 style='color:red;'>ลบ</h6></a></td>";
                            echo "</tr>";
                        }
                        echo "</table>
                      </div>"; 
                }else{
                    echo "  <div class='frame-table'>
                    <table  class='table table-hover' style='width: 100%;padding-left: 25px;'>
                    <tr>
                        <th colspan='5'><h1>แก้ไขวัตถุดิบในคลัง</h1></th>
                    </tr>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อวัตถุดิบ</th>
                        <th>ปริมาณคงเหลือ(กรัม)</th>
                        <th></th>
                        <th></th>
                    </tr>       ";
                    while ($row = $result->fetch_assoc() ) {
                        echo "<tr>";
                            echo "<td>" .$row["Ingredients_id"]. "</td>";
                            echo "<td>" .$row["Ingredients_name"]. "</td>";
                            echo "<td>" .$row["Ingredients_value"]. "</td>";
                            echo "<td><a href='EditIncentory.php?edit=".$row["Ingredients_id"]."' ><h6 style='color:orange;'>แก้ไข</h6></a></td>";
                            echo "<td><a href='process.php?del=".$row["Ingredients_id"]." ' Onclick ='ConfirmDelete()'><h6 style='color:red;'>ลบ</h6></a></td>";
                        echo "</tr>";
                    }
                    echo "</table>
                  </div>";
                }
            ?>
            </center>
            </div>
            <div class="col-4" >
                <div class="card mt-4">
                    <div class="card-title">
                    
                        <!--
                        <div class="alert alert-success">Bye</div>
                        -->
                        
                    <?php 
                    if (isset($_SESSION['message'])): 
                    ?>
                    <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
                        <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        ?>
                    </div>
                    <?php endif; ?>

                        <h3 class="bg-success text-white text-center py-3 ">Add Ingredients</h3>
                    </div>
                    <div class="card-body">
                    <?php
                        if($changT == "กิโลกรัม"){
                            echo'<form action="process.php" method="POST">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="text" class="form-control mb-2" value="'.$id.'" placeholder="ing_id" name="ing_id"></input><br>
                                    <input type="text" class="form-control mb-2" value="'.$name.'" placeholder="name" name="ing_name" ></input><br>
                                    <input type="text" class="form-control mb-2" value="'.$value.'" placeholder="value(kg)" name="ing_value"></input><br>';
                            if($update == true){
                                echo'<button type="submit" class="btn btn-info" name="updateKg">Update</button>';
                            }else{
                                echo'<button type="submit" class="btn btn-primary" name="saveKg">Save</button>';
                            }
                            echo'</form>';

                            echo '<a href="EditIncentory.php?ChangT=' . 'กรัม' . '" style="text-decoration: none;">
                                    <button class="btn-to-chang" type="button">ดูแบบกรัม</button>
                                </a>';
                        }else{
                            echo'<form action="process.php" method="POST">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="text" class="form-control mb-2" value="'.$id.'" placeholder="ing_id" name="ing_id"></input><br>
                                    <input type="text" class="form-control mb-2" value="'.$name.'" placeholder="name" name="ing_name" ></input><br>
                                    <input type="text" class="form-control mb-2" value="'.$value.'" placeholder="value(Grams)" name="ing_value"></input><br>';
                            if($update == true){
                                echo'<button type="submit" class="btn btn-info" name="update">Update</button>';
                            }else{
                                echo'<button type="submit" class="btn btn-primary" name="save">Save</button>';
                            }
                            echo'</form>';

                            echo '<a href="EditIncentory.php?ChangT=' . 'กิโลกรัม' . '" style="text-decoration: none;">
                                    <button class="btn-to-chang" type="button">ดูแบบกิโลกรัม</button>
                                </a>';
                        }
                        ?>
                    </div>
                </div>
            </div>                 
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>