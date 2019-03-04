<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToHeader'];
?>

<!--content-->
<div class = " container">
    <div class = "account">
        <h1>Update password</h1>
        <?php if ($success != null): ?>
            <p class="text-center text-success"><?= $success ?></p>
        <?php endif; ?>
        <div class="account-pass">
            <div class="col-md-8 account-top">
                <form method="POST" action="">
                    <h3>Password</h3>
                    <div>
                        <span>Current Password</span><p style="color:red"><?= isset($errors['currentPassword']) ? $errors['currentPassword'][0] : '' ?></p>
                        <input type = "password" name = "currentPassword">
                    </div>
                    <div>
                        <span>Type New Password</span><p style="color:red"><?= isset($errors['newPassword']) ? $errors['newPassword'][0] : '' ?></p>
                        <input type = "password" name = "newPassword">
                    </div>
                    <div>
                        <span>Confirm New Password</span><p style="color:red"><?= isset($errors['confirmNewPassword']) ? $errors['confirmNewPassword'][0] : '' ?></p>
                        <input type = "password" name = "confirmNewPassword">
                    </div>
                    <input type = "submit" value = "change" name="submit">
                </form>
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

