@extends('layouts.nav')
@section('title')
白州
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/hak_his/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hak_his/白州2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hak_his/test.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
        a.cart {
            width: 72px;
            height: 72px;
            border-radius: 36px;
            text-align: center;
            color: #616161;
            text-decoration: none;
            position: fixed;
            right: 0;
            top: 40%;
            z-index: 9;
            display: block;
            background: #535558 url(http://images.vfl.ru/ii/1484930184/14435803/15757225.png
    ) center no-repeat;
            background-size: 36px;
            box-shadow: 0 3px 6px rgba(97, 97, 97 0.16), 0 3px 6px rgba(97, 97, 97 0.23);
        }

        a.cart>span {
            width: 24px;
            height: 24px;
            font-size: 16px;
            color: #fff;
            line-height: 24px;
            position: absolute;
            border-radius: 12px;
            display: block;
            transform: scale(0);
            margin: auto;
            background: #ffab00;
            box-shadow: 0 3px 6px rgba(255, 171, 0, 0.16);
        }

        a.cart>span.counter {
            left: 48px;
            bottom: 48px;
            transition: .2s linear;
            transform: scale(1);
        }

        .navbar-collapse a {
            font-family: "Noto Sans TC";
        }

        .nav-link {
            padding: 0rem;
            margin: 0 0.5rem;
        }



        @media (max-width:575px) {
            .nav-link {
                padding: 0rem;
            }

            #nav {
                padding: 0 30px;
            }

            .navbar-brand {
                margin: 0
            }
        }


        .navbar-expand-md .navbar-nav .nav-link {
            padding: 5px 0;
        }
        p{
            margin: 0;
        }
    </style>
