from pathlib import Path
path = Path(r'c:\Users\Shaine\OneDrive\Laravel\Hotel\app\Http\Controllers\User\RoomController.php')
text = path.read_text()
start = text.find('->whereIn(')
print('START', start)
end_marker = '        )\n        ->orderByRaw("FIELD(upper(name), \'STANDARD\', \'DELUXE\', \'SUITE\', \'PRESIDENTIAL\')")'
end = text.find(end_marker, start)
print('END', end)
if start == -1 or end == -1:
    raise SystemExit('Marker not found')
replacement = "        ->whereRaw('upper(name) in (?, ?, ?, ?)', array_map('strtoupper', $roomTypes))\n"
new_text = text[:start] + replacement + text[end:]
path.write_text(new_text)
print('patched')
