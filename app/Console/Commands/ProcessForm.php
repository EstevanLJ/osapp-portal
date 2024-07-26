<?php

namespace App\Console\Commands;

use App\Form;
use App\Jobs\ProcessForm as Job;
use Illuminate\Console\Command;

class ProcessForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forms:processOne {form}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processa o formulario';

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
        $form = Form::findOrFail($this->argument('form'));
        $form->status = 'CREATED';
        $form->status_message = null;
        Job::dispatch($form);
    }
}
