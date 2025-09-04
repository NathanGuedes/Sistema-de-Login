<?php

namespace Validators;

use Support\Flash;

class RegisterFormValidator
{
    public static function validate(array $data): bool
    {
        $errors = [];

        foreach($data as $field => $value){
            if (empty($value)){
                Flash::set($field, "$field is required");
                $errors[] = $field;
            }
        }

        if (empty($errors)){

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                Flash::set("email", "Invalid email format");
                $errors[] = $data['email'];
            }

            if ($data['password'] != $data['password_confirm']) {
                Flash::set("password", "Password does not match");
                Flash::set("password_confirm", "Password does not match");
                $errors[] = $data['password'];
            }
        }

        return empty($errors);
    }
}