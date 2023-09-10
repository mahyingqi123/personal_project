<?php include 'db.php';?>
<?php
$sid=$_GET['id']
?>
<?php
 $result = mysqli_query($con,"SELECT * FROM schools WHERE school_id=$sid");
 $rows=mysqli_fetch_assoc($result) ?>
            
<!DOCTYPE html>
<html lang="en">
<head>
    <script data-ad-client="ca-pub-5660555499134222" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!--googlead-->
    <meta charset="UTF-8">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GGMZDWWBEB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GGMZDWWBEB');
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php include "style.php"?>
    <style>
        .photobox   {background-image: url(image/<?php echo $rows['school_title']?>.jpg)}"
    </style>
     <meta name="keywords" content="Rate This Uni, University,<?php echo $rows['school_title']?>,<?php echo $rows['school_name'] ?> , School, Uni, Rating, Rate, Malaysia, College, Review, Malaysia University Ranking">
    <script src="https://kit.fontawesome.com/f91e8e6182.js" crossorigin="anonymous"></script>
    <title><?php
                echo $rows['school_title'];
            ?></title>
            <link rel="icon" href="image/smalllogo.jpg">
            <meta property="og:image" content="image/<?php echo $rows['school_title']?>.jpg">
</head>
<body>
<div class="schoolheadd">
    <div class="schooll">
    <div class="photobox">
    <?php include 'header.html'?>
    </div >
        <h1 class="schoolheading">
            <?php echo $rows['school_name']?></h1></div>
        <div class="schoolmain">
            <div class="schoolleft">
    		<h1 class="text-warning mt-4 mb-4">
    			<b><span id="average_rating">
                    <?php
                    $result = mysqli_query($con,"SELECT AVG(Facilities) as Faci, AVG(Environment) as Envi,AVG(Lecture) as Lect,AVG(Management) as Manage ,AVG(Food) as Fo FROM comments WHERE school_id=$sid"); 
                    $row = mysqli_fetch_assoc($result);
                    $facilities=$row['Faci'];
                    $environment=$row['Envi'];
                    $lecture=$row['Lect'];
                    $management=$row['Manage'];
                    $food=$row['Fo'];
                    $average=array_sum($row) /count($row);
                    echo round($average,2)
                    ?>
			    </span> / 5</b>
    		</h1>
            <?php 
                 function starrating($rating){
                     switch($rating){
                      case $rating>=0.5 && $rating<1.5:
                        echo "<div class='mb-3'>
    			            <i style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                            <i  class='fas fa-star star-light mr-1 main_star'></i>
                            <i  class='fas fa-star star-light mr-1 main_star'></i>
                            <i  class='fas fa-star star-light mr-1 main_star'></i>
                            <i  class='fas fa-star star-light mr-1 main_star'></i></div>";
                            break;
                     case$rating>=1.5 && $rating<2.5:
                        echo "<div class='mb-3'>
    			                <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                                <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                                <i  class='fas fa-star star-light mr-1 main_star'></i>
                                <i  class='fas fa-star star-light mr-1 main_star'></i>
                                <i  class='fas fa-star star-light mr-1 main_star'></i></div>";
                                break;    
                     case $rating>=2.5 && $rating<3.5:
                        echo "<div class='mb-3'>
                                <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                                <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                                <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                                <i  class='fas fa-star star-light mr-1 main_star'></i>
                                <i  class='fas fa-star star-light mr-1 main_star'></i></div>";
                                break;
                     case $rating>=3.5 && $rating<4.5:
                        echo "<div class='mb-3'>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                        <i  class='fas fa-star star-light mr-1 main_star'></i></div>";
                        break;
                     case $rating>=4.5 && $rating<=5:
                        echo "<div class='mb-3'>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i>
                        <i  style='color:yellow' class='fas fa-star star-light mr-1 main_star'></i></div>";
                        break;
                     case $rating>=0 && $rating<0.5:
                        echo "<div class='mb-3'>
    			<i class='fas fa-star star-light mr-1 main_star'></i>
                <i class='fas fa-star star-light mr-1 main_star'></i>
                <i class='fas fa-star star-light mr-1 main_star'></i>
                <i class='fas fa-star star-light mr-1 main_star'></i>
                <i class='fas fa-star star-light mr-1 main_star'></i></div>";
                    break;}};
                starrating($average)?>
                <br>
                <h3>Rating Breakdown</h3>
                <div class="H44">
                <div> Facilities </div><div>:<?php echo round($facilities,1)?></div><?php starrating($facilities) ?>  
                <div> Environment</div><div>:<?php echo round($environment,1)?></div><?php starrating($environment) ?> 
                <div> Lecture    </div><div>:<?php echo round($lecture,1)?></div><?php starrating($lecture) ?> 
                <div> Food       </div><div>:<?php echo round($food,1)?></div><?php starrating($food) ?>    
                <div> Management </div><div>:<?php echo round($management)?></div><?php starrating($management) ?>  </div>
    		<h3><span id="total_review">
                <?php
                    $result = mysqli_query($con,"SELECT COUNT(*) AS total FROM comments WHERE school_id=$sid"); 
                    $row = mysqli_fetch_assoc($result);
                        echo $row['total']
                    ?></span> Reviews</h3>
            <div class="wrapper">
                <button class="open_button"   
                        onclick="openForm()">Comment</button>
                <form action="Done.php" method="POST" id="myForm" class="form">
                <div class="row">
                    <div class="notice">Reminder : *<i>Email address will not be shown on the page, it's just to avoid spamming and fake reviews. To prevent any misunderstanding, please enter your true Email. You may use a nickname for the Name section. All the comments will be anonymous.</i>*</div>
                	<div class="input-group">
                		<label for="name">Name</label>
                		<input class="typingbox"  minlength="5" maxlength="80" type="text" name="user_nickname" id="name" placeholder="Enter your Name" required>
                	</div>
                	<div class="input-group">
                		<label for="email">Email :</label>
                		<input class="typingbox" type="email" name="user_email" id="email" placeholder="Enter your Email" required>
                        </div>
                    <div class="input-group">
                		<label for="Course">Course :</label>
                		<input class="typingbox" type="text"  minlength="6" maxlength="80" name="user_course" id="course" placeholder="Enter your Course" required>
                	</div>
                    <div class="input-group">
                		<label for="Class of">Class of :</label>
                		<input class="typingbox" type="number" min="1957" max="2050" name="user_classof" id="class" placeholder="year"  required>
                        </div>
                	<div class="input-group">
                		<label for="rating">Facilities :</label>
                		<input class="typingbox" type="number" min="0" max="5" name="Facilities" id="Facilities" placeholder="1-5" required>
                        </div>
                    <div class="input-group">
                		<label for="rating">Environment :</label>
                		<input class="typingbox" type="number" min="0" max="5" name="Environment" id="Environment" placeholder="1-5" required>
                    </div>
                    <div class="input-group">
                		<label for="rating">Lecture :</label>
                		<input class="typingbox" type="number" min="0" max="5" name="Lecture" id="Lecture" placeholder="1-5" required>
                        </div>
                    <div class="input-group">
                		<label for="rating">Food :</label>
                		<input class="typingbox" type="number" min="0" max="5" name="Food" id="Food" placeholder="1-5" required>
                        </div>
                    <div class="input-group">
                		<label for="rating">Management :</label>
                		<input class="typingbox" type="number" min="0" max="5" name="Management" id="Management" placeholder="1-5" required>
                        </div>
                    </div>
                    <div class="input-group textarea">
                    	<label for="comment">Comment :</label>
                    	<textarea id="comment" minlength="100" class="typingbox" name="cmt_text" placeholder="Enter your Comment" required></textarea>
                    </div>
                    <div><i>By clicking submit, you have read and agree to our <a href="Terms of Use.php" target="_blank">Terms of use</a>.</i></div>
                    <br>
                    <input type='hidden' name='id' value="<?php echo $sid?>">
                    <div>
                    	<button
                    	class="btn-btm"  name="thisform" >Submit</button>
                        <button class="btn-btm" onclick="closeForm()">Close</button>
                    </div></form>
                </div>
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="fluid"
     data-ad-layout-key="-fb+5w+4e-db+86"
     data-ad-client="ca-pub-5660555499134222"
     data-ad-slot="4785496313"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                 </div>
            <div class="schoolright">
                <div ><div class="description">
                            <h2 class="commenth">Info About This School</h2>
			            	<p><b>Private/Public</b> :<?php echo $rows['private/public'];?></p>
			            	<p><b>Year Established</b> :<?php echo $rows['year_established'];?></p>
                            <p><b>Location</b> : <?php echo $rows['Address'];?></p>
                            <p><b>Description</b> : <?php echo $rows['Description'];?></p>
			            </div>
                </div>
                <div class="prev-comments">
                    <h1 class="commenth">All reviews</h1>
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="fluid"
     data-ad-layout-key="-gw-3+1f-3d+2z"
     data-ad-client="ca-pub-5660555499134222"
     data-ad-slot="7940791626"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                <?php 
			       function selectComments($mysqli,$schoolId)   
                   {
                       if ($schoolId) {
                           $stmt = $mysqli->prepare('SELECT * FROM comments WHERE school_id=? ORDER BY Datetime DESC');
                           $stmt->bind_param('s', $schoolId);
                           $stmt->execute();
                           $result = $stmt->get_result();
                       } else {
                           $result = $mysqli->query('SELECT * FROM comments ORDER BY Datetime DESC');
                       }
                       return $result->fetch_all(MYSQLI_ASSOC);
                   }
                   foreach(selectComments($con, $sid) as $row) {
                      if($row['Status']==1){?>
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
                }else{
                    continue;}}
                
			    ?> <script>
                function openForm() {
                  document.getElementById("myForm").style.display = "block";
                }
                function closeForm() {
                  document.getElementById("myForm").style.display = "none";
                }
                </script>    
                </div>
            </div>
            </div>
         <?php include 'listofstates.php'?>
    <?php include 'footer.html'?>
    
</body>
</html>
 