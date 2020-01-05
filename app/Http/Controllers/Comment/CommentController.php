<?php

namespace App\Http\Controllers\Comment;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  static function  commentSave(Request $request, $handlerId,$trackerId,$type,$table,$Id){

        $comment  =  new Comment();

        $frontUserId  = DB::table('ServApplicationTracker as s')
            ->select('c.FrontUserID')
            ->where('TrackerID',$trackerId)
            ->join(''.$table.' as c','c.'.$Id.'','=','s.ApplicationID')
            ->first();

        $comment->Comment  =  $request->comment;
        $comment->StaffID  =  $handlerId;
        $comment->TrackerID  =  $trackerId;
        $comment->CommentType  =  $type;
        $comment->FrontUserID= $frontUserId->FrontUserID;
        $comment->save();
    }



    public  static function  getComments($trackerId){

        $comments  =  DB::table('Comments as c')
            ->select('s.Username','c.CommentType','c.Comment','c.TrackerID','c.Date')
            ->where('c.TrackerID','=',$trackerId)
            ->join('Staff as s','s.StaffID','=','c.StaffID')
            ->get();

        return $comments;

    }
}
