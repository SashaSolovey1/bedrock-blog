<section class="relative xl:left-1/2 xl:translate-x-[-50%] xl:w-screen xl:px-10 2xl:px-0 bg-white py-10 xl:py-20 overflow-hidden">
  <div class="mx-auto w-full xl:max-w-[1370px] flex flex-col-reverse xl:flex-row items-center xl:items-start justify-center xl:justify-between gap-[30px] xl:gap-0">
    <div class="w-full xl:w-[558px] xl:h-[581px] flex flex-col gap-2.5 xl:gap-6 text-left">
      @if ($label)
        <span class="text-xs font-normal bg-[#F551FF] text-white w-fit py-1.5 px-2.5">
          {{ $label }}
        </span>
      @endif

      @if ($heading)
        <h2 class="text-2xl xl:text-6xl font-bold text-[#161B3D] leading-[34px] lg:leading-[88px] font-[Mulish] lg:font-[Spartan]">
          {!! nl2br(e($heading)) !!}
        </h2>
      @endif

      @if ($description)
        <p class="text-[#161B3D] text-lg lg:text-[22px] leading-[28px] max-w-[500px]">
          {{ $description }}
        </p>
      @endif
    </div>

    @if ($image)
      <div class="relative self-start w-[285px] sm:w-[485px] md:w-[585px] lg:w-[945px] h-[285px] sm:h-[485px] md:h-[520px] xl:max-w-[700px] xl:w-full xl:h-[581px]">
        <div class="absolute w-full h-full bg-[#00E6CA] z-0"></div>
        <img
          src="{{ $image['url'] }}"
          alt="{{ $image['alt'] ?? 'Hero image' }}"
          class="absolute top-[15px] left-[15px] xl:top-10 xl:left-24 w-full h-full object-cover z-10"
        >
      </div>
    @endif
  </div>
</section>
