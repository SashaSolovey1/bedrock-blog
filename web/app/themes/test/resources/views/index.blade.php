@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-[30px] gap-y-[50px] my-10">
    @while(have_posts()) @php(the_post())
    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
  @endwhile
  </div>

  {!! get_the_posts_navigation() !!}
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
