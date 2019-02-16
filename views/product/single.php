<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToHeader'];
?>

<div class="product">
    <div class="container">
        <div class="col-md-3 product-price">

            <div class=" rsidebar span_1_of_left">
                <div class="of-left">
                    <h3 class="cate">Categories</h3>
                </div>
                <ul class="menu">
                    <?php
                        $label = '+';
                        $i = 0;
                        $hieraElts = count($hiera);
                        
                        while($i < $hieraElts) {
                           echo '<li class="item 1 subitem1"><a href="/category/'.$hiera[$i]['id'].'">'.$label.' '.$hiera[$i]['title'].'</a></li>';
                           $label.='+';
                           $i++;
                        }
                    ?>
                </ul>
            </div>
            <!--initiate accordion-->
            <script type="text/javascript">
                $(function () {
                    var menu_ul = $('.menu > li > ul'),
                            menu_a = $('.menu > li > a');
                    menu_ul.hide();
                    menu_a.click(function (e) {
                        e.preventDefault();
                        if (!$(this).hasClass('active')) {
                            menu_a.removeClass('active');
                            menu_ul.filter(':visible').slideUp('normal');
                            $(this).addClass('active').next().stop(true, true).slideDown('normal');
                        } else {
                            $(this).removeClass('active');
                            $(this).next().stop(true, true).slideUp('normal');
                        }
                    });

                });
            </script>
            <!---->
        </div>
        <div class="col-md-9 product-price1">
            <div class="col-md-5 single-top">	
                <div class="flexslider">
                    <ul class="slides">
                        <li data-thumb="/web/images/si.jpg">
                            <img src="/web/images/si.jpg" />
                        </li>
                        <li data-thumb="/web/images/si1.jpg">
                            <img src="/web/images/si1.jpg" />
                        </li>
                        <li data-thumb="/web/images/si2.jpg">
                            <img src="/web/images/si2.jpg" />
                        </li>
                        <li data-thumb="/web/images/si.jpg">
                            <img src="/web/images/si.jpg" />
                        </li>
                    </ul>
                </div>
                <!-- FlexSlider -->
                <script defer src="/web/js/jquery.flexslider.js"></script>
                <link rel="stylesheet" href="/web/css/flexslider.css" type="text/css" media="screen" />

                <script>
                // Can also be used with $(document).ready()
                $(window).load(function () {
                    $('.flexslider').flexslider({
                        animation: "slide",
                        controlNav: "thumbnails"
                    });
                });
                </script>
            </div>	
            <div class="col-md-7 single-top-in simpleCart_shelfItem">
                <div class="single-para ">
                    <h4><?=$product['title']?></h4>
                    <div class="star-on">
                        <ul class="star-footer">
                            <li><a href="#"><i> </i></a></li>
                            <li><a href="#"><i> </i></a></li>
                            <li><a href="#"><i> </i></a></li>
                            <li><a href="#"><i> </i></a></li>
                            <li><a href="#"><i> </i></a></li>
                        </ul>
                        <div class="review">
                            <a href="#"> 1 customer review </a>

                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <h5 class="item_price">$ <?=$product['price']?></h5>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed 
                        diam nonummy nibh euismod tincidunt ut laoreet dolore 
                        magna aliquam erat </p>
                    <div class="available">
                        <ul>
                            <li>Color
                                <select>
                                    <option>Silver</option>
                                    <option>Black</option>
                                    <option>Dark Black</option>
                                    <option>Red</option>
                                </select></li>
                            <li class="size-in">Size<select>
                                    <option>Large</option>
                                    <option>Medium</option>
                                    <option>small</option>
                                    <option>Large</option>
                                    <option>small</option>
                                </select></li>
                            <div class="clearfix"> </div>
                        </ul>
                    </div>
                    <ul class="tag-men">
                        <li><span>TAG</span>
                            <span class="women1">: Women,</span></li>
                        <li><span>SKU</span>
                            <span class="women1">: CK09</span></li>
                    </ul>
                   
                    <a href="#" class="add-cart item_add">ADD TO CART</a>
                    
                </div>
            </div>
            
            <div class="clearfix"> </div>
            <br><br>
            <!---->
            <div class="cd-tabs">
                <nav>
                    <ul class="cd-tabs-navigation">
                        <li><a data-content="fashion"  href="#0">Description </a></li>
                        <li><a data-content="cinema" href="#0" >Addtional Informatioan</a></li>
                        <li><a data-content="television" href="#0" class="selected ">Reviews (1)</a></li>

                    </ul> 
                </nav>
                <ul class="cd-tabs-content">
                    <li data-content="fashion" >
                        <div class="facts">
                            <p > There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined </p>
                            <ul>
                                <li>Research</li>
                                <li>Design and Development</li>
                                <li>Porting and Optimization</li>
                                <li>System integration</li>
                                <li>Verification, Validation and Testing</li>
                                <li>Maintenance and Support</li>
                            </ul>         
                        </div>

                    </li>
                    <li data-content="cinema" >
                        <div class="facts1">

                            <div class="color"><p>Color</p>
                                <span >Blue, Black, Red</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="color">
                                <p>Size</p>
                                <span >S, M, L, XL</span>
                                <div class="clearfix"></div>
                            </div>

                        </div>

                    </li>
                    <li data-content="television" class="selected">
                        <div class="comments-top-top">
                            <div class="top-comment-left">
                                <img class="img-responsive" src="/web/images/co.png" alt="">
                            </div>
                            <div class="top-comment-right">
                                <h6><a href="#">Hendri</a> - September 3, 2014</h6>
                                <ul class="star-footer">
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                </ul>
                                <p>Wow nice!</p>
                            </div>
                            <div class="clearfix"> </div>
                            <a class="add-re" href="#">ADD REVIEW</a>
                        </div>

                    </li>
                    <div class="clearfix"></div>
                </ul> 
            </div> 
            <div class=" bottom-product">
                <div class="col-md-4 bottom-cd simpleCart_shelfItem">
                    <div class="product-at ">
                        <a href="#"><img class="img-responsive" src="/web/images/pi3.jpg" alt="">
                            <div class="pro-grid">
                                <span class="buy-in">Buy Now</span>
                            </div>
                        </a>	
                    </div>
                    <p class="tun">It is a long established fact that a reader</p>
                    <a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>						
                </div>
                <div class="col-md-4 bottom-cd simpleCart_shelfItem">
                    <div class="product-at ">
                        <a href="#"><img class="img-responsive" src="/web/images/pi1.jpg" alt="">
                            <div class="pro-grid">
                                <span class="buy-in">Buy Now</span>
                            </div>
                        </a>	
                    </div>
                    <p class="tun">It is a long established fact that a reader</p>
                    <a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>					</div>
                <div class="col-md-4 bottom-cd simpleCart_shelfItem">
                    <div class="product-at ">
                        <a href="#"><img class="img-responsive" src="/web/images/pi4.jpg" alt="">
                            <div class="pro-grid">
                                <span class="buy-in">Buy Now</span>
                            </div>
                        </a>	
                    </div>
                    <p class="tun">It is a long established fact that a reader</p>
                    <a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>					</div>
                <div class="clearfix"> </div>
				</div>
</div>

		<div class="clearfix"> </div>
		</div>
		</div>
<!--//content-->

<?php include_once $this->localSettings['pathToFooter']; ?>


