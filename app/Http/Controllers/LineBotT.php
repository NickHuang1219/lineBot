<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 use Illuminate\Support\Facades\Log;
//  use LINE\LINEBot;
 use LINE\LINEBot\Event\MessageEvent;
 use LINE\LINEBot\HTTPClient\CurlHTTPClient;

// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LineBotT extends Controller
{
    public function postTest(Request $cc){
        $dates = date("Y-m-d H:i:s");
        // $tt = $cc;
        
        // $text = $cc->input('events.0.message.text');
        $text = $cc->input('events')[0]['message']['text'];
        DB::insert('insert into lined (datT, dataTime) values (?, ?)', [$text, $dates]);
    
        // return '...';//.$cc->events[0]->message->text;
        return $text;

    }

    // public function handler(Request $request): string{
    //     $events = $request->input('events');
    //     abort_unless(Arr::accessible($events), 412); // 確認 $events 是 array

    //     collect($events)
    //         ->where('type', 'message')
    //         ->each(function ($event) {
    //             $text = optional($event['message'])['text'];

    //             var_dump($text);
    //         });
    // }

}
