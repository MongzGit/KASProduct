<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;
class updatePostGenInforG extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatePostGenInforG';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command updatePostGenInforG';

    public function handle()
    {
        PostBI::where('post_general_infor1', 'g')->increment('relation_counter');
        $this->info('updated post_general_infor1 at g');
    }
}
