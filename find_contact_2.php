<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views'));
foreach($files as $f) {
    if(strpos($f->getFilename(), '.blade.php') !== false) {
        $c = file_get_contents($f->getPathname());
        $lines = explode("\n", $c);
        foreach($lines as $i => $l) {
            if(preg_match('/name=[\'"]?(?:contact|contact_number|contact_person_number)[\'"]?/i', $l)) {
                echo $f->getPathname() . ':' . ($i+1) . ': ' . trim($l) . "\n";
            }
        }
    }
}
