@extends('layouts.app')
@inject('User', 'App\Models\User')
@section('page-title')
    <!-- Page Title
		============================================= -->
    <section id="page-title">
        <div style="display: flex;" class="container clearfix">
                <h2>{{$post->title}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="/news/">Новости</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
            </ol>

        </div>
    </section><!-- #page-title end -->
@endsection
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
                                            <a href="/tag/{{$tag->slug}}"><span class="badge badge-success">{{$tag->name}}</span></a>
                                    @endforeach
                                    <li><i class="icon-folder-open"></i><a href="/category/{{$post->category->slug}}">{{$post->category->name}}</a></li>
                                    <li><i class="icon-eye-open"></i>{{$post->views}}</li>
                                    {{--<li><a href="blog-single-small.html#"><i class="icon-comments"></i> 43 Comments</a></li>
                                    <li><a href="blog-single-small.html#"><i class="icon-camera-retro"></i></a></li>--}}
                                </ul>
                            </div><!-- .entry-meta end -->

                            <!-- Entry Content
                            ============================================= -->
                            <div class="entry-content mt-0">
                                {!! $post->post_html !!}
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Sidebar
                ============================================= -->
                <div class="sidebar col-lg-3">
                    <div class="sidebar-widgets-wrap">

                        <x-widgets.category-links-news/>
                        <x-widgets.tags-cloud-news/>

                    </div>
                </div><!-- .sidebar end -->

            </div>
        </div>
    </div>
@endsection
