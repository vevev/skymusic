<?php

namespace App\Console\Commands;

use Throwable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ChangeVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changeversion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        try {
            $env_string = file_get_contents(base_path() . '/.env', true);
            $env_string = preg_replace_callback(
                '#(APP_STATIC_VERSION=.+\.)(\d+)#',
                function ($matches) {
                    return $matches[1] . (++$matches[2]);
                }, $env_string);

            file_put_contents(base_path() . '/.env', $env_string);

            Artisan::call('config:cache');
            $this->line('<fg=green>Version Changed !</>');
        } catch (Throwable $e) {
            $this->line('<fg=red>Error !</>');
        }
    }
}
