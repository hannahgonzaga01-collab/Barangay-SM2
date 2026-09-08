<?php
$lines = file('resources/views/resident/index.blade.php');
foreach($lines as $i => $l) {
    if(preg_match('/violation|issuance|translate|Google|language/i', $l)) {
        echo ($i+1).': '.trim($l)."\n";
    }
}
