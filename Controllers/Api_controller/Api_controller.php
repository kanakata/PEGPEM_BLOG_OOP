<?php
namespace Controllers\Api_controller;
use App\Models\Auth\Auth;

class Api_controller extends Auth
{
    public static function Login_api()
    {
        if (isset($_POST['signin'])) {
            parent::loginAuth();
        }
    }
    public static function Post_blog(): array
    {
        return parent::Post_blog();
    }

    public static function Like_comment()
    {
        return parent::Like_comment();
    }
}

