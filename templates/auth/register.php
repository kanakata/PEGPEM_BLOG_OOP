<?php $page_title = "Register" ?>
<?php require_once ROOT . "/require/header.php" ?>
    <div class="signupheader">
        <button class="next">next</button>
        <button class="prev">next</button>
        <div class="form" id="form">
            <div class="contentholder1">
                <form action="sign_check.php" method="post">
                    <h3><img src="./assets/icons/blog-solid-full.svg" alt="">PeGPeM</h3>
                    <h2>✍️ Up For An Account</h2>
                    <h4>Welcome back select method to sign uo:</h4>
                    <!-- <div class="google">
                        <button><img src="./assets/icons/google-brands-solid-full (1).svg" alt="">google</button>
                        <button><img src="./assets/icons/facebook-brands-solid-full.svg" alt="">facebook</button>
                    </div> -->
                    <h5><span></span>or continue with email<span></span></h5>
                    <div class="email">
                        <input type="text" name="username" placeholder="👤 username"> <br>
                        <input type="email" name="email" placeholder="✉️ email"> <br>
                        <input type="password" name="password" placeholder="🔑 password"> <br>
                        <input type="password" name="confirmpassword" placeholder="🔑 confirm password"> <br>
                        <div class="rememberme">
                            <div class="remember">
                            </div>
                        </div>
                        <input type="submit" value="sign up" name="signup">
                        <h2>Back to home page<a href="?p=landing" id="signup">👈 Back</a></h2>
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