<?php
/**
 * @var array $localSettings - stores local settings of the project
 */
include_once $this->localSettings['pathToHeader'];
?>

<!--content-->
<div class = " container">
    <div class="center-block">
        <br>
        <h1><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;HELLO, <?php echo strtoupper($username);?></h1>
        
        <br>
        <p><a class = "btn btn-default btn-lg" href="/user/orderList"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;View order list</a></p>
        <br>
        <p><a class = "btn btn-default btn-lg" href="/profile/update"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit personal data</a></p>
        <br>
    </div>
</div>
<!--//content-->


<?php include_once $this->localSettings['pathToFooter']; ?>



