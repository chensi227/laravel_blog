<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Model\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    private $order;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order=[],$obj)
    {
        $this->order = $order;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Order::create($this->order);
    }
}
