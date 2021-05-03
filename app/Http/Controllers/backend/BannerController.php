<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\banner\CreateBannerRequest;
use App\Http\Requests\backend\banner\UpdateBannerRequest;
use App\Repositories\Banner\IBannerRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    protected $bannerRepository;
    public function __construct(IBannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->bannerRepository->getBannerWithPaginate(5);

        return view('backend.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request)
    {

        $slug = Str::slug($request->title);

        // check slug banner exist
        $banner = $this->bannerRepository->getBannerBySlug($slug);

        if(count($banner) > 0){
            $slug = $slug ."-".Carbon::parse(now())->timestamp;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status,
            'photo' => $request->photo
        ];

        $result = $this->bannerRepository->create($data);
        if($result){
            request()->session()->flash('success','Banner successfully added');
        } else{
            request()->session()->flash('error','Error occurred while adding banner');
        }
        return redirect()->route('banner.create');
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
        $banner = $this->bannerRepository->find($id);
        // dd($banner);
        return view('backend.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        $slug = Str::slug($request->title);

        // check slug banner exist
        $banner = $this->bannerRepository->getBannerBySlug($slug);

        if(count($banner) > 1){
            $slug = $slug ."-".Carbon::parse(now())->timestamp;
        }

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status,
            'photo' => $request->photo
        ];
        $result = $this->bannerRepository->update($id, $data);

        if($result != false){
            request()->session()->flash('success','Banner successfully edited');
        } else{
            request()->session()->flash('error','Error occurred while editing banner');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->bannerRepository->delete($id);

        if($result){
            request()->session()->flash('success','Banner successfully deleted');
        } else{
            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
