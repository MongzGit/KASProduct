<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;

class updatePostGenInforE extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatePostGenInforE';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command updatePostGenInforE';

    public function handle()
    {
        PostBI::where('post_general_infor1', 'e')->increment('relation_counter');
        $this->info('updated post_general_infor1 at e');
    }
}
