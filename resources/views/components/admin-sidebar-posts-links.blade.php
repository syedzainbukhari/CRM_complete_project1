<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Posts</span>
    </a>
    <div id="collapsePost" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Posts</h6>
            <a class="collapse-item" href="{{route('post.create')}}">Create s posts</a>
            <a class="collapse-item" href="{{route('posts.viewIndex')}}">View All Posts</a>
        </div>
    </div>
</li>