@endsection
@section('content')

    <a href="/product_list" class="cart"><span></span></a>
    <div class="row " style="display: block; margin: 0;">
        <div class="row sticky-top" style="margin: 0;">
            <div class="container">
                <nav id="nav" class=" navbar navbar-expand-md navbar-light " style="padding: 0;">
                    <a class="navbar-brand" href="#">
                        <img src="./img/0000.png" alt="" style="height: 68px; width: 120px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#hak_his" aria-controls="hak_his"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="hak_his">
                        <ul class="navbar-nav ml-auto py-4 py-md-0">
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                                <a class="nav-link hvr-underline-from-center text-body" href=#story_tag>
                                    {{$id->story != null ? $id->story : ""}}
                                </a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                                <a class="nav-link hvr-underline-from-center text-body" href="#manner_tag">
                                    {{$id->attitude != null ? $id->attitude : ""}}
                                </a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                                <a class="nav-link hvr-underline-from-center text-body" href="#distillery_tag">
                                    {{$id->sure != null ? $id->sure : ""}}
                                </a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                                <a class="nav-link hvr-underline-from-center text-body" href="#Award_tag">
                                    {{$id->method != null ? $id->method : ""}}
                                </a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                                <a class="nav-link hvr-underline-from-center text-body" href="#product_tag">
                                    {{$id->product != null ? $id->product : ""}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div id="carouselExampleFade" class="bannerbox carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/新白州圖.jpg" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/18白州.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/25白州.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="hakushu_title">
            <h1>白州 單一麥芽威士忌</h1>
        </div>

        <div class="hakushu_text">
            <p>來自三得利位於山深處的山區森林釀酒廠。
                <br>三得利單一麥芽威士忌是一種清新，
                <br>煙熏的威士忌，具有草本風味，
                <br>是日本單一麥芽威士忌的啟示。</p>
        </div>
        @foreach ($store as $item)
        <div class="story_box ">
            <div class=" d-flex align-items-center story_text">
                <div class="story_title">
                    <h1>白州的故事 <span id="story_tag"></span></h1>
                    {!! $item->content!!}
                </div>
            </div>
            <div class="img1  " data-aos="fade-left" data-aos-once="true" data-aos-offset="300" data-aos-duration="700"
                data-aos-easing="ease-in-sine" style="background-image: url('{{$item->img}}')">
            </div>
        </div>
        @endforeach




        <div class="manner_box ">
            @foreach ($attitude as $item)

            <div class="img2" data-aos="fade-right" data-aos-once="true" data-aos-offset="300" data-aos-duration="1000"
        data-aos-easing="ease-in-sine" style="background-image: url('{{$item->img}}')"></div>
            <div class=" d-flex align-items-center story_text">
                <div class="story_title">
                    <h1>{{$item->title}} <span id="manner_tag"></span></h1>
                    <p>{!!$item->content!!}</p>
                </div>
            </div>
            @endforeach

        </div>


        <div class="distillery_box">
            @foreach ($method as $item)
                <div class=" d-flex align-items-center story_text">
                    <div class="story_title">
                    <h1>{{$item->title}}<span id="distillery_tag"></span></h1>
                        <p>{!!$item->content!!}</p>
                    </div>
                </div>
                <div class="img3" data-aos="fade-left" data-aos-once="true" data-aos-offset="300" data-aos-duration="1000"
                    data-aos-easing="ease-in-sine"style="background-image: url('{{$item->img}}')">
                </div>
            @endforeach

        </div>

        <div class="container">
            <div class="Award">
                <div class="Award_title">
                    <h1>國際肯定<span id="Award_tag"></span></h1>
                </div>


            </div>
        </div>
        <section class="container">

            <div class="row active-with-click d-flex justify-content-center">
                @foreach ($product as $item=>$value)

                <div class="col-xl-4 col-md-6 col-sm-12 ">
                    <article class="material-card Light-Green">
                        <h2>
                            {{$value->title}}
                        </h2>
                        <div class="mc-content">
                            <div class="img-container">
                                <img class="img-responsive card_img_style" src="./img/img_04.jpg">
                                <div class="mask"></div>
                                <img class="liquor" src="{{$value->img}}" alt="" style="width: 60px;">
                                <img class="Medals" src="./img/awards_swsc_2015.png" alt="">

                            </div>
                            <div class="mc-description">
                                @foreach ($value->sure as $item)
                                    {{$item->year}}{{$value->title}}{{$item->contest}}<br>
                                @endforeach
                            </div>
                        </div>
                        <a class="mc-btn-action">
                            <i class="fa fa-bars"></i>
                        </a>
                        <div class="mc-footer">
                            <h4>
                                Social
                            </h4>
                            <a class="fa fa-fw fa-facebook"></a>
                            <a class="fa fa-fw fa-twitter"></a>
                            <a class="fa fa-fw fa-google-plus"></a>
                        </div>
                    </article>
                </div>
                @endforeach

            </div>
        </section>

        <div class="change_view">
            <div class="change_img"></div>
        </div>

        <div class="product_title">
            <h1>白州系列<span id="product_tag"></span></h1>
            <p>製品ラインナップ</p>
            <p>一瓶由稀有森林釀酒廠生產的麥芽威士忌白酒，<br>坐落在茂密的森林中。
                大自然的力量和熟練的技術創造的風味<br>受到世界各地人們的高度評價。</p>
        </div>
        <div class="backg">

            <div class="container backdrop">
                <div class="row d-flex justify-content-around  padbtm-100 flex-wrap">
                    @foreach ($product as $item)

                    <div class="prod col-4 row">
                        <a href="#prod1_tag" class=" col-xl-6 col-sm-12 d-flex justify-content-center">
                            <img src="{{$item->img}}" alt="" class="img-fluid">
                        </a>
                        <a href="#prod1_tag" class="prod_name col-xl-6 col-sm-12 align-self-center text-body"
                            style="text-decoration:none;">
                            <h2>{{$item->title}}</h2>
                        </a>
                    </div>
                    @endforeach

                </div>
                <div class="row d-flex align-items-center padbtm-100 " data-aos="fade-up" data-aos-once="true"
                    data-aos-offset="300" data-aos-duration="900">
                    @foreach ($product as $item)
                        <div class="prod1 col-xl-7 col-lg-6 col-md-5 col-sm-12 d-flex justify-content-center">
                            <img src="{{$item->img}}" alt="" class="img-fluid" style="width:200px;">
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-7 col-sm-12 ">
                            <div class="prod1_title  row">
                                <h1>白州&thinsp;|&thinsp;<span id="prod1_tag"></span></h1>
                                <h5>THE<br>HAKUSHU</h5>
                            </div>
                            <div class="prod1_text">
                                {!!$item->content!!}
                                <p>{{$item->color}}</p>
                                <p>{{$item->aroma}}</p>
                                <p>{{$item->taste}}</p>
                                <p>{{$item->aftertaste}}</p>
                                <a href="#" class="add-to-cart" onclick="addcart({{$item->id}})">立即購買</a>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js'></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
<script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js'></script>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init();
</script>
<script>
$(function () {
    $('.material-card > .mc-btn-action').click(function () {

        var card = $(this).parent('.material-card');
        var icon = $(this).children('i');
        icon.addClass('fa-spin-fast');

        if (card.hasClass('mc-active')) {
            card.removeClass('mc-active');

            window.setTimeout(function () {
                icon
                    .removeClass('fa-arrow-left')
                    .removeClass('fa-spin-fast')
                    .addClass('fa-bars');

            }, 800);
        } else {
            card.addClass('mc-active');

            window.setTimeout(function () {
                icon
                    .removeClass('fa-bars')
                    .removeClass('fa-spin-fast')
                    .addClass('fa-arrow-left');

            }, 800);
        }
    });
});


</script>

<script>

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






