<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    CommentModel, BlogModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments=CommentModel::all();
        return view("comments.comment", compact("comments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogs=BlogModel::all();
        return view("comments.add_comment", compact("blogs"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            "blog"          =>  "required",
            "comment"       =>  "required",
        ])->validate();
        
        DB::beginTransaction();
        try{
            CommentModel::create([
                "blog_id"          =>  $request["blog"],
                "comment"         =>  $request["comment"]
            ]);
            DB::commit();
            return redirect()->route("comment_models.index")->with(
                Session::flash("message", " Comment added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the comment"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
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
        $comments=CommentModel::where("id", $id)->get();
        $blogs=BlogModel::all();
        return view("comments.edit_comment", compact("blogs", "comments"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            "blog"          =>  "required",
            "comment"       =>  "required",
        ])->validate();
        
        DB::beginTransaction();
        try{
            CommentModel::where("id", $id)->update([
                "blog_id"          =>  $request["blog"],
                "comment"         =>  $request["comment"]
            ]);
            DB::commit();
            return redirect()->route("comment_models.index")->with(
                Session::flash("message", " Comment updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the comment"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(CommentModel::where("id", $id)->delete()){
            return redirect()->route("comment_models.index")->with(
                Session::flash("message", "Comment deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the comment"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
