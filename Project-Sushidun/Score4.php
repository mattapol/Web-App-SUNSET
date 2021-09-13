<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ให้คะแนน</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link rel="stylesheet" href="./css/style_star5multiple.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        div.welcome {
            margin-top: 10px;
            text-align: center;
            position: absolute;
            width: 1400px;
            height: 760px;
            left: 500px;
            top: 110px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            background: #AAAAAA;
        }
        
        div.frame-1,
        div.frame-2 {
            width: 100%;
            margin-top: 4%;
            margin-left: 5%;
            margin-right: 5%;
        }
        
        div.frame-chef,
        div.frame-course {
            width: 25%;
            height: 300px;
            border-radius: 50px;
            background-color: white;
            text-align: center;
            position: absolute;
        }
        
        div.frame-course {
            padding-top: 80px;
        }
        
        img.image-chef {
            width: 50%;
            height: 160px;
            border-radius: 100px;
            box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
            margin-bottom: 30px;
        }
        
        div.rate-chef-t,
        div.rate-chef-s,
        div.rate-course-f,
        div.rate-course-v {
            width: 60%;
            height: 150px;
            margin-left: 35%;
            text-align: start;
        }
        
        h1 {
            margin-bottom: 3%;
            margin-left: 5%;
        }
    </style>
