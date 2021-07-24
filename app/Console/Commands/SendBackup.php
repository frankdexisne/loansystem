<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
class SendBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Database backup';

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
     * @return int
     */
    public function handle()
    {
        // FETCH TO BE ATTACHED FILE
        Mail::send('system.mail',[],function($message){
            $message->to(env('MAIL_USERNAME'),env('MAIL_RECEIPIENT_NAME'))->subject(env('MAIL_SUBJECT'));
            $message->from(env('MAIL_USERNAME'),env('MAIL_RECEIPIENT_NAME'));
            // $message->attachData($file,'DB-BACKUP'.date('YmdHis').'.zip');
        });
        \Log::info('Successfully send backup');
        // return 0;
    }
}
