<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToHeader'];
?>

<!--content-->
<div class="container">
    <div class="account">
        <h1>Account</h1>
        <div class="account-pass">
            <div class="col-md-8 account-top">
                <form method="POST">
                    <div> 	
                        <span>Email</span><p style="color:red"><?=isset($errors['email']) ? $errors['email'][0] : ''?></p>
                        <input type="text" name="email" value="<?=$email?>"> 
                    </div>
                    <div> 
                        <span >Password</span><p style="color:red"><?=isset($errors['password']) ? $errors['password'][0] : ''?></p>
                        <input type="password" name="password" value="<?=$password?>">
                    </div>				
                    <input type="submit" name="summit" value="Login"> 
                </form>
            </div>
            <div class="col-md-4 left-account ">
                <a href="single.html"><img class="img-responsive " src="/web/images/s1.jpg" alt=""></a>
                <div class="five">
                    <h2>25% </h2><span>discount</span>
                </div>
                <a href="register.html" class="create">Create an account</a>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

</div>

<!--//content-->
<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToFooter'];
?>



