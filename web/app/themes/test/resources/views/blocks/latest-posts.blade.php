<section class="my-10">
  <div class="max-w-[1300px] mx-auto px-4">
    @if ($heading)
      <h2 class="text-[28px] lg:text-[36px] font-bold text-[#161B3D] text-center mb-12">{{ $heading }}</h2>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-[30px] gap-y-[50px] text-left">
      @foreach ($posts as $post)
        @php
          setup_postdata($post);
          $categories = get_the_category($post);
          $category = $categories ? $categories[0] : null;
        @endphp

        <article class="flex flex-col xl:flex-row gap-7.5 lg:gap-10">
          <div class="relative w-[285px] sm:w-[485px] md:w-[585px] lg:w-[235px] h-[285px] sm:h-[485px] md:h-[520px] lg:h-[235px] shrink-0">
            <div class="absolute w-full h-full bg-[#00E6CA] z-0"></div>
            <img
              src="{{ get_the_post_thumbnail_url($post, 'medium') }}"
              alt="{{ get_the_title($post) }}"
              class="absolute top-[15px] left-[15px] lg:top-4 lg:left-4 w-full h-full object-cover z-10"
            >
          </div>

          <div class="flex flex-col gap-2.5">
            <div class="flex flex-col justify-between gap-2.5 lg:gap-[15px] pt-[15px]">
              @if ($category)
                <span class="text-xs font-normal bg-[#F551FF] text-white w-fit py-1.5 px-2.5">
                  {{ $category->name }}
                </span>
              @endif

              <h3 class="font-bold text-[#0D0C2B] text-2xl font-[Mulish]">
                <a href="{{ get_permalink($post) }}">{{ get_the_title($post) }}</a>
              </h3>

              <div class="flex items-center text-xs text-[#6E6E6E] gap-2">
                <span>Added: {{ get_the_date('d F Y', $post) }}</span>

                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1.25 3.125V13.125H3.75V16.3086L4.76562 15.4883L7.71484 13.125H13.75V3.125H1.25ZM2.5 4.375H12.5V11.875H7.28516L7.10938 12.0117L5 13.6914V11.875H2.5V4.375ZM15 5.625V6.875H17.5V14.375H15V16.1914L12.7148 14.375H8.02734L6.46484 15.625H12.2852L16.25 18.8086V15.625H18.75V5.625H15Z" fill="#7B7485"/>
                </svg>

                <span>{{ get_comments_number($post) }}</span>
              </div>

              <p class="text-lg font-normal text-[#161B3D]">
                {!! Str::limit(strip_tags(get_the_excerpt($post)), 100) !!}
              </p>
            </div>

            <div class="flex items-center gap-2">
              <img src="{{ get_avatar_url($post->post_author) }}" class="w-5 h-5 rounded-full" alt="">
              <span class="text-lg text-[#BDBDBD] font-semibold">
                {{ get_the_author_meta('display_name', $post->post_author) }}
              </span>
            </div>
          </div>
        </article>
      @endforeach
      @php wp_reset_postdata() @endphp
    </div>

    @if ($button_label)
      <div class="mt-10 text-center">
        <a href="{{ get_post_type_archive_link('post') }}" class="inline-block px-6 py-3 bg-black text-white rounded hover:opacity-80 transition">
          {{ $button_label }}
        </a>
      </div>
    @endif
  </div>
</section>
