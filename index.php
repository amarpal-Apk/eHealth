<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="bootstrap.min " rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <style>
        /* .body {
            height: 2000px;
        } */
        #logo {
            margin-left: 45px;

        }

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;

        }

        .bg-transparrent {
            background-color: #82e6d7;
            background-color: #21d192;
            opacity: 0.8;
        }

        #navbar-mid {
            margin-left: 260px;
        }

        #navbar-mid a {
            margin-left: 7px;
            margin-right: 7px;
            padding-left: 15px;
            padding-right: 15px;
            color: rgb(255, 250, 250);
            font-weight: bolder;
            border-radius: 7px;
        }

        #navbar-mid a:hover {
            background-color: aqua;

        }

        .button {
            background-color: #ff4249;
            margin-right: 8px;
            padding: 5px 15px 5px 15px;
            color: white;
            border-radius: 20px;
            font-weight: bold;

        }

        .button:hover {
            background-color: #fa7378;
            box-shadow: #fcbdc0;
        }

        #banner {
            background-image: url("banner.jpg");
            background-repeat: no-repeat;
            height: auto;
            width: 100%;
            /* background-size: 300px 100px; */
            /* background-size: contain, cover; */
        }

        .active {
            background-color: aqua;

        }
    </style>
    <style>
        .features-boxed {
            color: #313437;
            background-color: #eef4f7;
        }

        .features-boxed p {
            color: #7d8285;
        }

        .features-boxed h2 {
            font-weight: bold;
            margin-bottom: 40px;
            padding-top: 40px;
            color: inherit;
        }

        @media (max-width:767px) {
            .features-boxed h2 {
                margin-bottom: 25px;
                padding-top: 25px;
                font-size: 24px;
            }
        }

        .features-boxed .intro {
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto;
        }

        .features-boxed .intro p {
            margin-bottom: 0;
        }

        .features-boxed .features {
            padding: 50px 0;
        }

        .features-boxed .item {
            text-align: center;
        }

        .features-boxed .item .box {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            margin-bottom: 30px;
        }

        .features-boxed .item .icon {
            font-size: 60px;
            color: #1485ee;
            margin-top: 20px;
            margin-bottom: 35px;
        }

        .features-boxed .item .name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 8px;
            margin-top: 0;
            color: inherit;
        }

        .features-boxed .item .description {
            font-size: 15px;
            margin-top: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <nav class=" sticky bg-transparrent navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand" id="logo">
                <img src="image/medical-logo.jpg" height="45" alt="eHEALTH">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav " id="navbar-mid">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="#services" class="nav-item nav-link">Services</a>
                    <a href="pages/about.html" class="nav-item nav-link">About us</a>
                    <a href="#footer" class="nav-item nav-link">Contact us</a>
                    <a href="pages/search_dctr.php" class="nav-item nav-link">Search doctor</a>
                    <!-- <a href="#" class="nav-item nav-link disabled" tabindex="-1">Reports</a> -->
                </div>
                <div class="navbar-nav ms-auto">
                    <a href="pages/login.php" class="btn button nav-item nav-link">Login</a>
                    <a href="pages/signup.php" class="btn  button nav-item nav-link">SignUp</a>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div id="banner">
            <div>
                <img id="banner" src="image/banner14.jpg">
            </div>

        </div>

        <div id="services">
            <section class="features-boxed">
                <div class="container">
                    <div class="intro">
                        <h2 class="text-center">Features </h2>
                        <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh
                            erat, pellentesque ut laoreet vitae.</p>
                    </div>
                    <div class="row justify-content-center features">
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-user-md icon"></i>
                                <h3 class="name">Online Appointment</h3>
                                <p class="description">We provide well experienced doctors&nbsp; on our platform you just need
                                    to search and book an appointment .&nbsp;</p><a class="learn-more" href="#">Learn more »</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-list icon"></i>
                                <h3 class="name">Medicine Schedule</h3>
                                <p class="description">Do you forget to take your medicine on time? Here we are. On our platform
                                    You can keep track on current medicine schedule.</p><a class="learn-more" href="#">Learn
                                    more »</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4 item">
                            <div class="box"><i class="fa fa-chain icon"></i>
                                <h3 class="name">Report chain</h3>
                                <p class="description">Having trouble in managing all your health test report. On our platform
                                    you can keep track of all previous your test reports date wise.</p><a class="learn-more" href="#">Learn more »</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <div id="footer">

            <?php
            include 'pages/footer.php';
            ?>

        </div>
    </main>
</body>

</html>