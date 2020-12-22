<div class="widget widget_links clearfix">
    <h4>Категории Блога</h4>
    <ul>
        @foreach($categories as $category)
            <li><a href="/category/{{$category['slug']}}"><div>{{$category['name']}}</div></a></li>
        @endforeach
    </ul>
</div>
