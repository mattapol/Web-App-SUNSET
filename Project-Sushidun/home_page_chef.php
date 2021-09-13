<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
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
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            background: #ffffff;
            margin-bottom: 150px;
        }
        
        img.flag-j {
            margin-top: 30px;
            width: 400px;
            height: 230px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
        }
    </style>
</head>
<?php
    session_start();
    require("connect.php");
    $sql_chief = "SELECT * FROM chief WHERE Chief_id ='" . $_SESSION["ChiefID"] . "'";
    $result_chief = $conn->query($sql_chief);
    $row_chief = $result_chief->fetch_assoc();
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
                    <div class="point" style="margin-left: 150%;">
                        <img src="./Assets/user.png" style=" width: 50px; height: 50px; border-radius: 50px; margin-right: 20px;">
                        <h5>คุณ : <?php echo $row_chief['Name-chief']; ?></h5>
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
                        <a href="home_page_chef.php" style="text-decoration: none;">
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
                        <a href="table_point_chef.php" style="text-decoration: none;">
                            <div class="point" style="color:aliceblue;width: 362px;height: 81px;">
                                <button>
                                <h3>
                                    ตารางงานและคะแนน
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
            <div class="flagJ">
                <img class="flag-j" src="Assets/icon.jpg" alt="logo">
            </div>
            <div class="img">
                <img src="Assets/welcom.JPG" alt="logo" style="width: 900px; margin-top: 20px;">
                <h1>ติดต่อผู้จัดการ: 094-659-4875</h1>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>