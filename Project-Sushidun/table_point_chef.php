<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตารางงานและคะแนน</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            background: #DDBB3D;
            margin-bottom: 150px;
        }
        div.header-title {
            width: 40%;
            margin-left: 30%;
            position: absolute;

        }
        hr {
            border-top: 5px solid black;
        }

        div.table-point {
            margin-top: 10%;
            margin-left: 10%;
            width: 80%;
            height: 450px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            background-color: white;
            border-radius: 50px;
        }

        div.table-all {
            position: relative;
        }

        img.imge-user {
            width: 30%;
            border-radius: 200px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
        }
        div.user {
            bottom: 60%;
            position: absolute;
            text-align: center;
            margin-left: 4%;
        }

        div.table-work {
            margin-left: 30%;
            margin-right: 3%;
            overflow: hidden;
        }
        table.t-work, th.th-work, td.td-work {
            margin-top: 4%;
            border: 2px solid black;
            padding: 10px;
        }
        table.t-work {
            width: 100%;
        }

        div.point-chef {
            margin-top: 1%;
            margin-left: 10%;
            width: 80%;
            height: 160px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            background-color: white;
            border-radius: 50px;
            position: absolute;
        }
        table.t-point, th.th-point, th.th-star {
            margin-top: 4%;
            border: 2px solid black;
            padding: 15px;
            margin-left: 5%;
        }
        table.t-point {
            width: 90%;
        }
        th.th-point {
            width: 20%;
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
                        <img src="./Assets/user.png"
                            style=" width: 50px; height: 50px; border-radius: 50px; margin-right: 20px;">
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
            <div class="header-title">
                <hr>
                <h1>ตารางงานและคะแนน</h1>
                <hr>
            </div>
            <!--content-->
            <div class="table-all">
                <div class="user">
                    <img class="imge-user" src="Assets/user.png" alt="">
                    <h2>เชฟ <?php echo $row_chief['Name-chief']; ?></h2> <!-- name chef -->
                    <form action="table_point_chef.php" method="post">
                        <input type="date" name="date-chef" style="height: 30px; width: 40%; border: 0px; font-size: 25px;">
                        <br><!-- Date and work of chef -->
                        <input type="submit" value="ยืนยันวันที่">
                    </form>
                </div>
                <div class="table-point">
                    <div class="table-work">
                        <?php
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                $dateT = $_POST['date-chef'];
                                echo '<br>';
                                echo '<h3>วันที่ '.$dateT.'</h3>';
                                $sql_df = "SELECT * FROM queue, course WHERE queue.Chief_id ='" . $_SESSION["ChiefID"] . "' 
                                AND queue.Date ='" . $dateT . "' AND queue.Course_id = course.Course_id";
                                $result_df = $conn->query($sql_df);
                                echo'<table class="t-work">';
                                while($row_df = $result_df->fetch_assoc()){
                                    echo'<tr>
                                            <td class="td-work"><h5>'.$row_df['Time'].'</h5></td>
                                            <th class="th-work"><h4>คอร์ส '.$row_df['Course_name'].'</h4></th>
                                        </tr>';
                                }
                                echo '</table>';
                            }else{
                                echo'<table class="t-work">
                                <tr>
                                    <td class="td-work"><h4>10:00:00-12:00:00</h4></td>
                                    <th class="th-work"><h1></h1></th>
                                </tr>
                                <tr>
                                    <td class="td-work"><h4>12:05:00-14:00:00</h4></td>
                                    <th class="th-work"><h1></h1></th>
                                </tr>
                                <tr>
                                    <td class="td-work"><h4>14:05:00-16:00:00</h4></td>
                                    <th class="th-work"><h1></h1></th>
                                </tr>
                                <tr>
                                    <td class="td-work"><h4>16:05:00-18:00:00</h4></td>
                                    <th class="th-work"><h1></h1></th>
                                </tr>
                                <tr>
                                    <td class="td-work"><h4>18:05:00-20:00:00</h4></td>
                                    <th class="th-work"><h1></h1></th>
                                </tr>
                            </table>';
                            }
                        ?>

                    </div>
                    
                </div>
            </div>
        
            <div class="point-chef">
                <table class="t-point">
                    <tr>
                        <th class="th-point"><h3>คะแนนเฉลี่ย</h3></th>
                        <th class="th-star">
                            <?php
                            $points = number_format(((($row_chief['Score_food'] + $row_chief['Score_service'])/2)/$row_chief['Number_of_users_chief']), 1);
                            for($i = 1; $i <= $points; $i++){
                                echo'<span class="fa fa-star checked" style="color:#F1C40F; width:10%; font-size: 50px;"></span>';
                                if($i==$points){
                                    echo '<span style="font-size: 40px;">'.$points.' -ดาว</span>';
                                }
                            }
                            ?>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

</html>