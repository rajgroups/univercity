<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Path to your SQL file
        $path = database_path('seeders/sql/settings.sql');

        // Read file content
        $sql = file_get_contents($path);

        // Execute SQL
        DB::unprepared($sql);

        $this->command->info('Custom SQL file executed successfully!');
    }
}
