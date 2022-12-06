@extends("layouts.layout")
@section("title", "comments")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Comments</h6>
        <a href="{{route('comment_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Blog Title</th>
                    <th>Comment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td>
                        <?php
                         echo(App\Models\BlogModel::where("id", $comment->blog_id)->value("title"));
                        ?>
                    </td>
                    <td>{{$comment->comment}}</td> 
                    <td class="sr_action">
                        <a href="{{route('comment_models.edit',[$comment->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('comment_models.destroy',[$comment->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection