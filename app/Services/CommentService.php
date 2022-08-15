<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class CommentService
{
    public function addComment($comment_data) {
        try {
            $comment = new Comment;
            $comment->content = $comment_data['content'];
            $comment->post_id = $comment_data['post_id'];
            $comment->parent_id = $comment_data['parent_id'];
            $result = $comment->save();
            return $result;
        }
        catch(\Exception $e) {
            Log::error('Exception: '.$e->getMessage());
            Log::error($e->getTraceAsString());
            return false;
        }
    }

    public function getPostComments($post) {
        $comments = $post->comments;
        return $comments;
    }
}
