<?php


include '../bk_end/login_check.php';
include '../bk_end/db_connect.php';

if(!isset($_SESSION['username']) || !isset($_SESSION['usertype']) || $_SESSION['usertype'] != 'admin') {
    // User is not logged in or not an admin, redirect to login page
    header("Location: index.php");
    exit();
}

//admin data
$sql = "SELECT * FROM login WHERE username = ?";
$sql = $db_connect->prepare($sql);
$sql->bind_param("s", $_SESSION['username']);
$sql->execute();
$result = $sql->get_result();
$sql->close();
$info = $result->fetch_assoc();




$stmt = "SELECT COUNT(DISTINCT cartegory) FROM blogs";
$stmt = $db_connect->prepare($stmt);
$stmt->execute();
$result2 = $stmt->get_result();
$stmt->close();
$info1= $result2->fetch_array()[0];

$stmt = "SELECT COUNT(DISTINCT username) FROM login";
$stmt = $db_connect->prepare($stmt);
$stmt->execute();
$result2 = $stmt->get_result();
$stmt->close();
$info2= $result2->fetch_array()[0];

$stmt = "SELECT COUNT(*) FROM blogs";
$stmt = $db_connect->prepare($stmt);
$stmt->execute();
$result2 = $stmt->get_result();
$stmt->close();
$info3= $result2->fetch_array()[0];

$stmt = "SELECT COUNT(comment) FROM comments_and_likes";
$stmt = $db_connect->prepare($stmt);
$stmt->execute();
$result2 = $stmt->get_result();
$stmt->close();

$info4 = $result2->fetch_array()[0];

