<!--this is the landing page-->
<?php
$page_title = "Pegpem_blog";
require_once ROOT . "/require/header.php";

use Controllers\Views_controller\Views_controller;
use Router\Router;

$landingData = Views_controller::General_view_controller();
$sliderContent = $landingData['slider_content'];
$categories = $landingData['categories'];
$editorsPic = $landingData['editors_pic'];
$topBlogs = $landingData['top_blogs'];
$footer = $landingData['footer'];
?>
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

<header>
    <div class="slider">
        <?php $counter = 0; ?>
        <?php foreach ($sliderContent as $info): ?>
            <?php $classes = 'item';
            if ($counter === 0) $classes .= ' active'; ?>
            <a href="?p=contentpage&id=<?= htmlspecialchars(Router::Mask_content($info['id'])) ?>" class="<?php echo $classes; ?>">
                <img src="./assets/images/<?= htmlspecialchars($info['blogImage']) ?>" alt="">
                <div class="content">
                    <h2><span></span><?php echo htmlspecialchars($info['cartegory']) ?><span></span></h2>
                    <p><?php echo htmlspecialchars($info['description']) ?></p>
                </div>
            </a>
            <?php $counter++ ?>
        <?php endforeach; ?>
        <button class="prev">&#8592;</button>
        <button class="next">&#8594;</button>
        <div class="paginations">
            <div class="pagination active"></div>
            <div class="pagination"></div>
            <div class="pagination"></div>
            <div class="pagination"></div>
            <div class="pagination"></div>
        </div>
    </div>
</header>

<section class="section">
    <div class="contentholder1">
        <form action="<?php echo "./src/search_output.php" ?>" method="get">
            <input type="search" name="search" placeholder="Search by category or author... 🔍">
        </form>

        <h2 id="categories">categories</h2>

        <div class="categories">
            <?php foreach ($topBlogs as $info): ?>
                <a href="?p=more&v=category&category=<?php echo htmlspecialchars($info['cartegory']) ?>" class="category">
                    <img src="./assets/images/<?php echo htmlspecialchars($info['blogImage']) ?>" alt="blogid">
                    <h2><?php echo htmlspecialchars($info['cartegory'])  ?></h2>
                </a>
            <?php endforeach; ?>
            <a href="?p=morecategories" class="morecategory">
                <h2>more cartegories</h2>
            </a>
        </div>

        <div class="topposts">
            <h2 id="editors">editor's pic</h2>
            <?php $i = 0 ?>
            <?php foreach ($editorsPic as $i => $info): ?>
                <a href="?p=contentpage&id=<?= htmlspecialchars(Router::Mask_content($info['id'])) ?>" class="post">
                    <h1><?php echo $i + 1; ?></h1>
                    <div class="content">
                        <p><?php echo htmlspecialchars($info['title']); ?></p>
                        <h2>
                            <?php echo htmlspecialchars($info['cartegory']); ?>.
                            <?php echo htmlspecialchars($info['date']); ?>
                        </h2>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- <div class="socials">
            <h2 id="pages">instagram</h2>
            <div class="pages">
                <a href="#"><img src="/header images/Bmw.jpg" alt=""></a>
                <a href="#"><img src="/header images/deadpool.jpeg" alt=""></a>
                <a href="#"><img src="/header images/Bmw.jpg" alt=""></a>
                <a href="#"><img src="/header images/housing.jpeg" alt=""></a>
                <a href="#"><img src="/header images/deadpool.jpeg" alt=""></a>
                <a href="#"><img src="/header images/Bmw.jpg" alt=""></a>
            </div> 
        </div> -->

    </div>

    <div class="contentholder2">
        <h2><span></span>top blogs<span></span></h2>
        <div class="blogs">
            <?php foreach ($topBlogs as $info): ?>
                <a href="?p=contentpage&id=<?= htmlspecialchars(Router::Mask_content($info['id'])) ?>" class="blog">
                    <img src="./assets/images/<?php echo htmlspecialchars($info['blogImage'])  ?>" alt="blogimage">
                    <div class="content">
                        <h3><?php echo htmlspecialchars($info['author'])  ?> . <?php echo htmlspecialchars($info['date']) ?> <span><?php ?> likes👍</span></h3>
                        <h2 id="title"><?php echo htmlspecialchars($info['title'])  ?></h2>
                        <p id="content"><?php echo htmlspecialchars($info['description']) ?></p>
                    </div>
                </a>
            <?php
            endforeach  ?>
        </div>

        <a href="?p=more&v=moreblogs" class="more">more blogs</a>
    </div>

</section>
<script>
    (function truncateTitles() {
        const titleElements = document.querySelectorAll('#title');
        const maxLength = 40;
        const replacement = '.....';

        titleElements.forEach((element) => {
            const originalText = element.textContent.trim();

            if (originalText.length > maxLength) {
                const truncationPoint = maxLength - replacement.length;
                const truncatedText =
                    originalText.substring(0, truncationPoint) + replacement;
                element.textContent = truncatedText;
            }
        });
    })();

    (function truncateContent() {
        // 1. Select all elements whose ID starts with "title"
        const contentElements = document.querySelectorAll('#content');

        // Define the maximum length and the replacement string
        const maxLength = 100;
        const replacement = '.....';

        contentElements.forEach((element) => {
            // Get the current text content of the element
            const originalText = element.textContent.trim();

            if (originalText.length > maxLength) {
                // 2. Truncate the string to (maxLength - replacement.length)
                // We subtract the replacement length so the resulting string + '.....'
                // is still very close to the 30 character limit.
                const truncationPoint = maxLength - replacement.length;

                // 3. Create the new truncated string
                const truncatedText =
                    originalText.substring(0, truncationPoint) + replacement;

                // 4. Update the element's content
                element.textContent = truncatedText;

            }
        });
    })();
</script>
<?php require_once ROOT . "/require/footer.php"; ?>