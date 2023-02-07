<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Bench Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <script src="https://kit.fontawesome.com/cdcced96ff.js" crossorigin="anonymous"></script>
</head>

<body>

    <section class="login_banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_content">
                        <div class="title">
                            <h2>Build Excellent</h2>
                            <h2>Engineering Partnership.</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_box">
                        <p>Get Started with <span>Login</span> </p>
                        @if(session()->get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session()->get('error')}}
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                          </button> --}}
                      </div>
                    @endif
                        <form method="POST" action="/authendicate">
                            @csrf

                        <div class="form-input">
                            <input type="text" name="userid" placeholder="User ID" style="text-transform:uppercase">
                        </div>
                        <div class="form-input position-relative">
                            <input type="password" name="password" placeholder="Password" class="login_password" > 
                            <div class="eye"><i class="far fa-eye-slash"></i></div>
                        </div>

                        <button type="submit" class="get_start">Get Started</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main_features">
        <div class="container-fluid text-center">
            <h1>Main Features</h1>
            <p>To manage the engineers and their projects, <span>Customer Relationship Management (CRM)</span> is used.
                It gives an overall view of the list of engineers and architects and the projects handled by them.
                CRM is used to track the progress of the project mainly. It's easy to use and communicate with.
                Everyone can be connected and monitored.
            </p>
            <div class="main_inner">
                <div class="row radius_shape_slider">
                    <div class="col-lg-2">
                        <div class="radius_shape">
                            <p>Track The Progess</p>
                            <img src="assets/images/login/main_1.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="radius_shape">
                            <img src="assets/images/login/main_2.png" class="img-fluid" alt="">
                            <p>Easy Communication</p>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="radius_shape">
                            <p>Easy to use</p>
                            <img src="assets/images/login/main_3.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="radius_shape">
                            <img src="assets/images/login/main_4.png" class="img-fluid" alt="">
                            <p>Progress Bar</p>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="radius_shape">
                            <p>Everyone Connected</p>
                            <img src="assets/images/login/main_5.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="radius_shape">
                            <img src="assets/images/login/main_6.png" class="img-fluid" alt="">
                            <p>Monitering</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="partnering">
        <div class="container-fluid">
            <div class="row justify-content-end text-end">
                <div class="col-lg-10">
                    <div class="group_title">
                        <h2>Partnering with</h2>
                        <h2>Sensational Construction</h2>
                        <h2>Company</h2>
                    </div>
                    <p>
                        Engineers receive projects from Business Bench through a partnership.
                        This is a means to address a variety of issues, including financial worries,
                        while also growing our firm and creating individual employment. The advantages
                        of this collaboration include the ability to access a larger pool of administrative and
                        commercial resources, construction expertise, a reduction in individual overhead and costs,
                        reputation and credibility, increased efficiency, and the capacity to pool connections,
                        which can lead to the best project outcome.
                    </p>
                    <button class="read_more">Read More</button>
                    <div class="arrow one">
                        <img src="assets/images/login/parter_arrow1.svg" class="img-fluid" alt="">
                    </div>
                    <div class="arrow two">
                        <img src="assets/images/login/parter_arrow2.svg" class="img-fluid" alt="">
                    </div>
                    <div class="arrow three">
                        <img src="assets/images/login/parter_arrow3.svg" class="img-fluid" alt="">
                    </div>
                    <div class="arrow four">
                        <img src="assets/images/login/parter_arrow4.svg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="man_img">
            <img src="assets/images/login/partner_img.png" class="img-fluid" alt="">
        </div>

        <div class="laptop_img">
            <img src="assets/images/login/laptop.png" class="img-fluid" alt="">
        </div>
    </section>

    <section class="basic_filter">
        <div class="container text-center">
            <h1>The Basics</h1>
            <p>Here are many variations of passages of Lorem Ipsum available,but the majority have suffered alterationin
                some form, by injected humour, or randomised
                words which don't look even slightly believable.If you are going to use a passage ofLorem Ipsum, you
                need to be sure there isn't anything embarrassing hidden in the
                middle of text. All the Lorem Ipsum generators on the Internet</p>
        </div>
        <div class="container text-center mt-5">
            <div class="content-slider">
                <div class="content-inner">
                    <h2>Filtering</h2>
                    <p>here are many variations of passages of Lorem Ipsum available,but the majority have suffered
                        alterationin some form, by injected humour, or randomised
                        words which don't look even slightly believable.If you are going to use a passage ofLorem Ipsum,
                        you need to be sure there isn't anything embarrassing hidden in the
                        middle of text. All the Lorem Ipsum generators on the Internet</p>
                </div>
                <div class="content-inner">
                    <h2>Filtering2</h2>
                    <p>here are many variations of passages of Lorem Ipsum available,but the majority have suffered
                        alterationin some form, by injected humour, or randomised
                        words which don't look even slightly believable.If you are going to use a passage ofLorem Ipsum,
                        you need to be sure there isn't anything embarrassing hidden in the
                        middle of text. All the Lorem Ipsum generators on the Internet</p>
                </div>
                <div class="content-inner">
                    <h2>Filtering3</h2>
                    <p>here are many variations of passages of Lorem Ipsum available,but the majority have suffered
                        alterationin some form, by injected humour, or randomised
                        words which don't look even slightly believable.If you are going to use a passage ofLorem Ipsum,
                        you need to be sure there isn't anything embarrassing hidden in the
                        middle of text. All the Lorem Ipsum generators on the Internet</p>
                </div>
            </div>
        </div>
    </section>

    <section class="track">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="group_title">
                        <h2>Track Your</h2>
                        <h2>Building Process </h2>
                    </div>
                    <p>
                        Engineers receive projects from Business Bench through a partnership.
                        This is a means to address a variety of issues, including financial worries,
                        while also growing our firm and creating individual employment. The advantages
                        of this collaboration include the ability to access a larger pool of administrative and
                        commercial resources, construction expertise, a reduction in individual overhead and costs,
                        reputation and credibility, increased efficiency, and the capacity to pool connections,
                        which can lead to the best project outcome.
                    </p>
                    <button class="login_btn">Login</button>
                    <div class="arrow one">
                        <img src="assets/images/login/track_arrow1.svg" class="img-fluid" alt="">
                    </div>
                    <div class="arrow two">
                        <img src="assets/images/login/track_arrow2.svg" class="img-fluid" alt="">
                    </div>
                    <div class="arrow three">
                        <img src="assets/images/login/track_arrow3.svg" class="img-fluid" alt="">
                    </div>
                    <div class="arrow four">
                        <img src="assets/images/login/track_arrow4.svg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="man_img">
            <img src="assets/images/login/man_2.png" class="img-fluid" alt="">
        </div>

        <div class="laptop_img">
            <img src="assets/images/login/mobile.png" class="img-fluid" alt="">
        </div>
    </section>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="assets/js/aos.js"></script>

    <script src="assets/js/script.js"></script>


</body>

</html>
