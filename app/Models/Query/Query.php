<?php

namespace App\Models\Query;

use PDO;
use App\Models\Database\Database;

abstract class Query extends Database
{
    private static $db_connect = null;
    protected static function Signin_query(): void
    {
        self::$db_connect = parent::db_connect("blogsitedb");
        if (isset($_POST['signin']) || isset($_POST['password']) || isset($_POST['username'])) {
            // 1. Capture inputs
            $username = trim($_POST['username']) ?? "";
            echo $username;
            $password = $_POST['password'] ?? "";
            echo $password;
            if (!empty($username) && !empty($password)) {
                $stmt = self::$db_connect->prepare("SELECT `username`, `password`, `usertype` FROM login WHERE `username` = ?");
                $stmt->execute([$username]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                unset($stmt);
                echo "<script> alert('hello')</script>";

                if ($result) {
                    // 3. Verify the password (assuming you use password_hash() to store them)
                    if (password_verify($password, $result['password'])) {
                        $_SESSION['username'] = $result['username'];
                        $_SESSION['usertype'] = $result['usertype'];

                        // 4. Redirect based on usertype
                        if ($result['usertype'] == 'blogger') {
                            header("Location: ?p=" . "userlandingpage");
                            exit();
                        } else if ($result['usertype'] == 'admin') {
                            header("Location: ?p=" . "admindash");
                            exit();
                        }
                    }
                }

                // Set a session variable to indicate the user came from the login page
                $_SESSION['came_from_login'] = true;
                // 5. Generic error message for security (don't reveal if user exists)
                $_SESSION['error_message'] = "Invalid username or password.";
                header("Location: ");
                exit();
            }
        } else {
        }
    }
    protected static function Register_query(): void
    {
        // Check if the user actually clicked the "sign up" button
        if (isset($_POST['register']) && $_POST['register'] == 'Create Account' || isset($_POST['confirmpassword'])) {

            // 1. Get data from the form
            $username = trim($_POST['username']);
            $email    = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm  = $_POST['confirmpassword'];

            // 2. Validation: Check if any fields are empty
            if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
                header("Location: signup_page.php?error=emptyfields");
                exit();
            }
            // Check if passwords match
            elseif ($password !== $confirm) {
                header("Location: signup_page.php?error=passwordmatch&username=" . $username);
                exit();
            } else {
                // 3. Check if the Username or Email is already taken
                $sql = "SELECT username FROM login WHERE username=?";
                $stmt = self::$db_connect->prepare($sql);
                $stmt->execute([$username]);

                if ($stmt->num_rows > 0) {
                    header("Location: signup_page.php?error=usertaken");
                    exit();
                } else {
                    // 4. SECURITY: Hash the password
                    // Do NOT store plain text passwords. This encrypts it.
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // 5. Insert the new user into the database
                    $insert_sql = "INSERT INTO login (username, email, password, usertype) VALUES (?, ?, ?, ?)";
                    $insert_stmt = self::$db_connect->prepare($insert_sql);
                    $usertype = 'blogger'; // Default usertype
                    $insert_stmt->bind_param("ssss", $username, $email, $hashedPassword, $usertype);

                    if ($insert_stmt->execute()) {
                        // 6. Success: Set the session and go to the landing page
                        header("Location: log_in.php");
                        exit();
                    } else {
                        header("Location: signup_page.php?error=sqlerror");
                        exit();
                    }
                }
            }

            // Close statements and connection


        } else {
            // Redirect back if they try to access the script directly
            header("Location: signup_page.php");
            exit();
        }
    }
    protected static function General_view_query(): array
    {
        self::$db_connect = parent::db_connect("blogsitedb");
        //configs
        $days_to_subtract = 1000;
        $current_timestamp = time();
        $past_timestamp = $current_timestamp - ($days_to_subtract * 86400);
        $formatted_date = date('Y-m-d', $past_timestamp);
        $current_date = date('y-m-d');
        $hot_blogs_date_limit = 1000;
        $past_timestamp2 = $current_timestamp - ($hot_blogs_date_limit * 86400);
        $formatted_date2 = date('Y-m-d', $past_timestamp2);

        //fetch slider content using pdo
        $hot_blogs = 5;
        $sql = "SELECT * FROM blogs  WHERE date BETWEEN '$formatted_date2' AND '$current_date' LIMIT ? ";
        $sql = self::$db_connect->prepare($sql);
        $sql->bindParam(1, $hot_blogs, \PDO::PARAM_INT);
        $sql->execute();
        $slider_content = $sql->fetchAll(PDO::FETCH_ASSOC);
        unset($sql);

        //trending
        $stmt = "SELECT * FROM blogs WHERE date  BETWEEN '$formatted_date' AND '$current_date'  LIMIT 6 ";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute();
        $trending = $stmt->fetchAll(PDO::FETCH_ASSOC);
        unset($stmt);

        //categories
        $stmt = "SELECT DISTINCT cartegory FROM blogs ";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        unset($stmt);

        //blogs
        $stmt = "SELECT * FROM blogs WHERE likes = 0 LIMIT 6 ";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute();
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        unset($stmt);

        //editors pic
        $stmt = "SELECT * FROM blogs WHERE date BETWEEN '$formatted_date' AND '$current_date' LIMIT 5 ";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute();
        $editors_pic = $stmt->fetchAll(PDO::FETCH_ASSOC);
        unset($stmt);

        //all categories
        $sql_query = "SELECT DISTINCT cartegory FROM blogs";
        $stmt = self::$db_connect->prepare($sql_query);
        $stmt->execute();
        $all_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        unset($stmt);

        //footer
        $stmt = "SELECT DISTINCT cartegory FROM blogs";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute();
        $footer = $stmt->fetchAll(PDO::FETCH_ASSOC);
        unset($stmt);

        return [
            "slider_content" => $slider_content,
            "trending" => $trending,
            "categories" => $categories,
            "top_blogs" => $blogs,
            "editors_pic" => $editors_pic,
            "footer" => $footer,
            "all_categories" => $all_categories,
        ];
    }
    protected static function More_categories_query($request, $view = ""): array
    {
        self::$db_connect = parent::db_connect("blogsitedb");
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $result_per_page = 8;
        $offset = ($page - 1) * $result_per_page;
        $pname = "";
        $count_sql = "";
        $data_sql = "";
        $bind_types = "";
        $bind_values = [];
        $query_param = "";

        // 1. Identify context and build queries
        if ($request === "moreblogs") {
            $pname = "More blogs for you";
            $count_sql = "SELECT COUNT(*) FROM blogs";
            $data_sql = "SELECT * FROM blogs LIMIT $offset, $result_per_page";
            $stmt_data = self::$db_connect->prepare($data_sql);
            $stmt_data->execute();
            $stmt_count = self::$db_connect->prepare($count_sql);
            $stmt_count->execute();
        } elseif ($request === "category") { // Simplified check
            $category = $view;
            $pname = $category;
            $count_sql = "SELECT COUNT(*) FROM blogs WHERE cartegory = ?";
            $data_sql = "SELECT * FROM blogs WHERE cartegory = ? LIMIT $offset, $result_per_page";
            $stmt_data = self::$db_connect->prepare($data_sql);
            $stmt_data->execute([$category]);
            $stmt_count = self::$db_connect->prepare($count_sql);
            $stmt_count->execute([$category]);
        } elseif ($request === "allpost") {
            $username = $_SESSION['username'] ?? null; // Handle null session cases
            $pname = "All your posts";
            $stmt_count = self::$db_connect->prepare("SELECT COUNT(*) FROM blogs WHERE author = ?");
            $stmt_count->execute([$username]);
            $data_sql = "SELECT * FROM blogs WHERE author = ? LIMIT ?, ?";
            $stmt_data = self::$db_connect->prepare($data_sql);
            $stmt_data->bindValue(1, $username, PDO::PARAM_STR);
            $stmt_data->bindValue(2, (int)$offset, PDO::PARAM_INT);
            $stmt_data->bindValue(3, (int)$result_per_page, PDO::PARAM_INT);
            $stmt_data->execute();
        } else {
            // Default fallback if no valid parameters are passed
            $pname = "All Website's Blogs";
            $count_sql = "SELECT COUNT(*) FROM blogs";
            $data_sql = "SELECT * FROM blogs LIMIT ?, ?";
            $stmt_data = self::$db_connect->prepare($data_sql);
            $stmt_data->execute([$offset, $result_per_page]);
            $stmt_count = self::$db_connect->prepare($count_sql);
            $stmt_count->execute();
        }

        // Count Query
        $total = $stmt_count->fetchColumn();
        unset($stmt_count);
        $pages_no = ceil($total / $result_per_page);
        // result Query
        $content = $stmt_data->fetchAll(PDO::FETCH_ASSOC);
        unset($stmt_data);

        // $stmt = self::$db_connect->prepare($stmt);
        // $stmt->execute();
        // $resultc = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // unset($stmt);

        return [
            "content" => $content,
            "page_description" => $pname,
            "pages_number" => $pages_no,
            "page" => $page,
        ];
    }
    protected static function Blog_query(int $blogId): array
    {
        self::$db_connect = parent::db_connect("blogsitedb");
        $stmt = "SELECT * FROM blogs WHERE id = ? ";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->bindParam(1, $blogId);
        $stmt->execute();
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($stmt);
        return [
            "blog" => $blog,
        ];
    }
    protected static function User_dashboard_query(): array
    {
        self::$db_connect = parent::db_connect("blogsitedb");
        if (!isset($_SESSION['username'])) {
            // User is not logged in or not a blogger, redirect to index page
            header("Location: ?p=" . "landing");
            exit();
        }

        //username
        $sql = "SELECT * FROM login WHERE username = ?";
        $sql = self::$db_connect->prepare($sql);
        $sql->execute([$_SESSION['username']]);
        $username = $sql->fetch(PDO::FETCH_ASSOC);
        unset($sql);

        //total blogs
        $stmt = "SELECT COUNT(DISTINCT id) FROM blogs WHERE author = ?";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute([$_SESSION['username']]);
        $total_blogs = $stmt->fetchColumn();
        unset($stmt);

        //total likes
        $stmt = "SELECT COUNT(likes) FROM blogs WHERE username = ?";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute([$_SESSION['username']]);
        $total_likes = $stmt->fetchColumn();
        unset($stmt);

        //total comments
        $stmt = "SELECT COUNT(comment) FROM comments_and_likes WHERE author= ? ";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute([$_SESSION['username']]);
        $total_comments = $stmt->fetchColumn();
        unset($stmt);


        //total categories
        $stmt = "SELECT COUNT(DISTINCT cartegory) FROM blogs WHERE author = ? ";
        $stmt = self::$db_connect->prepare($stmt);
        $stmt->execute([$_SESSION['username']]);
        $total_categories = $stmt->fetchColumn();
        unset($stmt);

        //recent blogs
        $username = $_SESSION['username'];
        $days_to_subtract = 1000;
        $current_timestamp = time();
        $past_timestamp = $current_timestamp - ($days_to_subtract * 86400);
        $formatted_date = date('Y-m-d', $past_timestamp);
        $current_date = date('y-m-d');

        $sql = "SELECT * FROM blogs WHERE author=? AND date BETWEEN '$formatted_date' AND '$current_date' LIMIT 4 ";
        $sql = self::$db_connect->prepare($sql);
        $sql->execute([$_SESSION['username']]);
        $recent_blog = $sql->fetchAll(PDO::FETCH_ASSOC);
        unset($stmt);

        return [
            "total_comments" => $total_comments,
            "total_likes" => $total_likes,
            "total_categories" => $total_categories,
            "total_blogs" => $total_blogs,
            "username" => $username,
            "recent_blog" => $recent_blog,
        ];
    }
    protected static function Blog_upload_query(): void
    {
        self::$db_connect = parent::db_connect("blogsitedb");

        // 2. HELPER FUNCTION: Secure Image Upload
        function uploadImage($fileKey, $folder, &$alert)
        {
            if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
                $target_dir = $folder . "/";
                if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime_type = $finfo->file($_FILES[$fileKey]['tmp_name']);
                $allowed = ['image/jpeg', 'image/png', 'image/gif'];

                if (in_array($mime_type, $allowed)) {
                    $ext = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
                    $filename = bin2hex(random_bytes(10)) . '.' . $ext;
                    if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $target_dir . $filename)) {
                        return $filename;
                    }
                } else {
                    $alert = "Invalid file type for $fileKey.";
                }
            }
            return null;
        }

        // 3. HANDLE NEW POST SUBMISSION
        if (isset($_POST['post'])) {
            $blog_img = uploadImage('blogimage', 'header images', $alert) ?? 'default.png';
            $auth_img = uploadImage('authorimage', 'profilepicture', $alert) ?? 'default.png';

            $sql = "INSERT INTO blogs (author, title, description, cartegory, message, blogImage, authorImage, 
            content1title, content1, content2title, content2, content3title, content3, content4title, content4, content5title, content5) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $db_connect->prepare($sql);
            $stmt->bind_param(
                "sssssssssssssssss",
                $username,
                $_POST['title_1'],
                $_POST['description_1'],
                $_POST['category'],
                $_POST['author_message'],
                $blog_img,
                $auth_img,
                $_POST['title1'],
                $_POST['content1'],
                $_POST['title2'],
                $_POST['content2'],
                $_POST['title3'],
                $_POST['content3'],
                $_POST['title4'],
                $_POST['content4'],
                $_POST['title5'],
                $_POST['content5']
            );

            if ($stmt->execute()) {
                $message = "Blog posted successfully!";
            } else {
                $alert = "Error posting blog.";
            }
            $stmt->close();
        }
    }
    protected static function Blog_edit_query(): void
    {
        // 1. FETCH USER INFO & SECURITY CHECK
        $username = $_SESSION['username'];
        $stmt = self::$db_connect->prepare("SELECT * FROM login WHERE username = ?");
        $stmt->execute([$username]);
        $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($stmt);

        // 4. HANDLE EDIT MODE (FETCH DATA)
        $edit_mode = false;
        $id = 0;
        $data = array_fill_keys(['title', 'description', 'cartegory', 'message', 'content1title', 'content1', 'content2title', 'content2', 'content3title', 'content3', 'content4title', 'content4', 'content5title', 'content5'], '');

        if (isset($_GET['id']) && isset($_GET['edit']) && $_GET['edit'] == 'edit_blog') {
            $id = intval($_GET['id']);
            $stmt = $db_connect->prepare("SELECT * FROM blogs WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($row = $res->fetch_assoc()) {
                // SECURITY: Only allow the author to edit
                if ($row['author'] === $username) {
                    $data = $row;
                    $edit_mode = true;
                } else {
                    die("Unauthorized Access.");
                }
            }
            $stmt->close();
        }

        // 5. HANDLE UPDATE SUBMISSION
        if (isset($_POST['edit_post'])) {
            $id = intval($_POST['blog_id']);
            // Verify ownership one last time
            $stmt = $db_connect->prepare("UPDATE blogs SET title=?, description=?, cartegory=?, message=?, content1title=?, content1=?, content2title=?, content2=?, content3title=?, content3=?, content4title=?, content4=?, content5title=?, content5=? WHERE id=? AND author=?");
            $stmt->bind_param(
                "ssssssssssssssis",
                $_POST['title_1'],
                $_POST['description_1'],
                $_POST['category'],
                $_POST['author_message'],
                $_POST['title1'],
                $_POST['content1'],
                $_POST['title2'],
                $_POST['content2'],
                $_POST['title3'],
                $_POST['content3'],
                $_POST['title4'],
                $_POST['content4'],
                $_POST['title5'],
                $_POST['content5'],
                $id,
                $username
            );
            if ($stmt->execute()) {
                header("Location: userdash.php?msg=updated");
                exit();
            }
        }
    }
    protected static function Like_comment_query($id, $blog_author, $account_username)
    {
        self::$db_connect = parent::db_connect("blogsitedb");

        // 1. Handle Actions (State Changes)
        self::handle_actions($id, $blog_author, $account_username);

        // 2. Fetch Aggregates
        $sql_stats = "SELECT 
                    SUM(CASE WHEN comment IS NOT NULL THEN 1 ELSE 0 END) AS total_comments, 
                    SUM(likes) AS total_likes,
                    MAX(CASE WHEN username = ? AND likes = 1 THEN 1 ELSE 0 END) AS user_has_liked,
                    MAX(CASE WHEN username = ? AND comment IS NOT NULL THEN 1 ELSE 0 END) AS user_has_comment
                  FROM comments_and_likes 
                  WHERE blogid = ? AND author = ?";

        $stmt_st = self::$db_connect->prepare($sql_stats);
        $stmt_st->execute([$account_username, $account_username, $id, $blog_author]);
        $stats = $stmt_st->fetch(PDO::FETCH_ASSOC);

        // 3. Fetch Comment List
        $sql_list = "SELECT * FROM comments_and_likes WHERE blogid = ? AND comment IS NOT NULL ORDER BY id DESC";
        $stmt_list = self::$db_connect->prepare($sql_list);
        $stmt_list->execute([$id]);

        return [
            "user_has_liked"   => $stats['user_has_liked'] ?? 0,
            "user_has_comment" => $stats['user_has_comment'] ?? 0,
            "likes"            => $stats['total_likes'] ?? 0,
            "total_comments"   => $stats['total_comments'] ?? 0,
            "all_comments"     => $stmt_list->fetchAll(PDO::FETCH_ASSOC),
        ];
    }
    private static function handle_actions($id, $author, $username)
    {
        // Handle Like (Now via POST for safety)
        if (isset($_POST['action']) && $_POST['action'] === 'like') {
            $sql = "INSERT INTO comments_and_likes (blogid, author, username, likes) 
                VALUES (?, ?, ?, 1) 
                ON DUPLICATE KEY UPDATE likes = 1";
            self::$db_connect->prepare($sql)->execute([$id, $author, $username]);
        }

        // Handle Comment
        if (!empty($_POST['comment'])) {
            $content = trim($_POST['comment']);
            $sql = "INSERT INTO comments_and_likes (blogid, author, username, comment) VALUES (?, ?, ?, ?)";
            self::$db_connect->prepare($sql)->execute([$id, $author, $username, $content]);
        }
    }
    protected static function Search_query($search_query){
        self::$db_connect = parent::db_connect("blogsitedb");
        $input = $search_query;

        $page = $_GET['page'] ?? 1;
        $search_term = "%" . $input . "%";
     
        $sql = "SELECT COUNT(*) FROM blogs  WHERE title LIKE ? OR author LIKE ? OR description LIKE ? OR cartegory LIKE ? OR content1title LIKE ?  OR content2title LIKE ?  OR content3title LIKE ? OR content4title LIKE ? OR content5title LIKE ?";
        $sql = self::$db_connect->prepare($sql);
        $sql->bindParam(1, $search_term);
        $sql->bindParam(2, $search_term);
        $sql->bindParam(3, $search_term);
        $sql->bindParam(4, $search_term);
        $sql->bindParam(5, $search_term);
        $sql->bindParam(6, $search_term);
        $sql->bindParam(7, $search_term);
        $sql->bindParam(8, $search_term);
        $sql->bindParam(9, $search_term);
        $sql->execute();
        $total = $sql->fetchColumn();
        unset($sql);
     
        $result_per_page = 8;
        $pages_no = ceil($total / $result_per_page); 
        $offset = ($page - 1) * $result_per_page ?? 0;
        
     
        $stmt = "SELECT * FROM blogs  WHERE title LIKE ? OR author LIKE ? OR description LIKE ? OR cartegory LIKE ? OR content1title LIKE ?  OR content2title LIKE ?  OR content3title LIKE ? OR content4title LIKE ? OR content5title LIKE ? ORDER BY date DESC LIMIT $offset, $result_per_page";
        $sql = self::$db_connect->prepare($stmt);
        $sql->bindParam(1, $search_term);
        $sql->bindParam(2, $search_term);
        $sql->bindParam(3, $search_term);
        $sql->bindParam(4, $search_term);
        $sql->bindParam(5, $search_term);
        $sql->bindParam(6, $search_term);
        $sql->bindParam(7, $search_term);
        $sql->bindParam(8, $search_term);
        $sql->bindParam(9, $search_term);
        $sql->execute();
        $search_result = $sql->fetchAll(PDO::FETCH_ASSOC);
        unset($sql);
     
        // $stmt = "SELECT DISTINCT cartegory FROM blogs ";
        // $stmt = $db_connect->prepare($stmt);
        // $stmt->execute();
        // $resultc = $stmt->get_result();
        // $stmt->close();

        return [
            "search_output" => $search_result,
            "pages_no" => $pages_no,
            "page" => $page,
        ];
    }
}