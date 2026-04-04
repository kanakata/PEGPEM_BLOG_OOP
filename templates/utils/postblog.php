<?php

use Controllers\Views_controller\Views_controller;

$username = "";
$data = [];
$edit_mode = $_GET['action'] ?? null;
if (isset($_GET['action']) && $_GET['action'] == "edit_blog") {
    $blog_data = Views_controller::Display_blog();
    $data = $blog_data['blog'];
}
//define variables
?>
<?php $page_title = "Blog Post & Edit Page"; ?>
<?php require_once ROOT . "/require/header.php" ?>
<style>
    :root {
        --main-bg: #E7F2EF;
        --dark-blue: #19183B;
        --accent: #2ecc71;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', sans-serif;
        background: var(--main-bg);
        color: var(--dark-blue);
        margin: 0;
        padding: 0px;
    }

    .post-form-container {
        width: 100%;
        margin-top: 100px;
        background: white;
        padding: 5px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .blog-post-group {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        background: #fafafa;
    }

    h1,
    h2 {
        padding-bottom: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 15px;
    }

    .btn {
        background: var(--dark-blue);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn:hover {
        background: var(--accent);
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 6px;
    }

    .error {
        background: #f8d7da;
        color: #721c24;
    }

    .success {
        background: #d4edda;
        color: #155724;
    }
</style>
</head>

<body>

    <nav class="navbar">

        <h2><img src="./assets/icons/blog-solid-full.svg" alt="">PeGPeM Blog Post & Edit Page</h2>


    </nav>

    <div class="post-form-container">
        <h1><?php echo $edit_mode ?? "Create New Blog Post" ?></h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="blog_id" value="<?php echo $id; ?>">

            <section class="blog-post-group">
                <div class="form-group">
                    <label>Author Name</label>
                    <input type="text" value="<?= isset($edit_mode) ? htmlspecialchars($data['author']) : ''; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Blog Title</label>
                    <input type="text" name="title_1" value="<?= isset($edit_mode) ? htmlspecialchars($data['title']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Short Description</label>
                    <textarea name="description_1" rows="2"><?= isset($edit_mode) ? htmlspecialchars($data['description']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" value="<?= isset($edit_mode) ? htmlspecialchars($data['cartegory']) : ''; ?>" placeholder="e.g. Technology">
                </div>
                <div class="form-group">
                    <label>Author Message</label>
                    <textarea name="author_message"><?= isset($edit_mode) ? htmlspecialchars($data['message']) : ''; ?></textarea>
                </div>
                <?php if (!$edit_mode): ?>
                    <div class="form-group">
                        <label>Blog Header Image</label>
                        <input type="file" name="blogimage">
                    </div>
                    <div class="form-group">
                        <label>Author Profile Picture</label>
                        <input type="file" name="authorimage">
                    </div>
                <?php endif; ?>
            </section>

            <?php for ($n = 1; $n <= 5; $n++): ?>
                <section class="blog-post-group">
                    <h3>Content Section <?php echo $n; ?></h3>
                    <div class="form-group">
                        <label>Section Title</label>
                        <input type="text" name="title<?php echo $n; ?>" value="<?= isset($edit_mode) ? htmlspecialchars($data["content{$n}title"]) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Body Content</label>
                        <textarea name="content<?php echo $n; ?>" rows="4"><?= isset($edit_mode) ? htmlspecialchars($data["content{$n}"]) : ''; ?></textarea>
                    </div>
                </section>
            <?php endfor; ?>

            <div style="text-align: right;">
                <button type="submit" name="<?= $edit_mode ? 'edit_post' : 'post'; ?>" class="btn">
                    <?= $edit_mode ? 'Update Blog' : 'Publish Blog'; ?>
                </button>
            </div>
        </form>
    </div>

</body>

</html>