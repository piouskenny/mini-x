<?php

namespace App\Http\Controllers\Api\V1\Posts;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;
use App\Interfaces\V1\PostRepositoryInterface;
use App\Repositories\V1\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct(protected PostRepositoryInterface $postRepositoryInterface)
    {
    }
    public function all()
    {
        DB::beginTransaction();

        try {
            $posts  = $this->postRepositoryInterface->all();
            return ApiResponseClass::sendResponse(PostResource::collection($posts), 'all posts', 201);
         } catch(\Exception $e) {
            report($e);
            return ApiResponseClass::rollback($e, "Opps!!! something went wrong");
        }
    }
}
