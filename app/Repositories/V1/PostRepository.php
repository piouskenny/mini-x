<?php

namespace App\Repositories\V1;

use App\Models\Post;

class PostRepository
{
    public function create(array $data)
    {
        $post = Post::create($data);

        return $post;
    }

    public function edit(array $data)
    {
        $post = Post::find($data['id']);

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
