<?php
include 'db.php';
$sid = $_GET['states'];
$sql = "SELECT * FROM states WHERE states_id=$sid";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <script data-ad-client="ca-pub-5660555499134222" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!--googlead-->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-GGMZDWWBEB"></script>
        <script src="https://kit.fontawesome.com/f91e8e6182.js" crossorigin="anonymous"></script>   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-GGMZDWWBEB');
        </script>
        <link rel="icon" href="image/smalllogo.jpg">
        <meta name="keywords" content="Rate This Uni, University, School, Uni, Rating, Rate, Malaysia, College, Review, Malaysia University Ranking">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:image" content="<?php echo $row['img'] ?>">
        <style>
            .stateshead   {background-image: url(<?php echo $row['img'] ?>);}
        </style>
        <title>
            <?php echo "Schools in " . $row['states_name'] ?>
        </title>
        <?php include "style.php" ?>
    </head>
    <body>
       
            <div class="stateshead" style="height:500px; width: 100%;">
                <?php include 'header.html' ?>
                <div class="schoolscontainer">
                    <h1 class='schoolistheading'>
                        <?php
                        echo "Schools in " . $row['states_name']
                        ?> </h1>
                    <div class="schoolis">
                        <?php
                        $selectCommand = "SELECT * FROM schools WHERE state_id=$sid ORDER BY school_name";
                        $result = mysqli_query($con, $selectCommand);
                        ?>
                    </div>
                </div>
            </div>

        </main>
        <?php
        //search function 
        $search = '';
        if (isset($_POST['btn-submit'])) {
            $search = '%' . $_POST['search'] . '%';
            $mysql = "SELECT * FROM schools WHERE (school_title LIKE '$search' OR school_name Like ?) AND state_id = $sid ;";
            $stmt = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt, $mysql)) {
                echo"Connection Failed";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $search);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        }
        //end of search function 
        
        ?>
         <!--search function-->
        <div class="search-btn"align="right">
            <form method="post" action="">
                <input type="text" name="search" value='<?php echo isset($_POST['search']) ? $_POST['search'] : "" ?>'  placeholder="school name" />               
                <button type="submit" name="btn-submit" class="searchbutton1"><i class="fas fa-search" style="width:20px;"></i></button>
            </form>
        </div>
         <!--end of search function-->
         
         <!--display states-->
        <div class="container overflow-hidden" >
            <div class="row gx-5">
                <?php
                //if search's result is not blank(display all) and no result found. Display "No result found";
                if ($search != '' && $result->num_rows == 0) {
                    echo"<h1 class='no-result'>No result</h1>";
                } else if ($search != '') { // if the search is blank. Display all the states.
                    while ($results = mysqli_fetch_array($result)) {
                        ?>
                        <!--sequence-->         
                        <div class="one-item" >
                            <div class="p-3 ">
                                <!--cards-->                          
                                <?php echo " <a href='school.php?id=" . $results['school_id'] . "' class='schoollink'>"; ?>
                                <div class="card" style="border:hidden;">
                                    <div class='image-container' style='border-radius:8px;'> 
                                        <?php
                                        echo"<img src='./image/" . $results['school_title'] . ".jpg' class='card-img-top'"
                                        . " style='min-height: 200px; max-height: 200px; border-radius:8px;  object-fit: cover;'   alt='pic-" . $results['school_name'] . "'>";
                                        ?>                                     
                                    </div> 
                                    <div class="card-body" style="text-align: center;">
                                        <?php echo"<h4 class='card-title'>" . $results['school_name'] . "</h4>"; ?>                                   
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else { // if the result is found. Display the found results.
                    while ($results = mysqli_fetch_array($result)) {
                        ?>
                        <!--sequence-->                            
                        <div class="col-lg-4 col-sm-6 col-xs-12" >
                            <div class="p-3">
                                <!--cards-->                          
                                <?php echo " <a href='school.php?id=" . $results['school_id'] . "' class='schoollink'>"; ?>
                                <div class="card" style="border:hidden;">
                                    <div class='image-container' style='border-radius:8px;'> 
                                        <?php
                                        echo"<img src='./image/" . $results['school_title'] . ".jpg' class='card-img-top'"
                                        . " style='min-height: 200px; max-height: 200px; border-radius:8px;  object-fit: cover;'   alt='pic-" . $results['school_name'] . "'>";
                                        ?>                                      
                                    </div>    
                                    <div class="card-body" style="text-align: center;">
                                        <?php echo"<h4 class='card-title'>" . $results['school_name'] . "</h4>"; ?>                                   
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php include 'listofstates.php' ?>
        <?php include 'footer.html' ?>
    </body>
</html>