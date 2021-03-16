<?php
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class Token
{
    // 簽發 token
    public static function createToken($uid = null) 
    {

        $signer = new Sha256();
        $time = time();
        $token = (new Builder())->issuedBy('https://example.com') // Configures the issuer (iss claim)
                        ->permittedFor('https://example.com') // Configures the audience (aud claim)
                        ->identifiedBy('123456789', true) // Configures the id (jti claim), replicating as a header item
                        ->issuedAt($time) // Configures the time that the token was issue (iat claim)
                        // ->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
                        ->expiresAt($time + 86400) // Configures the expiration time of the token (exp claim)
                        ->withClaim('uid', $uid) // Configures a new claim, called "uid"
                        ->getToken($signer, new Key('自定義金鑰')); // Retrieves the generated token
        return (String) $token;     
    }

    // 驗證token
    public static function validateToken($tokan = null) 
    {
        try {
            $token = (new Parser())->parse((String) $tokan);
            $signer =  new Sha256();
            if (!$token->verify($signer, '自定義金鑰')) {
                return false;
            }
  
            $time = time();
            $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
            $data->setIssuer('https://example.com');
            $data->setAudience('https://example.com');
            $data->setCurrentTime($time);
            return $token->validate($data);
        } catch (Exception $e) {
            return false;
        }
      
    }

    // 這邊我把解析出Uid另外寫，不然也可以寫在上面驗證的回傳值中
    public static function getUid ($tokan = null)
    {
        try {
            $token = (new Parser())->parse((String) $tokan);
            $claims = $token->getClaims();
            return $claims['uid'];
        } catch (Exception $e) {
            return false;
        }
    }
}

?>