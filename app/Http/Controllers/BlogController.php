<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    BlogModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models=BlogModel::orderBy("id", "desc")->get();
        return view("blogs.blog", compact("models"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blogs.add_blog");
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
            "image"          =>  "required | image | dimensions:max_width=360,max_height=245",
            "title"          =>  "required",
            "description"    =>  "required",
            "date"           =>  "required",
            "status"         =>  "required",
        ])->validate();

        $image=$request->file("image");
        $date=date("M-Y");
        $destination="images/blogs/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);
        
        DB::beginTransaction();
        try{
            BlogModel::create([
                "title"          =>  $request["title"],
                "image"          =>  $date.'/'.$image_name,
                "description"    =>  $request["description"],
                "date"           =>  $request["date"],
                "status"         =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("blog_models.index")->with(
                Session::flash("message", " Blog added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the blog"), 
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
        $models=BlogModel::where("id", $id)->get();
        return view("blogs.edit_blog", compact("models"));
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
            //"image"          =>  "required | image | dimensions:max_width=360,max_height=245",
            "title"          =>  "required",
            "description"    =>  "required",
            "date"           =>  "required",
            "status"         =>  "required",
        ])->validate();
        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
                "image"          =>  "required | image | dimensions:max_width=360,max_height=245",
            ])->validate();

            $image=$request->file("image");
            $date=date("M-Y");
            $destination="images/blogs/".$date;
            $image_name=$image->getClientOriginalName();
            $image->move($destination, $image_name);

            BlogModel::where("id", $id)->update([
               "image"          =>  $date.'/'.$image_name,
            ]);
        }
        
        
        DB::beginTransaction();
        try{
            BlogModel::where("id", $id)->update([
                "title"          =>  $request["title"],
                //"image"          =>  $date.'/'.$image_name,
                "description"    =>  $request["description"],
                "date"           =>  $request["date"],
                "status"         =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("blog_models.index")->with(
                Session::flash("message", " Blog updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the blog"), 
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
        if(BlogModel::where("id", $id)->delete()){
            return redirect()->route("blog_models.index")->with(
                Session::flash("message", "Blog deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the blog"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
