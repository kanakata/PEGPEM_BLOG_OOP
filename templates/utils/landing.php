<!--this is the landing page-->
<?php
$page_title = "Pegpem_blog";
require_once ROOT . "/require/header.php";

use Controllers\Views_controller\Views_controller;
use Router\Router;
if(isset($_GET['search'])){
    $search_data = Views_controller::Search_controller();
    $search_results = $search_data['search_output'] ?? null;
    $pages_no = $search_data['pages_no'];
    $page = $search_data['page'];
}

$landingData = Views_controller::General_view_controller();
$sliderContent = $landingData['slider_content'];
$categories = $landingData['categories'];
$editorsPic = $landingData['editors_pic'];
$topBlogs = $landingData['top_blogs'];
$footer = $landingData['footer'];
?>


<?php if(isset($_GET['search'])):?>

<head>
    <style>
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

        <h2><span></span>showing results for : <?php echo $_GET['search'] ?><span></span></h2>

        <?php if ($pages_no > 1): ?>
        <div class="pagination">
            <?php
    // --- Previous Page Link Logic ---
    $prev_page = $page - 1;
    $prev_class = $page <= 1 ? 'disabled' : '';
    ?>
            <a href="?page=<?php echo $prev_page; ?>&search=<?php echo $_GET['search']?>"
                class="<?php echo $prev_class; ?>">Previous</a>

            <?php
    // --- Page Number Links Logic ---
    for ($i = 1; $i <= $pages_no; $i++) {
        $active_class = $i == $page ? 'active' : '';?>
            <a href="?page=<?php echo $i ; ?>&search=<?php echo $_GET['search']?>"
                class="<?php echo $active_class; ?>"><?php echo $i; ?></a>
            <?php
    }
    // --- Next Page Link Logic ---
    $next_page = $page + 1;
    $next_class = $page >= $pages_no ? 'disabled' : '';?>
            <a href="?page=<?php echo $next_page; ?>&search=<?php echo $_GET['search']?>"
                class="<?php echo $next_class; ?>">Next</a>
        </div>
        <?php endif; ?>
    </div>

    <div class="contentholder2">
        <?php foreach ($search_results as $info):?>
        <!-- search link -->
        <a href="?p=contentpage&id=<?= $info['id'] ?>" class="blog">
            <img src="./assets/images/<?php echo "{$info['blogImage']}"?>" alt="">
            <div class="content">
                <h3><?php echo "{$info['author']}"?>.
                    <?php echo "{$info['date']}"?><span><?php echo "{$info['likes']}"?> likes 👍</span></h3>
                <h2 id="title"><?php echo "{$info['title']}"?></h2>
                <p id="content"><?php echo "{$info['description']}"?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <?php if ($pages_no > 1): ?>
    <div class="pagination">
        <?php
    // --- Previous Page Link Logic ---
    $prev_page = $page - 1;
    $prev_class = $page <= 1 ? 'disabled' : '';
    ?>
        <a href="?page=<?php echo $prev_page; ?>&search=<?php echo $_GET['search']?>"
            class="<?php echo $prev_class; ?>">Previous</a>

        <?php
    // --- Page Number Links Logic ---
    for ($i = 1; $i <= $pages_no; $i++) {
        $active_class = $i == $page ? 'active' : '';
        ?>
        <a href="?page=<?php echo $i ; ?>&search=<?php echo $_GET['search']?>"
            class="<?php echo $active_class; ?>"><?php echo $i; ?></a>
        <?php
    }

    // --- Next Page Link Logic ---
    $next_page = $page + 1;
    $next_class = $page >= $pages_no ? 'disabled' : '';
    ?>
        <a href="?page=<?php echo $next_page; ?>&search=<?php echo $_GET['search']?>"
            class="<?php echo $next_class; ?>">Next</a>
    </div>
    <?php endif; ?>
</section>

<?php else:?>

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
        <a href="?p=register">sign up</a>
        <a href="?p=signin">log in</a>
        <a href="#"><img src="./assets/icons/facebook-brands-solid-full.svg" alt=""></a>
        <a href="#"><img src="./assets/icons/instagram-brands-solid-full (1).svg" alt=""></a>
        <a href="#"><img src="./assets/icons/twitter-brands-solid-full.svg" alt=""></a>
        <a href="#"><img src="./assets/icons/youtube-brands-solid-full.svg" alt=""></a>
    </div>
    <img src="./assets/icons/list-solid-full.svg" alt="" class="menu_display">
    <img src="./assets/icons/x-solid-full.svg" alt="" class="menu_close">
</nav>

<header>
    <div class="slider">
        <?php $counter = 0; ?>
        <?php foreach ($sliderContent as $info): ?>
        <?php $classes = 'item';
            if ($counter === 0) $classes .= ' active'; ?>
        <a href="?p=contentpage&id=<?= htmlspecialchars(Router::Mask_content($info['id'])) ?>"
            class="<?php echo $classes; ?>">
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
        <form action="<?= "?p=more" ?>" method="get">
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
    </div>

    <div class="contentholder2">
        <h2><span></span>top blogs<span></span></h2>
        <div class="blogs">
            <?php foreach ($topBlogs as $info): ?>
            <a href="?p=contentpage&id=<?= htmlspecialchars(Router::Mask_content($info['id'])) ?>" class="blog">
                <img src="./assets/images/<?php echo htmlspecialchars($info['blogImage'])  ?>" alt="blogimage">
                <div class="content">
                    <h3>by: <?php echo htmlspecialchars($info['author'])  ?> .
                        <?php echo htmlspecialchars($info['date']) ?>
                        <span><?php echo htmlspecialchars($info['likes'])  ?> likes👍</span>
                    </h3>
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
<?php endif; ?>

<?php require_once ROOT . "/require/footer.php"; ?>