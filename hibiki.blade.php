@extends('layouts.nav')

@section('title')
響 HIBIKI
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/hibiki.css')}}">
<link rel="stylesheet" href="{{asset('css/hover.css')}}">
@endsection

@section('content')
<a href="/product_list" class="cart"><span></span></a>

<header class="row sticky-top" style="margin: 0;">

    <div class="container">
        <nav id="nav" class=" navbar navbar-expand-md navbar-light">
            <a class="navbar-brand" href="#">
                    <img src="./img/00.響_logo01.png" alt="響 HIBIKI" style="height: 68px;">
                </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto py-4 py-md-0">
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                        <a class="nav-link hvr-underline-from-center text-body" href=#story>
                            {{$nav_data->story != null ? $nav_data->story : ""}}
                        </a>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                        <a class="nav-link hvr-underline-from-center text-body"
                            href="#movement">{{$nav_data->attitude != null ? $nav_data->attitude : ""}}</a>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                        <a class="nav-link hvr-underline-from-center text-body"
                            href="#award">{{$nav_data->sure != null ? $nav_data->sure : ""}}</a>
                    </li>
                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
                        <a class="nav-link hvr-underline-from-center text-body"
                            href="#series">{{$nav_data->product != null ? $nav_data->product : ""}}</a>
                    </li>
                </ul>
            </div>
        </nav>

    </div>
</header>

