<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;


class updatePostGenInforB extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'command:updatePostGenInforB';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'command updatePostGenInforB';
    public function handle()
    {
        PostBI::where('post_general_infor1', 'b')->increment('relation_counter');
        $this->info('updated post_general_infor1 at b');
    }
}
