@extends('users.layouts.app_user')
@section('content')

<article class="tab-content trade-article">
    <section id="market-news-section" class="market-news-section d-grid user_education_page_section">
        <div class="card news-search-card">
            <div class="card-header">
                <div class="card-indicators scroll">
                    @foreach ( $full_data['educationTypes'] as $educationTypes )
                        <a href="javascript:void(0)"
                        data-id="{{$educationTypes->id}}"
                        class="btn-pill education_type {{ $loop->first ? 'active' : '' }}">
                            {{ ucfirst( $educationTypes->name) }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div id="news-title-area" class="card-body scroll education_posts" style="height: calc(-224px + 110vh);overflow: auto;margin-top: 10px;">
                @foreach ( $full_data['educationPosts'] as $educationPosts )
                    @if( $educationPosts->type == $full_data['educationTypes'][0]->id )
                        <ul class="list-style-none">
                            <li>
                                <a href="javascript:void(0)" data-id="{{$educationPosts->id}}" class="education_selected">
                                    <span class="news-title">{{ strlen($educationPosts->short_description) > 30 ? substr($educationPosts->short_description, 0, 30) . '...' : $educationPosts->short_description }}</span>
                                    <span class="news-time">{{  date('M d, Y', strtotime($educationPosts->created_at)); }}</span>
                                </a>
                            </li>
                        </ul>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="news-page scroll">
                <div id="loader-image" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                    <img src="{{ asset('assets/img/100x-loader.gif') }}" alt="Loading...">
                </div>
                <div id="trading-news-container" class="trading-news-container">
                <div class="news-title-img" style="text-align: center"></div>
                <h1 class="news-title" style="font-size: 30px"></h1>
                <h3 class="news-title short_description"></h3>
                <p class="news-post-time" style="padding: 5px;"></p>
                <div class="news-body"></div>
            </div>
        </div>
    </section>
   
</article>

@endsection
