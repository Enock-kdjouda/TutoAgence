<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Property;

class DemoJob implements ShouldQueue
{
    use Queueable , InteractsWithQueue , SerializesModels;
    
    public $deleteWhenMissingModels = true;
    /**
     * Create a new job instance.
     */
    public function __construct(private Property $property)
    {
       
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         $property = $this->property->refresh(); 
       echo $this->property->title;
    }
}
