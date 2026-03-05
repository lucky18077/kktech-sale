<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = ['users','leads','quotes_mst','quotes_det','sales','products','dealer','projects','architect','plumber'];

echo "Legacy (kktechsales):\n";
foreach ($tables as $t) {
    try {
        $c = DB::connection('legacy')->table($t)->count();
        echo str_pad($t, 15) . ": " . $c . "\n";
    } catch (\Exception $e) {
        echo str_pad($t, 15) . ": ERROR - " . $e->getMessage() . "\n";
    }
}

echo "\nLaravel (laravelkktech):\n";
foreach ($tables as $t) {
    try {
        $c = DB::connection()->table($t)->count();
        echo str_pad($t, 15) . ": " . $c . "\n";
    } catch (\Exception $e) {
        echo str_pad($t, 15) . ": ERROR - " . $e->getMessage() . "\n";
    }
}
