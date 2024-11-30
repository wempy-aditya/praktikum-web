<?php

namespace App\Http\Controllers\Api;
//import model Post
use App\Models\Post;
use App\Http\Controllers\Controller;
//import resource PostResource
use App\Http\Resources\PostResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $posts = Post::latest()->paginate(5);
        //return collection of posts as a resource
        return new PostResource(true, 'List Data Posts', $posts);
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        // Find post by ID
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return new PostResource(true, 'Post Found', $post);
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'user_id' => 'required|integer|exists:users,id',
            'slug' => 'required|string|unique:posts,slug',
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle file upload
        $thumbnail = $request->file('thumbnail')
            ? $request->file('thumbnail')->store('thumbnails')
            : null;

        // Jika file diupload, hilangkan prefix 'public/' dari path yang disimpan
        // if ($thumbnail) {
        //     $thumbnail = str_replace('public/', '', $thumbnail);
        // }

        // Create the post
        $post = Post::create(array_merge($request->all(), [
            'thumbnail' => $thumbnail,
        ]));

        // Return response
        return new PostResource(true, 'Post Created Successfully', $post);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable|integer|exists:categories,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'slug' => "nullable|string|unique:posts,slug,$id",
            'title' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'status' => 'nullable|in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('thumbnails');
            // $thumbnail = str_replace('public/', '', $thumbnail);
            $post->update(array_merge(
                $request->except(['_method', 'thumbnail']),
                ['thumbnail' => $thumbnail]
            ));
        } else {
            $post->update($request->except('_method'));
        }

        return new PostResource(true, 'Post Updated Successfully', $post);
    }


    /**
     * Remove the specified post.
     */
    public function destroy($id)
    {
        // Find post by ID
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Delete the post
        $post->delete();

        return new PostResource(true, 'Post Deleted Successfully', null);
    }
}
