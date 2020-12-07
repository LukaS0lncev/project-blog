<div class="widget clearfix">
        <h4>Облако тегов</h4>
        <div class="tagcloud">
            @foreach($tags as $tag)
            <a href="/tag/{{$tag->slug}}">{{$tag->name}}</a>
            @endforeach
        </div>
</div>