</head>
<?php
  session_start();
  require("connect.php");

  #การอ้างอิง User id
  $sql_user = "SELECT * FROM queue, user
  WHERE queue.User_id = user.User_id AND queue.User_id = '".$_SESSION["userId"]."'";
  $result_user = $conn->query($sql_user);
  $row_user = $result_user->fetch_assoc();

  #การอ้างอิง Chief id
  $sql_chief = "SELECT * FROM queue, chief
  WHERE queue.Chief_id = chief.Chief_id AND chief.Chief_id = '".$_GET['ChiefID']."'";
  $result_chief = $conn->query($sql_chief);
  $row_chief = $result_chief->fetch_assoc();

  #การอ้างอิง Course id
  $sql_course = "SELECT * FROM queue, course
  WHERE queue.Course_id = course.Course_id AND course.Course_id = '".$_GET['CourseID']."'";
  $result_course = $conn->query($sql_course);
  $row_course = $result_course->fetch_assoc();

  $_SESSION['chief_ID'] = $_GET['ChiefID']; #การส่ง Chief id กลับไปเพื่อใช้อ้างอิงการให้คะแนน
  $_SESSION['course_ID'] = $_GET['CourseID']; #การส่ง Course id กลับไปเพื่อใช้อ้างอิงการให้คะแนน
  $_SESSION['q_id'] = $_GET['QID']; #การส่ง Queue id กลับไปเพื่อใช้อ้างอิงการให้คะแนน

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
            <form action="Score.php?" method="post">
                <div class="frame-1">
                    <div class="frame-chef">
                        <img class="image-chef" src="./Assets/user.png">
                        <h1>เชฟ <?php echo $row_chief["Name-chief"]; ?></h1>
                    </div>

                    <div class="rate-chef-t">
                        <div class="page__group">
                            <h1>คะแนนรสชาติอาหาร</h1>
                            <div class="rating">
                                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1" value="1">
                                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2" value="2">
                                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3" value="3">
                                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4" value="4">
                                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5" value="5">
                                <label for="rc1" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">1</span>
                          </label>
                                <label for="rc2" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">2</span>
                          </label>
                                <label for="rc3" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">3</span>
                          </label>
                                <label for="rc4" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">4</span>
                          </label>
                                <label for="rc5" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">5</span>
                          </label>
                            </div>
                        </div>
                    </div>

                    <div class="rate-chef-s">
                        <div class="page__group">
                            <h1>คะแนนบริการ</h1>
                            <div class="rating">
                                <input type="radio" name="rating-star1" class="rating__control screen-reader" id="rc6" value="1">
                                <input type="radio" name="rating-star1" class="rating__control screen-reader" id="rc7" value="2">
                                <input type="radio" name="rating-star1" class="rating__control screen-reader" id="rc8" value="3">
                                <input type="radio" name="rating-star1" class="rating__control screen-reader" id="rc9" value="4">
                                <input type="radio" name="rating-star1" class="rating__control screen-reader" id="rc10" value="5">
                                <label for="rc6" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">1</span>
                          </label>
                                <label for="rc7" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">2</span>
                          </label>
                                <label for="rc8" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">3</span>
                          </label>
                                <label for="rc9" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">4</span>
                          </label>
                                <label for="rc10" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">5</span>
                          </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="frame-2">
                    <div class="frame-course">
                        <h1>คอร์ส <?php echo $row_course['Course_name']; ?></h1>
                        <h1><?php echo $row_course['Course_price'].".- บาท"; ?></h1>
                    </div>

                    <div class="rate-course-f">
                        <div class="page__group">
                            <h1>คะแนนความสด</h1>
                            <div class="rating">
                                <input type="radio" name="rating-star2" class="rating__control screen-reader" id="rc11" value="1">
                                <input type="radio" name="rating-star2" class="rating__control screen-reader" id="rc12" value="2">
                                <input type="radio" name="rating-star2" class="rating__control screen-reader" id="rc13" value="3">
                                <input type="radio" name="rating-star2" class="rating__control screen-reader" id="rc14" value="4">
                                <input type="radio" name="rating-star2" class="rating__control screen-reader" id="rc15" value="5">
                                <label for="rc11" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">1</span>
                          </label>
                                <label for="rc12" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">2</span>
                          </label>
                                <label for="rc13" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">3</span>
                          </label>
                                <label for="rc14" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">4</span>
                          </label>
                                <label for="rc15" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">5</span>
                          </label>
                            </div>
                        </div>
                    </div>

                    <div class="rate-course-v">
                        <div class="page__group">
                            <h1>คะแนนความคุ้มค่า</h1>
                            <div class="rating">
                                <input type="radio" name="rating-star3" class="rating__control screen-reader" id="rc16" value="1">
                                <input type="radio" name="rating-star3" class="rating__control screen-reader" id="rc17" value="2">
                                <input type="radio" name="rating-star3" class="rating__control screen-reader" id="rc18" value="3">
                                <input type="radio" name="rating-star3" class="rating__control screen-reader" id="rc19" value="4">
                                <input type="radio" name="rating-star3" class="rating__control screen-reader" id="rc20" value="5">
                                <label for="rc16" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">1</span>
                          </label>
                                <label for="rc17" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">2</span>
                          </label>
                                <label for="rc18" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">3</span>
                          </label>
                                <label for="rc19" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">4</span>
                          </label>
                                <label for="rc20" class="rating__item">
                            <svg class="rating__star">
                              <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">5</span>
                          </label>
                            </div>
                        </div>
                    </div>

                </div>
                <input type="submit" value="ยืนยันการให้คะแนน" style="background-color:white; 
                width: 300px; 
                height: 60px; 
                box-shadow: 0px 5px 6px rgba(0, 0, 0, 0.5);
                font-size: 25px;
                border-radius: 100px;
                margin-left: 75%;">
            </form>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                <symbol id="star" viewBox="0 0 26 28">
                  <path d="M26 10.109c0 .281-.203.547-.406.75l-5.672 5.531 1.344 7.812c.016.109.016.203.016.313 0 .406-.187.781-.641.781a1.27 1.27 0 0 1-.625-.187L13 21.422l-7.016 3.687c-.203.109-.406.187-.625.187-.453 0-.656-.375-.656-.781 0-.109.016-.203.031-.313l1.344-7.812L.39 10.859c-.187-.203-.391-.469-.391-.75 0-.469.484-.656.875-.719l7.844-1.141 3.516-7.109c.141-.297.406-.641.766-.641s.625.344.766.641l3.516 7.109 7.844 1.141c.375.063.875.25.875.719z"/>
                </symbol>
              </svg>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>