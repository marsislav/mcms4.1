<div class="col-xl-4 col-lg-5">
    <div class="sidebar-wrapper">
        <!-- Search Form -->
        <div class="sidebar-box search-form-box mb-30">
            @include('includes.search')
        </div>
        
        <!-- Recent Posts -->
        <div class="sidebar-box recent-blog-box mb-30">
            <h4>Последни публикации</h4>
            @foreach($posts as $post)
                <div class="recent-blog-items">
                    <div class="recent-blog mb-30">
                        <div class="recent-blog-img">
                            <img src="{{ $post->featured }}" alt="{{ $post->title }}">
                        </div>
                        <div class="recent-blog-content">
                            <h5>
                                <a href="{{ route('post.single', ['slug' => $post->slug]) }}">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <span class="date">
                                <i class="lni lni-calendar"></i> {{ $post->created_at->toFormattedDateString() }}
                            </span>
                            <p class="category">
                                <i class="lni lni-folder"></i>
                                <a href="{{ route('category.single', ['id' => $post->category->id]) }}">
                                    {{ $post->category->name }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Categories -->
        <div class="sidebar-box catagories-box mb-30">
            <h4>Категории</h4>
            <ul>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('category.single', ['id' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <!-- Tags -->
        <div class="sidebar-box tags-box mb-30">
            <h4>Всички етикети</h4>
            <ul>
                @foreach($tags as $tag)
                    <li>
                        <a href="{{ route('tag.single', ['id' => $tag->id]) }}">
                            {{ $tag->tag }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <!-- Social Media Links -->
        <div class="sidebar-box mb-30">
            <h4>Последвайте ме</h4>
            <div class="footer-social-links">
                <ul class="d-flex justify-content-start">
                    @if (!empty($settings->facebook))
                        <li><a href="{{ $settings->facebook }}" target="_blank"><i class="lni lni-facebook-filled"></i></a></li>
                    @endif
                    @if (!empty($settings->instagram))
                        <li><a href="{{ $settings->instagram }}" target="_blank"><i class="lni lni-instagram-filled"></i></a></li>
                    @endif
                    @if (!empty($settings->twitter))
                        <li><a href="{{ $settings->twitter }}" target="_blank"><i class="lni lni-twitter-filled"></i></a></li>
                    @endif
                    @if (!empty($settings->tiktok))
                        <li><a href="{{ $settings->tiktok }}" target="_blank"><i class="lni lni-tiktok"></i></a></li>
                    @endif
                    @if (!empty($settings->linkedin))
                        <li><a href="{{ $settings->linkedin }}" target="_blank"><i class="lni lni-linkedin-filled"></i></a></li>
                    @endif
                    @if (!empty($settings->vkontakte))
                        <li><a href="{{ $settings->vkontakte }}" target="_blank"><i class="lni lni-vk"></i></a></li>
                    @endif
                    @if (!empty($settings->youtube))
                        <li><a href="{{ $settings->youtube }}" target="_blank"><i class="lni lni-youtube"></i></a></li>
                    @endif
                    @if (!empty($settings->skype))
                        <li><a href="{{ $settings->skype }}" target="_blank"><i class="lni lni-skype"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
