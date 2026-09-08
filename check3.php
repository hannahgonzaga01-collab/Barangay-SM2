<?php
$lines = file('resources/views/resident/index.blade.php');
$depth = 0;
foreach($lines as $i => $l) {
    if($i >= 881) {
        if(preg_match('/@if\b/', $l)) $depth++;
        if(preg_match('/@endif\b/', $l)) {
            $depth--;
            if($depth == 0) {
                echo 'ENDIF at '.($i+1)."\n";
                break;
            }
        }
    }
}
