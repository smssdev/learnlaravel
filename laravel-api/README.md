// مشروع Laravel 12 API فقط مع نظام مستخدمين متعدد الأدوار والصلاحيات من الصفر

// الخطوة 1: إنشاء مشروع Laravel
composer create-project laravel/laravel laravel-api
cd laravel-api

// الخطوة 2: إعداد Laravel Sanctum للمصادقة API
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

// kernel.php - تفعيل Sanctum middleware لمسارات API
// app/Http/Kernel.php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],

// الخطوة 3: تثبيت حزمة Spatie للأدوار والصلاحيات
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

// الخطوة 4: تفعيل Trait في الموديل User
// app/Models/User.php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
}

// الخطوة 5: إنشاء Seeder للأدوار والصلاحيات
php artisan make:seeder RolePermissionSeeder

// database/seeders/RolePermissionSeeder.php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $permissions = ['view dashboard', 'manage users'];
        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo(['view dashboard']);
    }
}

php artisan db:seed --class=RolePermissionSeeder

// الخطوة 6: إنشاء API لتسجيل وتسجيل دخول المستخدم
// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole('user');

    return response()->json([
        'token' => $user->createToken('auth_token')->plainTextToken,
        'user' => $user
    ]);
});

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'token' => $user->createToken('auth_token')->plainTextToken,
        'user' => $user
    ]);
});

// خطوة 7: Endpoint محمي يعرض صلاحيات وأدوار المستخدم
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return [
        'user' => $request->user(),
        'roles' => $request->user()->getRoleNames(),
        'permissions' => $request->user()->getPermissionNames()
    ];
});
===================================

# lesson 2


php artisan make:controller API/AuthController


