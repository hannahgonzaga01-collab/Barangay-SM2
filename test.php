<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$compiler = app('blade.compiler');
$compiled = $compiler->compileString(file_get_contents('resources/views/resident/index.blade.php'));
file_put_contents('test_compiled.php', $compiled);
exec('php -l test_compiled.php', $output, $return_var);
echo implode("\n", $output);
