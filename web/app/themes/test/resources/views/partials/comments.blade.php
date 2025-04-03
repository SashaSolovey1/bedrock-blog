@if (! post_password_required())
  <section id="comments" class="comments">
    <div class="max-w-[870px] mx-auto">
      @if (get_comments_number() > 0)
        <h2 class="text-[#0D0C2B] font-bold text-xl lg:text-2xl text-center lg:text-start mb-6">
          Comments ({{ get_comments_number() }})
        </h2>

        <ol class="space-y-6">
          @php wp_list_comments(['style' => 'ol', 'callback' => 'App\\helpers\\custom_comment']) @endphp
        </ol>

        @if (get_comment_pages_count() > 1)
          <nav class="mt-8">
            <div class="flex justify-between text-sm text-[#7B7485]">
              <div class="prev">@previous_comments_link('← Previous')</div>
              <div class="next">@next_comments_link('Next →')</div>
            </div>
          </nav>
        @endif
      @endif

      @if (!comments_open())
        <div class="mt-6 text-yellow-700 bg-yellow-100 p-4 rounded">
          {{ __('Comments are closed.', 'sage') }}
        </div>
      @endif

      <h3 class="text-[#0D0C2B] font-bold text-xl lg:text-3xl mt-16 mb-4">Leave a comment</h3>

      @php(comment_form([
        'title_reply' => '',
        'class_form' => 'space-y-6',
        'class_submit' => 'bg-[#00E6CA] hover:opacity-90 transition text-white px-4 py-2 rounded',
        'label_submit' => 'Post Comment',
        'comment_field' => '
          <textarea id="comment" name="comment" rows="5"
            class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-[#00E6CA]"
            placeholder="Comment"></textarea>
        ',
        'fields' => [
          'author' => '<input id="author" name="author" type="text"
              class="w-full lg:w-[calc(33.333%-0.5rem)] border border-gray-300 rounded p-2"
              placeholder="Name *">',
          'email' => '<input id="email" name="email" type="email"
              class="w-full lg:w-[calc(33.333%-0.5rem)] border border-gray-300 rounded p-2"
              placeholder="Email *">',
          'url' => '<input id="url" name="url" type="url"
              class="w-full lg:w-[calc(33.333%-0.5rem)] border border-gray-300 rounded p-2"
              placeholder="Website">',
        ],
      ]))
    </div>
  </section>
@endif
