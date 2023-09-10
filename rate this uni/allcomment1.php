<?php include 'db.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hampalang</title>
    <?php include "style.php"?>
</head>
<body>
<?php 
			       function selectComments($mysqli,$schoolId)   
                   {
                       if ($schoolId) {
                           $stmt = $mysqli->prepare('SELECT * FROM comments ORDER BY Datetime DESC');
                           $stmt->bind_param('s', $schoolId);
                           $stmt->execute();
                           $result = $stmt->get_result();
                       } else {
                           $result = $mysqli->query('SELECT * FROM comments ORDER BY Datetime DESC');
                       }
                       return $result->fetch_all(MYSQLI_ASSOC);
                   }
                   foreach(selectComments($con, $sid) as $row) {
                      ?>
                    <div class="single-item">
                    <h4><?php echo $row['user_nickname'];?></h4>
                    <p><?php echo $row['Datetime']; 
                    ?></p>
                    <p><b>Course</b> : <?php echo $row['user_course']; 
                    ?></p>
                    <p><b>Class of</b> <?php echo $row['user_classof']; 
                    ?></b></p>
                    <p><b>Rating : </b><?php echo ($row['Food']+$row['Facilities']+$row['Management']+$row['Environment']+$row['Lecture']) /5;; 
                    ?>/5</p>
                    <p><b>Comment : </b><pre style="white-space: pre-wrap;font-family:calibri,'sans serif'"><?php echo $row['cmt_text']; 
                    ?></pre></p>
                </div>
                <?php
              }
                
			    ?> 
</body>
</html>