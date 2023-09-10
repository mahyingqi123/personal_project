<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'db.php';
$selectStateCommand = "SELECT * FROM states";
$result = mysqli_query($con, $selectStateCommand);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/f91e8e6182.js" crossorigin="anonymous"></script>   
        <link rel="icon" href="image/smalllogo.jpg">
        <title>States</title>
        <?php include "style.php" ?>
        <style>
            
        </style>

    </head>
    <body>
    
        <div class="stateshead" style="height:500px; width: 100%;">
                <?php include 'header.html' ?>
                <div class="schoolscontainer">                 
                    <div class="schoolis">
                       
                    </div>
                </div>
            </div>
        <?php
        $search = '';
        if (isset($_POST['btn-submit'])) {
            $search = '%' . $_POST['search'] . '%';
            $mysql = "SELECT * FROM states WHERE states_name LIKE '$search' OR states_name Like ?;";
            $stmt = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt, $mysql)) {
                echo"Connection Failed";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $search);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
        }
        ?>
        <!--search function-->
        <div class="search-btn"align="right">
            <form method="post" action="">
                  <input  class="searchbox1" type="text" name="search" value='<?php echo isset($_POST['search'])?$_POST['search']:"" ?>'  placeholder="state name" />
                  <button type="submit" name="btn-submit" class="searchbutton1"><i class="fas fa-search" ></i></button>
            </form> 
        </div>
        <!--end of search function-->
        <!--display states-->
        <div class="container overflow-hidden" >
            <div class="row gx-5">
                <?php
                 //if search's result is not blank(display all) and no result found. Display "No result found";
                if ($search != '' && $result->num_rows == 0) {
                      echo"<h1 class='no-result'>No result.</h1>";
                } else if ($search != '') {// if the search is blank. Display all the states.
                    while ($results = mysqli_fetch_array($result)) {
                        ?>
                        <!--sequence-->                            
                        <div class="col-lg-4 col-sm-6 col-xs-12" >
                            <div class="p-3">
                                <!--cards-->                          
                                <?php echo "<a href=./states.php?states=" . $results['states_id'] . ">"; ?>
                                <div class="card" style="border:hidden;">
                                    <div class='image-container' style='border-radius:8px;'> 
                                        <?php
                                        echo"<img src='./" . $results['img'] . "' class='card-img-top'"
                                        . "   alt='pic-" . $results['states_name'] . "'>";
                                        ?>
                                        <?php echo"<h2>" . $results['states_name'] . "</h2>"; ?>
                                    </div>                                
                                </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {// if the result is found. Display the found results.
                    while ($results = mysqli_fetch_array($result)) {
                        ?>
                        <!--sequence-->                            
                        <div class="col-lg-4 col-sm-6 col-xs-12" >
                            <div class="p-3">
                                <!--cards-->                          
                                <?php echo "<a href=./states.php?states=" . $results['states_id'] . ">"; ?>
                                <div class="card" style="border:hidden;">
                                    <div class='image-container' style='border-radius:8px;'> 
                                        <?php
                                        echo"<img src='./" . $results['img'] . "' class='card-img-top'"
                                        . " style=' min-height: 200px; max-height: 200px; border-radius:8px;  object-fit: cover;'   alt='pic-" . $results['states_name'] . "'>";
                                        ?>
                                        <?php echo"<h2>" . $results['states_name'] . "</h2>"; ?>
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

    </body>
    <?php include 'listofstates.php' ?>
    <?php include 'footer.html' ?>
</html>
