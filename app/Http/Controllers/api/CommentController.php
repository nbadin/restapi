<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCommentRequest $request)
    {
        Comment::create($request->validated());

        return response()->json(['message' => 'Comment created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return CommentResource
     */
    public function show(Comment $comment)
    {
        return CommentResource::make($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     * @return CommentResource
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        return CommentResource::make($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->noContent();
    }
}
