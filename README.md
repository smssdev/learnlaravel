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

-f
--factory
# php artisan make:model Car -f


-s
--seed
# php artisan make:model Car -s


-c
--controller
# php artisan make:model Car -c



# php artisan make:model Car -mc

with migration and controller 

==============

table names ..

protected $table= 'my_tasks';


# Crud Create Read Update Delete 

# php artisan make:controller TaskController

# php artisan make:model Task -mc     model with controller .

الكود الحالي اللي رح نكتبه مش أفضل كود يعني مش أفضل 
clean code ..

==========

# php artisan migrate:fresh
بيحذف الجداول من اول وجديد


# request->all() ابعد عنه مش الخيار الصح 

ممكن يساوي حاله ادمن فنبعد عنه مش صح هذا الكود

ممكن يحدث حاله ويخلي حاله ادمن

نستخدم بدلها
request->only('');


 create() + fillable:
أسهل وأسرع من حيث الكتابة.
مناسب في حالات الإدخال السريع لأكثر من خاصية مرة وحدة.
يجب تحديد fillable لتحديد الحقول المسموح بتمريرها دفعة واحدة.
==================

save() بدون fillable:
لا يحتاج إلى fillable لأنك تعيّن القيم يدويًا لكل خاصية.

آمن جدًا من حيث التحكم، لكنه أطول في الكتابة.

مفيد عندما تحتاج تعالج القيم أو تتحقق منها قبل الحفظ.
===============================================
تريد حفظ النموذج بسرعة بعد ملء عدة خصائص دفعة واحدة	create() + fillable
تريد تحكمًا أكبر أو تعديل القيم قبل الحفظ	save() بدون fillable
تخاف من ثغرات mass assignment أو ما تبي تحدد fillable	save()

نصيحتي: استخدم create() إذا كنت مرتاح وفاهم fillable، أما إذا كنت في بداية تعلم Laravel أو تشتغل على مدخلات حساسة، save() يعطيك تحكم أكبر وأمان أكثر.

====================

 خليني أشرح لك ببساطة ما هي ثغرة الـ Mass Assignment (الإدخال الجماعي) وليش Laravel يحميك منها.

🎯 الفكرة ببساطة:
تخيل عندك نموذج (Model) فيه مجموعة من الخصائص (مثل: name, email, role, is_admin).

ولما تجي تحفظ بيانات من الفورم، ممكن تستخدم الكود التالي:


User::create($request->all());
هذا الكود يعني: "خذ كل البيانات اللي أرسلها المستخدم، وحطها كلها داخل النموذج User وادخلها قاعدة البيانات".

لكن وش المشكلة هنا؟ 🤔

💥 الخطورة:
إذا المستخدم كان ذكي (أو هاكر)، يقدر يعدل البيانات المرسلة للفورم (مثلًا باستخدام أدوات مثل Postman أو أدوات المطور في المتصفح) ويضيف شيء ما كان المفروض يقدر يغيره، مثل:

{
  "name": "Slieman",
  "email": "slieman@example.com",
  "is_admin": true
}
لو ما كنت حامي النموذج، Laravel راح يقبل كل هالبيانات ويدخلها مباشرة!
يعني المستخدم صار "مدير" (admin) لأنه قدر يمرر is_admin: true 😱

💡 هنا يجي دور fillable و guarded
✅ fillable:
تقول فيه: "اسمح فقط لهذي الحقول إنها تُملأ بشكل جماعي".

protected $fillable = ['name', 'email'];
الحين لو أحد حاول يمرر is_admin، Laravel راح يتجاهلها تمامًا. 👮‍♂️

❌ guarded:
العكس، تقول فيه: "لا تسمح بهذه الحقول أبدًا تُملأ بشكل جماعي".

protected $guarded = ['is_admin'];
🎓 خلاصة:

الأسلوب	الحماية	متى تستخدمه؟
$model->fill() أو create()	لازم تستخدم fillable أو guarded	لما تبي إدخال جماعي
$model->name = ...; + save()	آمن تلقائيًا	لما تبي تحكم يدوي بالبيانات
===================


الأفضل في أغلب الحالات:
استخدم create() مع fillable بشكل منظم ومدروس.

ليش؟
الكود أنظف وأقصر.

سهل الصيانة لما الفريق يكبر.

Laravel مبني لدعم الإدخال الجماعي (mass assignment) بأمان باستخدام fillable.

يسرّع التطوير (especially APIs & CRUDs).
=====================================


# php artisan migrate:fresh
# php artisan mi:f

# راجع
https://laravel.com/docs/11.x/validation#available-validation-rules

# 422 Unprocessable Content 
ضمن الفاليديشن الخطأ


# use formRequest.

# php artisan make:request StoreTaskRequest


# php artisan make:controller TaskController --api

