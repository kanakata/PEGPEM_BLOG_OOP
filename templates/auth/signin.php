<?php
$page_title = "Login";
use Controllers\Api_controller\Api_controller;
Api_controller::Login_api();
?>
<?php require_once ROOT . "/require/header.php" ?>

    <div class="signupheader">
        <button class="next">next</button>
        <button class="prev">next</button>
        <div class="form" id="form">
            <div class="contentholder1">
                <form action="" method="post">
                    <h3><img src="./assets/icons/blog-solid-full.svg" alt="">PeGPeM</h3>
                    <h2>🪵 into your Account</h2>
                    <h4>Welcome back select method to sign in:</h4>
                    <!-- <div class="google">
                        <button name="login_method" value="google"><img src="./assets/icons/google-brands-solid-full (1).svg" alt="">google</button>
                        <button name="login_method" value="facebook"><img src="./assets/icons/facebook-brands-solid-full.svg" alt="">facebook</button>
                    </div>
                    <h5><span></span>or continue with email<span></span></h5> -->
                    <div class="email">
                        <input type="text" name="username" placeholder="username" required> <br>
                        <input type="text" name="password" placeholder="password" required> <br>
                        <div class="rememberme">
                            <div class="remember">
                            </div>
                            <a href="#">🤦‍♀️ forgot password</a>
                        </div>
                        <input type="submit" value="🪵 in" name="signin">
                        <h2>Dont have an account? <a href="<?= "?p=register" ?>" id="signup">Create one</a></h2>
                        <h2>Back to home page<a href="<?= "?p=landing" ?>" id="signup">👈 Back</a></h2>
                    </div>
                </form>
            </div>
            <div class="contentholder2">

                <div class="slider">
                    <div class="item active">
                        <div class="content">
                            <h2>Get posted on the latest blogs.</h2>
                            <p>Know what's up in your niche of choise edited by our bloggers.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <h2>Become a blogger and get to post stories on your niche of choise.</h2>
                            <p>Feed the public with informative content.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <h2>Gain the ability to like, comment, and share blogs across all platforms.</h2>
                            <p>Let information roam as it should.</p>
                        </div>
                    </div>

                    <div class="paginations">
                        <div class="pagination active"></div>
                        <div class="pagination"></div>
                        <div class="pagination"></div>
                    </div>
                </div>
                <button><a href="?p=landing">back</a></button>
            </div>
        </div>
    </div>
<script src="file.js"></script>    
</body>
</html>