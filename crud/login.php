<?php
session_start();
include "../service/koneksi.php";

if(isset($_POST["simpan"])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $_SESSION['username'] = $username;
        header("Location: ../page/admin/dasboard.php");
        exit();
    } else {
        header("Location: ../page/admin/dasboard.php");
        exit();
    }

    $stmt->close();
    $db->close();
}
?>
