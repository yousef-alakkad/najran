<?php

namespace App\Console\Commands;

use App\Models\member;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Helpers\WhatsappHelper;


class sendNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notify';

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
     * @return int
     */
    public function handle()
    {
        $members = member::count();
        $text = 'عدد المسجلين في ملتقى المهارات والتدريب "وعد" هو '.$members;
        WhatsappHelper::sendMessage('+966504446214',$text);
        WhatsappHelper::sendMessage('+963956013291',$text);

    }
}
