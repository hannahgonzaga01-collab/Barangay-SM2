<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BackupManager
{
    public function createBackup()
    {
        $timestamp = date('Y-m-d_H-i-s');
        $backupName = "Barangay_Backup_{$timestamp}";
        $tempDir = storage_path("app/temp_backup_{$timestamp}");
        
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // 1. Dump Database
        $sqlFile = "{$tempDir}/database.sql";
        $this->dumpDatabase($sqlFile);

        // 2. Prepare Zip
        $zipFile = storage_path("app/backups/{$backupName}.zip");
        if (!is_dir(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0777, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Add SQL
            $zip->addFile($sqlFile, 'database.sql');

            // Add Public Storage (Photos, etc.)
            $files = Storage::disk('public')->allFiles();
            foreach ($files as $file) {
                $filePath = storage_path("app/public/{$file}");
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, "storage/{$file}");
                }
            }

            $zip->close();
        }

        // 3. Cleanup temp
        unlink($sqlFile);
        rmdir($tempDir);

        return $backupName . '.zip';
    }

    private function dumpDatabase($path)
    {
        $tables = DB::select('SHOW TABLES');
        $dbName = config('database.connections.mysql.database');
        $prop = "Tables_in_{$dbName}";

        $handle = fopen($path, 'w+');
        
        foreach ($tables as $table) {
            $tableName = $table->$prop;
            
            // Create Table
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`")[0];
            $createTableSql = (array)$createTable;
            fwrite($handle, "\n\n" . $createTableSql['Create Table'] . ";\n\n");

            // Data
            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $row = (array)$row;
                $keys = array_keys($row);
                $values = array_values($row);
                
                $keys = array_map(fn($k) => "`{$k}`", $keys);
                $values = array_map(function($v) {
                    if (is_null($v)) return 'NULL';
                    return "'" . addslashes($v) . "'";
                }, $values);

                $sql = "INSERT INTO `{$tableName}` (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $values) . ");\n";
                fwrite($handle, $sql);
            }
        }

        fclose($handle);
    }

    public function getBackups()
    {
        if (!is_dir(storage_path('app/backups'))) return [];
        
        $files = scandir(storage_path('app/backups'), SCANDIR_SORT_DESCENDING);
        $backups = [];
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && str_ends_with($file, '.zip')) {
                $path = storage_path("app/backups/{$file}");
                $backups[] = [
                    'name' => $file,
                    'size' => round(filesize($path) / 1024 / 1024, 2) . ' MB',
                    'date' => date('Y-m-d H:i:s', filemtime($path)),
                ];
            }
        }
        return $backups;
    }
}
