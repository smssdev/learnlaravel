# أمور لازم نتعلمها

# Eloquent ORM
# Artisan Console
# MVC Architecture
# Security Tools


# Api = Application Programming Interface

================================================

# PHP

# Variable
# Conditional Statments
# Loops
# Arrays
# Functions

<?php 
    echo "Hello, world";
    $name = "test";
    $age = 29;
    $Age= 17;
    echo $name;
    if($age>10) {
        echo "Your age greater than 18";
    }
    else {
        echo "Your age not greater than 18";
    }

    for($i=0; $i<5;$i++) {
        echo "The number is : " . $i;   the number is 0 the number is1 the number is 2 the number is 3 the number is 4
    }

    $names= ["omar", "firas", "majd"];

    echo $names[1];

    function sayHello() {
        echo "Hello !";
    }

    sayHello();
    SayHello();


    php not sensetive for fucntion.
    For variable sensetive.


?>


================================

# need to install larvel

# Xampp Or Laragon php: 8.2

# Laravel V.11
From relase notes
11	8.2 - 8.4	March 12th, 2024	September 3rd, 2025	March 12th, 2026 


# from php.ini 
# extenstion=zip
ابحث عنه 
لو عليه ; 
احذفها 
يعني فعلها


# php -v يعطيك نسخة ال php


# install compser حتى تنزل packages of laravel .

# vscode محرر أكواد

===============================================

تنزيل مشروع لارافيل


# composer create-project laravel/laravel:11 test

composer create-project laravel/laravel:11 TaskManager




# MVC Model View Controller 

Controller -> request  عن طريق ال route == اليوزر اللي ببعت الركويست
Model -> بنبعت داتا اللي هي داتا بيز اللي هي من خلال model 
ضمن الموديل بكون العلاقات كلها، هي أساس التعامل مع الداتابيز 
View -> عرض الصفحات ، كباك اند ما بيلزم ، ممكن اعتبره ال json هو اللي بيرجع response 

او صفحات blade 
==============

كل جدول ممكن يكون اله model

فيه معايير معينة 

-----------------

# php artisan make:model Task

الجدول جمع 
الموديل مفرد

============

Elequent ORM :

-m 
--migration 

# php artisan make:model Car -m 

عمل موديل مع المايجريشن تبعها

