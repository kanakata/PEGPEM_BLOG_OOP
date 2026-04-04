<?php

namespace Controllers\Views_controller;

use App\Models\Query\Query;
use Router\Router;
use Symfony\Component\Routing\Route;

class Views_controller extends Query
{
    public static function General_view_controller()
    {
        return parent::General_view_query();
    }

    public static function More_categories_controller()
    {
        $user_request = "";
        $category = "";
        if(isset($_GET["v"])){
            $user_request = $_GET['v'];
            $category = $_GET['category'] ?? null;
            return parent::More_categories_query($user_request, $category);
        }
    }

    public static function Display_blog(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $id = (int) Router::Unmask_content($id);
            return parent::Blog_query($id);
        }
    }

    public static function Like_comment_controller()
    {
        $id = Router::Unmask_content($_GET["id"]);
        $username = stripslashes($_SESSION['username']);
        $author = stripslashes($_GET['author']);
        return parent::Like_comment_query($id, $author, $username);
    }

    public static function User_dashboard_controller(){
        return parent::User_dashboard_query();
    }
}