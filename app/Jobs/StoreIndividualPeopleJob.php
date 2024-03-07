<?php

namespace App\Jobs;

use App\Services\PeopleService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreIndividualPeopleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $people;
    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $gender = $data[3] == "Female" ? 0 : 1;
        $this->people = [
            'firstname' => $data[1],
            'gender' => $gender,
            'country' => $data[4],
            'age' => $data[5],
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $peopleService = new PeopleService;

        $peopleService->store($this->people);
    }
}
