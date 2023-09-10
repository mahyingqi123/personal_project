<?php include "db.php";
$id=$_GET['id'];
$sql = "SELECT * FROM Article WHERE id=$id";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_assoc($result);?>
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
    <script data-ad-client="ca-pub-5660555499134222" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!--googlead-->
        <meta charset="UTF-8">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5660555499134222"
     crossorigin="anonymous"></script>
        <meta name="google-site-verification" content="0qKnV-PWo-nkQh1m_anCLjMsDYT4QCWWAMTs6KKB36U" />
        <meta name="msvalidate.01" content="ACF0D5A5716D38F5E2EFED7F85191A0D" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="Rate This Uni, University, School, Uni, Rating, Rate, Malaysia, College, Review, Malaysia University Ranking">
        <meta name="author" content="Mah Ying Qi">
        <script src="https://kit.fontawesome.com/f91e8e6182.js" crossorigin="anonymous"></script>
        <title> <?php echo $row['title'] ?></title>
        <meta name="description" content="<?php echo $row['description']?> Malaysia's University Review. Write a review about your school, or read the reviews about your school. Choosing A School Just Got Easier. We have all the honest opinions about the schools you are cosidering.">
        <?php include "style.php"?>
        <link rel="icon" href="image/smalllogo.jpg">
        <meta property="og:image" content="image/article.jpg">
    </head>
<body>
<main>
        <div class="articlehead">
        <?php include 'header.html'?>
        </div>
        <div class="article">
        <h1 class="articleh1"><?php echo $row['title'] ?></h1>
        </div>
        <div class="articlemain">
            <br>
            <br>
    <div>
               <?php 
			echo "<pre style='font-family:Helvetica;' class='articlep'>".$row['Content']."</pre>"
            ?>
            <div style="text-align:right; margin:2em 8em 2em">--<?php 
			echo $row['Author']
            ?></div>
                </div>
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
</body>
</html>