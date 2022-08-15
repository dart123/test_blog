<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    private $commentService;
    public function __construct(CommentService $service)
    {
        $this->commentService = $service;
    }
    public function store(StoreCommentRequest $request) {
        $validated = $request->validated();
        Log::debug("validated: ".print_r($validated,true));

        $result = $this->commentService->addComment($validated);
        if ($result)
            return 1;
        else
            return json_encode(['error' => 'Something went wrong']);
    }
}
