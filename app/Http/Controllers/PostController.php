<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Models\PostImage;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Resources\Post\PostResource;

class PostController extends Controller
{

    public function index() {

        $posts = Post::where('user_id', auth()->id())->latest()->get();

        return PostResource::collection($posts);
    }

    public function store(StoreRequest $request) {

        $data = $request->validated();

        try {

            DB::beginTransaction();

            $imageId = $data['image_id'];
            unset($data['image_id']);

            $data['user_id'] = auth()->id();
            $post = Post::create($data);

            $this->processImage($post, $imageId);

            PostImage::clearStorage();

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollback();

            return responce()->json(['error' => $exception->getMessage()]);

        }

        return new PostResource($post);
    }

    private function processImage($post, $imageId)
    {
        if (isset($imageId)) {
            $image = PostImage::find($imageId);
            $image->update([
                'post_id' => $post->id
            ]);
        }
    }
}
