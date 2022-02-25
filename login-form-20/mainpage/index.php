<?php 
require_once("../php/videoManager.php");


session_start();
   
if(!isset($_SESSION["user"]))header('Location: ../index.php'); 

if(isset($_GET['path']))
{
    $video = $_GET['path'];
    // Echo inferior para limpiar la barra del navegador del string que llega por path.
    echo "<script type=\"text/javascript\">window.history.pushState('index', 'Title', '/Cinetics-master/login-form-20/mainpage/index.php');</script>";
}else
{
    $video = obtenirVideoAleatori();
}
if ($video!=0){
    // Aqui estoy filtrando para cuando no hay videos en la bdd. actualmente el html se fastidia ya que depende de miniaturaVid.
    $i = 0;
    $miniaturaVid = miniatura($video,$i);
    $i++;
}
$videosCarrusel=obtenirVideosAleatoris();
//TODO en $videosCarrusel habrá un array con Paths (0 min, 5 max). Falta crear dinamicamente el html
//TODO para mostrar en función de la variable las miniaturas.


?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            Cinetics</title>
            <link rel="icon" href="../images/favicon.png">
        <link rel="shortcut icon" href="assets/images/fav.jpg">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
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
                            <a href="./uploadVideo.php">Upload Video
                            <span>|</span></li>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
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
                    <img src="assets/images/logo2.jpg" alt="">
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
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Home
                                    </a>
                                </li>
                               
                                <li class="nav-item">
                                    <a class="nav-link" href="hashtag.php">Hashtag</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="videos.php">Videos</a>
                                </li>
                               
                               
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
        <!--####################### Slider Starts Here ###################-->
        <div class="banner-card container-fluid">
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-9 banner-slid">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active ">
                                    <a href="single.php">
                                        <img src="<?php echo $miniaturaVid ?>" class="d-block w-100" alt="...">
                                        <div class="detail-card">
                                            <p>Pictures, abstract symbols the ingredients with symbols the
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="single.php">
                                        <img src="<?php echo miniatura(obtenirVideoAleatori(),$i); $i++; ?>" class="d-block w-100" alt="...">
                                        <div class="detail-card">
                                            <p>Pictures, abstract symbols the ingredients with symbols the
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="single.php">
                                        <img src="<?php echo miniatura(obtenirVideoAleatori(),$i); $i++ ?>" class="d-block w-100" alt="...">
                                        <div class="detail-card">
                                            <p>Pictures, abstract symbols the ingredients with symbols the
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <a
                                class="carousel-control-prev"
                                href="#carouselExampleIndicators"
                                role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a
                                class="carousel-control-next"
                                href="#carouselExampleIndicators"
                                role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <div class="col-md-3 vgbh">
                        <div class="row">
                            <div class="video-card col-md-12 col-sm-6">
                                    <a href="single.php">
                                <img src="assets/images/video/b1.jpg" alt="">
                                <div class="detail-card">
                                    <p>Pictures, abstract symbols the ingredients with</p>
                                </div>
                                </a>
                            </div>
                            <div class="video-card col-md-12 col-sm-6">
                                    <a href="single.php">
                                <img src="assets/images/video/b2.jpg" alt="">
                                <div class="detail-card">
                                    <p>Pictures, abstract symbols the ingredients with</p>
                                </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--####################### Trending Starts Here ###################-->
        <div class="treanding-video container-fluid">
            <div class="container">
                <div class="row video-title no-margin">
                    <h6>
                        <i class="fas fa-book"></i>
                        Treanding Videos</h6>
                </div>
                <div class="video-row row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="video-card">
                                <a href="single.php">
                            <img src="assets/images/video/b1.jpg" alt="">

                            <div class="row details no-margin">
                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="col-md-6 col-6 no-padding left">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                </div>
                                <div class="col-md-6 col-6 no-padding right">

                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="video-card">
                                <a href="single.php">
                            <img src="assets/images/video/b2.jpg" alt="">

                            <div class="row details no-margin">
                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="col-md-6 col-6 no-padding left">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                </div>
                                <div class="col-md-6 col-6 no-padding right">

                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="video-card">
                                <a href="single.php">
                            <img src="assets/images/video/b3.jpg" alt="">

                            <div class="row details no-margin">
                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="col-md-6 col-6 no-padding left">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                </div>
                                <div class="col-md-6 col-6 no-padding right">

                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                            </div>
                            </a>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="single.php">
                        <div class="video-card">
                            <img src="assets/images/video/b4.jpg" alt="">

                            <div class="row details no-margin">
                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="col-md-6 col-6 no-padding left">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                </div>
                                <div class="col-md-6 col-6 no-padding right">

                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                            </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--####################### Latest Videos Starts Here ###################-->
        <div class="latest-video latest-video container-fluid">
            <div class="container">
                <div class="row no-margin video-title">
                    <h6>
                        <i class="fas fa-book"></i>
                        Latest Video Videos</h6>
                </div>
                <div class="video-row row">
                    <div class="col-lg-3 col-md-4 col-sm-6 ">
                            <a href="single.php">
                        <div class="video-card">
                            <img src="assets/images/video/b5.jpg" alt="">

                            <div class="row details no-margin">
                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="col-md-6 col-6 no-padding left">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                </div>
                                <div class="col-md-6 col-6 no-padding right">

                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                            </div>

                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="single.php">
                        <div class="video-card">
                            <img src="assets/images/video/b6.jpg" alt="">

                            <div class="row details no-margin">
                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="col-md-6 col-6 no-padding left">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                </div>
                                <div class="col-md-6 col-6 no-padding right">

                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                            </div>

                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="single.php">
                        <div class="video-card">
                            <img src="assets/images/video/b5.jpg" alt="">

                            <div class="row details no-margin">
                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="col-md-6 col-6 no-padding left">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                </div>
                                <div class="col-md-6 col-6 no-padding right">

                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                            </div>

                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="single.php">
                        <div class="video-card">
                            <img src="assets/images/video/b4.jpg" alt="">

                            <div class="row details no-margin">
                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="col-md-6 col-6 no-padding left">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                </div>
                                <div class="col-md-6 col-6 no-padding right">

                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                            </div>

                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--####################### Video Blog Starts Here ###################-->
        <div class="container-fluid video-blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row no-margin video-title">
                            <h6>
                                <i class="fas fa-book"></i>
                                Product Reviews</h6>
                        </div>
                        <div class="video-ro row">
                            
                            <div class="col-sm-4">
                                <div class="img">
                                    <img src="assets/images/video/b1.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-sm-8 detail">

                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="counts">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-thumbs-up"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus malesuada
                                    purus sit amet quam vehicula Sed ac fermentum leo.</p>
                                <div class="buttons">
                                    <button class="btn btn-sm btn-primary">View Detail</button>
                                    <button class="btn btn-sm btn-danger">Watch Now</button>
                                </div>

                            </div>
                        </div>
                        <div class="video-ro row">
                            <div class="col-sm-4">
                                <div class="img">
                                    <img src="assets/images/video/b2.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-sm-8 detail">

                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="counts">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-thumbs-up"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus malesuada
                                    purus sit amet quam vehicula Sed ac fermentum leo.</p>
                                <div class="buttons">
                                    <button class="btn btn-sm btn-primary">View Detail</button>
                                    <button class="btn btn-sm btn-danger">Watch Now</button>
                                </div>

                            </div>
                        </div>
                        <div class="video-ro row">
                            <div class="col-sm-4">
                                <div class="img">
                                    <img src="assets/images/video/b3.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-sm-8 detail">

                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="counts">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-thumbs-up"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus malesuada
                                    purus sit amet quam vehicula Sed ac fermentum leo.</p>
                                <div class="buttons">
                                    <button class="btn btn-sm btn-primary">View Detail</button>
                                    <button class="btn btn-sm btn-danger">Watch Now</button>
                                </div>

                            </div>
                        </div>
                        <div class="video-ro row">
                            <div class="col-sm-4">
                                <div class="img">
                                    <img src="assets/images/video/b4.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-sm-8 detail">

                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="counts">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-thumbs-up"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus malesuada
                                    purus sit amet quam vehicula Sed ac fermentum leo.</p>
                                <div class="buttons">
                                    <button class="btn btn-sm btn-primary">View Detail</button>
                                    <button class="btn btn-sm btn-danger">Watch Now</button>
                                </div>

                            </div>
                        </div>
                        <div class="video-ro row">
                            <div class="col-sm-4">
                                <div class="img">
                                    <img src="assets/images/video/b5.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-sm-8 detail">

                                <h6>Pictures, abstract symbols the ingredients with</h6>
                                <div class="counts">
                                    <i class="far fa-eye"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-thumbs-up"></i>
                                    <span>3,241,234</span>
                                    <i class="far fa-comments"></i>
                                    <span>3,241,234</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus malesuada
                                    purus sit amet quam vehicula Sed ac fermentum leo.</p>
                                <div class="buttons">
                                    <button class="btn btn-sm btn-primary">View Detail</button>
                                    <button class="btn btn-sm btn-danger">Watch Now</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row no-margin video-title">
                            <h6>
                                <i class="fas fa-book"></i>
                                Top Contributers</h6>
                        </div>
                        <div class="contri-row">
                            <div class="image">
                                <img src="assets/images/testimonial/member-01.jpg" alt="">
                            </div>
                            <div class="detail">
                                <h6>David Smith</h6>
                                <p>78 Videos</p>
                                <span>Joned 2018</span>
                            </div>
                        </div>
                        <div class="contri-row">
                            <div class="image">
                                <img src="assets/images/testimonial/member-02.jpg" alt="">
                            </div>
                            <div class="detail">
                                <h6>David Smith</h6>
                                <p>78 Videos</p>
                                <span>Joned 2018</span>
                            </div>
                        </div>
                        <div class="contri-row">
                            <div class="image">
                                <img src="assets/images/testimonial/member-03.jpg" alt="">
                            </div>
                            <div class="detail">
                                <h6>David Smith</h6>
                                <p>78 Videos</p>
                                <span>Joned 2018</span>
                            </div>
                        </div>
                        <div class="contri-row">
                            <div class="image">
                                <img src="assets/images/testimonial/member-04.jpg" alt="">
                            </div>
                            <div class="detail">
                                <h6>David Smith</h6>
                                <p>78 Videos</p>
                                <span>Joned 2018</span>
                            </div>
                        </div>
                        <div class="contri-row">
                            <div class="image">
                                <img src="assets/images/testimonial/member-01.jpg" alt="">
                            </div>
                            <div class="detail">
                                <h6>David Smith</h6>
                                <p>78 Videos</p>
                                <span>Joned 2018</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--####################### Ads Starts Here ###################-->
        <div class="ads-cont container-fluid"></div>
        <!--####################### Category Starts Here ###################-->
        <section class="sesion-type">
            <div class="container">
                <div class="inner-title row">
                    <h2>Top Category</h2>
                    <p>Not the answer you're looking for? Printing and typesetting inLorem Ipsum is
                        simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry’s Lorem</p>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="single-sess">
                            <img src="assets/images/session/therapy-1.jpg" alt="">
                            <p>Individual Therapy</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-sess">
                            <img src="assets/images/session/therapy-2.jpg" alt="">
                            <p>Cuple Therapy</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-sess">
                            <img src="assets/images/session/therapy-3.jpg" alt="">
                            <p>online Session</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-sess">
                            <img src="assets/images/session/therapy-4.jpg" alt="">
                            <p>Group Therapy</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-sess">
                            <img src="assets/images/session/therapy-5.jpg" alt="">
                            <p>All Age Group</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-sess sess-ok">
                            <h4>Start Your Session today</h4>
                            <p>Take the first step on your journey to feeling better.
                            </p>
                            <button class="btn btn-danger">View all Category</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--####################### Footer Starts Here ###################-->

        <div class="copy">
            <div class="container center">
              
                
                
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
