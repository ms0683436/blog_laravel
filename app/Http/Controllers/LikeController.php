<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LikeService;
use App\Like;

class LikeController extends Controller
{
    protected $liketService;

    public function __construct(LikeService $liketService)
    {
        $this->liketService = $liketService;
    }

    public function store(Request $request)
    {
        $like = $this->liketService
                ->store(Auth::user()->id, $request->object_id, $request->object);

        $count = $this->liketService
                ->count($request->object_id, $request->object);

        return response()->json($count);
    }

    public function count()
    {

    }

    public function isActive()
    {

    }

    public function destroy(Request $request)
    {
        $like = $this->liketService
                ->getLike(Auth::user()->id, $request->object_id, $request->object);
        $like->delete();

        $count = $this->liketService
                ->count($request->object_id, $request->object);

        return response()->json($count);
    }
}
