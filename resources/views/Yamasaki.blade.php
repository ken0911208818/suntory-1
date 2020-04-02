@extends('layouts.nav')

@section('title')
    山崎
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
<!-- <link rel="stylesheet" href="./css/timeline.css"> -->

<link rel="stylesheet" href="{{asset('css/time-line.css')}}">
<link rel="stylesheet" href="{{asset('css/index.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/navbar.css')}}"> --}}
<link rel="stylesheet" href="{{asset('css/lightbox.css')}}">
<link rel="stylesheet" href="{{asset('css/cart-style.css')}}">
<link rel="stylesheet" href="{{asset('css/hover.css')}}">

<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css" />
<style>
    p{
        margin:0;
    }
    .hvr-underline-from-center:before{
        bottom:10px;
    }
    .hvr-underline-from-center:hover:before, .hvr-underline-from-center:focus:before, .hvr-underline-from-center:active:before{
        bottom:10px;
        left: 13px;
    }
</style>
@endsection

@section('content')

    <a href="/product_list" class="cart"><span></span></a>

    <nav>


        <section>
            <div class="navbar_1">
                <div class="container">
                    <nav id="nav" class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="#">
                            <img src="./img/logo.png" alt="" style="height: 68px; display: none; width:auto" />
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnavber"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <div class="hamburger">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                    style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M492,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h472c11.046,0,20-8.954,20-20S503.046,236,492,236z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M492,76H20C8.954,76,0,84.954,0,96s8.954,20,20,20h472c11.046,0,20-8.954,20-20S503.046,76,492,76z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M492,396H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h472c11.046,0,20-8.954,20-20
			C512,404.954,503.046,396,492,396z" />
                                        </g>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                </svg>
                            </div>
                        </button>

                        <div class="collapse navbar-collapse" id="mainnavber">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 d-flex">
                                <a class="hvr-underline-from-center1" href="#story">
                                    {{$id->story != null ? $id->story : ""}}
                                </a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 d-flex">
                                    <a class=" hvr-underline-from-center1" href="#attitude">
                                        {{$id->attitude != null ? $id->attitude : ""}}
                                    </a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 d-flex">
                                    <a class=" hvr-underline-from-center1" href="#sure">
                                        {{$id->sure != null ? $id->sure : ""}}
                                    </a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 d-flex">
                                    <a class=" hvr-underline-from-center1" href="#method">
                                        {{$id->method != null ? $id->method : ""}}
                                    </a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 d-flex">
                                    <a class=" hvr-underline-from-center1" href="#product">
                                        {{$id->product != null ? $id->product : ""}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </section>
    </nav>
    <section>
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm d-flex justify-content-center align-items-center">
                        <div class="banner-title">
                            <img src="./img/top_logo.png" alt="" />
                        </div>
                    </div>
                    <div class="col-sm  d-flex justify-content-center align-items-center">
                        <div class="banner-img">
                            <img src="./img/keyvisual.jpg.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="story" id="story">
            <div class="container">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="story-title">
                        <h1>
                            山崎的故事
                        </h1>
                    </div>
                </div>

                <div class="swiper-container" style="max-height:500px">
                    <div class="swiper-wrapper">

                        @foreach ($stories as $story)

                        <div class="swiper-slide d-flex flex-wrap">

                            <div class="col-lg-6 col-12 img-6">
                                <img src="{{$story->img}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="col-lg-6 col-12 pading">
                                <div class="small-title">
                                    <h2>{{$story->title}}</h2>
                                </div>
                                <div class="small-content">
                                    {!!$story->content!!}
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="attitude" id="attitude">
            <div class="container">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="attitude-title">
                        <h1>山崎的態度</h1>
                    </div>
                </div>

                <div data-aos="fade-up-left" data-aos-duration="1000">
                    <div class="attitude-content">

                        <?php
                         $i=0;
                        ?>

                        @foreach ($attitudes as $attitude)
                        <?php
                            if($i%2 == 0){
                        ?>
                        <div class="content-one d-flex flex-wrap">
                            <div class="col-lg-5 col-12">
                                <div class="title">
                                <h2>{{$attitude->title}}</h2>
                                </div>
                                <div class="content">

                                        {!!$attitude->content!!}

                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6 col-12">
                                <img class="img-fluid" src="{{$attitude->img}}" alt="" srcset="" />
                            </div>
                        </div>
                        <?php
                            } else{
                        ?>

                        <div data-aos="fade-up-right" data-aos-duration="1000">
                            <div class="content-two d-flex flex-wrap">
                                <div class="col-lg-6 col-12">
                                    <img src="{{$attitude->img}}" class="img-fluid" alt="" srcset="" />
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-5 col-12">
                                    <div class="title text-lg-center">
                                        <h2>{{$attitude->title}}</h2>
                                    </div>
                                    <div class="content">
                                        <p>
                                            {!!$attitude->content!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>

                        <?php
                            $i++;
                        ?>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        @foreach ($products as $product)

        <div class="product">
            <div class="lightbox-target d-flex justify-content-center align-items-center" id="dog{{$product->id}}">
                <div class="detail text-left d-flex align-items-center" style="width: 600px;">
                    <p>
                        {!!$product->content!!}
                    </p>
                </div>

                <a class="lightbox-close" href="#123"></a>
            </div>

            <div class="container" id="product">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="product-title">
                        <h1>
                            山崎系列
                        </h1>
                    </div>
                </div>

                <div data-aos="flip-right" data-aos-duration="1000">
                    <div class="product-content d-flex flex-wrap align-items-center">
                        <div class="col-lg-3 col-12 d-flex justify-content-center">
                            <img class="product-img" src="{{$product->img}}" alt="" srcset="" />
                        </div>
                        <div class="col-lg-1"></div>

                        <div class="col-lg-8 col-12  ">
                            <div class="content border px-4 pb-3">
                                <div class="product-border-inner text-left">
                                    <div class="name pad">{{$product->title}}</div>
                                    <div class="ml pad">{{$product->capacity}}</div>
                                    <p>Tasting Note</p>
                                    <ul class="Tasting-Note">
                                        <li>色澤&thinsp;|&thinsp;{{$product->color}}。</li>
                                    <li>香氣&thinsp;|&thinsp;{{$product->aroma}}</li>
                                        <li>酒體&thinsp;|&thinsp;{{$product->body}}</li>
                                        <li>
                                            味覺&thinsp;|&thinsp;{{$product->taste}}
                                        </li>
                                        <li>餘覺&thinsp;|&thinsp;{{$product->aftertaste}}</li><br />
                                        <li>{{$product->price}}</li>

                                    </ul>
                                </div>

                                <div class="Introduction text-right pb-3">
                                <a href="#dog{{$product->id}}">
                                        <button class="detail-btn"
                                            style="color: white;background-color: unset;border: 0;">
                                            詳細介紹
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="buy-btn d-flex justify-content-center">
                                    <a href="#" class="add-to-cart" onclick="addcart({{$product->id}})">立即購買</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </section>


    <section>
        <div class="method" id="method">
            <div class="container">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="method-title">
                        <h1>
                            山崎蒸餾廠
                        </h1>
                    </div>
                </div>
                <div class="swiper-container" id="swiper2">
                    <div class="swiper-wrapper">

                        @foreach ($methods as $method)
                        <div class="swiper-slide d-flex flex-wrap">
                            <div class="col-lg-6 col-12">
                                <img class="img-fluid" src="{{$method->img}}" alt="" srcset="" />
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="title">
                                <h2>{{$method->title}}</h2>
                                </div>
                                <div class="content">
                                    <p>
                                        {!!$method->content!!}
                                    </p>
                                </div>
                            </div>
                        </div>


                        @endforeach


                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="sure" id="sure">
            <div class="container">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="sure-title">
                        <h1>
                            國際的肯定
                        </h1>
                    </div>
                </div>

                <div id="timeline">
                    <?php
                        $i=0;
                    ?>
                    @foreach ($sures as $sure)

                    <?php
                        if($i%2 == 0){
                    ?>

                    <div class="timeline-block">
                        <div class="timeline-year right" data-anime="scroll">
                        <strong>{{$sure->title}}</strong>
                        </div>
                        <!-- timeline-year -->
                        <div class="timeline-content" data-anime-left="scroll-left">
                            <img src="{{$sure->img}}" alt="" srcset="" class="img-fluid" style="width:50px">
                            <p>
                                {{$sure->award}}
                            </p>
                        </div>
                        <!-- timeline-content -->
                    </div>
                    <?php
                        } else{
                    ?>
                    <!-- timeline-block -->

                    <div class="timeline-block">
                        <div class="timeline-year left" data-anime="scroll">
                            <strong>{{$sure->title}}</strong>
                        </div>
                        <!-- timeline-year -->
                        <div class="timeline-content" data-anime-right="scroll-right">
                            <img src="{{$sure->img}}" alt="" srcset="" class="img-fluid" style="width:50px">
                            <p>
                                {{$sure->award}}
                            </p>
                        </div>
                        <!-- timeline-content -->
                    </div>
                        <?php
                            }
                        ?>

                        <?php
                            $i++;
                        ?>
                    @endforeach

                    <!-- timeline-block -->

                    {{-- <div class="timeline-block">
                        <div class="timeline-year right" data-anime="scroll">
                            <strong>2005</strong>
                        </div>
                        <div class="timeline-content" data-anime-left="scroll-left">
                            <p>
                                Em 2005, de modo complementar à Prova Brasil, o
                                <strong>SAVEAL</strong> avalia o 5º e 9º anos do ensino
                                fundamental, mas somente escolas estaduais urbanas com mais de
                                5 e menos de 30 estudantes por ano de escolaridade e escolas
                                estaduais rurais com mais de 5 estudantes por ano de
                                escolaridade integram o Sistema.
                            </p>
                        </div>
                    </div>

                    <div class="timeline-block">
                        <div class="timeline-year left" data-anime="scroll">
                            <strong>2011</strong>
                        </div>
                        <div class="timeline-content" data-anime-right="scroll-right">
                            <p>
                                Em 2011, o <strong>SAVEAL</strong> repete a observação dos
                                mesmos anos de escolaridade, mas incorporando todas as escolas
                                da rede pública estadual.
                            </p>
                        </div>
                    </div> --}}
                </div>
                <!-- timeline -->
            </div>
        </div>
    </section>
@endsection

@section('js')

<script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js'></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
crossorigin="anonymous"></script>
<!-- <script src="./js/timeline.js"></script> -->
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
crossorigin="anonymous"></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script src="{{asset('js/time-line.js')}}"></script>
<script src="{{asset('js/cart-style.js')}}"></script>
<script src="{{asset('js/swiper.js')}}"></script>


<script>
AOS.init();
</script>

<script>
$(window).scroll(function () {
    var scrollVal = $(document).scrollTop()
    if (scrollVal > 200) {
        $('.navbar_1').css("opacity", "0")
        if (scrollVal > 557) {

            $('.navbar_1 .navbar-brand img').css("display", "block")
            $('.navbar_1').addClass('active');
            $('.navbar_1').css("opacity", "1")

        } else {

            $('.navbar_1 .navbar-brand img').css("display", "none")
            $('.navbar_1').removeClass('active');
        }
    } else {
        $('.navbar_1').css("opacity", "1")
    }

})

$(window).scroll(function () {
    var scrollVal = $(document).scrollTop()
    var footerheight = $('.sure').offset().top + $('.timeline-content').height();

    // console.log(footerheight)
    // console.log(scrollVal)

    if (scrollVal > footerheight) {
        $('.footer2').addClass('active1');
    }
    else {
        $('.footer2').removeClass('active1');

    }

})

var count = 0;
function addcart(proid) {

    console.log(proid);

    axios.post('/frontaddcart',{id:proid})
                .then((res) => {
                    console.log(res.data);

                }).catch((err) => {
                    console.log(err);

                })
    count++;
        $("a.add-to-cart").addClass("size");
        setTimeout(function () {
            $("a.add-to-cart").addClass("hover");
        }, 200);
        setTimeout(function () {
            $("a.cart > span").addClass("counter");
            $("a.cart > span.counter").text(count);
        }, 400);
        setTimeout(function () {
            $("a.add-to-cart").removeClass("hover");
            $("a.add-to-cart").removeClass("size");
        }, 600);
        event.preventDefault();
}

</script>
@endsection

</html>
