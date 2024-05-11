<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Li;

class LikeController extends Controller
{
    public function like(Request $request)
    {

        $user = Like::where("video_id",$request->video_id)
            ->where("user_id", Auth::user()->id)
            ->get();

        if($user->count() > 0){
            $dislike = Like::where("video_id",$request->video_id)
                ->where("user_id", Auth::user()->id)
                ->where("dislike", 1)
                ->get();
            if($dislike->count() > 0){
                echo "mise a jour dislike 0 !";
                Like::where("video_id",$request->video_id)
                    ->where("user_id", Auth::user()->id)
                    ->update(["dislike" => 0, "like" => 1]);

            }else{
                $l  = Like::where("video_id",$request->video_id)
                    ->where("user_id", Auth::user()->id)
                    ->where("like", 1);
                if($l->count() > 0){
                    Like::where("video_id",$request->video_id)
                        ->where("user_id", Auth::user()->id)
                        ->update(["like" => 0]);
                }else{
                    Like::where("video_id",$request->video_id)
                        ->where("user_id", Auth::user()->id)
                        ->update(["like" => 1]);
                }
                echo "mise de like a 0";
            }
        }else{
            Like::create([
                'like' => 1,
                'dislike' => 0,
                'video_id' => $request->video_id,
                'user_id' => Auth::user()->id
            ]);
            echo "On cree l'user puis on like";
        }
        return to_route("video.show", $request->video_id);
    }

    public function dislike(Request $request)
    {
        $user = Like::where("video_id",$request->video_id)
            ->where("user_id", Auth::user()->id)
            ->get();
        if($user->count() > 0){
            $like = Like::where("video_id",$request->video_id)
                ->where("user_id", Auth::user()->id)
                ->where("like", 1)
                ->get();
            if($like->count() > 0){
                echo "mise a jour like 0 !";
                Like::where("video_id",$request->video_id)
                    ->where("user_id", Auth::user()->id)
                    ->update(["dislike" => 1, "like" => 0]);

            }else{
                $d  = Like::where("video_id",$request->video_id)
                    ->where("user_id", Auth::user()->id)
                    ->where("dislike", 1);
                if($d->count() > 0){
                    Like::where("video_id",$request->video_id)
                        ->where("user_id", Auth::user()->id)
                        ->update(["dislike" => 0]);
                }else{
                    Like::where("video_id",$request->video_id)
                        ->where("user_id", Auth::user()->id)
                        ->update(["dislike" => 1]);
                }
                echo "mise de dislike a 0";
            }
        }else{
            Like::create([
                'like' => 0,
                'dislike' => 1,
                'video_id' => $request->video_id,
                'user_id' => Auth::user()->id
            ]);
            echo "On cree l'user puis on dislike";
        }
        return to_route("video.show", $request->video_id);
    }
}
