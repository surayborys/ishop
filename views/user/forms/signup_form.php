<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToHeader'];
?>

<!--content-->
<div class = " container">
    <div class = " register">
        <h1>Register</h1>
        <form method="POST" action="">
            <div class = "col-md-6 register-top-grid">
                <h3>Personal information</h3>
                <div>
                    <span>First Name</span><p style="color:red"><?=isset($errors['firstname']) ? $errors['firstname'][0] : ''?></p>
                    <input type = "text" name = "firstname" value="<?=$firstname?>">
                </div>
                <div>
                    <span>Last Name</span><p style="color:red"><?=isset($errors['lastname']) ? $errors['lastname'][0] : ''?></p>
                    <input type = "text" name = "lastname" value="<?=$lastname?>">
                </div>
                <div>
                    <span>Email Address</span><p style="color:red"><?=isset($errors['email']) ? $errors['email'][0] : ''?></p>
                    <input type = "text" name="email" value="<?=$email?>">
                </div>
                <a class = "news-letter" href = "#">
                    <label class = "checkbox"><input type = "checkbox" name = "checkbox" checked = ""><i> </i>Sign Up for Newsletter</label>
                </a>
            </div>
            <div class = "col-md-6 register-bottom-grid">
                <h3>Login information</h3>
                <div>
                    <span>Password</span><p style="color:red"><?=isset($errors['password']) ? $errors['password'][0] : ''?></p>
                    <input type = "password" name="password"value="">
                </div>
                <div>
                    <span>Confirm Password</span><p style="color:red"><?=isset($errors['confirm']) ? $errors['confirm'][0] : ''?></p>
                    <input type = "password" name="confirm"value="">
                </div>
                <input type = "submit" value = "submit" name="submit">

            </div>
            <div class = "clearfix"> </div>
        </form>
    </div>
</div>
<!--//content-->
<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToFooter'];
?>

