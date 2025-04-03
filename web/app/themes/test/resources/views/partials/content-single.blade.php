@php
  $categories = get_the_category();
  $category = $categories ? $categories[0] : null;
  $author_id = get_the_author_meta('ID');
@endphp

<section class="px-4">
    <div class="flex items-start gap-3 mb-6">
      <svg class="self-center hidden lg:block" width="100" height="1" viewBox="0 0 100 1" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="100" height="1" fill="black"/>
      </svg>
      <nav class="text-base lg:text-xl font-normal text-black font-[Mulish]">
        @if ($category)
          <a href="{{ get_category_link($category) }}">{{ $category->name }}</a>
        @endif
        <span class="mx-1">/</span>
        <span>{{ get_the_title() }}</span>
      </nav>
    </div>

    <h1 class="text-[28px] lg:text-[56px] leading-[36px] lg:leading-[68px] font-bold text-[#0D0C2B] font-[Spartan] mb-6">
      {!! $title !!}
    </h1>

</section>

@if (has_post_thumbnail())
  <div class="max-w-[1170px] mx-auto mb-12 px-4">
    <img
      src="{{ get_the_post_thumbnail_url(null, 'full') }}"
      alt="{{ get_the_title() }}"
      class="w-full h-auto object-cover rounded"
    >
  </div>
@endif

<section class="px-4 mb-12">
  <div class="max-w-[870px] mx-auto flex flex-col gap-4">
    <div class="flex items-center gap-3">
      <img src="{{ get_avatar_url($author_id) }}" class="w-9 h-9 rounded-full" alt="{{ get_the_author() }}">
      <p class="text-[#161B3D] text-[22px] font-semibold text-sm">{{ get_the_author() }}</p>
    </div>

    <div class="flex items-center justify-between text-sm text-[#7B7485]">
      <span>Added: {{ get_the_date('d F Y') }}</span>
      <span class="flex items-center gap-1">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.25 3.125V13.125H3.75V16.3086L4.76562 15.4883L7.71484 13.125H13.75V3.125H1.25ZM2.5 4.375H12.5V11.875H7.28516L7.10938 12.0117L5 13.6914V11.875H2.5V4.375ZM15 5.625V6.875H17.5V14.375H15V16.1914L12.7148 14.375H8.02734L6.46484 15.625H12.2852L16.25 18.8086V15.625H18.75V5.625H15Z" fill="#7B7485"/>
        </svg>
        {{ get_comments_number() }}
      </span>
    </div>
  </div>
</section>

<section class="px-4">
  <div class="max-w-[870px] mx-auto prose prose-lg text-[#161B3D] font-[Mulish]">
    @php(the_content())
  </div>
</section>

<section class="px-4 mt-20">
  <div class="max-w-[870px] mx-auto">
    @php(comments_template())
  </div>
</section>
