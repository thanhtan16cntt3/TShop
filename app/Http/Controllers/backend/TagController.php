<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostTag\CreatePostTagRequest;
use App\Http\Requests\PostTag\UpdatePostTagRequest;
use App\Repositories\Tag\ITagRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class TagController extends Controller
{
    private $tagRepository;

    public function __construct(ITagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tagRepository->getTagWithPaginate(5);

        return view('backend.post-tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post-tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostTagRequest $request)
    {
        $slug = Str::slug($request->title);

        $tags = $this->tagRepository->getPostTagBySlug($slug);

        if(count($tags) > 0){
            $slug = $slug . "-" . Carbon::parse(now())->timestamp;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'status' => $request->status
        ];
        $result = $this->tagRepository->create($data);
        if($result){
            request()->session()->flash('success','Post tag successfully added');
        } else{
            request()->session()->flash('error','Error occurred while adding post tag');
        }
        return redirect()->route('tags.create');
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
        $tag = $this->tagRepository->find($id);

        return view('backend.post-tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostTagRequest $request, $id)
    {
        $slug = Str::slug($request->title);

        $tags = $this->tagRepository->getPostTagBySlug($slug);

        if(count($tags) > 1){
            $slug = $slug . "-" . Carbon::parse(now())->timestamp;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'status' => $request->status
        ];

        $result = $this->tagRepository->update($id, $data);

        if($result){
            request()->session()->flash('success','Post tag successfully edited');
        } else{
            request()->session()->flash('error','Error occurred while editing post tag');
        }
        return redirect()->route('tags.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->tagRepository->delete($id);

        if($result){
            request()->session()->flash('success','Post tag successfully deleted');
        } else{
            request()->session()->flash('error','Error occurred while deleting post tag');
        }
        return redirect()->route('post-tags.index');
    }
}
