<?php

namespace victorap93\PowerBIEmbedded;

class EmbeddedToken
{
    public function getEmbeddedToken($workspace_id, $report_id, $ms_token, $params = [])
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->request('POST', "https://api.powerbi.com/v1.0/myorg/groups/$workspace_id/reports/$report_id/GenerateToken", [
            'headers' => [
                "Authorization" => "Bearer $ms_token",
                "Content-Type" => "application/json"
            ],
            'json' => $params
        ]);

        return $request->getStatusCode() === 200 ? json_decode((string) $request->getBody()) : false;
    }
}
