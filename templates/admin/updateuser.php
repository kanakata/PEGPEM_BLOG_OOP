<?php
include '../bk_end/db_connect.php';
include '../bk_end/login_check.php';

// Fetch current user data
$sql = "SELECT * FROM login WHERE username = ?";
$stmt = $db_connect->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_assoc();

$error_message = "";

if (isset($_POST['update'])) {
    $old_pass_input = $_POST['old_password']; 
    $new_name       = trim($_POST['newfullname']);
    $new_email      = trim($_POST['newemail']);
    $new_password   = $_POST['newpassword'];
    $confirm_pass   = $_POST['confirm-new-password'];
    $current_user   = $_SESSION['username']; // The original username before update

    if (password_verify($old_pass_input, $info['password'])) {
        if ($new_password === $confirm_pass) {
            $hashed_pass = password_hash($new_password, PASSWORD_DEFAULT);

            // --- START TRANSACTION ---
            // Using a transaction ensures both tables update or neither do (prevents data mismatch)
            $db_connect->begin_transaction();

            try {
                // 1. Update the 'login' table
                $upd_login = $db_connect->prepare("UPDATE login SET username=?, email=?, password=? WHERE username=?");
                $upd_login->bind_param("ssss", $new_name, $new_email, $hashed_pass, $current_user);
                $upd_login->execute();

                // 2. Update the 'blogs' table (update author column)
                // We use $current_user to find the blogs and $new_name to set the new author
                $upd_blogs = $db_connect->prepare("UPDATE blogs SET author=?, username=? WHERE author=?");
                $upd_blogs->bind_param("sss", $new_name, $new_name, $current_user);
                $upd_blogs->execute();

                // If both queries worked, commit the changes
                $db_connect->commit();

                // Update session and redirect
                $_SESSION['username'] = $new_name;
                header("Location: userdash.php?status=updated");
                exit();

            } catch (Exception $e) {
                // If anything fails, undo the changes
                $db_connect->rollback();
                $error_message = "Update failed: " . $e->getMessage();
            }
        } else {
            $error_message = "New passwords do not match.";
        }
    } else {
        $error_message = "Current password incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Your Account Details</title>
    <style>
        :root {
            --primary-color: orangered;
            --background-color: #e9ecef; 
            --card-background: #ffffff;
            --text-color: #333;
            --border-color: #ced4da;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 3%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--background-color);
        }

        .signup-container {
            width: 450px;
            padding: 20px;
            background-color: var(--card-background);
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .signup-container h2 {
            margin-bottom: 20px;
            color: var(--primary-color);
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
            font-size: 0.95em;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .signup-button {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.15em;
            font-weight: 600;
            transition: 0.3s;
        }

        .signup-button:hover {
            background-color: #d13d00;
        }

        .error-msg {
            color: #d9534f;
            background: #f2dede;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <div class="signup-container">
        <h2>Update Profile</h2>

        <?php if($error_message): ?>
            <div class="error-msg"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Current Username: <strong><?php echo htmlspecialchars($info['username']); ?></strong></label>
            </div>

            <div class="form-group">
                <label for="old_password">Current Password (Required)</label>
                <input type="password" name="old_password" placeholder="Enter current password" required>
            </div>

            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
            <h3>New Credentials</h3>

            <div class="form-group">
                <label for="newfullname">New Name</label>
                <input type="text" name="newfullname" value="<?php echo htmlspecialchars($info['username']); ?>" required>
            </div>

            <div class="form-group">
                <label for="newemail">New Email Address</label>
                <input type="email" name="newemail" value="<?php echo htmlspecialchars($info['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="newpassword">New Password</label>
                <input type="password" name="newpassword" placeholder="Leave blank to keep old" required>
            </div>

            <div class="form-group">
                <label for="confirm-new-password">Confirm New Password</label>
                <input type="password" name="confirm-new-password" placeholder="Re-enter new password" required>
            </div>

            <input type="submit" value="Update Profile" class="signup-button" name="update">
        </form>

        <div style="margin-top: 20px;">
            <a href="userdash.php" style="color: var(--primary-color); text-decoration: none;">Cancel and Go Back</a>
        </div>
    </div>

</body>
</html>