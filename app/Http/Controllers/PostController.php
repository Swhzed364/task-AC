<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Http\Requests\post\IndexRequest;
use App\Http\Requests\post\StoreRequest;
use App\Http\Requests\post\UpdateRequest;
use App\Http\Resources\PostResouce;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    public function index (IndexRequest $request)
    {
        $posts = Post::all();

        $validated = $request->validated();

        if (isset($validated['filter'])) {

            $filteredPosts = PostService::filter($validated['filter'], $posts);

            $posts = $filteredPosts;
        }

        if (isset($validated['sort'])) {

            $sortedPosts = PostService::sort($validated['sort'], $posts);

            $posts = $sortedPosts;
        }

        $paginatedPosts = PaginationHelper::paginate($posts);
        #dd($paginatedPosts);
        return PostResouce::collection($paginatedPosts);
    }

    public function store (StoreRequest $request)
    {
        $validated = $request->validated();

        $post = Post::firstOrCreate($validated);

        return new PostResouce($post);
    }

    public function update (UpdateRequest $request, $id)
    {
        $validated = $request->validated();

        $post = Post::findOrFail($id);

        $post->update($validated);
    }

    public function show ($id)
    {
        $post = Post::findOrFail($id);

        return new PostResouce($post);
    }

    public function destroy ($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return response()->json([
            'data' => [
                'message' => 'Post deleted succesfully'
            ]
        ], 200);
    }
}
