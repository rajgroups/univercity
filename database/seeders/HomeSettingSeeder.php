<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to your SQL file
        $path = database_path('seeders/sql/homesetting.sql');

        // Read file content
        $sql = file_get_contents($path);

        // Execute SQL
        DB::unprepared($sql);

        $this->command->info('Custom SQL file executed successfully!');
    }
}
