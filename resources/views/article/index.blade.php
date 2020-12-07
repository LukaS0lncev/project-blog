@extends('layouts.app')
@extends('widgets.subscribe')
@extends('widgets.links')
@extends('widgets.recent-posts')
@extends('layouts.top-bar')
@extends('layouts.footer.blade.php.del')
@extends('layouts.header')
@inject('User', 'App\Models\User')
@section('page-title')
    <!-- Page Title
		============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>{{$article->title}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$article->title}}</li>
            </ol>
        </div>

    </section><!-- #page-title end -->
@endsection
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">
            {!! $article->article_html !!}
        </div>
    </div>
@endsection
