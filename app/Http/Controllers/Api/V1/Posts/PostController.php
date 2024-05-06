<?php

namespace App\Http\Controllers\Api\V1\Posts;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\PostResource;
use App\Interfaces\V1\PostRepositoryInterface;
use App\Repositories\V1\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

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
        } catch (\Exception $e) {
            report($e);
            return ApiResponseClass::rollback($e, "Opps!!! something went wrong");
        }
    }

    public function create(PostRequest $request, $id)
    {

        $postDetails = [
            'user_id' => $id,
            'content' => $request->content,
        ];

        DB::beginTransaction();

        try {
            $post = $this->postRepositoryInterface->create($postDetails);
            DB::commit();
            return ApiResponseClass::sendResponse(new PostResource($post), 'Post created successfully', '201');
        } catch (\Exception $e) {
            report($e);
            return ApiResponseClass::rollback($e, 'Unable to create Post now, try again later');
        }
    }

    public function edit(Request $request, $post_id)
    {
        $postDetails = [
            'post_id' => $post_id,
            'content' => $request->content
        ];

        DB::beginTransaction();
        try {
            $edit = $this->postRepositoryInterface->edit($postDetails);
            DB::commit();
            return ApiResponseClass::sendResponse(new PostResource($edit), 'Post edited successfully', '201');
        } catch (\Exception $e) {
            report($e);
            return ApiResponseClass::rollback($e, 'Unable to edit Post now, try again later');
        }
    }

    public function delete($post_id)
    {
        DB::beginTransaction();

        try {
            $delete = $this->postRepositoryInterface->delete($post_id);
            DB::commit();
            return ApiResponseClass::sendResponse($delete, 'Post deleted successfully', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e, 'Unable to delete Post now, try again later');
        }
    }
}
