<?php

namespace Modules\WaGateway\Services;

use Config\Services;

/**
 * EvolutionApiService
 * 
 * Abstraksi library untuk berkomunikasi dengan Evolution API.
 * Memanfaatkan cURLRequest bawaan CodeIgniter 4.
 */
class EvolutionApiService
{
    protected $client;
    protected $apiUrl;
    protected $globalApiKey;

    public function __construct()
    {
        $this->client = Services::curlrequest();
        $this->apiUrl = rtrim(getenv('EVOLUTION_API_URL'), '/');
        $this->globalApiKey = getenv('EVOLUTION_GLOBAL_API_KEY');
    }

    /**
     * Membuat Instance baru di Evolution API
     * endpoint: /instance/create
     */
    public function createInstance(string $instanceName)
    {
        $endpoint = $this->apiUrl . '/instance/create';

        $payload = [
            'instanceName' => $instanceName,
            'token' => $this->globalApiKey, // Global token atau spesifik per instance
            'qrcode' => true
        ];

        try {
            $response = $this->client->post($endpoint, [
                'headers' => [
                    'apikey' => $this->globalApiKey,
                    'Content-Type' => 'application/json'
                ],
                'json' => $payload
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            log_message('error', '[EvolutionAPI] Create Instance Error: ' . $e->getMessage());
            return [
                'status' => 'ERROR', 
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Mengirim Pesan Teks
     * endpoint: /message/sendText/{instanceName}
     */
    public function sendText(string $instanceName, string $number, string $text)
    {
        $endpoint = $this->apiUrl . '/message/sendText/' . $instanceName;

        $payload = [
            'number' => $number,
            'options' => [
                'delay' => 1200, // delay manusiawi untuk anti-ban
                'presence' => 'composing' // menampilkan status 'Sedang mengetik...'
            ],
            'textMessage' => [
                'text' => $text
            ]
        ];

        try {
            $response = $this->client->post($endpoint, [
                'headers' => [
                    'apikey' => $this->globalApiKey,
                    'Content-Type' => 'application/json'
                ],
                'json' => $payload
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            log_message('error', '[EvolutionAPI] Send Text Error: ' . $e->getMessage());
            return [
                'status' => 'ERROR', 
                'message' => $e->getMessage()
            ];
        }
    }
}
