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
