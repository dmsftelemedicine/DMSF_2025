<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\DashboardController;

class WarmDashboardCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:warm-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warm up the dashboard cache for better performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Warming up dashboard cache...');
        
        // Clear existing cache
        Cache::forget('dashboard_data');
        Cache::forget('dashboard_basic_counts');
        Cache::forget('dashboard_monthly_data_' . now()->year . '_' . now()->month);
        Cache::forget('dashboard_monthly_patients_' . now()->year);
        Cache::forget('dashboard_diabetes_data');
        
        // Warm up the cache by calling the controller
        $controller = new DashboardController();
        $controller->index();
        
        $this->info('Dashboard cache warmed successfully!');
        
        return 0;
    }
}
