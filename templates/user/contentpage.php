<?php
$page_title = $_GET['p'] ?? "";

use Controllers\Views_controller\Views_controller;

$landingData = Views_controller::General_view_controller();
$blog_data = Views_controller::Display_blog();
$content = $blog_data['blog'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title . "-pegpem" ?></title>
    <link rel="shortcut icon" href="./assets/icons/blog-solid-full.svg" type="image/x-icon">
    <style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: calibri;
    }

    .userdashnavbar {
        display: none;
    }

    nav {
        width: 100%;
        height: 70px;
        display: flex;
        align-items: center;
        position: fixed;
        z-index: 20;
        top: 0;
        background: orangered;
    }

    .navbar.hide {
        transform: translateY(-70px);
        transition: 2s;
    }

    nav .join {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 20px;
        padding-left: 40px;
    }

    nav .join a {
        color: black;
        font-size: 15px;
        text-decoration: none;
        text-transform: capitalize;
        font-weight: bolder;
        font-family: broadway;
        height: 30px;
        width: 150px;
        border: 1px solid black;
        display: flex;
        gap: 5px;
        align-items: center;
        justify-content: center;
        border-radius: 5px;

        & img {
            height: 20px;
            width: 20px;
        }
    }

    nav h2 {
        flex: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bolder;
        font-family: broadway;
        font-size: 30px;
        letter-spacing: 0.5px;
        color: black;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    nav h2 img {
        height: 50px;
        width: 50px;
    }

    nav .links {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: end;
        gap: 10px;
        padding-right: 40px;

        & a {
            display: flex;
            align-items: center;
            height: 100%;
            color: black;
            text-decoration: none;
            font-size: 18px;
            text-transform: capitalize;
            font-family: broadway;
            position: relative;
            z-index: 20;
        }
    }

    nav .links_ss {
        display: none;
    }

    nav .links button {
        width: 100px;
        height: 30px;
        background: rgba(204, 216, 211, 0.626);
        border: none;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    nav .links div {
        display: flex;
        align-items: center;
        gap: 10px;
        color: green;
        font-size: 20px;
    }

    nav .links div img {
        height: 50px;
        width: 50px;
        border-radius: 50%;
    }

    nav .links a img {
        height: 30px;
        width: 30px;
    }

    nav .menu_display {
        display: none;
    }

    nav .menu_close {
        display: none;
    }


    .section1 {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: calibri;
        margin-top: 70px;

        & .blog_meta {
            width: 95%;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 5px 5px 10px orangered;
            margin-bottom: 20px;
            margin-top: 10px;

            & #author {
                text-align: center;
                font-size: 18px;
                color: black;
                text-transform: capitalize;
            }

            & #title {
                text-align: center;
                font-size: 18px;
                color: orangered;
            }

            & #description {
                text-align: center;
                font-size: 18px;
                color: gray;
            }
        }
    }

    .top_display {
        width: 100%;
        display: flex;
        gap: 20px;
        margin-top: 10px;
        height: 80vh;
        padding: 0px 10px 20px 10px;
        border-bottom: 1px solid orangered;

        & img {
            flex: .8;
            height: 100%;
            border-radius: 10px;
            filter: brightness(.6);
        }

        & .top_display_cnt {
            flex: .2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;

            & .details {
                background: orangered;
                width: 100%;
                height: auto;
                border-radius: 5px;
                padding: 5px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .details h2 {
                color: white;
                text-align: left;
                font-size: 14px;
                padding-bottom: 10px;
                font-family: calibri;
            }

            .detail h2 {
                display: flex;
                justify-content: space-between;
                font-size: 10px;
                padding-bottom: 20px;
                font-size: 12px;
            }

            .details h2 span {
                color: rgba(204, 216, 211, 0.626);
                text-transform: lowercase;
                font-family: calibri;
            }

            .authormessage {
                width: 100%;
                height: auto;
                background: rgba(204, 216, 211, 0.626);
                padding: 15px;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 5px;
                font-family: calibri;
                border-radius: 5px;
            }

            .authormessage h2 {
                text-align: right;
                font-size: 14px;
                background: none;
                height: 0;
                text-align: none;
                font-family: calibri;
            }

            .authormessage .details {
                display: flex;
                width: 100%;
                height: 70%;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                background: transparent;
                gap: 5px;
                font-family: calibri;
                padding: 0;
            }

            .authormessage .details img {
                height: 100%;
                width: 40%;
                border-radius: 50%;
            }

            .authormessage .details .detail h2 {
                font-size: 12px;
                color: black;
                text-transform: capitalize;
                font-family: calibri;
            }

            .authormessage .message {
                width: 100%;
            }

            .authormessage .message p {
                width: 100%;
                text-align: left;
                font-size: 12px;
                font-family: calibri;
            }

            .likes {
                width: 100%;
                height: auto;
                padding: 10px;
                background: orangered;
                border-radius: 5px;
                display: flex;
                align-items: center;
                justify-content: center;

                & a {
                    width: 90%;
                    height: 40px;
                    border: 1px solid white;
                    color: white;
                    text-decoration: none;
                    font-size: 15px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    border-radius: 5px;
                }
            }
        }
    }

    .contentholder {
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 10px;

        & .holder2 {
            padding: 10px 20px;
            border-left: 1px solid orangered;
            width: 60%;
            display: flex;
            flex-direction: column;
            gap: 10px;

        }
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

    .del {
        position: absolute;
        top: 20px;
        width: 100%;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: orangered;
        text-decoration: none;
        font-size: 18px;
        border-radius: 10px;
        text-transform: capitalize;
        color: black;
    }

    .can {
        position: absolute;
        top: 70px;
        width: 100%;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: orangered;
        text-decoration: none;
        font-size: 18px;
        border-radius: 10px;
        text-transform: capitalize;
        color: black;
    }
    </style>


    <script type="application/json" id="blog_data">
    <?= json_encode([
            "author" => htmlspecialchars($content['author']),
            "title" => htmlspecialchars($content['title']),
            "description" => htmlspecialchars($content['description'])
        ])
        ?>
    </script>

</head>

<body>

    <?php if (isset($_SESSION['username'])): ?>
    <nav class="navbar">
        <div class="join">
            <a href=""><img src="./assets/icons/arrow-right-to-bracket-solid-full.svg" alt="">log out</a>
        </div>
        <h2><img src="./assets/icons/blog-solid-full.svg" alt="">PeGPeM</h2>
        <div class="links">

            <a href="#"><img src="./assets/icons/user-solid-full.svg" alt=""> <?= $_SESSION['username'] ?? "" ?></a>
            <a href="?p=userdash"><img src="./assets/icons/icons8-dashboard-48.png" alt="">dash</a>
        </div>
        <div class="links_ss">
            <a href="logout.php"><img src="./assets/icons/arrow-right-to-bracket-solid-full.svg" alt="">log out</a>
            <a href="userdash.php"><img src="./assets/icons/icons8-dashboard-48.png" alt="">my dash</a>
            <a href="#"><img src="./assets/icons/facebook-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/instagram-brands-solid-full (1).svg" alt=""></a>
            <a href="#"><img src="./assets/icons/twitter-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/youtube-brands-solid-full.svg" alt=""></a>
        </div>
        <img src="./assets/icons/list-solid-full.svg" alt="" class="menu_display">
        <img src="./assets/icons/x-solid-full.svg" alt="" class="menu_close">
    </nav>
    <?php else: ?>
    <nav class="navbar navbar_one">
        <div class="join">
            <a href="?p=register"><img src="./assets/icons/user-solid-full.svg" alt="">Register</a>
            <a href="?p=signin"><img src="./assets/icons/arrow-right-to-bracket-solid-full.svg" alt="">sign in</a>
        </div>
        <h2><img src="./assets/icons/blog-solid-full.svg" alt="">PeGPeM</h2>
        <div class="links">
            <a href="#"><img src="./assets/icons/facebook-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/instagram-brands-solid-full (1).svg" alt=""></a>
            <a href="#"><img src="./assets/icons/twitter-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/youtube-brands-solid-full.svg" alt=""></a>
        </div>
        <div class="links_ss">
            <a href="/signup">sign up</a>
            <a href="/login">log in</a>
            <a href="#"><img src="./assets/icons/facebook-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/instagram-brands-solid-full (1).svg" alt=""></a>
            <a href="#"><img src="./assets/icons/twitter-brands-solid-full.svg" alt=""></a>
            <a href="#"><img src="./assets/icons/youtube-brands-solid-full.svg" alt=""></a>
        </div>
        <img src="./assets/icons/list-solid-full.svg" alt="" class="menu_display">
        <img src="./assets/icons/x-solid-full.svg" alt="" class="menu_close">
    </nav>
    <?php endif; ?>

    <section class="section1">
        <input type="hidden" name="author" value="<?= htmlspecialchars($content['author']) ?>">
        <input type="hidden" name="title" value="<?= htmlspecialchars($content['title']) ?>">
        <input type="hidden" name="description" value="<?= htmlspecialchars($content['description']) ?>">
        <div class="blog_meta">
            <h2 id="author"></h2>
            <h1 id="title"></h1>
            <p id="description"></p>
        </div>
        <div class="top_display">
            <img src="./assets/images/<?php echo htmlspecialchars($content['blogImage']) ?>" alt="blog image">
            <div class="top_display_cnt">
                <div class="details">
                    <h2>details</h2>
                    <div class="detail">
                        <h2>current date <span>📅 <?php echo htmlspecialchars(date("y-m-d")) ?></span></h2>
                        <h2>category <span><?php echo htmlspecialchars($content['cartegory']) ?></span></h2>
                        <h2>publish date <span>📅 <?php echo htmlspecialchars($content['date']) ?></span></h2>
                    </div>
                </div>
                <div class="authormessage">
                    <div class="details">
                        <img src="./assets/profilepicture/<?php
                                                            if ($content['authorImage'] && $content['authorImage'] !== "") {
                                                                echo htmlspecialchars($content['authorImage']);
                                                            } else {
                                                                echo "user.svg";
                                                            }
                                                            ?>" alt="">
                        <div class="detail">
                            <h2>By: <?php echo htmlspecialchars($content['author']) ?></h2>
                            <h2><?php echo htmlspecialchars($content['cartegory']) ?> analyst</h2>
                        </div>
                    </div>
                    <div class="message">
                        <p><?php echo htmlspecialchars($content['message']) ?></p>
                    </div>
                </div>
                <?php if (isset($_SESSION['username'])): ?>
                <div class="likes">
                    <a
                        href="?p=like_comment&id=<?php echo $_GET['id'] ?>&author=<?php echo htmlspecialchars($content['author']) ?>">View
                        comments 💬, share your thoughts🤔 & like👍 blog.</a>
                </div>
                <?php else: ?>
                <div class="likes">
                    <a href="?p=signin">Login/signup to comment and like blogs</a>
                </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['username'])  && $_SESSION['username'] == $content['author']) : ?>
                <div class="likes">
                    <a
                        href="?delete=del&id=<?php echo $_GET['id'] ?>&author=<?php echo htmlspecialchars($content['author']) ?>">Delete
                        blog ❎</a>
                </div>
                <?php endif; ?>
                <?php if (isset($_GET['delete']) && $_GET['delete'] == 'del' && !empty($_GET["delete"])) {

                    $id = $_GET['id'];
                    $author = $_GET['author'];

                    //delete statment
                    $sql = "DELETE FROM blogs WHERE author=? AND id=? AND username=?";
                    $sql = $db_connect->prepare($sql);

                    if ($sql) {
                        echo "
                        <a href='?action=delete&id=<?php echo $_GET[id]?>&author=<?php echo htmlspecialchars($content[author]) ?>'
                class='del'>delete blog</a>
                <a href='?action=cancel&id=<?php echo $_GET[id]?>&author=<?php echo htmlspecialchars($content[author]) ?>'
                    class='can'>cancel</a>
                ";
                }
                }
                ?>
            </div>
        </div>

        <div class="contentholder">
            <div class="holder2">
                <h1 id="content1title"><?php echo htmlspecialchars($content['content1title']) ?></h1>
                <p id="content1"><?php echo htmlspecialchars($content['content1']) ?></p>
                <h2 id=""><?php echo htmlspecialchars($content['content2title']) ?></h2>
                <p><?php echo htmlspecialchars($content['content2']) ?></p>
                <h2><?php echo htmlspecialchars($content['content3title']) ?></h2>
                <p><?php echo htmlspecialchars($content['content3']) ?></p>
                <h2><?php echo htmlspecialchars($content['content4title']) ?></h2>
                <p><?php echo htmlspecialchars($content['content4']) ?></p>
                <h2><?php echo htmlspecialchars($content['content5title']) ?></h2>
                <p><?php echo htmlspecialchars($content['content5']) ?></p>
            </div>
        </div>
    </section>
    <script>
    let menu = document.querySelector(".menu_display")
    let links_ss = document.querySelector(".links_ss")

    menu.addEventListener("click", () => {
        links_ss.classList.toggle("show")
    })
    </script>
    <?php require_once ROOT . "/require/footer.php" ?>