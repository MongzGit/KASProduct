<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;

class updatePostGenInforD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatePostGenInforD';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command updatePostGenInforD';

    public function handle()
    {
        PostBI::where('post_general_infor1', 'd')->increment('relation_counter');
        $this->info('updated post_general_infor1 at d');
    }
}
