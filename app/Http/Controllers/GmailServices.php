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

         $envToken = env('GOOGLE_ACCESS_TOKEN');
        if ($envToken) {
            $accessToken = json_decode($envToken, true);
            $client->setAccessToken($accessToken);

            if ($client->isAccessTokenExpired()) {
                if ($client->getRefreshToken()) {
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());

                
                    Log::info('New Gmail token generated:', $client->getAccessToken());
                }
            }
        }



        return new Gmail($client);
    }
    public function sendEmail($to, $subject, $body)
    {
        $gmail = $this->getClient();

        $strRawMessage = "From: Your Name <nsavllera@gmail.com>\r\n";
        $strRawMessage .= "To: <$to>\r\n";
        $strRawMessage .= "Subject: $subject\r\n";
        $strRawMessage .= "MIME-Version: 1.0\r\n";
        $strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n\r\n";
        $strRawMessage .= "$body";

        $mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
        $message = new Message();
        $message->setRaw($mime);

        $gmail->users_messages->send("me", $message);
    }


}
