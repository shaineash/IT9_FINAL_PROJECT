<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$rooms = App\Models\Room::select('type','room_number')->orderBy('id')->get();
echo 'rooms=' . $rooms->count() . PHP_EOL;
foreach ($rooms as $row) {
    echo $row->type . ': ' . $row->room_number . PHP_EOL;
}
