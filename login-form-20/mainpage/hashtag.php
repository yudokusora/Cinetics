<?php 

    require_once("../php/bddFunciones.php");
    session_start();

    if(!isset($_SESSION["user"]))header('Location: ../index.php'); 

    $hastags = top5hashtags();

    $hastagcount = count($hastags);


    $portadas = [];

    foreach($hastags as $datos)
    {
        array_push($portadas,randomPortadaHashtag($datos["idHashtag"]));
    }
    
    $portadas = str_replace("mp4", "png", $portadas);
    

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
            Cinetics</title>
            <link rel="icon" href="../images/favicon.png">  

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
  
  <!--####################### Header Starts Here ###################-->
  <header class="continer-fluid ">
    <div class="header-top">
        <div class="container">
            <div class="row col-det">
                <div class="col-lg-6 d-none d-lg-block">
                    <ul class="ulleft">
                        <li>
                            <i ></i>
                            Cinetics
                            <span>|</span></li>
                        <li>
                            <i class="far fa-clock"></i>
                            <?php   print_r(date("H:i")) ?></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <ul class="ulright">
                        <li>
                            <i class="fas fa-cloud-upload-alt"></i>
                            <a id="uploadvid" href="./uploadVideo.php">Upload Video</a><span>|</span></li>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="./profile.php">Profile</a>
                            <a class="dropdown-item" href="../php/logOut.php">Log Out</a>

                        </div>
                        <li class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <?php  print_r($_SESSION['user']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row nav-row">
                <div class="col-md-3 logo">
                   <a href="./index.php"> <img src="assets/images/logo2.jpg" alt=""></a>
                </div>
                <div class="col-md-9 nav-col">
                    <nav class="navbar navbar-expand-lg navbar-light">

                        <button
                            class="navbar-toggler"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarNav"
                            aria-controls="navbarNav"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="index.php">Home
                                    </a>
                                </li>
                               
                                <li class="nav-item active">
                                    <a class="nav-link" href="hashtag.php">Hashtag</a>
                                </li>
                                <li>
                               <div class="input-group">
                                   <form action="../php/buscarVid.php" method="POST">
                                    <div class="form-outline">
                                    <input type="search" id="form1" class="form-control" name="keys" placeholder="search for video"/>
                                   
                                    </div>
                               </li>
                               <li>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                                </form>
                                </div>
                               </li>
                               
                               
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
  
       <!--  ************************* Page Title Starts Here ************************** -->
     <div class="page-nav no-margin row">
            <div class="container">
                <div class="row">
                    <h2>Top hashtag</h2>
                    <ul>
                        <li> <a href="./index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li><i class="fas fa-angle-double-right"></i> Hashtag</li>
                    </ul>
                </div>
            </div>
        </div>


  <!--####################### hashtag Starts Here ###################-->
      <section class="sesion-type">
  	    <div class="container">
           
  	        <div class="row">
  	            <div class="col-md-4 col-sm-6 <?php if($hastagcount<1)echo "d-none" ?>">
  	                <div class="single-sess">
  	                    <a href="./index.php?hashtag=<?php echo $hastags[0]["idHashtag"]?>"><img src="<?php echo $portadas[0] ?>" width = "100vw" alt=""></a>
  	                    <p><?php echo $hastags[0]["tag"] ?></p>
  	                </div>
  	            </div>
  	            <div class="col-md-4 col-sm-6 <?php if($hastagcount<2)echo "d-none" ?>">
  	                <div class="single-sess">
                      <a href="./index.php?hashtag=<?php echo $hastags[1]["idHashtag"]?>"><img src="<?php echo $portadas[1] ?>" alt=""></a>
  	                    <p><?php echo $hastags[1]["tag"] ?></p>
  	                </div>
  	            </div>
  	            <div class="col-md-4 col-sm-6 <?php if($hastagcount<3)echo "d-none" ?>">
  	                <div class="single-sess">
                      <a href="./index.php?hashtag=<?php echo $hastags[2]["idHashtag"]?>"> <img src="<?php echo $portadas[2] ?>" alt=""></a>
  	                    <p><?php echo $hastags[2]["tag"] ?></p>
  	                </div>
  	            </div>
  	            <div class="col-md-4 col-sm-6 <?php if($hastagcount<4)echo "d-none" ?>">
  	                <div class="single-sess">
                      <a href="./index.php?hashtag=<?php echo $hastags[3]["idHashtag"]?>"><img src="<?php echo $portadas[3] ?>" alt=""></a>
  	                    <p><?php echo $hastags[3]["tag"] ?></p>
  	                </div>
  	            </div>
  	            <div class="col-md-4 col-sm-6 <?php if($hastagcount<5)echo "d-none" ?>">
  	                <div class="single-sess">
                      <a href="./index.php?hashtag=<?php echo $hastags[4]["idHashtag"]?>"> <img src="<?php echo $portadas[4] ?>" alt=""></a>
  	                    <p><?php echo $hastags[4]["tag"] ?></p>
  	                </div>
  	            </div>

  	        </div>
  	    </div>
  	</section>

   <!--####################### Footer Starts Here ###################-->
   <div class="copy navbar fixed-bottom justify-content-around" >
            <div class=" center">
              
                
                
                <a href="https://github.com/yudokusora/Cinetics"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
       
            </div>

        </div>
</body>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="assets/js/script.js"></script>


</html>