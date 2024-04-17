<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    /**
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function saveFavouriteGif(Request $request)
    {
        try {
            dd($request);

            $userId = $request->user()->id;

            $request->validate([
                'gifId' => 'required',
                'alias' => 'required',
            ]);

            $requestData = $request->only(['gifId', 'alias']);

            $requestData['userId'] = $userId;



            $data = $this->userService->saveFavouriteGif($requestData);

            return response()->json(['message' => 'Favourite GIF saved successfully.', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred while saving favourite gif', 'error' => $e->getMessage()], 500);
        }
    }

}

?>
