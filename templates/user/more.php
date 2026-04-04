<?php
$page_title = $_GET['v'] ?? "";
require_once ROOT . "/require/header.php";

use Controllers\Views_controller\Views_controller;
use Router\Router;

$moreCategoriesData = Views_controller::More_categories_controller();
$landingData = Views_controller::General_view_controller();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* General Reset */
    @font-face {
        font-family: 'broadway';
        src: url("./fonts/BROADW.TTF") format(truetype);
    }

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

    /* --- Simple Styling for Pagination Links (You should move this to style.css) --- */
    .pagination {
        display: flex;
        justify-content: center;
        padding: 20px 0;
        margin-top: 15px;
    }

    .pagination a {
        color: orangered;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin: 0 4px;
        border-radius: 4px;
    }

    .pagination a:hover:not(.active) {
        background-color: #f2f2f2;
    }

    .pagination a.active {
        background-color: orangered;
        /* Active page color */
        color: white;
        border: 1px solid orangered;
    }

    .pagination a.disabled {
        pointer-events: none;
        cursor: default;
        color: #ccc;
        border-color: #eee;
    }

    .details table th,
    .searchoutput table th {
        background-color: #f0f0f0;
        color: #333;
    }

    .pagtop {
        display: flex;
        width: 100%;
        padding-left: 10px;
        align-items: center;
        justify-content: space-between;
        padding-right: 10px;

        & h2 {
            display: flex;
            align-items: center;
            gap: 5px;
            font-family: broadway;
            text-transform: capitalize;
            color: orangered;

            & span {
                width: 100px;
                height: 2px;
                background: orangered;
            }
        }
    }

    .categories_post {
        margin-top: 80px;
    }

    @media (max-width: 700px) {
        .pagtop {
            display: flex;
            flex-direction: column;
            width: 100%;

            & h2 {
                font-size: 15px;

                & span {
                    width: 50px;
                    height: 2px
                }
            }
        }
    }
    </style>
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

    <section class="categories_post">

        <div class="pagtop">

            <h2><span></span><?= htmlspecialchars($moreCategoriesData['page_description']) ?><span></span></h2>

            <!-- pagination system -->
            <?php if ($moreCategoriesData['pages_number'] > 1): ?>
            <div class="pagination">
                <?php
                    // --- Previous Page Link Logic ---
                    $prev_page = $moreCategoriesData['page'] - 1;
                    $prev_class = $moreCategoriesData['page'] <= 1 ? 'disabled' : '';
                    ?>
                <a href="?p=more<?= isset($_GET['v']) ? "&v=" . $_GET['v'] : "" ?><?= isset($_GET['category']) ? "&category=" . $_GET['category'] : "" ?>&page=<?= $prev_page ?>"
                    class="<?php echo $prev_class; ?>">Previous</a>

                <?php for ($i = 1; $i <= $moreCategoriesData['pages_number']; $i++): ?>
                <?php $active_class = $i == $moreCategoriesData['page'] ? 'active' : ''; ?>
                <a href="?p=more<?= isset($_GET['v']) ? "&v=" . $_GET['v'] : "" ?><?= isset($_GET['category']) ? "&category=" . $_GET['category'] : "" ?>&page=<?= $i ?>"
                    class="<?php echo $active_class; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                <?php
                    // --- Next Page Link Logic ---
                    $next_page = $moreCategoriesData['page'] + 1;
                    $next_class = $moreCategoriesData['page'] >= $moreCategoriesData['pages_number'] ? 'disabled' : '';
                    ?>
                <a href="?p=more<?= isset($_GET['v']) ? "&v=" . $_GET['v'] : "" ?><?= isset($_GET['category']) ? "&category=" . $_GET['category'] : "" ?>&page=<?= $next_page ?>"
                    class="<?php echo $next_class; ?>">Next</a>
            </div>
            <?php endif; ?>


        </div>

        <div class="contentholder2">


            <!-- displaying page content -->
            <?php foreach ($moreCategoriesData['content'] as $info): ?>
            <a href="?p=contentpage&id=<?= htmlspecialchars(Router::Mask_content($info['id'])) ?>" class="blog">
                <img src="./assets/images/<?php echo htmlspecialchars($info['blogImage']) ?>" alt="">
                <div class="content">
                    <h3><?php echo htmlspecialchars($info['author']) ?>. <?php echo htmlspecialchars($info['date']) ?>
                        <span><?php echo htmlspecialchars($info['likes']) ?> likes 👍</span></h3>
                    <h2 id="title"><?php echo htmlspecialchars($info['title']) ?></h2>
                    <p id="content"><?php echo htmlspecialchars($info['description']) ?></p>
                    <h2>category : <?php echo htmlspecialchars($info['cartegory']) ?></h2>
                </div>
            </a>
            <?php endforeach; ?>

        </div>

        <!-- pagination system -->
        <?php if ($moreCategoriesData['pages_number'] > 1): ?>
        <div class="pagination">
            <?php
                // --- Previous Page Link Logic ---
                $prev_page = $moreCategoriesData['page'] - 1;
                $prev_class = $moreCategoriesData['page'] <= 1 ? 'disabled' : '';
                ?>
            <a href="?p=more<?= isset($_GET['v']) ? "&v=" . $_GET['v'] : "" ?><?= isset($_GET['category']) ? "&category=" . $_GET['category'] : "" ?>&page=<?= $prev_page ?>"
                class="<?php echo $prev_class; ?>">Previous</a>

            <?php for ($i = 1; $i <= $moreCategoriesData['pages_number']; $i++): ?>
            <?php $active_class = $i == $moreCategoriesData['page'] ? 'active' : ''; ?>
            <a href="?p=more<?= isset($_GET['v']) ? "&v=" . $_GET['v'] : "" ?><?= isset($_GET['category']) ? "&category=" . $_GET['category'] : "" ?>&page=<?= $i ?>"
                class="<?php echo $active_class; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php
                // --- Next Page Link Logic ---
                $next_page = $moreCategoriesData['page'] + 1;
                $next_class = $moreCategoriesData['page'] >= $moreCategoriesData['pages_number'] ? 'disabled' : '';
                ?>
            <a href="?p=more<?= isset($_GET['v']) ? "&v=" . $_GET['v'] : "" ?><?= isset($_GET['category']) ? "&category=" . $_GET['category'] : "" ?>&page=<?= $next_page ?>"
                class="<?php echo $next_class; ?>">Next</a>
        </div>
        <?php endif; ?>

    </section>

    <script type="text/javascript" defer>
    let menu = document.querySelector(".menu_display")
    let links_ss = document.querySelector(".links_ss")


    function truncateTitles() {
        // 1. Select all elements whose ID starts with "title"
        const titleElements = document.querySelectorAll("#title")

        // Define the maximum length and the replacement string
        const maxLength = 35;
        const replacement = '.....';

        titleElements.forEach(element => {
            // Get the current text content of the element
            const originalText = element.textContent.trim();

            if (originalText.length > maxLength) {
                // 2. Truncate the string to (maxLength - replacement.length)
                // We subtract the replacement length so the resulting string + '.....' 
                // is still very close to the 30 character limit.
                const truncationPoint = maxLength - replacement.length;

                // 3. Create the new truncated string
                const truncatedText = originalText.substring(0, truncationPoint) + replacement;

                // 4. Update the element's content
                element.textContent = truncatedText;

                console.log(`Truncated: "${originalText}" to "${truncatedText}"`);

            } else {
                console.log(`No change: "${originalText}"`);
            }
        });
    }

    truncateTitles();

    function truncateContent() {
        // 1. Select all elements whose ID starts with "title"
        const contentElements = document.querySelectorAll("#content")

        // Define the maximum length and the replacement string
        const maxLength = 100;
        const replacement = '.....';

        contentElements.forEach(element => {
            // Get the current text content of the element
            const originalText = element.textContent.trim();

            if (originalText.length > maxLength) {
                // 2. Truncate the string to (maxLength - replacement.length)
                // We subtract the replacement length so the resulting string + '.....' 
                // is still very close to the 30 character limit.
                const truncationPoint = maxLength - replacement.length;

                // 3. Create the new truncated string
                const truncatedText = originalText.substring(0, truncationPoint) + replacement;

                // 4. Update the element's content
                element.textContent = truncatedText;

                console.log(`Truncated: "${originalText}" to "${truncatedText}"`);

            } else {
                console.log(`No change: "${originalText}"`);
            }
        });
    }

    truncateContent();

    menu.addEventListener("click", () => {
        links_ss.classList.toggle("show")
    })
    </script>
    <script defer type="text/javascript">
    let blog = document.querySelectorAll(".blog")
    blog.forEach(item => {
        item.addEventListener("click", () => {
            location.href = "contentpage.html"
        })
    })

    const blogObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show")
            }
        })
    }, {
        threshold: 0.1
    })
    blog.forEach(item => {
        blogObserver.observe(item)
    })
    if (document.querySelector(".navbar")) {
        navbar.style.top = '0';

        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;

            // **Dynamic Logic Addition:** If the user is at the very top (e.g., scroll position < 10)
            // ensure the navbar is always visible and reset tracking.
            if (currentScrollPos < 10) {
                navbar.style.top = '0';
                prevScrollpos = currentScrollPos; // Reset tracking
                return; // Exit the function early
            }

            // Standard Scroll Logic (Show on Down, Hide on Up)
            if (prevScrollpos > currentScrollPos) {
                // Scrolling UP -> HIDE
                navbar.style.top = HIDE_OFFSET + 'px';
            } else {
                // Scrolling DOWN -> SHOW
                navbar.style.top = '0';
            }

            // **THIS IS THE KEY LINE THAT MAKES IT DYNAMIC**
            prevScrollpos = currentScrollPos;
        };
    }
    </script>
    <?php require_once ROOT . "/require/footer.php" ?>