$days_to_subtract = 30;
$current_timestamp = time();
$past_timestamp = $current_timestamp - ($days_to_subtract * 86400);
$formatted_date = date('Y-m-d', $past_timestamp);
$current_date = date('y-m-d');
$sql = "SELECT * FROM blogs WHERE date BETWEEN '$formatted_date' AND '$current_date' LIMIT 4 ";
$sql = $db_connect->prepare($sql);
$sql->execute();
$result3 = $sql->get_result();
$sql->close();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Super Dashboard</title>
    
    <style>
        /* General Reset and Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color:   #f4f7f6; /* Lighter background for professional feel */
            color:  orangered;
        }

        /* --- 1. MAIN LAYOUT: CSS GRID --- */
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr; 
            min-height: 100vh;
        }

        /* --- 2. SIDEBAR (Navigation) --- */
        .sidebar {
            background-color: orangered; /* Deep, authoritative dark color */
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            margin: 10px;
        }

        .logo {
            padding: 0 20px 20px 20px;
            font-size: 20px;
            font-weight: 900;
            color: black;
            font-family: broadway;
            border-bottom: 1px solid #f4f7f6;
            display: flex;
            align-items: center;
            gap: 10px;
            & img{
                height: 40px;
                width: 40px;
            }
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            & li{
                font-size: 15px;
            }
        }

        .sidebar nav a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #f2f7f6;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar nav a:hover,
        .sidebar nav .active a {
            background-color: #f4f7f6; 
            color: orangered;
            border-left: 4px solid  #f9a620; /* Primary Admin Accent Color */
            padding-left: 16px;
        }
        
        .sidebar nav a::before {
            content: "• "; 
            margin-right: 10px;
            color:  #f9a620;
            font-size: 1.1em;
        }
        
        /* --- 3. MAIN CONTENT AREA --- */
        .main-content {
            padding: 30px;
            overflow-y: auto; 
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #cbd5e0;
        }

        .admin-info {
            display: flex;
            align-items: center;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color:  #f9a620;
            color: white;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            margin-right: 10px;
        }

        /* --- 4. STATS GRID (Site Health) --- */
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #4299e1; 
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 2.2em;
            font-weight: 700;
            color: orangered;
        }

        .stat-label {
            color: #718096;
            font-size: 0.95em;
            margin-top: 5px;
        }
        
        .stat-card.critical {
            border-bottom-color: #e53e3e; /* Red for urgent items */
        }
        
        .stat-card.warning {
            border-bottom-color: #dd6b20; /* Orange for warnings */
        }


        /* --- 5. MAIN CONTENT PANELS --- */
        .content-panels {
            display: grid;
            grid-template-columns: 3fr 1fr; /* Main Content List (3/4) and Quick Actions (1/4) */
            gap: 20px;
        }

        .panel {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .section-title {
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #edf2f7;
        }

        /* Moderation/User Table Styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9em;
        }
        
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ebf4f5;
        }

        .data-table th {
            background-color: #f7fafc;
            font-weight: 600;
            color: #4a5568;
        }
        
        .action-button {
            background: none;
            border: 1px solid #4299e1;
            color: #4299e1;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8em;
            margin-right: 5px;
            transition: background-color 0.2s, color 0.2s;
            & a{
                color: #4299e1;
                text-decoration: none;
            }
        }
        
        .action-button.delete {
            border-color: #e53e3e;
            color: #e53e3e;
            & a{
                color: red;
                text-decoration: none;
                height: 100%;
                width: 100%;
            }
        }

        .action-button:hover {
            background-color: #4299e1;
            & a{
                color: white;
            }
        }
        
        .action-button.delete:hover {
            background-color: #e53e3e;
            & a{
                color: white;
            }
        }

        /* Quick Actions List */
        .quick-actions-list {
            list-style: none;
            padding: 0;
        }
        
        .quick-actions-list button {
            display: block;
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            text-align: left;
            background-color: #f7fafc;
            border: 1px solid #ebf4f5;
            border-radius: 4px;
            cursor: pointer;
            color: #f4f7f6;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            & a{
                color: #4299e1;
                text-decoration: none;
                height: 100%;
                width: 100%;
            }
        }
        
        .quick-actions-list button:hover {
            background-color: #edf2f7;
            border-color: #a0aec0;
        }
        li{
            font-size: 10px;
            list-style-type: circle;
        }

        /* --- 6. RESPONSIVENESS --- */
        @media (max-width: 900px) {
            body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color:   #f4f7f6; /* Lighter background for professional feel */
            color:  orangered;
        }

        /* --- 1. MAIN LAYOUT: CSS GRID --- */
        .dashboard-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- 2. SIDEBAR (Navigation) --- */
        .sidebar {
            background-color: orangered; /* Deep, authoritative dark color */
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .logo {
            padding: 0 20px 20px 20px;
            font-size: 20px;
            font-weight: 900;
            color: black;
            font-family: broadway;
            border-bottom: 1px solid #f4f7f6;
            display: flex;
            align-items: center;
            gap: 10px;
            & img{
                height: 40px;
                width: 40px;
            }
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            & li{
                font-size: 15px;
            }
        }

        .sidebar nav a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #f2f7f6;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar nav a:hover,
        .sidebar nav .active a {
            background-color: #f4f7f6; 
            color: orangered;
            border-left: 4px solid  #f9a620; /* Primary Admin Accent Color */
            padding-left: 16px;
        }
        
        .sidebar nav a::before {
            content: "• "; 
            margin-right: 10px;
            color:  #f9a620;
            font-size: 1.1em;
        }
        
        /* --- 3. MAIN CONTENT AREA --- */
        .main-content {
            padding: 5px;
            overflow-y: auto; 
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #cbd5e0;
        }

        .admin-info {
            display: flex;
            align-items: center;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color:  #f9a620;
            color: white;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            margin-right: 10px;
        }

        /* --- 4. STATS GRID (Site Health) --- */
        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #4299e1; 
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 2.2em;
            font-weight: 700;
            color: orangered;
        }

        .stat-label {
            color: #718096;
            font-size: 0.95em;
            margin-top: 5px;
        }
        
        .stat-card.critical {
            border-bottom-color: #e53e3e; /* Red for urgent items */
        }
        
        .stat-card.warning {
            border-bottom-color: #dd6b20; /* Orange for warnings */
        }


        /* --- 5. MAIN CONTENT PANELS --- */
        .content-panels {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center; /* Main Content List (3/4) and Quick Actions (1/4) */
            gap: 20px;
            overflow: scroll;
        }

        .panel {
            width: 90%;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow-x: scroll;
        }
        
        .section-title {
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #edf2f7;
        }

        /* Moderation/User Table Styling */
        .panel .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9em;
        }
        
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ebf4f5;
            height: 60px;
        }

        .data-table th {
            background-color: #f7fafc;
            font-weight: 600;
            color: #4a5568;
        }
        
        .action-link {
            background: none;
            border: 1px solid #4299e1;
            color: #4299e1;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8em;
            margin-right: 5px;
            width: 100px;
            transition: background-color 0.2s, color 0.2s;
            & a{
                color: #4299e1;
                text-decoration: none;
            }
        }
        
        .action-link.delete {
            border-color: #e53e3e;
            color: #e53e3e;
            & a{
                color: red;
                text-decoration: none;
                height: 100%;
                width: 100%;
            }
        }

        .action-button:hover {
            background-color: #4299e1;
            & a{
                color: white;
            }
        }
        
        .action-button.delete:hover {
            background-color: #e53e3e;
            & a{
                color: white;
            }
        }

        /* Quick Actions List */
        .quick-actions-list {
            list-style: none;
            padding: 0;
        }
        
        .quick-actions-list button {
            display: block;
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            text-align: left;
            background-color: #f7fafc;
            border: 1px solid #ebf4f5;
            border-radius: 4px;
            cursor: pointer;
            color: #f4f7f6;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            & a{
                color: #4299e1;
                text-decoration: none;
                height: 100%;
                width: 100%;
            }
        }
        
        .quick-actions-list button:hover {
            background-color: #edf2f7;
            border-color: #a0aec0;
        }
        li{
            font-size: 10px;
            list-style-type: circle;
        }
        }
    </style>
