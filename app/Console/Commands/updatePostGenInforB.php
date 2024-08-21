<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\PostBI;
use Carbon\Carbon;


class updatePostGenInforB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatePostGenInforB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command updatePostGenInforB';

    
    public function handle()
    {
        $currentDateMinusFifteenMin = Carbon::now()->subMinutes(15);

        PostBI::where('post_general_infor1', 'b')->where('updated_at', '<' , $currentDateMinusFifteenMin)->increment('relation_counter');

        $this->info('updated post_general_infor1 at b');
    }
}
