<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo route('admin.rooms.destroyByType') . "\n";
} catch (Exception $e) {
    echo 'ERROR: ' . get_class($e) . ' - ' . $e->getMessage() . "\n";
}
