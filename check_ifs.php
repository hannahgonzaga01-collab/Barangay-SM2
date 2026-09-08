<?php
$lines = file('test_compiled.php');
$ifs = [];
foreach($lines as $i => $line) {
    if (preg_match('/^\s*<\?php if\(/', $line)) {
        $ifs[] = $i;
    } elseif (preg_match('/^\s*<\?php endif;/', $line)) {
        array_pop($ifs);
    }
}
echo "Unclosed IFs at lines: \n";
foreach($ifs as $line_num) {
    echo "Line " . ($line_num+1) . ": " . trim($lines[$line_num]) . "\n";
}
