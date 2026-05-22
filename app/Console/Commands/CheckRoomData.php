<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckRoomData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-room-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories = \App\Models\RoomCategory::all();
        $this->info('Categories created: ' . $categories->count());
        
        foreach($categories as $cat) {
            $this->line($cat->name . ' (' . $cat->range_start . '-' . $cat->range_end . '): ' . count($cat->room_numbers) . ' rooms');
        }
        
        $rooms = \App\Models\Room::all();
        $this->info('Total rooms: ' . $rooms->count());
        
        $available = \App\Models\Room::available()->count();
        $this->info('Available rooms: ' . $available);
    }
}
