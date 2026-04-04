<?php

use Controllers\Views_controller\Views_controller;
use Router\Router;

$content = Views_controller::User_dashboard_controller();
$username = $content['username'];
$postCount = $content['total_blogs'];
$likeCount = $content['total_likes'];
$commentCount = $content['total_comments'];
$categoryCount = $content['total_categories'];
$recentBlog = $content['recent_blog']
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashoard</title>
    <link rel="shortcut icon" href="./assets/icons/blog-solid-full.svg" type="image/x-icon">
    <style>
        /* General Reset and Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f4f7f6;
            color: #333;
        }

        /* --- 1. MAIN LAYOUT: CSS GRID --- */
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* --- 2. SIDEBAR (Navigation) --- */
        .sidebar {
            background-color: orangered;
            /* Blue shade fitting a creative/blog theme */
            color: white;
            border-radius: 10px;
            padding-top: 20px;
            margin: 10px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            padding: 10px;
            font-size: 1.5em;
            font-weight: bold;
            color: black;
            font-family: broadway;
            border-bottom: 1px solid orangered;
            display: flex;
            align-items: center;
            gap: 2px;

            & img {
                height: 40px;
                width: 40px;
            }
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #d1e5f0;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar nav a:hover,
        .sidebar nav .active a {
            background-color: #E7F2EF;
            color: orangered;
            border-left: 4px solid #f9a620;
            /* Accent color highlight */
            padding-left: 16px;
        }

        /* Icon placeholders */
        .sidebar nav a::before {
            content: "• ";
            margin-right: 10px;
            color: #f9a620;
        }

        /* --- 3. MAIN CONTENT AREA --- */
        .main-content {
            padding-left: 10px;
            padding-right: 10px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f9a620;
            color: white;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            margin-right: 10px;
        }

        /* --- 4. STATS GRID (Top Cards) --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-left: 5px solidorangered;
            /* Primary color highlight */
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 2em;
            font-weight: 700;
            color: #2c3e50;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.9em;
        }

        /* Highlight warning stats (e.g., pending comments) */
        .stat-card.warning {
            border-left-color: #e74c3c;
        }

        /* --- 5. ACTIVITY/POST LIST SECTION --- */
        .section-title {
            font-size: 1.4em;
            margin-bottom: 20px;
            border-left: 4px solid #f9a620;
            padding-left: 10px;
        }

        .post-grid {
            display: grid;
            grid-template-columns: 2fr;
            /* Posts List (2/3) and Quick Draft/Comments (1/3) */
            gap: 20px;
        }

        .panel {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Post Table Styling */
        .post-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9em;
        }

        .post-table th,
        .post-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }

        .post-table th {
            background-color: #f8f8f8;
            font-weight: 600;
            color: #555;
        }

        .action-link {
            color: orangered;
            text-decoration: none;
            margin-right: 10px;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        /* Comments/Drafts List Styling */
        .compact-list {
            list-style: none;
            padding: 0;
        }

        .compact-list li {
            padding: 10px 0;
            border-bottom: 1px dashed #ecf0f1;
            font-size: 0.9em;
        }

        .compact-list li:last-child {
            border-bottom: none;
        }

        .item-meta {
            color: #95a5a6;
            font-size: 0.8em;
            display: block;
            margin-top: 3px;
        }

        /* --- 6. RESPONSIVENESS --- */
        @media (max-width: 900px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar nav ul {
                display: flex;
                overflow-x: auto;
            }

            .sidebar nav li {
                flex-shrink: 0;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .post-grid {
                grid-template-columns: 1fr;
                /* Stack the main panels */
            }
        }

        @media (max-width: 500px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <h2></h2>
    <div class="dashboard-container">

        <aside class="sidebar">
            <div class="logo"><img src="./assets/icons/blog-solid-full.svg" alt="">PeGPeM</div>
            <nav>
                <ul>
                    <li class="active"><a href="#">Dashboard</a></li>
                    <li><a href="?p=postblog">Create a new Post</a></li>
                    <li><a href="?p=more&v=allpost">All Posts</a></li>
                    <li><a href="?p=like_comment">comments</a></li>
                    <li><a href="?p=updateuser">Profile Settings</a></li>
                    <li><a href="?p=userlandingpage">Back</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">

            <header class="header">
                <h1>Dash Summary</h1>
                <div class="user-info">
                    <div class="user-avatar">B</div>
                    <span><?= htmlspecialchars($username) ?>, Blogger</span>
                </div>
            </header>

            <section class="stats-grid">

                <div class="stat-card">
                    <div class="stat-value"><?php echo htmlspecialchars($postCount) ?></div>
                    <div class="stat-label">Total Published Posts</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value"><?php echo htmlspecialchars($likeCount) ?></div>
                    <div class="stat-label">Total likes</div>
                </div>

                <div class="stat-card warning">
                    <div class="stat-value"><?php echo htmlspecialchars($commentCount) ?></div>
                    <div class="stat-label">Total comments </div>
                </div>

                <div class="stat-card">
                    <div class="stat-value"><?php echo htmlspecialchars($categoryCount) ?></div>
                    <div class="stat-label">Categories </div>
                </div>

            </section>

            <section class="post-grid">

                <div class="panel">
                    <h2 class="section-title">Your Recent Published Posts</h2>
                    <table class="post-table">
                        <thead>
                            <tr>
                                <th>Blog title</th>
                                <th>category</th>
                                <th>date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($recentBlog as $info): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($info['title']) ?></td>
                                    <td><?php echo htmlspecialchars($info['cartegory']) ?></td>
                                    <td><?php echo htmlspecialchars($info['date']) ?></td>
                                    <td>
                                        <a href="?p=postblog&id=<?php echo htmlspecialchars(Router::Mask_content($info['id'])) ?>&action=edit_blog" class="action-link">Edit</a>
                                        <a href="?p=contentpage&id=<?= htmlspecialchars(Router::Mask_content($info['id'])) ?>" class="action-link">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>

                <!-- <div class="panel">
                    <h2 class="section-title">Moderation & Drafts</h2>
                    
                    <h3>Drafts</h3>
                    <ul class="compact-list">
                        <li>
                            <a href="#" class="action-link">5 Tips for Better SEO in 2026</a>
                            <span class="item-meta">Last edited: 2 hours ago</span>
                        </li>
                        <li>
                            <a href="#" class="action-link">Review: New Tech Gadget</a>
                            <span class="item-meta">Last edited: Yesterday</span>
                        </li>
                    </ul>

                    <h3>Pending Comments</h3>
                    <ul class="compact-list">
                        <li>
                            "Great article!" - by John D.
                            <span class="item-meta">On: Future of CSS Grid</span>
                        </li>
                        <li>
                            Spam comment detected.
                            <span class="item-meta">On: Python vs. R</span>
                        </li>
                    </ul>
                </div> -->

            </section>

        </main>
    </div>

</body>

</html>