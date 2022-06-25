@extends('layouts.frontend')
@section('title', 'Blogs')

@section('content')
<section class="section-tb-padding blog-page">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="blog-style-1-full-grid">
                    @foreach ($blogs as $blog)
                    <div class="blog-start">
                        <div class="blog-post">
                            <div class="blog-image">
                                <a href="{{ route('blogs-view',$blog->slug) }}">
                                    <img src="{{ asset('uploads/blog/'.$blog->image) }}" alt="blog-image"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-title">
                                    <h6><a
                                            href="{{ route('blogs-view',$blog->slug) }}">{{ Str::limit($blog->title,20) }}</a>
                                    </h6>
                                    <span class="blog-admin">By <span class="blog-editor">Website Admin</span></span>
                                </div>
                                <p class="blog-description">{{ $blog->short_des }}</p>
                                <a href="{{ route('blogs-view',$blog->slug) }}" class="read-link">
                                    <span>Read more</span>
                                    <i class="ti-arrow-right"></i>
                                </a>
                                <div class="blog-date-comment">
                                    <span class="blog-date">{{ $blog->created_at->diffForHumans() }}</span>
                                    <a href="javascript:void(0)">6 Comments</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="all-page">
                    <div class="page-number style-1">
                        {{ $blogs->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
