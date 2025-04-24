# File -> Prefences -> Theme -> color Theme 
# Light Modern

#  File -> Prefences -> Theme -> File icon Theme 
# Material Icon

#  File -> Prefences -> Theme -> Product icon Theme  
# Emoji product icons
====================================

# routes -> web.php

-------------------------------------

#  Thunder Client and Testing First API Route 

مثل post man
--------------------------

# to install route api.php 

# from Doc -> Basics 

# php artisan install:api

=================================

Route::get()
Route::post ..

# http://localhost:8000/api/welcome 

=========================

# php artisan list

====================

# next we will use controllers ..


# php artisan make:controller UserController
# php artisan make:controller WelcomeController

=======================

# JSON 
# خفيف وسريع ومتوافق مع لغات البرمجة js,php, paython ,, etc.. 
# تستخدم لنقل البيانات، لبناء ال api's

# JSON JavaScript Object Rotation

{
    "name": "Mohammed",
    "age": 20,
    isAvaliable: true,
    Array: ["car", "boat"]
}
as 
key : value
===============


# convert text to json.

===========

# HP status code

# 404 = not found 

تخسن تجربة المستخدم
توضح الريسبونس الراجع
سهولة التصحيح 
سبب فشل الطلب يتم معرفته بسهولة

الأرقام كلها 3 خانات

# 200 = success
# 201 = created
# 204 = No content : تم تنفيذ الطلب بدون بيانات ، أسرع من 201 ، مثل الحذف كود سريع جدا

# 400= Bad request: طلب غير صالح مثل بعتت رقم وهو طالب نص مثلأ
# 401= UnAuthorization : المصادفة غير صحيحة، مثل طلب بيانات ليوزر مش مسجل دخول
# 403= Forbiden : ليس لديك إذن وصول إلى المورد
# 404= not found: مكان غير موجود
# 500= Internal server error : خطأ سيرفر، خطأ باك اند ، خطأ عام في الخادم


