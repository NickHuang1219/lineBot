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

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LINEBot extends Controller
{
    public function postTest(Request $cc){
        $dates = date("Y-m-d H:i:s");
        // $tt = $cc;
        
        $text = $cc->input('events.0.message.text');
        DB::insert('insert into lined (datT, dataTime) values (?, ?)', [$text, $dates]);
    
        return '...';//.$cc->events[0]->message->text;
        // return $text;

    }

}
