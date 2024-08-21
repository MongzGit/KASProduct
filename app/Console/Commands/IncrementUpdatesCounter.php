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
        $currentDateMinusTenMin = Carbon::now()->subMinutes(10);

        $aCount = PostBI::where('post_general_infor1', 'a')->where('updated_at', '<' , $currentDateMinusTenMin)->increment('relation_counter');

        $this->info('Updated relation_counter for all posts based on post_general_infor1.');
    }
}
