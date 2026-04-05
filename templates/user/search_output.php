<?php

include '../bk_end/db_connect.php';


?>
<?php require_once "header.php" ?>
<style>
/* --- Simple Styling for Pagination Links (You should move this to style.css) --- */
.pagination {
    display: flex;
    justify-content: center;
    padding: 20px 0;
    margin-top: 0px;
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
    border: 1px solid orangered;
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
    border-color: 1px solid orangered;
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
        font-size: 18px;

        & span {
            width: 100px;
            height: 5px;
            background: orangered;
        }
    }
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
</style>
</head>

<body>


    <!-- <nav>
        <div class="join">
            <a href="index.html" class="back">back</a>
        </div>
        <h2><img src="/icons/icon.png" alt="">PeGPeM</h2>
        <div class="links">
            <button><a href="signup.html">create</a></button>
        </div>
        <img src="/icons/menu.png" alt="" class="menu_display">
    </nav> -->



    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h3 class="footer-logo">Pegpem<span>.</span></h3>
                <p>Sharing insights on technology, lifestyle, and design. Follow our journey as we explore the digital
                    world.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Back to top</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Categories</h4>
                <ul>

                    <?php while($info = $resultc->fetch_assoc()){ ?>

                    <li><a
                            href="more.php?categories&category=<?php echo "{$info['cartegory']}"?>"><?php echo "{$info['cartegory']}"?></a>
                    </li>

                    <?php }?>

                </ul>
            </div>

            <div class="footer-col">
                <h4>Newsletter</h4>
                <p>Subscribe to get the latest posts delivered to your inbox.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Join</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Pegpem. All rights reserved.</p>
            <div class="bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script>
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
        console.log(contentElements)

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
    </script>
</body>

</html>