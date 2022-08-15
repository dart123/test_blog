<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class PostService
{
    private CommentService $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function getLastPosts($post_num = 6) {
        return Post::select('*')
            ->orderBy('id', 'DESC')
            ->limit($post_num)
            ->get();

    }

    public function getAllPosts($per_page = 10) {
        return Post::select('*')
            ->orderBy('id', 'DESC')
            ->paginate($per_page);
    }

    public function getPostBySlug($slug) {
        try {
            $post = Post::where('slug', '=', $slug)->firstOrFail();

            $comments = $this->commentService->getPostComments($post);
            return [
                'info' => $post,
                'comments' => $comments
            ];
        }
        catch (\Exception $e) {
            Log::error('Exception: '.$e->getMessage());
            return false;
        }

    }
}
