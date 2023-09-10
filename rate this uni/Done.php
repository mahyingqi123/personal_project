<?php include 'db.php'?>
<?php
    if (isset($_POST['thisform'])) {
    $nickname=$_POST['user_nickname'];
    $email=$_POST['user_email'];
    $comment=$_POST['cmt_text'];
    $course=$_POST['user_course'];
    $Facilities=$_POST['Facilities'];
    $Environment=$_POST['Environment'];
    $Lecture=$_POST['Lecture'];
    $Food=$_POST['Food'];
    $Management=$_POST['Management'];
    $classof=$_POST['user_classof'];
    $school_id=$_POST['id'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $db="INSERT INTO comments(user_nickname,user_email,cmt_text,user_course,school_id,user_classof,Facilities,Environment,Lecture,Food,Management,IP) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt,$db)){
        echo "Data Error";
    }else{
        mysqli_stmt_bind_param($stmt,"ssssiiiiiiis", $nickname,$email,$comment,$course,$school_id,$classof,$Facilities,$Environment,$Lecture,$Food,$Management,$ip);
        mysqli_stmt_execute($stmt);
    }
    header("location:Done.php");
    exit;
    }?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
    <script data-ad-client="ca-pub-5660555499134222" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!--google ad-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GGMZDWWBEB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GGMZDWWBEB');
</script>
    <?php include "style.php"?>
     <link rel="icon" href="image/smalllogo.jpg">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Done</title>
</head>
<body>
    <main>
        <div class="donehead">
        <?php include 'header.html'?>
        <div class="done">
        <h1 class="doneh1">Your Review has been submitted</h1>
        </div>
        </div>
        <div class="donemain">
    <h1 class="doneheading">
        What to do next?
    </h1>
    <div class="donep">
        <div>
        <img src="image/cat.jpg" class="qp" alt="">
        <img src="image/11q.jpg" class="qq" alt="">
        Please wait for a few hours for us to approve your review. If you're review is still not posted after a day, please contact us immediately.
        <br><br>
        We are always looking for improvement!
        <br><br>
        So, if you have any constructive criticism, contact us at    <a class="aboutusmail" href="mailto:contact@ratethisuni.com">contact@ratethisuni.com</a>
        <br><br>
        You may continue and read the reviews of your school or the other schools too!
        </div>
    </div>
     </div>
     <?php include 'listofstates.php'?>
    </main> 
    <?php include 'footer.html'?>
</body>
</html>