<?php

namespace App\Console\Commands;

use App\Models\member;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

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
        $members = member::where('send_email',0)->limit(30)->get();
        $link = '';

        foreach ($members as $member){
            $data = ['memberEmail' => $member->email, 'link' => $link, 'member' => $member];

            try {
                Mail::send('email.reminder', $data, function ($m) use ($data) {
                    $m->to($data['memberEmail'])->subject(' ملتقى المهارات والتدريب "وعد" بمنطقة نجران');
                });


                $member->update([
                    'send_email'=>1
                 ]);

                // $text = 'الوعد في وعد';
                // $text.= ' \n \n';
                // $text.= ' \n \n';
                // $text.= ' ننتظركم غداً باذن الله في ملتقى المهارات والتدريب وعد بمنطقة نجران في مركز  الأمير سلطان الحضاري بنجران';
                // $text.= ' \n \n';
                // $text.= 'الساعه ١٠ صباحاً';
                // $text.= ' \n \n';
                // $text.= ' \n \n';
                // $text.= 'رابط الموقع :';
                // $text.=' \n \n';
                // $text.= 'https://maps.app.goo.gl/gZRg9QWaAXPB7BLX6?g_st=ic';

                // WhatsappHelper::sendMessage($member->mobile,$text);
            } catch (Exception $ex) {

            }
        }
        return 0;
    }
}
