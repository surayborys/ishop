<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToHeader'];
?>

<!--content-->
<div class = " container">
    <div class = "account">
        <h1>Update</h1>
        <?php if ($success != null): ?>
            <p class="text-center text-success"><?= $success ?></p>
        <?php endif; ?>
        <div class="account-pass">
            <div class="col-md-8 account-top">
                <form method="POST" action="">
                    <h3>Personal information</h3>
                    <div>
                        <span>First Name</span><p style="color:red"><?= isset($errors['firstname']) ? $errors['firstname'][0] : '' ?></p>
                        <input type = "text" name = "firstname" value="<?= $firstname ?>">
                    </div>
                    <div>
                        <span>Last Name</span><p style="color:red"><?= isset($errors['lastname']) ? $errors['lastname'][0] : '' ?></p>
                        <input type = "text" name = "lastname" value="<?= $lastname ?>">
                    </div>
                    <div>
                        <span>Email Address</span><p style="color:red"><?= isset($errors['email']) ? $errors['email'][0] : '' ?></p>
                        <input type = "text" name="email" value="<?= $email ?>">
                    </div>
                    <input type = "submit" value = "update profile" name="submit">
                </form>
            </div>
            <div class="clearfix"> </div>
            <br>
            <p class="text-center text-uppercase"><h4><a href="/profile/changepass">Update password</a></h4></p>
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

