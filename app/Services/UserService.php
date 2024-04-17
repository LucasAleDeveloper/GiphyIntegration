<?php

namespace App\Services;
use App\Services\GiphyApiService;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $giphyApiService;

    public function __construct(GiphyApiService $giphyApiService)
    {
        $this->giphyApiService = $giphyApiService;
    }

    public function saveFavouriteGif($data)
    {
        try {
            $gif = $this->giphyApiService->searchGifById($data['gifId']);

            DB::table('users_gifs')
                ->upsert(
                    [
                        'userId' => $data['userId'],
                        'gifId' => $data['gifId'],
                        'alias' => $data['alias']
                    ],
                    ['userId'],
                    ['gifId', 'alias']
                );
                
            $favouriteGif = DB::table('users_gifs')
                ->where('userId', $data['userId'])
                ->first();    

            return $favouriteGif;
        } catch (\Throwable $th) {
            throw $th;
        }
        

        
    }
}


    
