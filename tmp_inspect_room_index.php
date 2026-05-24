<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$roomTypes = App\Models\Room::selectRaw(
    'type, count(*) as room_count, MIN(price_per_night) as min_price, MAX(price_per_night) as max_price, MIN(capacity) as min_capacity, MAX(capacity) as max_capacity'
)
->groupBy('type')
->orderBy('type')
->get();

foreach ($roomTypes as $type) {
    echo $type->type . ' => ' . $type->room_count . ' rooms, price ' . $type->min_price . ' - ' . $type->max_price . ', capacity ' . $type->min_capacity . ' - ' . $type->max_capacity . PHP_EOL;
}