</head>

<body>

    <div class="dashboard-container">

        <aside class="sidebar">
            <div class="logo"><img src="../icons/blog-solid-full.svg" alt="">PeGPeM</div>
            <nav>
                <ul>
                    <li class="active"><a href="#">Dashboard</a></li>
                    <li><a href="more.php">All Content</a></li>
                    <li><a href="view.php">User Accounts</a></li>
                    <li><a href="delete.html">Manage users</a></li>
                    <li><a href="log_in.php">Back</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            
            <header class="header">
                <h1>Admin Overview</h1>
                <div class="admin-info">
                    <div class="admin-avatar">A</div>
                    <span><?php echo "{$info['username']}" ?> Admin</span>
                </div>
            </header>

            <h2 class="section-title" style="border-bottom: none;">Site analytics</h2>
            <section class="stats-grid">
                
                <div class="stat-card">
                    <div class="stat-value"><?php echo $info3 ?></div>
                    <div class="stat-label">Gross blogs</div>
                </div>

                <div class="stat-card critical">
                    <div class="stat-value"><?php echo $info2 ?></div>
                    <div class="stat-label">Users</div>
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-value"><?php echo $info1 ?></div>
                    <div class="stat-label">Cartegories</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value"><?php echo $info4 ?></div>
                    <div class="stat-label">comments</div>
                </div>

            </section>
            
            <section class="content-panels">
                
                <div class="panel">
                    <h2 class="section-title">latest posted blogs</h2>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Post category</th>
                                <th>Date</th>
                                <th> Delete</th>
                                <th> View</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while($info = $result3->fetch_assoc()){?>
                            <tr>
                                <td><?php echo "{$info['id']}"?></td>
                                <td><?php echo "{$info['author']}"?>    </td>
                                <td><?php echo "{$info['title']}"?></td>
                                <td><?php echo "{$info['cartegory']}"?></td>
                                <td><?php echo "{$info['date']}"?></td>
                                <td>
                                    <a href="#" class="action-link delete">Delete</a>
                                </td>
                                <td>
                                    <a href="#" class="action-link">View</a>
                                </td>
                            </tr>
                            <?php }?>

                            
                        </tbody>
                    </table>
                </div>

                <div class="panel">
                    <h2 class="section-title">Quick Actions</h2>
                    <ul class="quick-actions-list">
                        <li><button><a href="">create a blog</a></button></li>

                    </ul>

                    <h2 class="section-title" style="margin-top: 30px; font-size: 15px;">Recent Accounts created</h2>
                    <ol class="quick-actions-list">
                        <li>User "JaneDoe" was approved.</li>
                        <li>Post ID #45 published.</li>
                    </ol>
                </div>
                
            </section>

        </main>
    </div>

</body>
</html>