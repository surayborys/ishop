<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToHeader'];
?>

<?php
/*echo '<pre>';
print_r($mainCategories);
echo '</pre>';*/
?>

<!-------------------------------------BANNER----------------------------------->
<div class="banner">
    <div class="container">
        <script src="web/js/responsiveslides.min.js"></script>
        <script>
            $(function () {
                $("#slider").responsiveSlides({
                    auto: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    pager: true,
                });
            });
        </script>
        <div  id="top" class="callbacks_container">
            <ul class="rslides" id="slider">
                <li>

                    <div class="banner-text">
                        <h3>Lorem Ipsum is not simply dummy  </h3>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor .</p>
                        <a href="single.html">Learn More</a>
                    </div>

                </li>
                <li>

                    <div class="banner-text">
                        <h3>There are many variations </h3>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor .</p>
                        <a href="single.html">Learn More</a>

                    </div>

                </li>
                <li>
                    <div class="banner-text">
                        <h3>Sed ut perspiciatis unde omnis</h3>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor .</p>
                        <a href="single.html">Learn More</a>

                    </div>

                </li>
            </ul>
        </div>

    </div>
</div>
<!-------------------------------------/BANNER---------------------------------->

<!-------------------------------------CONTENT---------------------------------->
<div class="content">
    <div class="container">
        <div class="content-top">
            <h1>NEW RELEASED</h1>
            
            <?php foreach ($optimizedArrayOfNewProducts as $row):?>
            <div class="grid-in">
                <?php foreach ($row as $product):?>
                <div class="col-md-4 grid-top">
                    <a href="/product/<?=$product['id'];?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="/<?=$product['image']?>" alt="">
                        <div class="b-wrapper">
                            <h3 class="b-animate b-from-left    b-delay03 ">
                                <span><?=$product['finalCategoryName']?></span>	
                            </h3>
                        </div>
                    </a>
                  

                    <p><a href="/product/<?=$product['id'];?>"><?=$product['title']?></a></p>
                </div>
                <?php endforeach;?>
                
                <div class="clearfix"> </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!----->

        <div class="content-top-bottom">
            <h2>Featured Collections</h2>
            <div class="col-md-6 men">
                <a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="web/images/t1.jpg" alt="">
                    <div class="b-wrapper">
                        <h3 class="b-animate b-from-top top-in   b-delay03 ">
                            <span>Lorem</span>	
                        </h3>
                    </div>
                </a>


            </div>
            <div class="col-md-6">
                <div class="col-md1 ">
                    <a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="web/images/t2.jpg" alt="">
                        <div class="b-wrapper">
                            <h3 class="b-animate b-from-top top-in1   b-delay03 ">
                                <span>Lorem</span>	
                            </h3>
                        </div>
                    </a>

                </div>
                <div class="col-md2">
                    <div class="col-md-6 men1">
                        <a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="web/images/t3.jpg" alt="">
                            <div class="b-wrapper">
                                <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                                    <span>Lorem</span>	
                                </h3>
                            </div>
                        </a>

                    </div>
                    <div class="col-md-6 men2">
                        <a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="web/images/t4.jpg" alt="">
                            <div class="b-wrapper">
                                <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                                    <span>Lorem</span>	
                                </h3>
                            </div>
                        </a>

                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!---->
    <div class="content-bottom">
        <ul>
            <li><a href="#"><img class="img-responsive" src="web/images/lo.png" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="web/images/lo1.png" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="web/images/lo2.png" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="web/images/lo3.png" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="web/images/lo4.png" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="web/images/lo5.png" alt=""></a></li>
            <div class="clearfix"> </div>
        </ul>
    </div>
</div>
<!-------------------------------------/CONTENT---------------------------------->


<?php include_once $this->localSettings['pathToFooter']; ?>
