<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ImagiQuest - AI Image Generation</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">

    <!-- Styles -->
</head>

<body class="antialiased">
    <nav>
        <div class="nav-container">
            <div class="logo" data-aos="zoom-in" data-aos-duration="1500">
                Imagi<span>Quest</span>
            </div>
            <div class="links">
                <!-- Laravel Auth Links -->
                @if (Route::has('login'))
                    @auth
                        <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        </div>
                    @else
                        <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                        @if (Route::has('register'))
                            <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200">
                                <a href="{{ route('register') }}">Sign Up</a>
                            </div>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
        <i class="fa-solid fa-bars hamburg" onclick="hamburg()"></i>
        <div class="dropdown">
            <div class="links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Sign Up</a>
                        @endif
                    @endauth
                @endif
                <i class="fa-solid fa-xmark cancel" onclick="cancel()"></i>
            </div>
        </div>
    </nav>
    <section>
        <div class="main-container">
            <div class="content">
                <h1 data-aos="fade-left" data-aos-duration="1500" data-aos-delay="700">
                    Welcome to
                    <span>ImagiQuest</span>
                    <svg viewBox="0 -10 76 76" xmlns="http://www.w3.org/2000/svg" class="rainbow-icon">
                        <path fill="red"  stroke-width="0.2" stroke-linejoin="round"
                            d="M 28.4874,31.6667L 30.0707,31.6667L 30.0707,33.25L 28.4874,33.25L 28.4874,31.6667 Z M 28.5,39.5834L 30.0833,39.5834L 30.0833,41.1667L 28.5,41.1667L 28.5,39.5834 Z M 33.25,33.2501L 34.8333,33.2501L 34.8333,34.8334L 33.25,34.8334L 33.25,33.2501 Z M 31.6996,41.1667L 33.283,41.1667L 33.283,42.75L 31.6996,42.75L 31.6996,41.1667 Z M 30.0833,36.4167L 31.6666,36.4167L 31.6666,38.0001L 30.0833,38.0001L 30.0833,36.4167 Z M 34.8333,30.0834L 36.4166,30.0834L 36.4166,31.6667L 34.8333,31.6667L 34.8333,30.0834 Z M 44.3333,40.3751C 45.2077,40.3751 45.9166,41.1253 45.9166,41.5626C 45.9166,41.9998 45.2077,42.3542 44.3333,42.3542C 43.4588,42.3542 42.7499,41.9998 42.7499,41.5626C 42.7499,41.1253 43.4588,40.3751 44.3333,40.3751 Z M 53.8333,40.3751C 54.7077,40.3751 55.4166,41.1253 55.4166,41.5625C 55.4166,41.9998 54.7077,42.3542 53.8333,42.3542C 52.9588,42.3542 52.25,41.9998 52.25,41.5625C 52.25,41.1253 52.9588,40.3751 53.8333,40.3751 Z M 41.1666,30.4792L 46.3124,36.0209L 47.4999,36.0209L 47.4999,31.6667C 47.4999,29.9178 46.0822,28.5001 44.3333,28.5001L 30.0833,28.5C 28.3344,28.5 26.9167,29.9178 26.9167,31.6667L 26.9166,40.3751C 26.9166,42.124 28.3344,44.3334 30.0833,44.3334L 36.5299,44.3334C 35.2027,40.2631 38.1847,35.4492 41.1666,30.4792 Z M 50.2708,36.0209L 50.6666,35.5946L 50.6666,28.5C 50.6666,26.7511 49.2489,25.3334 47.5,25.3334L 26.9166,25.3334C 25.1677,25.3334 23.75,26.7511 23.75,28.5L 23.75,38L 23.75,42.75L 23.75,44.3334C 23.75,46.0822 25.1677,47.5 26.9166,47.5L 28.5,47.5L 30.0833,47.5L 38.6804,47.5C 38.1146,46.9897 37.6579,46.4614 37.2983,45.9167L 29.2916,45.9167C 27.5427,45.9167 25.3333,42.9156 25.3333,41.1667L 25.3333,30.875C 25.3333,29.1261 27.5428,26.9167 29.2917,26.9167L 45.1249,26.9167C 46.8738,26.9167 49.0833,29.1262 49.0833,30.8751L 49.0833,36.0209L 50.2708,36.0209 Z M 55.4166,30.4792C 55.4166,30.4792 69.0457,45.2441 51.8743,50.3375C 52.3509,51.3635 52.5666,52.6458 50.6667,52.6458C 49.8163,52.6458 49.5542,51.6181 49.4938,50.6667L 45.5641,50.6667C 45.9793,51.6181 46.0341,52.6458 44.3333,52.6458C 43.3174,52.6458 43.0552,51.1793 42.9977,50.1281L 40.9023,49.0834L 30.9554,49.0834C 31.5857,50.4649 32.0246,52.25 30.0833,52.25C 29.1127,52.25 28.7371,50.4649 28.5917,49.0834L 26.9181,49.0834C 26.6335,50.3285 25.5198,51.8542 21.7708,51.8542C 20.657,51.8542 22.8732,49.6994 24.2855,48.4215C 23.1286,47.6336 22.1666,46.279 22.1666,45.125L 22.1666,42.4751C 12.8265,40.5393 14.3299,34.7534 15.8333,33.25C 16.9098,32.1735 20.182,34.7566 22.1666,36.5205L 22.1666,27.7084C 22.1666,25.9595 24.3761,23.75 26.125,23.75L 48.2916,23.75C 50.0405,23.75 52.25,25.9595 52.25,27.7084L 52.25,33.8895L 55.4166,30.4792 Z M 41.1666,33.25C 36.4166,39.5834 38,49.0834 45.9166,49.0834L 50.6666,49.0834C 64.9166,45.9167 55.4166,33.25 55.4166,33.25L 50.6666,38L 45.9166,38L 41.1666,33.25 Z M 49.4791,41.1667C 49.9164,41.1667 50.2708,41.5211 50.2708,41.9584C 50.2708,42.3956 49.9164,42.7501 49.4791,42.7501C 49.0419,42.7501 48.6875,42.3956 48.6875,41.9584C 48.6875,41.5211 49.0419,41.1667 49.4791,41.1667 Z M 44.3333,32.4584L 45.9166,32.4584L 45.9166,34.0417L 44.3333,34.0417L 44.3333,32.4584 Z" />

                    </svg>
                </h1>
                <div data-aos="fade-right" data-aos-duration="1500" data-aos-delay="900" class="typewriter">
                    Create <span class="typewriter-text"></span><label for="">|</label> with AI.
                </div>
                <p data-aos="flip-down" data-aos-duration="1500" data-aos-delay="1100">
                    Discover the limitless possibilities of AI-powered image generation. Bring your ideas to life with
                    just a few clicks.
                </p>
                <div class="social-links">
                    <a href="#" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1300"><i
                            class="fa-brands fa-github"></i></a>
                    <a href="#" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1400"><i
                            class="fa-brands fa-facebook"></i></a>
                    <a href="#" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1500"><i
                            class="fa-brands fa-linkedin"></i></a>
                    <a href="#" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1600"><i
                            class="fa-brands fa-twitter"></i></a>
                </div>

                <div class="btn" data-aos="zoom-out" data-aos-duration="1500" data-aos-delay="1800">
                    @auth
                        <button onclick="window.location.href='{{ url('/dashboard') }}'">Go to Dashboard</button>
                    @else
                        <button onclick="window.location.href='{{ route('register') }}'">Get Started</button>
                    @endauth
                </div>
            </div>
            <div class="carousel" data-aos="zoom-in" data-aos-duration="3000">
                <div class="carousel-images">
                    <img src="{{ URL::asset('images/ai-image0.png') }}" alt="AI Art Example 1">
                    <img src="{{ URL::asset('images/ai-image1.png') }}" alt="AI Art Example 2">
                    <img src="{{ URL::asset('images/ai-image2.png') }}" alt="AI Art Example 3">
                    <img src="{{ URL::asset('images/ai-image3.png') }}" alt="AI Art Example 4">
                    <img src="{{ URL::asset('images/ai-image4.png') }}" alt="AI Art Example 5">
                    <img src="{{ URL::asset('images/ai-image0.png') }}" alt="AI Art Example 1 (Duplicate)">
                </div>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 0
        });
    </script>
    <script src="{{ URL::asset('js/index.js') }}"></script>
</body>

</html>
