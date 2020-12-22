@extends('layouts.app')
@section('page-title')
    <!-- Page Title
		============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h2>Новости</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Новости</li>
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

                    <!-- Posts
                    ============================================= -->
                    <div id="posts" class="row grid-container gutter-40">
                        @foreach ($posts as $post)
                            <div class="entry col-12">
                                @php
                                      $date = new DateTime($post->created_at);
                                @endphp
                                <div class="grid-inner row no-gutters">
                                    <div class="entry-image col-md-4">
                                        <a href="/storage/{{$post->picture}}" data-lightbox="image"><img src="/storage/{{$post->picture}}" alt="{{$post->title}}"></a>
                                    </div>
                                    <div class="col-md-8 pl-md-4">
                                        <div class="entry-title title-sm">
                                            <h2><a href="/news/{{$post->id}}-{{$post->slug}}">{{$post->title}}</a></h2>
                                        </div>
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
                                                {{--<li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                                <li><a href="index-blog-2.html#"><i class="icon-camera-retro"></i></a></li>--}}
                                            </ul>
                                        </div>
                                        <div class="entry-content">
                                            <p>{{ Illuminate\Support\Str::limit($post->description, 250) }}</p>
                                            <a href="/news/{{$post->id}}-{{$post->slug}}" class="more-link">Читать далее</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div><!-- #posts end -->

                    <!-- Pager
                    ============================================= -->
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{$posts->previousPageUrl()}}" class="btn btn-outline-dark {{ ($posts->onFirstPage()) ? 'disabled' : '' }}" >&larr; Назад</a>
                        <a href="{{$posts->nextPageUrl()}}" class="btn btn-outline-dark {{ ($posts->currentPage() == $posts->lastPage()) ? 'disabled' : '' }}">Далее &rarr;</a>
                    </div>
                    <!-- .pager end -->

                </div><!-- .postcontent end -->

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
