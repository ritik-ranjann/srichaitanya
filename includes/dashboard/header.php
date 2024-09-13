<?php
include_once("includes/config/config.php");

session_start();
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="SriChaitanya" name="keywords">
    <meta content="SriChaitanya" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <?php
    
    function pageTitle($title=""){
        static $titleCalled = 0;
        if($titleCalled == 0){
            $titleCalled = 1;
            if($title){
                echo "<title>".$title."</title>";
                return;
            }else{
                echo "<title>Sri Chaitanya techno School - Empowering Minds, Shaping Futures</title>";
            }
        }
    }
    $schoolDetails = [
        "schoolname" => "SriChaitanya-Techno-School"
    ]
    ?>

<style>
        .navbar-brand img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin: 2px;
        }
        .logout-button {
            background: transparent;
            border: none;
            color: #007bff;
            cursor: pointer;
        }
    </style>