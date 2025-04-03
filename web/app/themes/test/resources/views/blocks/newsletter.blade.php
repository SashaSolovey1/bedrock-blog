<section class="bg-[#2820FC] py-[45px] px-7.5 lg:px-15 my-10">
  <div class="max-w-[800px] mx-auto text-center text-white flex flex-col items-center gap-4">
    @if ($heading)
      <h3 class="font-[Spartan] font-bold text-[30px] leading-[44px] lg:text-[40px] lg:leading-[56px]">
        {{ $heading }}
      </h3>
    @endif

    @if ($description)
      <p class="font-[Mulish] text-[18px] leading-[28px] lg:text-[22px]">
        {!! nl2br(e($description)) !!}
      </p>
    @endif

    <div class="mt-2 w-full">
      @php
        echo do_shortcode('[contact-form-7 id="62ebe2c" title="Contact form 1"]');
      @endphp
    </div>
  </div>
</section>
