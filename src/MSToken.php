<?php

namespace victorap93\PowerBIEmbedded;

class MSToken
{
    public function getMSTokenBySecret($tenant_id, $client_id, $client_secret)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->request('GET', "https://login.microsoftonline.com/$tenant_id/oauth2/token", [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'resource' => 'https://analysis.windows.net/powerbi/api',
                'client_id' => $client_id,
                'client_secret' => $client_secret
            ]
        ]);

        return $request->getStatusCode() === 200 ? json_decode((string) $request->getBody()) : false;
    }

    public function getMSTokenByCredentials($tenant_id, $client_id, $username, $password)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->request('GET', "https://login.microsoftonline.com/$tenant_id/oauth2/token", [
            'form_params' => [
                'grant_type' => 'password',
                'resource' => 'https://analysis.windows.net/powerbi/api',
                'client_id' => $client_id,
                'username' => $username,
                'password' => $password
            ]
        ]);

        return $request->getStatusCode() === 200 ? json_decode((string) $request->getBody()) : false;
    }
}
