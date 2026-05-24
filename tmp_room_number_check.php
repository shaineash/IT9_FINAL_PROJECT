<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$type = 'Standard';
$prefix = '1';
$existing = App\Models\Room::where('room_number', 'like', $prefix . '%')->pluck('room_number')->all();
$maxIndex = 0;
foreach ($existing as $rn) {
    if (preg_match('/^' . preg_quote($prefix, '/') . '(\d+)$/', $rn, $m)) {
        $idx = (int)$m[1];
        if ($idx > $maxIndex) $maxIndex = $idx;
    }
}
echo "Existing: " . implode(', ', $existing) . PHP_EOL;
echo "Max index: $maxIndex\n";
$startIndex = $maxIndex + 1;
$pad = 2;
$roomNumber = $prefix . str_pad((string)$startIndex, $pad, '0', STR_PAD_LEFT);
echo "Next generated room number: $roomNumber\n";
