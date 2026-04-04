<?php

namespace App\Models\Auth;

use App\Models\Query\Query;

abstract class Auth extends Query
{
    protected static function Sign_out(): void
    {
        session_start();
        session_destroy();
    }
    protected static function loginAuth(): void
    {
        parent::Signin_query();
    }
    protected static function signinAuth(): void
    {
        parent::Register_query();
    }

    protected static function Post_blog(): array
    {
        if (isset($_POST['post'])) {
            parent::Blog_upload_query();
        }
        return [];
    }
    protected static function Edit_blog(): array
    {
        if (isset($_POST['edit_blog'])) {
            parent::Blog_edit_query();
        }
        return [];
    }

    protected static function Like_comment()
    {
        if (isset($_GET[''])) {
        }
    }
}
