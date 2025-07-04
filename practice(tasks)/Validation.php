<?php
namespace Classes;
class Validation {
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword($password) {
        return strlen($password) >= 8;
    }

    public static function validateField($field) {
        return !empty($field);
    }
}