<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportLegacyData extends Command
{
    protected $signature = 'legacy:import {--table=}';
    protected $description = 'Import data from legacy database into Laravel tables';

    public function handle()
    {
        $table = $this->option('table');

        if ($table) {
            $this->info("Importing single table: $table");
            $this->importTable($table);
        } else {
            $tables = [
                'users',
                'department',
                'designation',
                'area_mst',
                'sources',
                'status',
                'categories',
                'sub_categories',
                'products',
                'dealer',
                'leads',
                'lead_comments',
                'lead_product',
                'quotes_mst',
                'quotes_det',
                'sales',
                // add more as needed
            ];

            foreach ($tables as $t) {
                $this->importTable($t);
            }
        }

        $this->info('Legacy import completed.');
        return 0;
    }

    protected function importTable(string $table)
    {
        $this->line("-> migrating $table");

        $legacy = DB::connection('legacy');
        $new = DB::connection('mysql');

        $rows = $legacy->table($table)->get();

        // per-table column mapping and transforms
        $mappings = [
            'leads' => [
                // legacy => new
                'name' => 'contact_name',
                'phone' => 'contact_number',
                'whatsapp_no' => 'contact_number',
                'status' => 'status',
                'notes' => 'notes',
                'address' => 'address',
                'state' => 'state',
                'city' => 'city',
                'user_id' => 'user_id',
                'project_id' => 'project_id',
                'lead_date' => 'lead_date',
                'id' => 'id',
                'email' => 'email',
                'catg_id' => 'catg_id',
                'sub_catg_id' => 'sub_catg_id',
                'dealer_id' => 'dealer_id',
            ],
        ];

        foreach ($rows as $row) {
            $data = (array) $row;

            // apply mapping if available for this table
            if (isset($mappings[$table])) {
                $mapped = [];
                foreach ($mappings[$table] as $legacyCol => $newCol) {
                    if (array_key_exists($legacyCol, $data)) {
                        $mapped[$newCol] = $data[$legacyCol];
                    }
                }
                $data = array_merge($data, $mapped);
            }

            // normalize common types (bits -> int, datetime -> date)
            if ($table === 'leads') {
                if (isset($data['is_allocated'])) {
                    $data['is_allocated'] = (int) $data['is_allocated'];
                }
                if (!empty($data['lead_date'])) {
                    try {
                        $dt = new \DateTime($data['lead_date']);
                        $data['lead_date'] = $dt->format('Y-m-d');
                    } catch (\Exception $e) {
                        // leave as-is; MySQL may convert or default
                    }
                }
            }

            // filter columns to match new table schema
            $columns = $new->getSchemaBuilder()->getColumnListing($table);
            $filtered = array_intersect_key($data, array_flip($columns));

            try {
                // try upsert for id-based primary keys to avoid duplicates
                if (isset($filtered['id'])) {
                    $new->table($table)->updateOrInsert(['id' => $filtered['id']], $filtered);
                } else {
                    $new->table($table)->insertOrIgnore($filtered);
                }
            } catch (\Exception $e) {
                $this->error("Failed inserting row in $table: " . $e->getMessage());
            }
        }

        $this->info("finished $table (" . count($rows) . " rows)");
    }
}
