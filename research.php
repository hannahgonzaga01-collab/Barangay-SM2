<?php
echo "==== Resident Schema ====\n";
$schema = Schema::getColumnListing('residents');
print_r($schema);

echo "==== Office Controller (storeResident) ====\n";
$c = file_get_contents('app/Http/Controllers/OfficeController.php');
if (preg_match('/public function storeResident.*?\{.*?\}/s', $c, $m)) {
    echo substr($m[0], 0, 500) . "...\n";
} else {
    echo "storeResident not found.\n";
}

echo "==== Resident Portal Controller ====\n";
$c = file_get_contents('app/Http/Controllers/ResidentPortalController.php');
if (preg_match('/public function store.*?\{.*?\}/s', $c, $m)) {
    echo substr($m[0], 0, 300) . "...\n";
} else {
    echo "store method not found.\n";
}
