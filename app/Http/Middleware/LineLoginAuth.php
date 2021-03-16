<?php

namespace App\Http\Middleware;

use Closure;
use Token;
use Helper;

class LineLoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 從Header抓 X-token 欄位 （要把token設在哪跟什麼名字都可以，看自己喜好就好，然後盡量不要用__下底線 在nginx沒去設定會有問題)
        $token = $request->header('X-token');
        if (!$token) { return 'token not found'; }
        // 驗證 token
        if (Token::validateToken($token)) {
            // 將 uid 加到原本的請求內，方便之後取用
            $request['token_uid'] = Token::getUid($token);
            return $next($request);
        } else {
            return 'token verify error';
        }
    }
}

?>