@extends('layouts.app')
@section('page-title')
    <!-- Page Title
		============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h2>Категории</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Категории</li>

            </ol>
        </div>

    </section><!-- #page-title end -->
@endsection
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <!-- Posts
            ============================================= -->
            <div id="posts" class="post-grid row grid-container gutter-30" data-layout="fitRows">

                @foreach($categories as $category)
                <div class="entry col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="grid-inner">
                        <div class="entry-title">
                            <h2><a href="/category/{{$category->slug}}">{{$category->name}}</a></h2>
                        </div>
                        <div class="entry-content">
                            <p>{{$category->description}}</p>
                            <a href="/category/{{$category->slug}}" class="more-link">Все статьи</a>
                        </div>
                    </div>
                </div>
                @endforeach



            </div><!-- #posts end -->
        </div>
    </div>
@endsection
