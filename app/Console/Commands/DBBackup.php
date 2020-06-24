<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DBBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database Backup';

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
        $command = 'php artisan backup:run --only-db; rclone copy /var/www/html/my_recipes/storage/app/Laravel/ gdrive:backup_banda_tujumi';
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);
    }
}
