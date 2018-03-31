<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangePostStatusToExpiredAfter3Months extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:clear-expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the status of post that are older than 3 months to expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('posts')
            ->where('created_at', '>', Carbon::now()->addDay(-7))
            ->where('deleted_at', null)
            ->where('status', 1)
            ->update(['status'=>0]);
    }
}
