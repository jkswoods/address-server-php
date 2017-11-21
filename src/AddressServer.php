<?php

namespace LBAM;

use GuzzleHttp\Client;

class AddressServer {

    private $client;

    public function __construct($baseUri)
    {
        $this->client = new Client([
            'base_uri' => $baseUri,
        ]);
    }

    /**
     * Generate a Bitcoin address.
     *
     * @return string The Bitcoin address.
     */
    public function generateAddress()
    {
        $response = $this->client->request('GET', 'api/generate-address');

        // Return the address.
        return (string)$response->getBody();
    }

    /**
     * Generate a SegWit compatible Bitcoin address.
     *
     * @return string The SegWit-compatible Bitcoin address.
     */
    public function generateAddressSegWit()
    {
        $response = $this->client->request('GET', '/api/generate-address-segwit');

        // Return the address.
        return (string)$response->getBody();
    }

    /**
     * Generate a transaction hash from inputs and their addresses.
     *
     * @param string $payload JSON-encoded inputs and outputs.
     *
     * @return string The transaction hash.
     */
    public function createTransaction($payload)
    {
        $response = $this->client->request('POST', '/api/send-transaction', [
            'body' => $payload,
        ]);

        // Return the transaction hash.
        return (string)$response->getBody();
    }

    /**
     * Generates a SegWit compatible transaction hash from inputs and 
     * their addresses.
     *
     * @param string $payload JSON-encoded inputs and outputs.
     *
     * @return string The SegWit-compatible Bitcoin transaction.
     */
    public function createTransactionSegWit($payload)
    {
        $response = $this->client->request('POST', '/api/send-transaction-segwit', [
            'body' => $payload,
        ]);

        // Return the transaction hash.
        return (string)$response->getBody();
    }
}