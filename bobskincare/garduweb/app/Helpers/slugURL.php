<?php

class Slug
{

    public static function textToSlug($text = '')
    {
        $text = trim($text);
        if (empty($text)) return '';
        $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
        $text = strtolower(trim($text));
        $text = str_replace(' ', '-', $text);
        $text = preg_replace('/\-{2,}/', '-', $text);
        return $text;
    }

    //input: selamat datang di garduweb
    //output: selamat-datang-di-garduweb

    public static function slugToText($slug = '')
    {
        $slug = trim($slug);
        if (empty($slug)) return '';
        $slug = str_replace('-', ' ', $slug);
        // $slug = ucwords($slug);
        $slug = strtolower($slug);
        return $slug;
    }

    //input: selamat-datang-di-garduweb
    //output: selamat datang di garduweb

    public static function cleanNumber($number = '')
    {
        $number = trim($number);
        if (empty($number)) return '';
        $number = preg_replace("/[^0-9\-\s]+/", "", $number);
        // $number = strtolower(trim($number));
        $number = str_replace(' ', '', $number);
        $number = str_replace('.', '', $number);
        $number = preg_replace('/\-{2,}/', '', $number);
        return $number;
    }

    //input: selamat datang 23
    //output: 23
}
