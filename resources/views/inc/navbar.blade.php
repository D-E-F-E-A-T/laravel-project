<nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <a href="/" class="navbar-brand">{{config('app.name','CMS')}}</a>
                <li class="nav-item ">
                <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="/services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/posts">Blog</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/posts/create">Create Post</a></li>
            </ul>
        </div>
    </div>
</nav>