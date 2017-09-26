<?php

namespace Glooby\Pexels;

/**
 * @author Emil Kilhage <emil@glooby.com>
 * @author Chiel Betting <c.betting@programic.nl>
 */
class Client
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    private function getClient()
    {
        if (null === $this->client) {
            $this->client = new \GuzzleHttp\Client([
                'headers' => [
                    'Authorization' => $this->token
                ]
            ]);
        }

        return $this->client;
    }

    /**
     * @param $query
     * @param int $size
     * @param int $page
     *
     * @return mixed
     */
    public function search($query, $size = 15, $page = 1)
    {
        return $this->getClient()
            ->request('GET', 'http://api.pexels.com/v1/search', [
                'query' => [
                    'query' => $query,
                    'per_page' => $size,
                    'page' => $page
                ]])
            ->getBody()
            ->getContents();
    }
}
