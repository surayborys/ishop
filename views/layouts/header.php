<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    <head>
        <title>New Store A Ecommerce Category Flat Bootstarp Resposive Website Template | Home :: w3layouts</title>
        <link href="/web/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/web/js/jquery.min.js"></script>
        <!-- Custom Theme files -->
        <!--theme-style-->
        <link href="/web/css/style.css" rel="stylesheet" type="text/css" media="all" />	
        <!--//theme-style-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="New Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!--fonts-->
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'><!--//fonts-->
        <!-- start menu -->
        <link href="/web/css/memenu.css" rel="stylesheet" type="text/css" media="all" />
        
            <link href="/web/css/accordion.css" rel="stylesheet" type="text/css" media="all" />
        
        <script type="text/javascript" src="/web/js/memenu.js"></script>
        <script>$(document).ready(function () {
        $(".memenu").memenu();
    });</script>
        <script srcjs/simpleCart.min.js"></script>
    </head>
    <body>
        <!--header-->
        <div class="header">
            <div class="header-top">
                <div class="container">
                    <div class="search">
                        <form>
                            <input type="text" value="Search " onfocus="this.value = '';" onblur="if (this.value == '') {
                                                            this.value = 'Search';
                                                        }">
                            <input type="submit" value="Go">
                        </form>
                    </div>
                    <div class="header-left">		
                        <ul>
                            <li ><a href="login.html"  >Login</a></li>
                            <li><a  href="/register"  >Register</a></li>

                        </ul>
                        <div class="cart box_1">
                            <a href="checkout.html">
                                <h3> <div class="total">
                                        <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
                                    <img src="web/images/cart.png" alt=""/></h3>
                            </a>
                            <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>

                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="container">
                <div class="head-top">
                    <div class="logo">
                        <a href="index.html"><img src="/web/images/logo.png" alt=""></a>	
                    </div>
                    <div class=" h_menu4">
                        <ul class="memenu skyblue">
                            <li class="grid"><a class="color8" href="/">Home</a></li>
                            <?php 
                                if(isset($activeCategory))
                                    $activeTitle = $activeCategory['title'];
                                else
                                    $activeTitle = false;
                            ?>
                            <?php foreach ($mainCategories as $mainCategory):?>
                            <li <?php print(($activeTitle)&&($activeTitle == $mainCategory['title'])) ? 'class="active"' : '';?> ><a class="color1" href="/category/<?=$mainCategory['title'];?>/page-1"><?=$mainCategory['title'];?></a>
                                <div class="mepanel">
                                    <div class="row">
                                        <div class="col1">
                                            <div class="h_nav">
                                                <ul>
                                                    <?php foreach ($mainCategory['subcategories'] as $subcategory ):?>
                                                    <li>
                                                        <a href="/category/<?=$mainCategory['title'];?>/<?=$subcategory['id'];?>/page-1"><?=$subcategory['title'];?></a>
                                                    </li>
                                                    <?php endforeach;?>
                                                </ul>	
                                            </div>							
                                        </div>
                                        
                                        <div class="col1">
                                            <div class="h_nav">
                                                <h4>Popular Brands</h4>
                                                <ul>
                                                    <?php foreach ($brands as $brand):?>
                                                    <li><a href="/brands/<?=$brand['id']?>"><?=$brand['title'];?></a></li>
                                                    <?php endforeach;?>
                                                </ul>	
                                            </div>												
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach;?>
                            
                            <li><a class="color4" href="blog.html">Blog</a></li>				
                            <li><a class="color6" href="contact.html">Contact</a></li>
                        </ul> 
                    </div>

                    <div class="clearfix"> </div>
                </div>
            </div>

        </div>