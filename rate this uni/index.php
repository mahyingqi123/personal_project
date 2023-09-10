<?php
include 'db.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GGMZDWWBEB"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'G-GGMZDWWBEB');</script>
    <script data-ad-client="ca-pub-5660555499134222" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!--ad-->
    <script src="https://kit.fontawesome.com/f91e8e6182.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="0qKnV-PWo-nkQh1m_anCLjMsDYT4QCWWAMTs6KKB36U" />
    <meta name="msvalidate.01" content="ACF0D5A5716D38F5E2EFED7F85191A0D" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Rate This Uni, University, School, Uni, Rating, Rate, Malaysia, College, Review, Malaysia University Ranking">
    <meta name="author" content="Mah Ying Qi">
    <title>Rate This Uni</title>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
    <meta name="description" content="Malaysia's University Review. Write a review about your school, or read the reviews about your school. Choosing A School Just Got Easier. We have all the honest opinions about the schools you are cosidering.">
    <?php include "style.php"?>
    <link rel="icon" href="image/smalllogo.jpg">
    <meta property="og:image" content="image/smalllogo.jpg">
</head>
<body>
    <main>
        <div id="part1">
            <headers><h1 class="head"><a class="headers " href="index.php">Rate This Uni</a></h1>
    </headers>
        <navs>
        <ul class="navlink">
            <li class="navigate" ><a class="navtags" href="States-School.php">States</a> </li>
            <li class="navtas">|</li>
            <li ><a class="navtags" href="#article">Articles</a></li>
            <li class="navtas">|</li>
            <li ><a class="navtags" href="About us.php">About</a></li>
            <li class="navtas">|</li>
            <li><a href="mailto:contact@ratethisuni.com" class="navtags">Contact</a></li>
        </ul>
    </navs><div class="extra">
            <div class="indexpart1">
            <h1 class="divh1">Rate Yours</h1>
            <p class="divp1">Give us your honest review about your school!</p>
            </div>
            <form action="index.php" class="searchbox" method="post">
            <input class="search" type="text" name="search" placeholder="Search your school...">
            <button type="submit" name="submit-search" class="searchbutton"><i class="fas fa-search"></i></button>
        </form>
        <?php 

            if(isset($_POST['submit-search'])){
            $search='%'.$_POST['search'].'%';
            $mysql = "SELECT * FROM schools WHERE school_title LIKE '$search' OR school_name Like ? ;";
            $stmt=mysqli_stmt_init($con);
            if(!mysqli_stmt_prepare($stmt,$mysql)){
                echo"Connection Failed";
            }else{
                mysqli_stmt_bind_param($stmt,"s",$search);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
            $queryresult=mysqli_num_rows($result);
            if ($queryresult>0) {
                while($row=mysqli_fetch_assoc($result)){
                    echo"<form action='../school.php' method='get'>
                <h3><button class='searchedschool' value=".$row['school_id']." name='id'>"
                .$row['school_name']."</button>
                </h3>
                </form>";}
            }else{
                echo "<div class='searchedschool'>No result. If you did not get the result you wanted,<br> we suggest to type the school's name in full form or<br> search it in the states lists.</div>";
            }
        } 
    }?></div>
        </div>
<!--<div style="text-align:center">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5660555499134222"
     data-ad-slot="1589870221"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script><div>-->
        <div id="part2">
            <h1 class="div2h1">Choosing A School Can Be Easy.</h1>
            <p class="div2p1">We have all the honest opinions about the schools you are considering.
            </p>
        </div>
        <div class="most">
            <h1 class="mostreviewedschoolshead">Most Reviewed Schools
            </h1>
            <br><br>
            <div class='mostschools'>
            <?php
             $topschool=mysqli_query(
                 $con,
                 "SELECT 
                 school_name,schools.school_id,school_title
                 FROM comments
                 INNER JOIN
                 schools 
                 ON comments.school_id=schools.school_id
                 GROUP BY comments.school_id
                 ORDER BY COUNT(comments.school_id) DESC
                 LIMIT 6")
                 ;
            while($row=mysqli_fetch_array($topschool)){
                echo"<form action='../school.php' method='get'>
                    <h3><button class='mostschoolsname' value=".$row['school_id']." name='id'>
                    <div><img class='photo1' src='image/".$row['school_title'].".jpg' alt='Photo of a Uni'>
                    <br>".$row['school_name']."
                    </div>
                    </button>
                    </h3>
                    </form>";}?>   
            </div>       
            <br><br>
        </div>
        <div class="most mosts">
            <h1 class="mostreviewedschoolshead" id="article">Articles</h1>
            <div class='mostarticle'>
                <ul >
                    <?php 
			$sql = "SELECT * FROM Article LIMIT 6";
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
                echo"<li class='articlelist'><a href='Article1.php?id=".$row['id']."' class='articles'>".$row['title']."</a></li>";
            }}?>
                </ul>
            </div>    
            <br><br>
        </div>
        <?php include 'listofstates.php'?>
    </main>
    <?php include 'footer.html'?>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6114b80d426ff34d"></script>
</body>
</html>