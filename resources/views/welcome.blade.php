<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Sphere - Stock trading and Investment Platform</title>

    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="{{ asset('./assets/css/style.css') }}">

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* From Uiverse.io by Admin12121 */
        .price-section {
            color: #fff;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        /* End basic CSS override */
        .price-table {
            background-color: #152148;
            border-radius: 16px;
            width: 350px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 15px 45px 0 rgba(0, 0, 0, 0.15);
            position: relative;
            background-image: linear-gradient(135deg, rgba(74, 222, 128, 0.15), rgba(29, 123, 219, 0.1) 20%, #152148 40%, #152148 100%);
        }

        .price-table:after {
            content: "";
            display: block;
            top: -3px;
            left: -3px;
            bottom: -3px;
            right: -3px;
            z-index: -1;
            position: absolute;
            border-radius: 16px;
            background-image: linear-gradient(135deg, #4ade80, #1d7bdb 40%, #293359 60%, #152148 100%);
        }

        .price-table .price {
            font-size: 3rem;
            line-height: 1;
            font-weight: 700;
            display: inline-flex;
            align-self: center;
            align-items: center;
            gap: 4px;
            position: relative;
            color: #fff;
        }

        .price-table .price small {
            font-size: 1.25rem;
            font-weight: 400;
            position: absolute;
            left: -1.5ch;
        }

        .price-table .title {
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.25;
            text-align: center;
            margin-top: 10px;
            color: #fff;
        }

        .price-table .description {
            font-size: 1rem;
            text-align: center;
            margin-top: 2px;
        }

        .features {
            margin-top: 22px;
            text-align: center;
        }

        .feature {
            position: relative;
        }

        .feature+.feature {
            margin-top: 16px;
        }

        .feature summary {
            display: inline-flex;
            align-items: center;
            list-style: none;
        }

        .feature summary::-webkit-details-marker {
            display: none;
        }

        .feature[open] summary:after {
            content: "";
            display: block;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: fixed;
            z-index: 50;
        }

        .feature[open] div {
            -webkit-animation: scale 0.15s ease;
            animation: scale 0.15s ease;
        }

        .feature .checkmark {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #4ade80;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }

        .feature .checkmark svg {
            width: 18px;
            height: 18px;
            color: #fff;
        }

        .feature .question-icon {
            display: flex;
            align-items: center;
            margin-left: 6px;
            cursor: pointer;
        }

        .feature .answer {
            padding: 12px;
            background-color: #111b40;
            border-radius: 6px;
            position: absolute;
            top: -12px;
            z-index: 100;
            transform: translatey(-100%) translatex(-50%);
            transform-origin: bottom center;
            width: 80%;
            left: 50%;
            border: 1px solid #293359;
            box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.1);
        }

        @-webkit-keyframes scale {
            0% {
                transform: translatey(-100%) translatex(-50%) scale(0);
            }

            100% {
                transform: translatey(-100%) translatex(-50%) scale(1);
            }
        }

        @keyframes scale {
            0% {
                transform: translatey(-100%) translatex(-50%) scale(0);
            }

            100% {
                transform: translatey(-100%) translatex(-50%) scale(1);
            }
        }

        .preloader {
            --uib-size: 45px;
            --uib-color: black;
            --uib-speed: 1.75s;
            display: flex;
            align-items: flex-end;
            padding-bottom: 20%;
            justify-content: space-between;
            width: var(--uib-size);
            height: calc(var(--uib-size) * 0.6);
        }

        .cube {
            flex-shrink: 0;
            width: calc(var(--uib-size) * 0.2);
            height: calc(var(--uib-size) * 0.2);
            animation: jump var(--uib-speed) ease-in-out infinite;
        }

        .cube__inner {
            display: block;
            height: 100%;
            width: 100%;
            border-radius: 25%;
            background-color: white;
            transform-origin: center bottom;
            animation: morph var(--uib-speed) ease-in-out infinite;
            transition: background-color 0.3s ease;
        }

        .cube:nth-child(2) {
            animation-delay: calc(var(--uib-speed) * -0.36);

            .cube__inner {
                animation-delay: calc(var(--uib-speed) * -0.36);
            }
        }

        .cube:nth-child(3) {
            animation-delay: calc(var(--uib-speed) * -0.2);

            .cube__inner {
                animation-delay: calc(var(--uib-speed) * -0.2);
            }
        }

        @keyframes jump {
            0% {
                transform: translateY(0px);
            }

            30% {
                transform: translateY(0px);
                animation-timing-function: ease-out;
            }

            50% {
                transform: translateY(-200%);
                animation-timing-function: ease-in;
            }

            75% {
                transform: translateY(0px);
                animation-timing-function: ease-in;
            }
        }

        @keyframes morph {
            0% {
                transform: scaleY(1);
            }

            10% {
                transform: scaleY(1);
            }

            20%,
            25% {
                transform: scaleY(0.6) scaleX(1.3);
                animation-timing-function: ease-in-out;
            }

            30% {
                transform: scaleY(1.15) scaleX(0.9);
                animation-timing-function: ease-in-out;
            }

            40% {
                transform: scaleY(1);
            }

            70%,
            85%,
            100% {
                transform: scaleY(1);
            }

            75% {
                transform: scaleY(0.8) scaleX(1.2);
            }
        }

        body.loading {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div id="preloader"
        style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center; position: absolute; top: 0; z-index: 5; background: black; overflow: hidden;">
        <div>
            <div class="preloader">
                <div class="cube">
                    <div class="cube__inner"></div>
                </div>
                <div class="cube">
                    <div class="cube__inner"></div>
                </div>
                <div class="cube">
                    <div class="cube__inner"></div>
                </div>
            </div>
        </div>
    </div>

    <!--
    - #HEADER
  -->

    <header class="header" data-header>
        <div class="container">

            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('./assets/images/logo.svg') }}" width="32" height="32" alt="Cryptex logo">
                Stock Sphere
            </a>

            <nav class="navbar" data-navbar>
                <ul class="navbar-list">

                    <li class="navbar-item">
                        <a href="#hero" class="navbar-link active" data-nav-link>Home</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#plans" class="navbar-link" data-nav-link>Our Plans</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#market" class="navbar-link" data-nav-link>Stocks</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#about" class="navbar-link" data-nav-link>About</a>
                    </li>

                </ul>
            </nav>

            <button class="nav-toggle-btn" aria-label="Toggle menu" data-nav-toggler>
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </button>

            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>

        </div>
    </header>





    <main>
        <article>

            <!--
        - #HERO
      -->

            <section class="section hero" id='hero' aria-label="hero" data-section>
                <div class="container">

                    <div class="hero-content">

                        <h1 class="h1 hero-title">Trade Stocks, cryptocurrencies with Stocksphere</h1>

                        <p class="hero-text">
                            Stocksphere is the easiest, safest, and fastest way to Trade and Invest in stocks.
                        </p>

                        <a href="{{ route('register') }}" class="btn btn-primary">Get started now</a>

                    </div>

                    <figure class="hero-banner">
                        <img src="{{ asset('./assets/images/hero-banner.png') }}" width="570" height="448"
                            alt="hero banner" class="w-100">
                    </figure>

                </div>
            </section>





            <!--
        - #TREND
      -->

            <section class="section trend" aria-label="crypto trend" data-section>
                <div class="container">

                    <div class="trend-tab">

                        <ul class="tab-nav">

                            <li>
                                <button class="tab-btn active">Trending</button>
                            </li>

                        </ul>

                        <ul class="tab-content">

                            <li>
                                <div class="trend-card">

                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/"
                                                rel="noopener nofollow" target="_blank"><span
                                                    class="blue-text"></span></a></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                            {
                                                "symbol": "NASDAQ:TSLA",
                                                "width": "100%",
                                                "isTransparent": true,
                                                "colorTheme": "dark",
                                                "locale": "en"
                                            }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->

                                </div>
                            </li>

                            <li>
                                <div class="trend-card">

                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/"
                                                rel="noopener nofollow" target="_blank"><span
                                                    class="blue-text"></span></a></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                            {
                                                "symbol": "NASDAQ:AAPL",
                                                "width": "100%",
                                                "isTransparent": true,
                                                "colorTheme": "dark",
                                                "locale": "en"
                                            }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->

                                </div>
                            </li>

                            <li>
                                <div class="trend-card">

                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/"
                                                rel="noopener nofollow" target="_blank"><span
                                                    class="blue-text"></span></a></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                            {
                                                "symbol": "NASDAQ:NVDA",
                                                "width": "100%",
                                                "isTransparent": true,
                                                "colorTheme": "dark",
                                                "locale": "en"
                                            }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->

                                </div>
                            </li>

                            <li>
                                <div class="trend-card">

                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <div class="tradingview-widget-copyright"><a
                                                href="https://www.tradingview.com/" rel="noopener nofollow"
                                                target="_blank"><span class="blue-text"></span></a></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                            {
                                                "symbol": "NASDAQ:META",
                                                "width": "100%",
                                                "isTransparent": true,
                                                "colorTheme": "dark",
                                                "locale": "en"
                                            }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->

                                </div>
                            </li>

                        </ul>

                    </div>

                </div>
            </section>





            <!--
        - #MARKET
      -->

            <section id="market" class="section market" aria-label="market update" data-section>
                <div class="container">

                    <div class="title-wrapper">
                        <h2 class="h2 section-title">Market Update</h2>
                    </div>

                    <div class="market-tab">

                        <ul class="tab-nav">

                            <li>
                                <button class="tab-btn active">Stocks</button>
                            </li>
                        </ul>

                        <table class="market-table">

                            <thead class="table-head">

                                <tr class="table-row table-title">

                                    <th class="table-heading"></th>

                                    <th class="table-heading" scope="col">#</th>

                                    <th class="table-heading" scope="col">Name</th>

                                    <th class="table-heading" scope="col">Last Price</th>

                                    <th class="table-heading" scope="col">24h %</th>

                                    <th class="table-heading" scope="col">Market Cap</th>

                                    <th class="table-heading" scope="col">Last 7 Days</th>

                                    <th class="table-heading"></th>

                                </tr>

                            </thead>

                            <tbody class="table-body">

                                <tr class="table-row">

                                    <td class="table-data">
                                        <button class="add-to-fav" aria-label="Add to favourite" data-add-to-fav>
                                            <ion-icon name="star-outline" aria-hidden="true"
                                                class="icon-outline"></ion-icon>
                                            <ion-icon name="star" aria-hidden="true" class="icon-fill"></ion-icon>
                                        </button>
                                    </td>

                                    <th class="table-data rank" scope="row">1</th>

                                    <td class="table-data">
                                        <div class="wrapper">
                                            <img src="./assets/images/coin-1.svg" width="20" height="20"
                                                alt="Bitcoin logo" class="img">

                                            <h3>
                                                <a href="#" class="coin-name">Bitcoin <span
                                                        class="span">BTC</span></a>
                                            </h3>
                                        </div>
                                    </td>

                                    <td class="table-data last-price">$56,623.54</td>

                                    <td class="table-data last-update green">+1.45%</td>

                                    <td class="table-data market-cap">$2,780,423,640,582</td>

                                    <td class="table-data">
                                        <img src="./assets/images/chart-1.svg" width="100" height="40"
                                            alt="profit chart" class="chart">
                                    </td>

                                    <td class="table-data">
                                        <a href="{{ route('login') }}" class="btn btn-outline"
                                            style="text-align: center">Trade</a>
                                    </td>

                                </tr>

                                <tr class="table-row">

                                    <td class="table-data">
                                        <button class="add-to-fav" aria-label="Add to favourite" data-add-to-fav>
                                            <ion-icon name="star-outline" aria-hidden="true"
                                                class="icon-outline"></ion-icon>
                                            <ion-icon name="star" aria-hidden="true" class="icon-fill"></ion-icon>
                                        </button>
                                    </td>

                                    <th class="table-data rank" scope="row">2</th>

                                    <td class="table-data">
                                        <div class="wrapper">
                                            <img src="./assets/images/coin-2.svg" width="20" height="20"
                                                alt="Ethereum logo" class="img">

                                            <h3>
                                                <a href="#" class="coin-name">Ethereum <span
                                                        class="span">ETH</span></a>
                                            </h3>
                                        </div>
                                    </td>

                                    <td class="table-data last-price">$56,623.54</td>

                                    <td class="table-data last-update red">-5.12%</td>

                                    <td class="table-data market-cap">$880,423,640,582</td>

                                    <td class="table-data">
                                        <img src="./assets/images/chart-2.svg" width="100" height="40"
                                            alt="loss chart" class="chart">
                                    </td>

                                    <td class="table-data">
                                        <a href="{{ route('login') }}" class="btn btn-outline"
                                            style="text-align: center">Trade</a>
                                    </td>

                                </tr>

                                <tr class="table-row">

                                    <td class="table-data">
                                        <button class="add-to-fav" aria-label="Add to favourite" data-add-to-fav>
                                            <ion-icon name="star-outline" aria-hidden="true"
                                                class="icon-outline"></ion-icon>
                                            <ion-icon name="star" aria-hidden="true" class="icon-fill"></ion-icon>
                                        </button>
                                    </td>

                                    <th class="table-data rank" scope="row">3</th>

                                    <td class="table-data">
                                        <div class="wrapper">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Tesla_logo.png"
                                                width="20" height="20" alt="BNB logo" class="img">

                                            <h3>
                                                <a href="#" class="coin-name">Tesla Inc.<span
                                                        class="span">TSLA</span></a>
                                            </h3>
                                        </div>
                                    </td>

                                    <td class="table-data last-price">$288.87</td>

                                    <td class="table-data last-update green">+13.75%</td>

                                    <td class="table-data market-cap">-</td>

                                    <td class="table-data">
                                        <img src="./assets/images/chart-1.svg" width="100" height="40"
                                            alt="loss chart" class="chart">
                                    </td>

                                    <td class="table-data">
                                        <a href="{{ route('login') }}" class="btn btn-outline"
                                            style="text-align: center">Trade</a>
                                    </td>

                                </tr>

                                <tr class="table-row">

                                    <td class="table-data">
                                        <button class="add-to-fav" aria-label="Add to favourite" data-add-to-fav>
                                            <ion-icon name="star-outline" aria-hidden="true"
                                                class="icon-outline"></ion-icon>
                                            <ion-icon name="star" aria-hidden="true" class="icon-fill"></ion-icon>
                                        </button>
                                    </td>

                                    <th class="table-data rank" scope="row">4</th>

                                    <td class="table-data">
                                        <div class="wrapper">
                                            <img src="https://upload.wikimedia.org/wikipedia/sco/thumb/2/21/Nvidia_logo.svg/1200px-Nvidia_logo.svg.png"
                                                width="20" height="20" alt="Tether logo" class="img">

                                            <h3>
                                                <a href="#" class="coin-name">Nivida Corp. <span
                                                        class="span">NVDA</span></a>
                                            </h3>
                                        </div>
                                    </td>

                                    <td class="table-data last-price">$145.56</td>

                                    <td class="table-data last-update green">+3.15%</td>

                                    <td class="table-data market-cap">-</td>

                                    <td class="table-data">
                                        <img src="./assets/images/chart-1.svg" width="100" height="40"
                                            alt="profit chart" class="chart">
                                    </td>

                                    <td class="table-data">
                                        <a href="{{ route('login') }}" class="btn btn-outline"
                                            style="text-align: center">Trade</a>
                                    </td>

                                </tr>



                                <tr class="table-row">

                                    <td class="table-data">
                                        <button class="add-to-fav" aria-label="Add to favourite" data-add-to-fav>
                                            <ion-icon name="star-outline" aria-hidden="true"
                                                class="icon-outline"></ion-icon>
                                            <ion-icon name="star" aria-hidden="true" class="icon-fill"></ion-icon>
                                        </button>
                                    </td>

                                    <th class="table-data rank" scope="row">5</th>

                                    <td class="table-data">
                                        <div class="wrapper">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg"
                                                width="20" height="20" alt="Solana logo" class="img">

                                            <h3>
                                                <a href="#" class="coin-name">Apple Inc. <span
                                                        class="span">AAPL</span></a>
                                            </h3>
                                        </div>
                                    </td>

                                    <td class="table-data last-price">$222.72</td>

                                    <td class="table-data last-update green">+0.5%</td>

                                    <td class="table-data market-cap">-</td>

                                    <td class="table-data">
                                        <img src="./assets/images/chart-1.svg" width="100" height="40"
                                            alt="profit chart" class="chart">
                                    </td>

                                    <td class="table-data">
                                        <a href="{{ route('login') }}" class="btn btn-outline"
                                            style="text-align: center">Trade</a>
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>
            </section>





            <!--
        - #INSTRUCTION
      -->

            <section class="section instruction" aria-label="instruction" data-section>
                <div class="container">

                    <h2 class="h2 section-title">How It Works</h2>



                    <ul class="instruction-list">

                        <li>
                            <div class="instruction-card">

                                <figure class="card-banner">
                                    <img src="{{ asset('./assets/images/instruction-1.png') }}" width="96"
                                        height="96" loading="lazy" alt="Step 1" class="img">
                                </figure>

                                <p class="card-subtitle">Step 1</p>

                                <h3 class="h3 card-title">Register</h3>

                                <p class="card-text">
                                    Creacte an account
                                </p>

                            </div>
                        </li>

                        <li>
                            <div class="instruction-card">

                                <figure class="card-banner">
                                    <img src="{{ asset('./assets/images/instruction-2.png') }}" width="96"
                                        height="96" loading="lazy" alt="Step 2" class="img">
                                </figure>

                                <p class="card-subtitle">Step 2</p>

                                <h3 class="h3 card-title">Deposit</h3>

                                <p class="card-text">
                                    Make a deposit through available methods
                                </p>

                            </div>
                        </li>

                        <li>
                            <div class="instruction-card">

                                <figure class="card-banner">
                                    <img src="{{ asset('./assets/images/instruction-3.png') }}" width="96"
                                        height="96" loading="lazy" alt="Step 3" class="img">
                                </figure>

                                <p class="card-subtitle">Step 3</p>

                                <h3 class="h3 card-title">Start Trading and Investing</h3>

                                <p class="card-text">
                                    You can buy stocks and hold or invest for a period of time
                                </p>

                            </div>
                        </li>

                        <li>
                            <div class="instruction-card">

                                <figure class="card-banner">
                                    <img src="{{ asset('./assets/images/instruction-4.png') }}" width="96"
                                        height="96" loading="lazy" alt="Step 4" class="img">
                                </figure>

                                <p class="card-subtitle">Step 4</p>

                                <h3 class="h3 card-title">Earn Money</h3>

                                <p class="card-text">
                                    Earn money either way and withdraw easily through crypto and bank transfers
                                </p>

                            </div>
                        </li>

                    </ul>

                </div>
            </section>






            <!--
        - #ABOUT
      -->

            <section id="about" class="section about" aria-label="about" data-section>
                <div class="container">

                    <figure class="about-banner">
                        <img src="{{ './assets/images/about-banner.png' }}" width="748" height="436"
                            loading="lazy" alt="about banner" class="w-100">
                    </figure>

                    <div class="about-content">

                        <h2 class="h2 section-title">What Is StockSphere</h2>

                        <p class="section-text">
                            We provide a platorm for easy and reliable trading and investment of stocks, crypto
                            currencies and other commodities
                        </p>

                        <ul class="section-list">

                            <li class="section-item">
                                <div class="title-wrapper">
                                    <ion-icon name="checkmark-circle" aria-hidden="true"></ion-icon>

                                    <h3 class="h3 list-title">View real-time stock prices prices</h3>
                                </div>

                                <p class="item-text">
                                    You can watch stock prcies and filter them based on different condtions before
                                    decideing to trade them or speak with one of our experts for proffesional support
                                </p>
                            </li>

                            <li class="section-item">
                                <div class="title-wrapper">
                                    <ion-icon name="checkmark-circle" aria-hidden="true"></ion-icon>

                                    <h3 class="h3 list-title">Buy and store Cryptos, Stock and Comodities</h3>
                                </div>

                                <p class="item-text">
                                    You will have a wallets for each assets bought and stored for long term investment
                                </p>
                            </li>

                        </ul>

                        <a href="{{ route('login') }}" class="btn btn-primary">Explore More</a>

                    </div>

                </div>
            </section>





            <!--
        - #INVESTMENT PLANS
      -->


            <section id="plans" class="section instruction" aria-label="instruction" data-section>
                <div class="container">

                    <h2 class="h2 section-title">Investment Plans</h2>



                    <div class="price-section">
                        @foreach ($plans as $plan)
                            <article class="price-table">
                                <div class="price">{{ $plan->name }}</div>
                                <span class="title">Plan details</span>
                                <div class="features">

                                    <details class="feature">
                                        <summary>
                                            <span class="name">
                                                {{ $plan->duration }}
                                                @if ($plan->frequency === 'hourly')
                                                    Hours
                                                @elseif ($plan->frequency === 'daily')
                                                    Days
                                                @elseif ($plan->frequency === 'weekly')
                                                    Weeks
                                                @else
                                                    Months
                                                @endif
                                            </span>
                                        </summary>
                                    </details>
                                    <details class="feature">
                                        <summary>
                                            <span class="name">{{ $plan->rate }}% {{ $plan->frequency }}</span>
                                        </summary>
                                    </details>
                                    <details class="feature">
                                        <summary>
                                            <span class="name">${{ number_format($plan->min_value) }} -
                                                ${{ number_format($plan->max_value) }}</span>
                                        </summary>
                                    </details>
                                    <div style="display: flex; justify-content: center; padding: 20px 10px; ">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Invest</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach

                    </div>

                </div>
            </section>

        </article>
    </main>





    <!--
    - #FOOTER
  -->

    <footer class="footer">

        <div class="footer-top" data-section>
            <div class="container">

                <div class="footer-brand">

                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('./assets/images/logo.svg') }}" width="50" height="50"
                            alt="Stocksphere logo">
                        Stocksphere
                    </a>

                    <h2 class="footer-title">Let's talk! 🤙</h2>

                    <a href="tel:+123456789101" class="footer-contact-link">+12 345 678 9101</a>

                    <a href="mailto:hello.cryptex@gmail.com" class="footer-contact-link">mail@stock-sphere.com</a>

                    <address class="footer-contact-link">
                        Cecilia Chapman 711-2880 Nulla St. Mankato Mississippi 96522
                    </address>

                </div>

                <ul class="footer-list">

                </ul>
                <ul class="footer-list">

                    <li>
                        <p class="footer-list-title">Quick Links</p>
                    </li>

                    <li>
                        <a href="#about" class="footer-link">About Us</a>
                    </li>

                    <li>
                        <a href="#hero" class="footer-link">Home</a>
                    </li>

                    <li>
                        <a href="#plans" class="footer-link">Investment Plans</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Contact Us</a>
                    </li>

                </ul>
                <ul class="footer-list">

                </ul>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">

                <p class="copyright">
                    &copy; 2024 Stocksphere All Rights Reserved by <a href="{{ url('/') }}"
                        class="copyright-link">Stocksphere</a>
                </p>

                <ul class="social-list">

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-linkedin"></ion-icon>
                        </a>
                    </li>

                </ul>

            </div>
        </div>

    </footer>




    <!--
    - custom js link
  -->
    <script src="{{ asset('./assets/js/script.js') }}" defer></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        // Add this when preloader starts
        document.body.classList.add('loading');

        // Remove this when preloader ends
        window.addEventListener('load', function() {
            document.getElementById('preloader').style.display = 'none';
            document.body.classList.remove('loading');
        });
    </script>

</body>

</html>
