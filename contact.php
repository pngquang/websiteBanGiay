<?php
require_once('db/dbhelper.php');

session_start();


?>



<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Liên hệ</title>
    <?php include('include/head.php') ?>
</head>

<body>
    <?php include('include/header.php') ?>


    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Liên hệ</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Trang chủ<span class="fa-solid fa-chevron-right"></span></a>
                        <a href="contact.php">Liên Hệ</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="contact_area section_gap_bottom">
        <div class="container">
            <style>
            #mapBox iframe {
                width: 100%;
            }

            </style>
            <div class="mapBox" id="mapBox">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15883.207510961529!2d108.01726418051992!3d16.271410733759506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1668982344611!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="fas fa-home"></i>
                            <h6>Đà Nẵng, Việt Nam</h6>
                            <p>455 Hàm Nghi</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="fas fa-phone"></i>
                            <h6><a href="#">0787679729</a></h6>
                            <p>Làm việc từ 7h đến 17h</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact_info">

                        <div class="info_item">
                            <i class="fa-solid fa-paper-plane"></i>
                            <h6><a href="#">support@gmail.com</a></h6>
                            <p>Hãy liên hệ với chúng tôi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <?php include('include/footer.php') ?>
    <?php include('include/script.php') ?>



</body>

</html>
;
