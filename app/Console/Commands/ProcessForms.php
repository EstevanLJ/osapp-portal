<?php

namespace App\Console\Commands;

use App\Form;
use App\Jobs\ProcessForm;
use Illuminate\Console\Command;

class ProcessForms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forms:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manda procssar os formulários em estado "Criado" ou "Erro"';

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
        $forms = Form::whereIn('status', ['CREATED', 'ERRRO'])
            ->orderBy('id', 'desc')
            ->get();

        foreach ($forms as $form) {
            $this->info('Process form ID: ' . $form->id);
            ProcessForm::dispatch($form);
        }
    }
}
