<?php

use Controllers\Views_controller\Views_controller;

$moreCategoriesData = Views_controller::More_categories_controller();
$landingData = Views_controller::General_view_controller();
$content = $landingData['all_categories'];
?>
<?php require_once ROOT . "/require/header.php" ?>
<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .footer {
        background-color: #1a1a1a;
        color: #ffffff;
        padding: 60px 0 20px;
        margin-top: 50px;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        padding: 0 20px;
    }

    .footer-col {
        flex: 1;
        min-width: 250px;
        margin-bottom: 30px;
    }

    .footer-col h3.footer-logo {
        font-size: 24px;
        margin-bottom: 20px;
        color: #fff;
    }

    .footer-col h3.footer-logo span {
        color: #ff4d4d;
        /* Brand accent color */
    }

    .footer-col h4 {
        font-size: 18px;
        margin-bottom: 25px;
        position: relative;
        font-weight: 500;
    }

    /* Underline decoration for headings */
    .footer-col h4::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -8px;
        background-color: #ff4d4d;
        height: 2px;
        width: 40px;
    }

    .footer-col p {
        font-size: 14px;
        line-height: 1.6;
        color: #bbbbbb;
        padding-right: 20px;
    }

    .footer-col ul {
        list-style: none;
    }

    .footer-col ul li {
        margin-bottom: 12px;
    }

    .footer-col ul li a {
        color: #bbbbbb;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .footer-col ul li a:hover {
        color: #ffffff;
        padding-left: 8px;
    }

    /* Newsletter Form */
    .newsletter-form {
        display: flex;
        margin-top: 20px;
    }

    .newsletter-form input {
        padding: 10px;
        border: none;
        border-radius: 4px 0 0 4px;
        outline: none;
        width: 70%;
    }

    .newsletter-form button {
        padding: 10px 15px;
        background-color: #ff4d4d;
        color: white;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        transition: 0.3s;
    }

    .newsletter-form button:hover {
        background-color: #e63939;
    }

    /* Footer Bottom Bar */
    .footer-bottom {
        border-top: 1px solid #333;
        margin-top: 40px;
        padding: 20px 20px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        flex-wrap: wrap;
        gap: 15px;
    }

    .footer-bottom p {
        font-size: 13px;
        color: #888;
    }

    .bottom-links a {
        color: #888;
        text-decoration: none;
        font-size: 13px;
        margin-left: 15px;
    }

    .bottom-links a:hover {
        color: #fff;
    }

    /* Responsive adjustment */
    @media (max-width: 768px) {
        .footer-col {
            min-width: 100%;
        }

        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }

        .bottom-links a {
            margin: 0 10px;
        }
    }
</style>
</head>

<body>

    <nav class="navbar">
        <div class="join">
        </div>
        <h2><img src="./assets/icons/blog-solid-full.svg" alt="">PeGPeM</h2>
        <div class="links">
            <a href="#"><img src="./assets/icons/facebook-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/instagram-brands-solid-full (1).svg" alt=""></a>
            <a href="#"><img src="./assets/icons/twitter-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/youtube-brands-solid-full.svg" alt=""></a>
        </div>
        <div class="links_ss">
            <a href="#"><img src="./assets/icons/facebook-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/instagram-brands-solid-full (1).svg" alt=""></a>
            <a href="#"><img src="./assets/icons/twitter-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/youtube-brands-solid-full.svg" alt=""></a>
        </div>
        <img src="./assets/icons/list-solid-full.svg" alt="" class="menu_display">
        <img src="./assets/icons/x-solid-full.svg" alt="" class="menu_close">
    </nav>


    <div class="mcheading">
        <h2>all categories</h2>
    </div>

    <div class="mcategories">
        <?php foreach ($content as $info): ?>
            <a href="?p=more&v=category&category=<?php echo htmlspecialchars($info['cartegory']) ?>" class="mcategory">
                <h2><?php echo "{$info['cartegory']}" ?></h2>
            </a>
        <?php endforeach; ?>
    </div>
    <script src="file,js"></script>
    <script>
        let menu = document.querySelector(".menu_display")
        let links_ss = document.querySelector(".links_ss")

        menu.addEventListener("click", () => {
            links_ss.classList.toggle("show")
        })
    </script>

    <?php require_once ROOT . "/require/footer.php" ?>