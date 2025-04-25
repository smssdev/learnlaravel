🎯 العلاقات اللي راح نغطيها:
One to One (1:1):

User ↔ Profile

One to Many (1:N):

User ↔ Posts

Many to Many (N:N):

Post ↔ Tag

Polymorphic (علاقة بوليمورفيك):

Image ↔ يمكن ترتبط بـ User أو Post

=======================

# migrations
php artisan make:model Profile -m
php artisan make:model Post -m
php artisan make:model Tag -m
php artisan make:model Image -m
php artisan make:migration create_post_tag_table
=====================

profiles (لعلاقة 1:1 مع user) 
====================
