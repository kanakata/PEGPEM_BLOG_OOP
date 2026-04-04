<?php


include '../bk_end/db_connect.php';

//count all messages
$sql = "SELECT COUNT(username) FROM login WHERE usertype='blogger'";
$sql = $db_connect->prepare($sql);
$sql->execute();
$result = $sql->get_result();
$sql->close();
$total = $result->fetch_array()[0];


$page = $_GET['page'] ?? 1;
$result_per_page = 1;

$pages_no = ceil($total/$result_per_page);

$offset = ceil( ($page - 1) * $result_per_page);

$sql = "SELECT * FROM login WHERE usertype='blogger' LIMIT $offset, $result_per_page";
$sql = $db_connect->prepare($sql);
$sql->execute();
$result = $sql->get_result();
$sql->close();



?>
<?php require_once "header.php" ?>
    <style>
        /* CSS for the Admin User Details Table */

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
        }
        
        .user-table-container {
            overflow-x: auto;
            margin-top: 10px;
        }
        a{
            color: orangered;
            text-transform: capitalize;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse; /* Removes spaces between borders */
            margin: 20px 0;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        /* Style for the table header */
        .admin-table th {
            background-color: orangered; /* Green background */
            color: white;
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        /* Style for table rows */
        .admin-table td {
            padding: 10px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        /* Zebra-striping for readability */
        .admin-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        /* Hover effect */
        .admin-table tbody tr:hover {
            background-color: #ddd;
            cursor: pointer;
        }
        /* Style for the Status column to show it clearly */
        .admin-table .status-active {
            color: #28a745; /* Dark Green for Active */
            font-weight: bold;
        }
        .admin-table .status-inactive {
            color: #dc3545; /* Red for Inactive */
            font-weight: bold;
        }
        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px 0;
            margin-top: 0px;
        }
        .pagination a {
            color: #333;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
            border-radius: 4px;
        }
        .pagination a:hover:not(.active) { background-color: #f2f2f2; }
        .pagination a.active {
            background-color: orangered; /* Active page color */
            color: white;
            border: 1px solid orangered;
        }
        .pagination a.disabled {
            pointer-events: none;
            cursor: default;
            color: #ccc;
            border-color: #eee;
        }
        .viewtitle{
            width: 100%;
            text-align: center;
            font-weight: bolder;
            font-size: 25px;
        }
    </style>
</head>
<body>



    <h2 class="viewtitle">User Details📋</h2>

    <div class="user-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>User type</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php while($info = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo "{$info['id']}" ?></td>
                    <td><?php echo "{$info['username']}" ?></td>
                    <td><?php echo "{$info['email']}" ?></td>
                    <td><?php echo "{$info['usertype']}" ?></td>
                    <td>2025-12-10 14</td>
                    <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
                </tr>
                <?php }?>

                
            </tbody>
        </table>


        <div class="pagination">

        

      
      <?php if ($pages_no > 1): ?>

        <div class="pagination">

            <?php $prev_page = $page - 1; $prev_class = $page <= 1 ? 'disabled' : '';?>
            <a href="?page=<?php echo $prev_page; ?>" class="<?php echo $prev_class; ?>">Previous</a>

            <?php for ($i = 1; $i <= $pages_no; $i++) {$active_class = $i == $page ? 'active' : '';?>
            <a href="?page=<?php echo $i ; ?>" class="<?php echo $active_class; ?>"><?php echo $i; ?></a>
            <?php }?>

            <?php $next_page = $page + 1; $next_class = $page >= $pages_no ? 'disabled' : '';?>
            <a href="?page=<?php echo $next_page; ?>" class="<?php echo $next_class; ?>">Next</a>


        </div>
        <?php endif; ?>

    </div>

</body>
</html>