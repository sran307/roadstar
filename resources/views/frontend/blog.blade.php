@extends("frontend.layout")
@section("title", "Blog")
@section("content")
	<!--Inner Banner Section Start-->
	<div class="tj-inner-banner">
	    <div class="container">
	    	<h2>{{$heading}}</h2>
	    </div>
	</div>
	<!--News Content Start-->
	<section class="tj-news">
		<div class="container">
			<div class="row"> 
			@foreach($blogs as $blog)
				@if($blog->status=='active')
				<div class="col-md-4 col-sm-6">
					<div class="news-box">
						<figure>
							<img src="{{asset('images/blogs/'.$blog->image)}}" alt=""/>
						</figure>
						<div class="news-detail">
							<a href="{{route('all_blogs', $blog->id)}}"><h4>{{$blog->title}}</h4></a>
							<p>{{$blog->description}}</p>
							<ul>
								<li><i class="far fa-clock">  </i> <?php $time=strtotime($blog->date);
																	$month=date("F",$time);
																	$year=date("Y",$time);
																	$date=date("d", $time);
																	echo($month.' '.$date.', '.$year);
																?>
								</li>
								<li><i class="far fa-comments"></i> <?php echo (count(App\Models\BlogModel::find($blog->id)->comment));?></li>
							</ul>
						</div>
					</div>
				</div>
				@endif
			@endforeach
			</div>
		</div>
	</section>
@endsection
	