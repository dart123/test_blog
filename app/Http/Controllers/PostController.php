<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index() {
        $posts = $this->postService->getLastPosts(6);
        $active_menu_item = 'main';
        return view('main',
            [
                'posts' => $posts,
                'active_menu_item' => $active_menu_item
            ]
        );
    }
    public function create() {
        return view('post_create');
    }
    public function edit($id) {
        $post = Post::where('id', $id)->first();
        return view('post_edit')->with(['post' => $post]);
    }

    public function update(Request $request, $id) {
        $data = $request->except(['_method', '_token']);
        DB::beginTransaction();
        try {
            $post = $this->postService->storePost($data, $id);
            DB::commit();
            return Redirect::route('articles.edit', $post->id)->with('success',
                trans('posts.save_success'));
        } catch (\Throwable $e) {
            Log::error(\sprintf('Cant save post %d, error %s', $id, $e->getMessage()));
            DB::rollBack();
            return Redirect::route('articles.edit', $id)->with('error',
                trans('posts.save_error'))->withInput();
        }
    }
    public function store(Request $request) {
        $data = $request->except(['_method', '_token']);
        DB::beginTransaction();
        try {
            $post = $this->postService->storePost($data);
            DB::commit();
            return Redirect::route('articles.edit', $post->id)->with('success',
                trans('posts.save_success'));
        } catch (\Throwable $e) {
            Log::error(\sprintf('Cant save post! Error: %s', $e->getMessage()));
            DB::rollBack();
            return Redirect::route('articles.create')->with('error',
                trans('posts.save_error'))->withInput();
        }
    }
    public function destroy($id) {
        if ($id) {
            try {
                $post = Post::where('id', $id)->firstOrFail();
                $post->delete();
                return json_encode(['text' => trans('posts.delete_success'), 'success' => '1']);
            }
            catch (\Throwable $e) {
                return json_encode(['text' => trans('posts.delete_error'), 'success' => '0']);
            }
        }
    }
    public function getPostsByUser() {
        $posts = $this->postService->getAllPosts(10);
        $active_menu_item = 'catalog';
        return view('post_list',
            [
                'posts' => $posts,
                'active_menu_item' => $active_menu_item
            ]
        );
    }

    public function show($slug) {
        $post = $this->postService->getPostBySlug($slug);
        if (!$post)
        {
            App::abort(404);
        }

        $active_menu_item = 'catalog';

        return view('post_single',
            [
                'post' => $post,
                'active_menu_item' => $active_menu_item
            ]
        );
    }
}
