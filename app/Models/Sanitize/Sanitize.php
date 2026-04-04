<?php
class Sanitizer_model{
    protected static function Sanitize_string(string $string){
        $sanitized_string = is_string($string) ? trim($string) : null;
        $sanitized_string = strip_tags($sanitized_string);
        $sanitized_string = stripcslashes($sanitized_string);
        $sanitized_string = htmlspecialchars($sanitized_string);
        return $sanitized_string;
    }
    protected static function Sanitize_int(int $int){
        $sanitized_int = is_int($int) ? trim($int) : null;
        $sanitized_int = strip_tags($sanitized_int);
        $sanitized_int = stripcslashes($sanitized_int);
        $sanitized_int = htmlspecialchars($sanitized_int);
        return $sanitized_int;
    }
}