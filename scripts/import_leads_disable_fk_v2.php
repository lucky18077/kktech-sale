<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$legacy = DB::connection('legacy');
$new = DB::connection();

echo "Disabling foreign key checks...\n";
$new->statement('SET FOREIGN_KEY_CHECKS=0');

$rows = $legacy->table('leads')->cursor();

$count = 0;
foreach ($rows as $row) {
    $data = (array) $row;
    // mappings
    $mapped = [];
    $map = [
        'name' => 'contact_name',
        'phone' => 'contact_number',
        'whatsapp_no' => 'contact_number',
        'email' => 'email',
        'address' => 'address',
        'state' => 'state',
        'city' => 'city',
        'user_id' => 'user_id',
        'project_id' => 'project_id',
        'lead_date' => 'lead_date',
        'catg_id' => 'catg_id',
        'sub_catg_id' => 'sub_catg_id',
        'dealer_id' => 'dealer_id',
        'notes' => 'notes',
        'status' => 'status'
    ];
    foreach ($map as $l => $n) {
        if (array_key_exists($l, $data)) {
            $mapped[$n] = $data[$l];
        }
    }
    $data = array_merge($data, $mapped);

    // normalize
    if (isset($data['is_allocated'])) {
        $data['is_allocated'] = (int) $data['is_allocated'];
    }

    if (!empty($data['lead_date'])) {
        try {
            $dt = new DateTime($data['lead_date']);
            $year = (int) $dt->format('Y');
            if ($year < 1900 || $year > 2100) {
                // fallback to today when legacy date is invalid
                $data['lead_date'] = date('Y-m-d');
            } else {
                $data['lead_date'] = $dt->format('Y-m-d');
            }
        } catch (Exception $e) {
            $data['lead_date'] = date('Y-m-d');
        }
    } else {
        // missing date, default to today too
        $data['lead_date'] = date('Y-m-d');
    }

    // filter to new schema
    $columns = $new->getSchemaBuilder()->getColumnListing('leads');
    $filtered = array_intersect_key($data, array_flip($columns));

    try {
        if (isset($filtered['id'])) {
            $new->table('leads')->updateOrInsert(['id' => $filtered['id']], $filtered);
        } else {
            $new->table('leads')->insertOrIgnore($filtered);
        }
    } catch (Exception $e) {
        echo "Failed inserting id={$data['id']} : " . $e->getMessage() . "\n";
    }

    $count++;
    if ($count % 1000 === 0) {
        echo "Imported: $count\n";
    }
}

$new->statement('SET FOREIGN_KEY_CHECKS=1');

echo "Done. Total processed: $count\n";
