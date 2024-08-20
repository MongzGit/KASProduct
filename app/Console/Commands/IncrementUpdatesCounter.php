<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;
use Illuminate\Support\Facades\Log;

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
        // Increment for post_general_infor1 'a'
        $aCount = PostBI::where('post_general_infor1', 'a')->increment('relation_counter');
        Log::info('Incremented updates_counter for post_general_infor1 a', ['count' => $aCount]);

        // Increment for post_general_infor1 'b'
        $bCount = PostBI::where('post_general_infor1', 'b')->increment('relation_counter');
        Log::info('Incremented updates_counter for post_general_infor1 b', ['count' => $bCount]);

        // Increment for post_general_infor1 'c'
        $cCount = PostBI::where('post_general_infor1', 'c')->increment('relation_counter');
        Log::info('Incremented relation_counter for post_general_infor1 c', ['count' => $cCount]);

        $this->info('Updated relation_counter for all posts based on post_general_infor1.');
    }
}
