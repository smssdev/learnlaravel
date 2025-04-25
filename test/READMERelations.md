# one to one 

# Users Table
id (PK)
name
email
password

# Profile Table
id (PK)
phone
address
date_of_birth
bia
user_id (FK)

# Tasks Table
id (PK)
title
description
priority

كل يوزر له بروفايل واحد
مرتبط باليوزر الخاص بك

# php artisan make:model Profile -mc

===========================================

Users PK ==> hasOne Profile
Profile FK ==> belongsTo one User
=====================

# 1 to many 

كثير استخدامها

كل مدير اله عدد من الموظفين

كل موظف له مدير واحد
---------------------
كاتب واحد بيكتب أكثر من كتاب ممكن يكون له مجموعة كتب
كل كتاب بيتبع لكاتب واحد
=======================
أستاذ عنده طلاب كثير
كل طالب بينتمي لنفس الأستاذ
------------------------------

users -> tasks

كل يوزر اله عدة مهام
وكل مهمة بترجع ليوزر واحد
--------------------

cascadeOnDelete ==>

مهام عند اليوزر
لما بحذف اليوزر بيتم حذف جميع مهامه 
==================

user -> tasks
اليوزر اله مجموعة مهام
hasMany(Task);
belongsTo(User);
====

اليوزر كذا كله مهامه بدنا

===

بدنا نعمل المهمة لأي يوزر تابعة
حترجعلي اليوزر

===================

# many to many

طلاب ضمن الجامعة
مشاريع 
طلاب

الطالب الواحد اله مشروع أو أكثر من مشروع
المشروع ممكن يشترك فيه أكثر من طالب
===

category اليوزر اله أكثر من 

التصنيف ممكن يكون لأكثر من يوزر
=============

الطالب اله أكثر من مهارة
المهارة ممكن يشترك فيها أكثر من طالب
----------------------------------

الكاتوجري

categories:
id 
name

العلاقة بين المهام والكاتوجري

كل مهمة الها أكثر من تصنيف
والتصنيف ممكن يتبع لمهمة أو أكثر

الحل بنعمل 
pivotTable
جدول كسر العلاقة

نسميه

category_task
id (PK)
taks_id (FK)
category_id (FK)
============

# php artisan make:model Category -m
# php artisan make:migration create_category_task_table
