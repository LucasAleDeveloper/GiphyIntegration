<?php

namespace App\Services;

class GiphyApiService
{
    public function __construct()
    {
        $this->apiUrl = env('GIPHY_API_BASE_URL');
        $this->apiKey = env('GIPHY_API_KEY');
    }

    /** 
     * @return array
     */
    public function searchGifs($parameters)
    {
        $query = [
            'q' => isset($parameters['q']) ? $parameters['q'] : null,
            'limit' => isset($parameters['limit']) ? $parameters['limit'] : 10,
            'offset' => isset($parameters['offset']) ? $parameters['offset'] : 0,
        ];

        $baseUrl = $this->apiUrl . 'search?';

        $queryString = http_build_query($query);
                
        $urlWithParams = $baseUrl . 'api_key=' . $this->apiKey . '&' . $queryString;

        $response = file_get_contents($urlWithParams);

        $response = json_decode($response, true);

        return $response['data'];
    }

    public function searchGifById($id) 
    {
        $urlWithParams = $this->apiUrl . $id . '?api_key=' . $this->apiKey;

        $response = file_get_contents($urlWithParams);

        $response = json_decode($response, true);

        return $response['data'];
    }

}


    
