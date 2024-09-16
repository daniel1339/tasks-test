<?php

class Validation {
    
    public static function required($value) {
        return !empty(trim($value));
    }

    
    public static function minLength($value, $min) {
        return strlen(trim($value)) >= $min;
    }
    
   
}