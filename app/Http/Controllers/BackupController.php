<?php

namespace App\Http\Controllers;

use App\Services\BackupManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BackupController extends Controller
{
    protected $backupManager;

    public function __construct(BackupManager $backupManager)
    {
        $this->backupManager = $backupManager;
    }

    public function index()
    {
        $backups = $this->backupManager->getBackups();
        return response()->json($backups);
    }

    public function run()
    {
        try {
            $filename = $this->backupManager->createBackup();
            return redirect()->back()->with('success', 'Backup created successfully: ' . $filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        $path = storage_path("app/backups/{$filename}");
        if (file_exists($path)) {
            return Response::download($path);
        }
        return redirect()->back()->with('error', 'Backup file not found.');
    }

    public function destroy($filename)
    {
        $path = storage_path("app/backups/{$filename}");
        if (file_exists($path)) {
            unlink($path);
            return redirect()->back()->with('success', 'Backup deleted.');
        }
        return redirect()->back()->with('error', 'Backup file not found.');
    }
}
