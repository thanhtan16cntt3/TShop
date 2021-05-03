<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Repositories\Post\IPostRepository;
use App\Repositories\PostCategory\IPostCategoryRepository;
use App\Repositories\Tag\ITagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostController extends Controller
{
    private $postRepository;
    private $postCategoryRepository;
    private $tagRepository;
    public function __construct(IPostRepository $postRepository, IPostCategoryRepository $postCategoryRepository, ITagRepository $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->postCategoryRepository = $postCategoryRepository;
        $this->tagRepository = $tagRepository;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->getPostWithTagsPaginate(5);
        // dd($posts);
        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->postCategoryRepository->getActive();
        $tags = $this->tagRepository->getActive();
        return view('backend.posts.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $slug = Str::slug($request->title);

        $post = $this->postRepository->getBySlug($slug);

        if(count($post) > 0){
            $slug = $slug . " - " . Carbon::parse(now())->timestamp;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'summary' => $request->summary,
            'quote' => $request->quote,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'photo' => $request->photo,
            'status' => $request->status,
            'added_by' => Auth::user()->id
        ];
        // dd($data);
        $post = $this->postRepository->create($data);

        
        if($post){
            $post->tags()->attach($request->tags);
            request()->session()->flash('success','Post successfully added');
        } else{
            request()->session()->flash('error','Error occurred while adding post');
        }
        return redirect()->route('posts.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->findWithTags($id);
        $categories = $this->postCategoryRepository->getActive();
        $tags = $this->tagRepository->getActive();

        

        return view('backend.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $slug = Str::slug($request->title);

        $post = $this->postRepository->getBySlug($slug);

        if(count($post) > 0){
            $slug .= "-".Carbon::parse(now())->timestamp;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'summary' => $request->summary,
            'quote' => $request->quote,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'photo' => $request->photo,
            'status' => $request->status,
        ];

        $result = $this->postRepository->update($id, $data);

        if($result){
            $result->tags()->sync($request->tags);
            request()->session()->flash('success','Post successfully edited');
        } else{
            request()->session()->flash('error','Error occurred while editing post');
        }
        return redirect()->route('posts.edit', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->postRepository->delete($id);

        if($result){
            request()->session()->flash('success','Post successfully edited');
        } else{
            request()->session()->flash('error','Error occurred while editing post');
        }
        return redirect()->route('posts.index');
    }
}
