<?php
namespace Router;
class Router
{
    public static function View()
    {
        $root_folder = "/templates/";
        $extension = ".php";
        if (isset($_GET['p'])) {

            $page = $_GET['p'];
            $allowed_pages = [
                "admindash",
                "updateuser",
                "view",
                "landing",
                "signin",
                "register",
                "contentpage",
                "like_comment",
                "more",
                "morecategories",
                "search_output",
                "userdash",
                "userlandingpage",
                "landing",
                "postblog",
            ];
            $utils_pages = [
                "landing",
                "postblog",
            ];
            $user_pages = [
                //user pages
                "contentpage",
                "like_comment",
                "more",
                "morecategories",
                "search_output",
                "userdash",
                "userlandingpage",
            ];
            $auth_pages = [
                "signin",
                "register",
            ];
            $admin_pages = [
                "admindash",
                "updateuser",
                "view",
            ];
            if (in_array($page, $allowed_pages)) {
                //continue to load the page
                if (in_array($page, $utils_pages)) {
                    $folder = "utils/";
                } elseif (in_array($page, $user_pages)) {
                    $folder = "user/";
                } elseif (in_array($page, $auth_pages)) {
                    $folder = "auth/";
                } elseif (in_array($page, $admin_pages)) {
                    $folder = "admin/";
                }


                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $unmasked_id = self::Unmask_content($id);
                    if($unmasked_id == ""){
                        $folder = "/public/";
                        return require_once ROOT . $folder . "404" . $extension;
                    }
                }
                return require_once ROOT . $root_folder . $folder . $page . $extension;
            } else {
                // Handle invalid page request
                $folder = "/public/";
                return require_once ROOT    . $folder . "404" . $extension;
            }

        } else {
            $folder = "utils/";
            $file = "landing";
            return require_once ROOT . $root_folder . $folder . $file . $extension;
        }
    }
    public static function Mask_content($content)
    {
        // To Encrypt
        // $content = (string) $content;
        // $key = "your-secret-key-keep-it-safe";
        // $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // $encrypted = openssl_encrypt($content, 'aes-256-cbc', $key, 0, $iv);
        $encrypted = base64_encode($content);
        return $encrypted;
    }
    public static function Unmask_content($encrypted_content)
    {
        // To Decrypt (Convert back to text)
        // $key = "your-secret-key-keep-it-safe";
        // $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // $decrypted = openssl_decrypt($encrypted_content, 'aes-256-cbc', $key, 0, $iv);
        $decrypted = base64_decode($encrypted_content);
        return $decrypted;
    }
}