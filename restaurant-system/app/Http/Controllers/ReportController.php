<?php
// app/Http/Controllers/Api/ReportController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Info(title="Restaurant API", version="1.0")
 */
class ReportController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/reports",
     *     tags={"Reports"},
     *     summary="Get sales and order reports",
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         @OA\Schema(type="string", format="date", example="2025-04-01")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         @OA\Schema(type="string", format="date", example="2025-04-30")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     security={{"sanctum": {}}}
     * )
     */
    public function index(Request $request)
    {
        $startDate = $request->query('start_date', now()->subDays(30)->toDateString());
        $endDate = $request->query('end_date', now()->toDateString());

        $reports = Cache::remember("reports_{$startDate}_{$endDate}", now()->addMinutes(10), function () use ($startDate, $endDate) {
            $totalSales = Order::whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->sum('total');

            $ordersByStatus = Order::whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('status')
                ->selectRaw('status, count(*) as count')
                ->pluck('count', 'status');

            $topItems = Item::withCount(['orders' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('orders.created_at', [$startDate, $endDate]);
            }])
                ->orderByDesc('orders_count')
                ->take(5)
                ->get();

            return [
                'total_sales' => $totalSales,
                'orders_by_status' => $ordersByStatus,
                'top_items' => $topItems,
            ];
        });

        return response()->json($reports);
    }
}
?>
