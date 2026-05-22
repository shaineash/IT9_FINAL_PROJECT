<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Room;

$types = Room::selectRaw('type,count(*) as room_count,MIN(price_per_night) as min_price,MAX(price_per_night) as max_price,MIN(capacity) as min_capacity,MAX(capacity) as max_capacity')
    ->groupBy('type')
    ->orderBy('type')
    ->get();

foreach ($types as $type) {
    echo 'TYPE:' . $type->type . ' COUNT:' . $type->room_count . ' MIN_PRICE:' . $type->min_price . ' MAX_PRICE:' . $type->max_price . ' MIN_CAP:' . $type->min_capacity . ' MAX_CAP:' . $type->max_capacity . "\n";
}
