<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategory\CreatePostCategoryRequest;
use App\Http\Requests\PostCategory\UpdatePostCategoryRequest;
use App\Repositories\PostCategory\IPostCategoryRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class PostCategoryController extends Controller
{
    private $postCategoryRepository;

    public function __construct(IPostCategoryRepository $postCategoryRepository)
    {
        $this->postCategoryRepository = $postCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories = $this->postCategoryRepository->getPostCategoryWithPaginate(5);

        return view('backend.post-categories.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostCategoryRequest $request)
    {
        $slug = Str::slug($request->title);

        $postCategories = $this->postCategoryRepository->getPostCategoryBySlug($slug);

        if(count($postCategories) > 0){
            $slug = $slug . "-" . Carbon::parse(now())->timestamp;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'status' => $request->status,
        ];

        $result = $this->postCategoryRepository->create($data);

        if($result){
            request()->session()->flash('success','Post Category successfully added');
        } else{
            request()->session()->flash('error','Error occurred while adding post category');
        }
        return redirect()->route('post-categories.create');
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
        $postCategory = $this->postCategoryRepository->find($id);

        return view('backend.post-categories.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostCategoryRequest $request, $id)
    {
        $slug = Str::slug($request->title);

        $postCategories = $this->postCategoryRepository->getPostCategoryBySlug($slug);

        if(count($postCategories) > 1){
            $slug = $slug . "-" . Carbon::parse(now())->timestamp;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'status' => $request->status
        ];

        $result = $this->postCategoryRepository->update($id, $data);

        if($result){
            request()->session()->flash('success','Post Category successfully edited');
        } else{
            request()->session()->flash('error','Error occurred while editing post category');
        }
        return redirect()->route('post-categories.edit', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->postCategoryRepository->delete($id);

        if($result){
            request()->session()->flash('success','Post Category successfully deleted');
        } else{
            request()->session()->flash('error','Error occurred while deleting post category');
        }
        return redirect()->route('post-categories.index');
    }
}
