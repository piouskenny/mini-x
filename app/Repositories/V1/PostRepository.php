<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\PostResource;
use App\Interfaces\V1\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostRepositoryInterface
{
    public function all()
    {
        $post = Post::paginate(20);

        // return PostResource::collection($post);
        return $post;
    }

    public function create(array $data)
    {
        $post = Post::create($data);

        return $post;
    }

    public function edit(array $data)
    {
        $post = Post::find($data['post_id']);

        $user_details = Auth::user();

        //  check if it was the user that actually created the post
        if ($post->user_id != $user_details['id']) {
            return false;
        }
        $post->update($data);

        return $post;
    }

    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();

        return true;
    }
}
