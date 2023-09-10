<?php
    //  if (isset($_POST['thisform'])) {
     $nickname=$_POST['user_nickname'];
     $email=$_POST['user_email'];
     $comment=$_POST['cmt_text'];
     $course=$_POST['user_course'];
     $rating=$_POST['user_rating'];
     $classof=$_POST['user_classof'];
     $studentid=$_POST['studentid'];
     $school_id=$_POST['id'];
     $db="INSERT INTO comments(user_nickname,user_email,cmt_text,user_course,user_rating,school_id,user_classof,student_id) VALUES(?,?,?,?,?,?,?,?)";
     $stmt=mysqli_stmt_init($con);
     if(!mysqli_stmt_prepare($stmt,$db)){
         echo "Data Error";
     }else{
         mysqli_stmt_bind_param($stmt,"ssssiiis", $nickname,$email,$comment,$course,$rating,$school_id,$classof,$studentid);
         mysqli_stmt_execute($stmt);
     }
     header("location:Done.php");
     exit;
     ?>