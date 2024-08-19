<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostBI;

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
        // Increment for posts with posty_type 'a'
        PostBI::where('post_type', 'a')->increment('relation_counter');

        // Increment for posts with posty_type 'b'
        PostBI::where('post_type', 'b')->increment('relation_counter');

        $this->info('Updated updates_counter for all posts based on posty_type.');
    }
}
