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
        $client = new Client();

        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $client->addScope(Gmail::GMAIL_SEND);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $tokenPath = storage_path('app/google/token.json');

        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                $authUrl = $client->createAuthUrl();
                exit("Please authorize Gmail access: <a href='$authUrl'>$authUrl</a>");
            }
        }



        return new Gmail($client);
    }


}
