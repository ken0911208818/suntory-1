<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('scss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('scss/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('scss/navbar.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">

    @yield('css')

</head>

<body>
    <nav>
        <section style="padding:0 0;">
            <div class="d-flex flex-wrap navbar_all" style="display: block; background-color:white; ">
                <div class="d-flex flex-wrap w-100">
                    <div class="container">
                        <nav id="nav1" class="navbar navbar-expand-md navbar-light">
                            <a class="navbar-brand" href="/">
                                <img src="./img/SUNTORY_logo.svg.png" alt="" style="height: 20px;width: 119px;">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                                <div class="">
                                    <span>menu</span>
                                </div>
                            </button>

                            <div class="collapse navbar-collapse" id="navbar">
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item pl-4 pl-md-0 ml-0 md-4 d-flex">
                                        <a class="nav-link hvr-underline-from-center text-dark d-flex align-items-center"
                                            href="/hak_his">白州</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 md-4 d-flex">
                                        <a class="nav-link hvr-underline-from-center text-dark d-flex align-items-center"
                                            href="/hibiki">響</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 md-4 d-flex">
                                        <a class="nav-link hvr-underline-from-center text-dark d-flex align-items-center"
                                            href="/yamasaki">山崎</a>
                                    </li>

                                    <li class="nav-item pl-4 pl-md-0 ml-0 md-4 d-flex">
                                        <a class="nav-link hvr-underline-from-center text-dark d-flex align-items-center"
                                            href="/Dealer">經銷商</a>
                                    </li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 md-4 d-flex">
                                        <a class="nav-link hvr-underline-from-center text-dark d-flex align-items-center"
                                            href="/product_list">產品列表</a>
                                    </li>

                                    <li class="nav-item pl-4 pl-md-0 ml-0 md-4 d-flex">
                                        <a class="nav-link  text-dark" href="#">
                                            <img src="./img/facebook.png"
                                                style="width: 30px;height: 30px;padding-right: 10p;margin-right: 13px;"
                                                alt="">
                                        </a>
                                        <a class="nav-link  text-dark" href="#">
                                            <img src="./img/instagram.png" style="width: 30px;height: 30px;" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </nav>
    <div id="app">

        @yield('content')

    </div>


    <footer>
        <section style="padding:0 0;">
            <div class="footer d-flex justify-content-center align-items-center">
                <span>Copyright ©</span>
            </div>
            <div class="footer2 d-flex justify-content-center">

                <img src="./img/sxc-warning.gif" class="img-footer" alt="">
            </div>
        </section>
    </footer>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>


    <script>
        // var scene = document.getElementById('scene');
        // var parallaxInstance = new Parallax(scene);



        // $(window).scroll(function () {
        //     var scrollVal = $(document).scrollTop()
        //     var footerheight=$('.wine3-detail-bg').offset().top ;

        //     // console.log(footerheight)
        //     // console.log(scrollVal)

        //     if (scrollVal > footerheight) {
        //         $('.footer2').addClass('active1');
        //     }
        //     else {
        //         $('.footer2').removeClass('active1');

        //     }

        // })



    </script>

    @yield('js')
</body>

</html>