<main>
    <div id="banner" class="bannerbox carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($nav_data->imgs as $item)
            @if ($loop->index == 1)
            <div class="carousel-item active">
                <img src="{{asset($item->img)}}" class="d-block w-100 " alt="HIBIKI">
            </div>
            @else
            <div class="carousel-item">
                <img src="{{asset($item->img)}}" class="d-block w-100" alt="HIBIKI">
            </div>
            @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#banner" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#banner" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section id="story">
        <div class="container">
            <h1>{{$nav_data->story}}</h1>
        </div>
        <div class="row w-100 m-0">
            <div class="col-xl-9 col-lg-10 col-md-12  p-0 d-flex justify-content-start flex-wrap"
                data-aos="zoom-in-right" data-aos-duration="2000">
                <div class="top" style="background-image: url('{{$story_data[0]->img}}');">
                    <div class="content ">
                        <h2>{{$story_data[0]->title}}</h2>
                        <div>
                            {!! $story_data[0]->content !!}
                        </div>
                    </div>
                </div>
                <div class="phone_text ">
                    <h2>{{$story_data[0]->title}}</h2>
                    <div>
                        {!! $story_data[0]->content !!}
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-2 col-md-0 "></div>
        </div>


        <div class="row w-100 m-0">
            <div class="col-xl-3 col-lg-2 col-md-0 "></div>
            <div class="col-xl-9 col-lg-10 col-md-12  p-0 d-flex flex-wrap" data-aos="zoom-in-left"
                data-aos-duration="2000">
                <div class="bottom" style="background-image: url('{{$story_data[1]->img}}');">
                    <div class="content">
                        <h2>{{$story_data[1]->title}}</h2>
                        <div>
                            {!! $story_data[1]->content !!}
                        </div>
                    </div>
                </div>
                <div class="phone_text">
                    <h2>{{$story_data[1]->title}}</h2>
                    <div>
                        {!! $story_data[1]->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="movement">
        <div class="container">
            <h1 class="text-center">{{$nav_data->attitude}}</h1>
            <div class="bg" style="background-image: url('{{$attitude_data[0]->img}}');"></div>
            {{-- <img src="{{$attitude_data[0]->img}}" alt="whiskey" class="w-100 mb-2"> --}}
            <div class="row  d-flex justify-content-center">
                <div class="text-center">
                    {!! $attitude_data[0]->content !!}
                </div>
            </div>
        </div>
    </section>


    <section id="award">
        <div class="container">
            <h1>{{$nav_data->sure}}</h1>
        </div>
        <div class="timeline" data-aos="fade-up" data-aos-duration="3000">
            <ol>
                @foreach ($sure_data as $item)
                <li>
                    <div>
                        <time>{{$item->year}}</time>
                        <span>{{$item->contest}}</span>
                        <img src="{{asset($item->img)}}">
                        <p>
                            {{$item->title}}<br><br>
                            {{$item->award}}
                        </p>
                    </div>
                </li>
                @endforeach
                <li></li>
            </ol>

            <div class="arrows">
                <button class="arrow arrow__prev disabled" disabled>
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="arrow arrow__next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>


    <section id="series">
        <div class="container">
            <h1>{{$nav_data->product}}</h1>
            <div class="accordion">

                @foreach ($product_data as $item)
                <div class="box d-flex">
                    <div class="img">
                        <img src="{{asset($item->img)}}" height=100%>
                    </div>
                    <div class="text">
                        <h2>{{$item->title}}</h2>
                        <div class="series_content">
                            {!! $item->content !!}
                        </div>
                        <p>色&thinsp;|&thinsp;{{$item->color}}。</p>
                        <p>香&thinsp;|&thinsp;{{$item->aroma}}</p>
                        <p>味&thinsp;|&thinsp;{{$item->taste}}</p>
                        <p>餘&thinsp;|&thinsp;{{$item->aftertaste}}</p>
                        <br>
                        <a href="#" class="add-to-cart" onclick="addcart({{$item->id}})">立即購買</a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
</main>
@endsection

@section('js')
<script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js'></script>
<script>
    //時間軸js
        (function () {

            // VARIABLES
            const timeline = document.querySelector(".timeline ol"),
                elH = document.querySelectorAll(".timeline li > div"),
                arrows = document.querySelectorAll(".timeline .arrows .arrow"),
                arrowPrev = document.querySelector(".timeline .arrows .arrow__prev"),
                arrowNext = document.querySelector(".timeline .arrows .arrow__next"),
                firstItem = document.querySelector(".timeline li:first-child"),
                lastItem = document.querySelector(".timeline li:last-child"),
                xScrolling = 700,
                disabledClass = "disabled";

            // START
            window.addEventListener("load", init);

            function init() {
                setEqualHeights(elH);
                animateTl(xScrolling, arrows, timeline);
                setSwipeFn(timeline, arrowPrev, arrowNext);
                setKeyboardFn(arrowPrev, arrowNext);
            }

            // SET EQUAL HEIGHTS
            function setEqualHeights(el) {
                let counter = 0;
                for (let i = 0; i < el.length; i++) {
                    const singleHeight = el[i].offsetHeight;

                    if (counter < singleHeight) {
                        counter = singleHeight;
                    }
                }

                for (let i = 0; i < el.length; i++) {
                    el[i].style.height = `${counter}px`;
                }
            }

            // CHECK IF AN ELEMENT IS IN VIEWPORT
            // http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
            function isElementInViewport(el) {
                const rect = el.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }

            // SET STATE OF PREV/NEXT ARROWS
            function setBtnState(el, flag = true) {
                if (flag) {
                    el.classList.add(disabledClass);
                } else {
                    if (el.classList.contains(disabledClass)) {
                        el.classList.remove(disabledClass);
                    }
                    el.disabled = false;
                }
            }

            // ANIMATE TIMELINE
            function animateTl(scrolling, el, tl) {
                let counter = 0;
                for (let i = 0; i < el.length; i++) {
                    el[i].addEventListener("click", function () {
                        if (!arrowPrev.disabled) {
                            arrowPrev.disabled = true;
                        }
                        if (!arrowNext.disabled) {
                            arrowNext.disabled = true;
                        }
                        const sign = (this.classList.contains("arrow__prev")) ? "" : "-";
                        if (counter === 0) {
                            tl.style.transform = `translateX(-${scrolling}px)`;
                        } else {
                            const tlStyle = getComputedStyle(tl);
                            // add more browser prefixes if needed here
                            const tlTransform = tlStyle.getPropertyValue("-webkit-transform") || tlStyle.getPropertyValue("transform");
                            const values = parseInt(tlTransform.split(",")[4]) + parseInt(`${sign}${scrolling}`);
                            tl.style.transform = `translateX(${values}px)`;
                        }

                        setTimeout(() => {
                            isElementInViewport(firstItem) ? setBtnState(arrowPrev) : setBtnState(arrowPrev, false);
                            isElementInViewport(lastItem) ? setBtnState(arrowNext) : setBtnState(arrowNext, false);
                        }, 1100);

                        counter++;
                    });
                }
            }

            // ADD SWIPE SUPPORT FOR TOUCH DEVICES
            function setSwipeFn(tl, prev, next) {
                const hammer = new Hammer(tl);
                hammer.on("swipeleft", () => next.click());
                hammer.on("swiperight", () => prev.click());
            }

            // ADD BASIC KEYBOARD FUNCTIONALITY
            function setKeyboardFn(prev, next) {
                document.addEventListener("keydown", (e) => {
                    if ((e.which === 37) || (e.which === 39)) {
                        const timelineOfTop = timeline.offsetTop;
                        const y = window.pageYOffset;
                        if (timelineOfTop !== y) {
                            window.scrollTo(0, timelineOfTop);
                        }
                        if (e.which === 37) {
                            prev.click();
                        } else if (e.which === 39) {
                            next.click();
                        }
                    }
                });
            }

        })();

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
