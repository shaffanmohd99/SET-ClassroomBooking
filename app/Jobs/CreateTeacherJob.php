<?php

namespace App\Jobs;

use App\Models\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;


//register a random theacher at 1pm everyday 
class CreateTeacherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $name;
    public function __construct($name)
    {
        //
        $this->name=$name;
    }

    public $timeout=3000;
    public function middleware()
    {
        return [(new WithoutOverlapping($this->name))->dontRelease()];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Teacher::factory()->create([
            'name'=>$this->name
        ]);
    }
}
