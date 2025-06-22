<?

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Google\Service\Gmail\Message;
use Google\Client;
use Google\Service\Gmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GmailServices extends Controller
{
    public function getClient(): Gmail
    {
        $credPath = storage_path('app/google/credential.json');

        
        if (!file_exists($credPath) && env('GOOGLE_CREDENTIALS_BASE64')) {
            file_put_contents($credPath, base64_decode(env('GOOGLE_CREDENTIALS_BASE64')));
        }

        $client = new Client();
        $client->setAuthConfig($credPath);
        $client->addScope(Gmail::GMAIL_SEND);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

       
        $tokenPath = storage_path('app/google/token.json');
        if (!file_exists($tokenPath) && env('GOOGLE_TOKEN_BASE64')) {
            file_put_contents($tokenPath, base64_decode(env('GOOGLE_TOKEN_BASE64')));
        }

        
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                // First time: redirect user to authenticate
                $authUrl = $client->createAuthUrl();
                exit("Please authorize access: <a href='$authUrl'>$authUrl</a>");
            }
        }

        return new Gmail($client);
    }


}
