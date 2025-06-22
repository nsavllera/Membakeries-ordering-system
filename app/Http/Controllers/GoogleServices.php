<?

namespace App\Services;
use Google\Service\Gmail\Message;
use Google\Client;
use Google\Service\Gmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GoogleServices
{
    public function getClient(): Gmail
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Gmail::GMAIL_SEND);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Optionally store token to reuse
        $tokenPath = storage_path('app/google/token.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        if ($client->isAccessTokenExpired()) {
            // Only for first-time auth or refresh
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Redirect user to authenticate
                $authUrl = $client->createAuthUrl();
                exit("Open the following link in your browser:\n$authUrl\n");
            }

            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }

        return new Gmail($client);
    }

    

    public function sendEmail($to, $subject, $body)
    {

        try {
                $gmail = $this->getClient();

                $strRawMessage = "From: Your Name <your@gmail.com>\r\n";
                $strRawMessage .= "To: <$to>\r\n";
                $strRawMessage .= "Subject: $subject\r\n";
                $strRawMessage .= "MIME-Version: 1.0\r\n";
                $strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n\r\n";
                $strRawMessage .= "$body";

                $mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
                $message = new Message();
                $message->setRaw($mime);

                $gmail->users_messages->send("me", $message);
            } catch (\Exception $e) {
                Log::error('Gmail send failed: ' . $e->getMessage());
            }
    }

}
