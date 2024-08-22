<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class IncrementUpdatesCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:incrementCounter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Incrementing to the updates counter';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        PostBI::where('post_general_infor1', 'a')->increment('relation_counter');
        $this->info('updated post_general_infor1 at a');
    }
}
