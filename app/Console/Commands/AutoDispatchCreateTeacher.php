<?php

namespace App\Console\Commands;

use App\Jobs\CreateTeacherJob;
use Illuminate\Console\Command;

class AutoDispatchCreateTeacher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teacher:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'testing 123 teacher 123 testing 1234';

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
     * @return int
     */
    public function handle()
    {
        // return 0;
        CreateTeacherJob::dispatch('Commander');
    }
}
