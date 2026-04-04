<?php

use Controllers\Views_controller\Views_controller;

$page_title = "like_comment";
//data for footer
$landingData = Views_controller::General_view_controller();
//data for page
$page_data = Views_controller::Like_comment_controller();
$all_comments = $page_data['all_comments'];
$user_has_liked = $page_data['user_has_liked'] ?? null;
$user_has_comment = $page_data['user_has_comment'] ?? null;
$total_comments = $page_data['total_comments'] ?? null;
$likes = $page_data['likes'] ?? null;
echo $total_comments;
echo $user_has_comment;
?>
<?php require_once ROOT . "/require/header.php" ?>

<head>
    <style>
        /* All your original CSS remains exactly as provided */
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
        }

        .footer-col h4 {
            font-size: 18px;
            margin-bottom: 25px;
            position: relative;
            font-weight: 500;
        }

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

        body {
            font-family: Arial, sans-serif;
            margin: auto;
            color: #001F3D;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .interaction-container {
            margin-top: 80px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            width: 99%;
        }

        .reaction-bar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .reaction-button {
            background: none;
            border: 1px solid #adb5bd;
            color: #495057;
            padding: 8px 15px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .reaction-button.back {
            background-color: orangered;
            color: white;
            border: none;
        }

        .reaction-button.back a {
            color: white;
            text-decoration: none;
        }

        .total-reactions {
            font-size: 15px;
            text-align: right;
            color: #6c757d;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
            resize: vertical;
        }

        .comment-form input[type="text"] {
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin-bottom: 10px;
            width: calc(50% - 5px);
            background-color: #f8f9fa;
        }

        .comment-form input[type="submit"] {
            background-color: orangered;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .comment-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e9ecef;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #adb5bd;
            color: white;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .comment-meta time {
            font-size: 0.8em;
            color: #6c757d;
        }

        .comment-text {
            margin-top: 5px;
            color: #343a40;
        }

        hr {
            border: 0;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }
    </style>
</head>

<body>

    <nav class="navbar" style="padding: 20px;">
        <h2><img src="./assets/icons/blog-solid-full.svg" alt="">PeGPeM Like And Comment</h2>
    </nav>

    <div class="interaction-container">
        <section class="reaction-bar">
            <div class="reaction-buttons">
                <?php if ($user_has_liked): ?>
                    <button class="reaction-button back">👍 Liked</button>
                <?php else: ?>
                    <a href="like&comment.php?id=<?php echo $blog_id; ?>&author=<?php echo $author; ?>&status=liked" class="reaction-button back">👍 Like Blog</a>
                <?php endif; ?>
            </div>

            <div class="total-reactions">
                <?php if ($user_has_liked) echo "You already liked this. "; ?>
                <?php echo $likes; ?> <?php echo ($likes == 1) ? "Like" : "Likes"; ?>
                &
                <?php echo $total_comments; ?> <?php echo ($total_comments == 1) ? "Comment" : "Comments"; ?>
            </div>
        </section>

        <hr>

        <section class="comment-form">
            <?php if ($user_has_comment): ?>
                <h3>You have already posted a comment.</h3>
            <?php else: ?>
                <h3>Share your thoughts</h3>
                <form action="<?php echo $location; ?>" method="POST">
                    <textarea name="comment" rows="3" placeholder="✍️ Write your comment here..." required></textarea>
                    <input type="text" readonly value="User: <?php echo htmlspecialchars($_SESSION['username']); ?>">
                    <input type="text" readonly value="Author: <?php echo htmlspecialchars($_GET['author']); ?>">
                    <input type="submit" value="Post Comment" name="post">
                </form>
            <?php endif; ?>
        </section>

        <hr style="clear:both; margin-top:40px;">

        <section class="comments-list">
            <div style="font-weight:bold; margin-bottom:20px; font-size:1.1em;">
                All Comments (<?php echo $total_comments ?? ""; ?>)
            </div>

            <?php foreach ($all_comments as $info): ?>
                <article class="comment-item">
                    <div class="comment-avatar">
                        <?php echo strtoupper(substr($info['username'], 0, 1)); ?>
                    </div>
                    <div class="comment-content-box">
                        <div class="comment-meta">
                            <span style="font-weight:bold;"><?php echo htmlspecialchars($info['username']); ?></span>
                            <time> • <?php echo date("M d, Y", strtotime($info['created_at'] ?? 'now')); ?></time>
                        </div>
                        <p class="comment-text">
                            <?php echo htmlspecialchars($info['comment']); ?>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
    <?php require_once ROOT . "/require/footer.php" ?>