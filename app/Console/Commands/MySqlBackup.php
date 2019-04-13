<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MySqlBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a MySQL Backup';

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
        $username = \Config::get('database.connections.mysql.username');
        $password = \Config::get('database.connections.mysql.password');
        $dbname = \Config::get('database.connections.mysql.database');
        $filename = $dbname . \Carbon\Carbon::now()->toDateString() . '.sql';

        exec('mysqldump -u'.$username.' -p'.$password.' '.$dbname. ' > ' . $filename);
        $this->info('Your backup is being saved to the root directory ' . $filename);
    }
}
