# php artisan about

php artisan about --only=environment

php artisan about --only=database

# php artisan env:encrypt


========================================



الإعدادات (Configuration) في Laravel
المقدمة
جميع ملفات الإعدادات الخاصة بإطار العمل Laravel يتم تخزينها في مجلد config. كل خيار في هذه الملفات موثق بشكل جيد، لذا يمكنك استعراض الملفات والتعرف على الخيارات المتاحة لك.

تتيح لك هذه الملفات تكوين العديد من الأشياء في تطبيقك مثل معلومات الاتصال بقاعدة البيانات، معلومات خادم البريد الإلكتروني، بالإضافة إلى إعدادات أخرى أساسية مثل عنوان التطبيق (URL) ومفتاح التشفير.

الأمر about
Laravel يقدم إمكانية عرض نظرة عامة حول إعدادات التطبيق، والمحركات (drivers) المستخدمة، وبيئة التشغيل عبر أمر Artisan يسمى about. هذا الأمر يعرض لك معلومات مفصلة عن البيئة التي يعمل بها التطبيق، مثل:

إعدادات التطبيق: تشمل اسم التطبيق، والمفتاح الخاص بالتشفير، والمزيد.

المحركات (Drivers): عرض المحركات المستخدمة في التطبيق مثل محرك البريد، محرك التخزين، وغيرها.

بيئة التشغيل (Environment): عرض ما إذا كانت البيئة هي بيئة تطوير أو إنتاج أو اختبار.

هذا الأمر مفيد في معرفة الإعدادات التي يعتمد عليها التطبيق بشكل سريع، ويمكنك استخدامه عبر سطر الأوامر كالتالي:

bash
Copy
Edit
php artisan about
الملفات داخل مجلد config
تحتوي مجلد config على العديد من الملفات التي يمكنك تعديلها حسب احتياجاتك، ومنها:

config/app.php: يحتوي على الإعدادات الأساسية للتطبيق مثل اسم التطبيق، والمفتاح السري (encryption key)، ولغة التطبيق.

config/database.php: يحتوي على إعدادات الاتصال بقاعدة البيانات، مثل نوع قاعدة البيانات (MySQL، SQLite، PostgreSQL، إلخ) ومعلومات الاتصال.

config/mail.php: يحتوي على إعدادات خادم البريد الإلكتروني.

config/session.php: يحتوي على إعدادات الجلسات في التطبيق.

config/cache.php: يحتوي على إعدادات التخزين المؤقت (Cache).

وهنالك العديد من الملفات الأخرى التي تحتوي على إعدادات خاصة بأنواع مختلفة من الخدمات في Laravel.

خلاصة
يمكنك استخدام ملفات الإعدادات في Laravel لتخصيص الكثير من جوانب التطبيق. عند تعديل هذه الملفات، من المهم أن تكون على دراية بكل خيار وكيف يؤثر على التطبيق، ويمكنك دائما العودة إلى ملفات التوثيق لفهم المزيد عن كل خيار.

إذا كان لديك أي استفسار حول أي إعداد أو كيف تستخدمه في تطبيقك، يمكنك سؤالي!
===============

تكوين البيئة (Environment Configuration) في Laravel
مقدمة
في كثير من الأحيان، قد يكون من المفيد أن يكون لديك قيم تكوين مختلفة بناءً على البيئة التي يعمل فيها التطبيق. على سبيل المثال، قد ترغب في استخدام محرك ذاكرة مؤقتة (cache driver) مختلف على بيئة التطوير مقارنة ببيئة الإنتاج.

لتسهيل هذا الأمر، يستخدم Laravel مكتبة DotEnv الخاصة بـ PHP. في تثبيت جديد لـ Laravel، سيحتوي الدليل الجذري للتطبيق على ملف يسمى .env.example الذي يحدد العديد من المتغيرات البيئية المشتركة. أثناء عملية التثبيت، سيتم نسخ هذا الملف تلقائيًا إلى .env.

كيفية استخدام ملف .env
يحتوي ملف .env الافتراضي في Laravel على بعض القيم المشتركة التي قد تختلف حسب ما إذا كان التطبيق يعمل محليًا أو على خادم إنتاج. يتم قراءة هذه القيم من خلال ملفات التكوين الموجودة في مجلد config باستخدام دالة env الخاصة بـ Laravel.
============

