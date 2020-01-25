
<div class="sidebar">
    <aside class="menu mt-3">
        @if(isset($recentPosts))
        <span>Recent Posts</span>
            @foreach($recentPosts as $post)
            <ul>
            
            <li><a href="{{route('blog.single', ['username'=>$post->user->username, 'slug'=>$post->slug])}}">{{$post->title}}</a></li>
            
            </ul>
            @endforeach
        @endif
    </aside>
</div>