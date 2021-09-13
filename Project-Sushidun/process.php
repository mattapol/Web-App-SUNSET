<?php

    include('connect.php');
    session_start();

    $update = false;
    $id = '';
    $name = '';
    $value = '';

// save แบบ กรัม
    if (isset($_POST['save'])) {
        $id = $_POST['ing_id'];
        $name = $_POST['ing_name'];
        $value = $_POST['ing_value'];
        $conn ->   query("INSERT INTO ingredients (Ingredients_id, Ingredients_name, Ingredients_value) VALUES('$id','$name','$value') ") or
                     die($conn->error);

        $_SESSION['message'] = "Ingredients has been saved!";
        $_SESSION['msg_typ'] = "success";
        header("location: EditIncentory.php");
    }

// save แบบ Kg
    if (isset($_POST['saveKg'])) {
        $id = $_POST['ing_id'];
        $name = $_POST['ing_name'];
        $value = $_POST['ing_value']*1000;
        $conn ->   query("INSERT INTO ingredients (Ingredients_id, Ingredients_name, Ingredients_value) VALUES('$id','$name','$value') ") or
                     die($conn->error);

        $_SESSION['message'] = "Ingredients has been saved!";
        $_SESSION['msg_typ'] = "success";
        header("location: EditIncentory.php");
    }

    if (isset($_GET['del'])) {
        $ingID = $_GET['del'];
        $query = "DELETE FROM ingredients WHERE Ingredients_id = '$ingID' ";
    
        $_SESSION['message'] = "Ingredients has been deleted!";
        $_SESSION['msg_typ'] = "danger";
        header("location: EditIncentory.php");
    
        $result = mysqli_query($conn,$query);
        if(mysqli_affected_rows($conn)) {
            header("location: EditIncentory.php");
        }
    }
    
    if(isset($_GET['edit'])){
        $ingID = $_GET['edit'];
        $update = true;
        $result = $conn->query("SELECT * FROM ingredients WHERE Ingredients_id='$ingID' ") or die($conn->error);
        if(count($result)==1){
            $row = $result->fetch_array();  
            $id = $row["Ingredients_id"];
            $name = $row["Ingredients_name"];
            $value =$row["Ingredients_value"];
        } 
    }

// update แบบ กรัม
    if(isset($_POST['update'])) {
        $id = $_POST['ing_id'];
        $name = $_POST["ing_name"]; 
        $value = $_POST["ing_value"];
    
        $conn->query("UPDATE ingredients SET Ingredients_name='$name', Ingredients_value='$value' WHERE Ingredients_id = '$id' ") or die($conn->error);

        $_SESSION['message'] = "Ingredients has been updated!";
        $_SESSION['msg_typ'] = "warning";
        header("location: EditIncentory.php");
    
    }
// update แบบ Kg
    if(isset($_POST['updateKg'])) {
        $id = $_POST['ing_id'];
        $name = $_POST["ing_name"]; 
        $value = $_POST["ing_value"]*1000;
    
        $conn->query("UPDATE ingredients SET Ingredients_name='$name', Ingredients_value='$value' WHERE Ingredients_id = '$id' ") or die($conn->error);

        $_SESSION['message'] = "Ingredients has been updated!";
        $_SESSION['msg_typ'] = "warning";
        header("location: EditIncentory.php");
    
    }

?>