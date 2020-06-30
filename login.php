<?php 
    $current = "login";
    require_once 'layouts/header.php';

    if(isset($_POST["login"])){
        login($_POST);
    }
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-4 m-auto text-center">
            <h4>Login</h4>
            <hr>
            <form method="post">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <button class="btn btn-info btn-block" name="login">LOGIN</button>
            </form>
        </div>
    </div>
</div>



<?php
    require_once 'layouts/footer.php';
?>


