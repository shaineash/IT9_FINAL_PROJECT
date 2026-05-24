<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$pdo = DB::connection()->getPdo();
$stmt = $pdo->query('SHOW COLUMNS FROM rooms');
foreach ($stmt as $row) {
    echo $row[0] . ' ' . $row[1] . ' ' . $row[3] . PHP_EOL;
}
