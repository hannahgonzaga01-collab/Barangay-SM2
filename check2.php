<?php
$lines = file('resources/views/resident/index.blade.php');
$ifs = [];
foreach($lines as $i => $line) {
    if (preg_match('/@if\b/', $line)) {
        $ifs[] = $i + 1;
    }
    if (preg_match('/@endif\b/', $line)) {
        array_pop($ifs);
    }
}
echo "Unclosed IFs at lines: \n";
foreach($ifs as $line_num) {
    echo "Line $line_num\n";
}
