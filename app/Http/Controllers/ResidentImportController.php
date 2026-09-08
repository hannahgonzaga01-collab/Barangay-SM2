<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResidentImportController extends Controller
{
    public function show() {
        return view('residents.import');
    }

    public function store(Request $request) {
        // Bina-validate kung CSV file ang inupload
        $request->validate(['csv_file' => 'required|mimes:csv,txt']);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');

        while (($row = fgetcsv($file)) !== FALSE) {
            // Format ng CSV: Name, Email
            User::updateOrCreate(
                ['email' => $row[1]], // Hahanapin muna kung existing ang email para iwas error
                [
                    'name' => $row[0],
                    'password' => Hash::make('Resident123!'),
                    'role' => 'resident',
                    'status' => 'active'
                ]
            );
        }
        fclose($file);
        return back()->with('success', '2,000+ Residents Imported Successfully!');
    }
}
