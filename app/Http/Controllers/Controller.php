<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// use Modules\Base\Http\Controllers\BaseController;

use Illuminate\Http\Request;

 use Illuminate\Support\Facades\Log;
 use LINE\LINEBot;
 use LINE\LINEBot\Event\MessageEvent;
 use LINE\LINEBot\HTTPClient\CurlHTTPClient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// use DB;
use PDO;
// use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct(){
		$this->db = new PDO('mysql:host=localhost;dbname=l6;', 'root', '');
	}

    public function postTest(Request $cc){
        $dates = date("Y-m-d H:i:s");
        $tt = $cc;

        // DB::insert('insert into lined (datT, dataTime) values (?, ?)', [json_decode($tt,true)->events, $dates]);
        // $line= $this->db->query("INSERT INTO `lined`(`datT`, `dataTime`) VALUES ('".$tt."','".$dates."')");
        
//         $data = json_decode($text = $cc->input('events.0.message.text'), true);
// DB::insert(
//     'insert into lined (datT, dataTime) values (?, ?)',
//     [
//         $data,
//         $dates]);
    
        return '...';

        // $ret = $cc->name;//$cc->all();//
        //dd(json_decode($request->getContent(), true));
        // return 'postT return: '.$cc->input('id');

        // $params = $cc->all();
        // logger(json_encode($params, JSON_UNESCAPED_UNICODE));
        // return response('hello world', 200);
    }

    public function postTestC(){
        
        // $ret = $cc->name;//$cc->all();//
        //dd(json_decode($request->getContent(), true));
        // $users = DB::select('select * from lined where i = ?', [1]);
        $users = DB::select('select * from lined where i=?',[1]);
        foreach ($users as $user) {
            echo $user->datT;
        }
        return 'postT return: ';
    }

    public function infoD(){
        // $ret = $cc->name;//$cc->all();//
        //dd(json_decode($request->getContent(), true));
        return phpinfo();
    }
}
