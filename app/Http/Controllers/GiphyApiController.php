<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GiphyApiService;

class GiphyApiController extends Controller
{
    protected $giphyApiService;

    /**
     * @return void
     */
    public function __construct(GiphyApiService $giphyApiService)
    {
        $this->giphyApiService = $giphyApiService;
    }

    /**
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function findOne($id)
    {
        try {
            $data = $this->giphyApiService->searchGifById($id);

            return response()->json(['message' => 'Success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred while finding a GIF', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function findAll(Request $request)
    {
        try {
            $request->validate([
                'q' => 'nullable|string',
                'limit' => 'nullable|numeric',
                'offset' => 'nullable|numeric',
            ]);

            $parameters = array_merge($request->only(['q', 'limit', 'offset']), [
                'q' => $request->input('q', ''), 
                'limit' => $request->input('limit', 10), 
                'offset' => $request->input('offset', 0), 
            ]);

            $data = $this->giphyApiService->searchGifs($parameters);

            return response()->json(['message' => 'Success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred while fetching gifs', 'error' => $e->getMessage()], 500);
        }
    }
}

?>
