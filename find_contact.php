<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views'));
foreach($files as $f) {
    if(strpos($f->getFilename(), '.blade.php') !== false) {
        $c = file_get_contents($f->getPathname());
        if(preg_match('/name=[\'"]?contact[\'"]?|contact_number/i', $c)) {
            echo $f->getPathname() . "\n";
        }
    }
}
