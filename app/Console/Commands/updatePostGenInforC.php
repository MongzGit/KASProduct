<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;
use Carbon\Carbon;

class updatePostGenInforC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatePostGenInforC';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command updatePostGenInforC';

    
    public function handle()
    {
        $currentDateMinusTwentyFiveMin = Carbon::now()->subMinutes(25);

        PostBI::where('post_general_infor1', 'c')->where('updated_at', '<' , $currentDateMinusTwentyFiveMin)->increment('relation_counter');

        $this->info('updated post_general_infor1 at c');
    }
}
