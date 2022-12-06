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
	<section class="tj-blog-detail">
		<div class="container">
			<div class="row">
					<div class="col-md-9 col-sm-8 col-xs-12">
					    <div class="blog-detail-outer">
						@foreach($blogs as $blog)
						<div class="blog-outer">
							<figure class="blog-thumb">
								<img src="{{asset('images/blogs/'.$blog->image)}}" alt="">
								<div class="blog-date">
									<strong>{{$blog->date}}</strong>
								</div>
								<ul class="blog_meta">
								<li><i class="far fa-comments"></i>  <?php echo (count(App\Models\BlogModel::find($blog->id)->comment));?></li>
							</ul>
							</figure>
							
							<h3>{{$blog->title}}l</h3>
							<div class="blog-text">
								<p>{{$blog->description}}</p>
							<div class="quote">
						</div>
						@endforeach
						<div class="tj-comment-outer">
							<h3>Comments</h3>
							<!--Comments Listed Start-->
							<ul class="comments-listed">
								@foreach($comments as $comment)
								<li>
									<div class="comments-info">
										<div class="text-holder">
												<p>{{$comment->comment}}  </p>
											</div>
										</div>
									
								</li>
								@endforeach
							</ul><!--Comments Listed End-->
						</div>
						</div>
					</div>
					</div>
					</div>
				    <!--Widgets Column Start-->
    				<div class="col-md-3 col-sm-4 col-xs-12">
    				     <div class="blog-detail-outer">
    					<div class="tj-sidebar-outer">
    						<div class="recent-post widget">
    							<h3>Recent Blogs</h3>
    							<div class="recent-news">
    								<ul>
    									@foreach($images as $image)
    									<li>
    										<figure>
    											<a href="{{route('all_blogs', $image->id)}}"><img src="{{asset('images/blogs/'.$image->image)}}" alt=""></a>
    										</figure>
    										<div class="detail-box">
    											<h4><a href="#">Book Taxi Online</a></h4>
    												<span><i class="far fa-calendar-alt"></i> Nov 12, 2018</span>
    										</div>
    									</li>
    									@endforeach
    								</ul>
    							</div>
    						</div>
    					</div>
    					</div>
    				</div>
    			</div>
			</div> 
	</section>
@endsection
	