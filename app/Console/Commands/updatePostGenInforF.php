<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;

class updatePostGenInforF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatePostGenInforF';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command updatePostGenInforF';


    public function handle()
    {
        PostBI::where('post_general_infor1', 'f')->increment('relation_counter');
        $this->info('updated post_general_infor1 at f');
    }
}
