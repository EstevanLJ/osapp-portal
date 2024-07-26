<?php

namespace App\Jobs;

use App\Form;
use App\Services\FormsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $form;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Form $form)
    {
        $this->form = $form->withoutRelations();
    }

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        FormsService::process($this->form);
    }
}
