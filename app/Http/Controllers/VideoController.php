<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Video;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Requests\CreateVideoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('new_video');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateVideoRequest $request)
    {

        Video::create($this->FilesData($request, new Video()));

        return to_route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $likes = Like::where("video_id", $id)
            ->where("like", 1)
            ->get();

        $like = 0 ;
        foreach ($likes as $l){
            $like +=1;
        }


        $dislikes = Like::where("video_id", $id)
            ->where("dislike", 1)
            ->get();
        $dis = 0 ;
        foreach ($dislikes as $d){
            $dis +=1;
        }

        return view('view', [
            'suggestion_videos' => Video::all(),
            'video' => Video::find($id),
            'likes' => $like,
            'dislikes' => $dis
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {

        return view('edit-video',['video'=>$video]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateVideoRequest $request,Video $video)
    {
        $video->update($this->FilesData($request, $video));
        return view('view', ['suggestion_videos' => Video::all(),'video' => $video]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // Ici on supprime la video existante
        Storage::disk('public')->delete($video->videoPath);
        // Ici on supprime l'image existante
        Storage::disk('public')->delete($video->imagePath);
        $video->delete();
        return to_route('dashboard');
    }

    private function FilesData(CreateVideoRequest $request,Video $video) :array
    {
        $data = $request->validated();
        /** @var  UploadedFile|null $img */
        /** @var UploadedFile|null $vid */
        $img = $request->validated('image');
        $vid = $request->validated('video');

        // Ici on supprime la video existante
        if($video->videoPath){
            Storage::disk('public')->delete($video->videoPath);
        }
        // Ici on supprime l'image existante
        if($video->imagePath){
            Storage::disk('public')->delete($video->imagePath);
        }

        if($img == null || $img->getError()){
            $data['imagePath']  = "/storage/blog/415749541_7325104604167343_5860027160449550950_n.jpg";
        }else{
            $data['imagePath'] = $img->store('images', 'public');
        }

        $data['videoPath'] = $vid->store('videos', 'public');
        if($video->views == null){
            $data['views'] = 0;
            $data['user_id'] = 1; // Utilisateur connecte
        }else{
            $data['views'] = $video->views;
            $data['user_id'] = $video->user_id;
        }
        return $data;
    }
}
