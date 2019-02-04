<?php
/**
 * @var array $newsList from NewsController
 */
?>

<!DOCTYPE HTML>
<!--
        Future Imperfect by HTML5 UP
        html5up.net | @ajlkn
        Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>TEST:NEWS LIST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="../assets/css/main.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="../assets/css/ie8.css" /><![endif]-->
    </head>
    <body>

        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="#">News LIst</a></h1>
                <nav class="links">
                    <ul>
                        <li><a href="#">Lorem</a></li>
                        <li><a href="#">Ipsum</a></li>
                        <li><a href="#">Feugiat</a></li>
                        <li><a href="#">Tempus</a></li>
                        <li><a href="#">Adipiscing</a></li>
                    </ul>
                </nav>
                <nav class="main">
                    <ul>
                        <li class="search">
                            <a class="fa-search" href="#search">Search</a>
                            <form id="search" method="get" action="#">
                                <input type="text" name="query" placeholder="Search" />
                            </form>
                        </li>
                        <li class="menu">
                            <a class="fa-bars" href="#menu">Menu</a>
                        </li>
                    </ul>
                </nav>
            </header>

            <!-- Menu -->
            <section id="menu">

                <!-- Search -->
                <section>
                    <form class="search" method="get" action="#">
                        <input type="text" name="query" placeholder="Search" />
                    </form>
                </section>

                <!-- Links -->
                <section>
                    <ul class="links">
                        <li>
                            <a href="#">
                                <h3>Lorem ipsum</h3>
                                <p>Feugiat tempus veroeros dolor</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <h3>Dolor sit amet</h3>
                                <p>Sed vitae justo condimentum</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <h3>Feugiat veroeros</h3>
                                <p>Phasellus sed ultricies mi congue</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <h3>Etiam sed consequat</h3>
                                <p>Porta lectus amet ultricies</p>
                            </a>
                        </li>
                    </ul>
                </section>

                <!-- Actions -->
                <section>
                    <ul class="actions vertical">
                        <li><a href="#" class="button big fit">Log In</a></li>
                    </ul>
                </section>

            </section>

            <!-- Main -->
            <div id="main">

                <?php foreach ($newsList as $newsItem):?>
                <!-- Post -->
                <article class="post">
                    <header>
                        <div class="title">
                            <h2><a href="../news/<?=$newsItem['id'];?>"><?=$newsItem['title'];?></a></h2>
                            <p><?=$newsItem['short_content'];?></p>
                        </div>
                        <div class="meta">
                            <time class="published" datetime="2015-11-01"><?=$newsItem['date'];?></time>
                        </div>
                    </header>
                    <a href="#" class="image featured"><img src="../images/pic01.jpg" alt="" /></a>
                    <footer>
                        <ul class="actions">
                            <li><a href="#" class="button big">Continue Reading</a></li>
                        </ul>
                        <ul class="stats">
                            <li><a href="#">General</a></li>
                            <li><a href="#" class="icon fa-heart">28</a></li>
                            <li><a href="#" class="icon fa-comment">128</a></li>
                        </ul>
                    </footer>
                </article>
                <?php endforeach;?>
                <!-- Pagination -->
                <ul class="actions pagination">
                    <li><a href="" class="disabled button big previous">Previous Page</a></li>
                    <li><a href="#" class="button big next">Next Page</a></li>
                </ul>

            </div>

            <!-- Sidebar -->
            <section id="sidebar">

                <!-- Intro -->
                <section id="intro">
                    <a href="#" class="logo"><img src="../images/logo.jpg" alt="" /></a>
                    <header>
                        <h2>Future Imperfect</h2>
                        <p>Another fine responsive site template by <a href="http://html5up.net">HTML5 UP</a></p>
                    </header>
                </section>

                <!-- Mini Posts -->
                <section>
                    <div class="mini-posts">
                        <?php foreach ($newsList as $newsItem):?>
                        <!-- Mini Post -->
                        <article class="mini-post">
                            <header>
                                <h3><a href="#">Vitae sed condimentum</a></h3>
                                <time class="published" datetime="2015-10-20">October 20, 2015</time>
                                <a href="#" class="author"><img src="../images/avatar.jpg" alt="" /></a>
                            </header>
                            <a href="#" class="image"><img src="../images/pic04.jpg" alt="" /></a>
                        </article>
                        <?php endforeach;?>

                    </div>
                </section>
                
                <!-- Footer -->
                <section id="footer">
                    <ul class="icons">
                        <li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li>
                        <li><a href="#" class="fa-envelope"><span class="label">Email</span></a></li>
                    </ul>
                    <p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a href="http://unsplash.com">Unsplash</a>.</p>
                </section>

            </section>

        </div>

        <!-- Scripts -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/skel.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="../assets/js/main.js"></script>

    </body>
</html>