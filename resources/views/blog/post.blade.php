@extends('layouts.app')
@extends('widgets.subscribe')
@extends('widgets.links')
@extends('widgets.recent-posts')
@extends('layouts.top-bar')
@extends('layouts.footer')
@extends('layouts.header')
@inject('User', 'App\Models\User')
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row gutter-40 col-mb-80">
                <!-- Post Content
                ============================================= -->
                <div class="postcontent col-lg-9">

                    <div class="single-post mb-0">

                        <!-- Single Post
                        ============================================= -->
                        <div class="entry clearfix">

                            <!-- Entry Title
                            ============================================= -->
                            <div class="entry-title">
                                <h2>{{$post->title}}</h2>
                            </div><!-- .entry-title end -->
                        @php
                              $date = new DateTime($post->created_at);
                        @endphp
                            <!-- Entry Meta
                            ============================================= -->
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="icon-calendar3"></i> {{$date->format('F j, Y')}}</li>
                                    <li><a href="/user/{{$post->user->id}}"><i class="icon-user"></i> {{$post->user->name}}</a></li>
                                    <li><i class="icon-tag"></i>
                                        @foreach($post->tags as $tag)
                                            <a href="/tag/{{$tag->slug}}">{{$tag->name}}</a>
                                    @endforeach
                                    <li><i class="icon-folder-open"><a href="/category/{{$post->category->slug}}">{{$post->category->name}}</a></i>
                                    {{--<li><a href="blog-single-small.html#"><i class="icon-comments"></i> 43 Comments</a></li>
                                    <li><a href="blog-single-small.html#"><i class="icon-camera-retro"></i></a></li>--}}
                                </ul>
                            </div><!-- .entry-meta end -->

                            <!-- Entry Content
                            ============================================= -->
                            <div class="entry-content mt-0">
                                {!! $post->post_html !!}
                            </div>
@endsection
