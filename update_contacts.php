<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views'));
foreach($files as $f) {
    if(strpos($f->getFilename(), '.blade.php') !== false) {
        $path = $f->getPathname();
        $c = file_get_contents($path);
        
        $newC = str_replace('placeholder="09XXXXXXXXX"', 'placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, \'\');"', $c);
        
        if($c !== $newC) {
            file_put_contents($path, $newC);
            echo "Updated $path\n";
        }
    }
}

// Update controllers
$controllers = [
    'app/Http/Controllers/ResidentPortalController.php',
    'app/Http/Controllers/AdminController.php',
    'app/Http/Controllers/Auth/RegisteredUserController.php'
];

foreach($controllers as $ctrl) {
    if(file_exists($ctrl)) {
        $c = file_get_contents($ctrl);
        // Look for 'contact' => 'required|string|max:...' or similar
        // Or we just search and replace max:255 or max:20 with digits:11
        $c = preg_replace('/\'contact_number\'\s*=>\s*\'[^\']+\'/i', "'contact_number' => 'required|digits:11'", $c);
        $c = preg_replace('/\'contact\'\s*=>\s*\'[^\']+\'/i', "'contact' => 'required|digits:11'", $c);
        $c = preg_replace('/\'contact_person_number\'\s*=>\s*\'[^\']+\'/i', "'contact_person_number' => 'required|digits:11'", $c);
        
        file_put_contents($ctrl, $c);
        echo "Updated $ctrl\n";
    }
}
