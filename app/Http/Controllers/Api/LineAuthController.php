<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Token;
use App\Member;
use Helper;

class LineAuthController extends Controller
{
    // 登入的 function
    
    public function login (Request $request) {
        $member_id = $request['userId'];
        $access_token = $request['accessToken'];

        // 先檢查資料庫有沒有這個 MEMBER
        $member = Member::find($member_id);
        if ($member) {
            // LINE 的 token 驗證
            $url = 'https://api.line.me/oauth2/v2.1/verify?access_token=' . $access_token;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = json_decode(curl_exec($ch));
            curl_close($ch);
            // 如果驗證回傳有錯就印錯誤訊息出來
            if (isset($output->error)) { return $output->error_description; }
            if ($output->client_id === env('CLIENT_LIFF_CHANNEL')) {
                // 判斷 accessToken 的 LIFF ChannelID 是不是跟我們 env 設置的一樣
                $token = Token::createToken($member_id);
                return 'success';
            }
        } else {
            return 'Member not found';
        }
    }
}

?>