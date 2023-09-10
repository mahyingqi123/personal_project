<?php include "db.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GGMZDWWBEB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GGMZDWWBEB');
</script>
    <meta charset="UTF-8">
     <meta name="keywords" content="Rate This Uni, University, School, Uni, Rating, Rate, Malaysia, College, Review, Malaysia University Ranking">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "style.php"?>
    <link rel="icon" href="image/smalllogo.jpg">
    <script data-ad-client="ca-pub-5660555499134222" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!--googlead-->
    <title>About Us</title>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
</head>
<body >
    <main>
        <div class="aboutushead">
        <?php include 'header.html'?>
        <div class="aboutus">
        <h1 class="aboutush1">About Rate This Uni</h1>
        </div></div>
        <div class="aboutusmain">
    <h1 class="aboutusheading">
        What is This About?
    </h1>
    <p class="aboutusp">
        We believe that most of the students in Malaysia had struggled to choose the school that suits your the best. Hence, we created this website to help you. Not only that you can know more about your options, you can talk about your school too! This is a platform that you can voice out your opinion about your school, help yourself, help the others.
        <br>
        <br>
        We have collected <b><?php 
        $result = mysqli_query($con,"SELECT COUNT(*) AS total FROM comments"); 
            $row = mysqli_fetch_assoc($result);
                        echo $row['total']?> reviews</b> up to now, share it to your friends to support us!
                        <br>
        <br>
        We're always looking for ways to improve. Contact us at    <a class="aboutusmail" href="mailto:contact@ratethisuni.com">contact@ratethisuni.com</a>
        <br><br>
        RateThisUni was founded and developed in 2021 by YingQi.
    </p>
     </div>
     <?php include 'listofstates.php'?>
    </main> 
    <?php include 'footer.html'?>
</body>
</html>