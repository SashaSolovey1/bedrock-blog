<?php

namespace App\helpers;

function custom_comment($comment, $args, $depth): void
{
    if ($comment->comment_parent > 0) {
        return;
    }

    $tag = $args['style'] === 'div' ? 'div' : 'li';
    $author = get_comment_author();
    $avatar = get_avatar($comment, 40, '', '', ['class' => 'rounded-full w-14 h-14']);
    $date = get_comment_date('F j, Y \a\t g:i a');
    $text = get_comment_text($comment);
    $reply_count = get_comments([
        'parent' => $comment->comment_ID,
        'status' => 'approve',
        'count'  => true,
    ]);
    $replies = get_comments([
        'parent' => $comment->comment_ID,
        'status' => 'approve',
    ]);

    $reply = get_comment_reply_link([
        'depth'     => $depth,
        'max_depth' => $args['max_depth'],
        'reply_text' => '<div class="flex flex-row gap-1.5 items-center">
            <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.14062 0.640625L1.14063 4.64062L0.796875 5L1.14063 5.35938L5.14063 9.35938L5.85938 8.64062L2.71875 5.5L9.5 5.5C10.8867 5.5 12 6.61328 12 8C12 9.38672 10.8867 10.5 9.5 10.5V11.5C11.4277 11.5 13 9.92773 13 8C13 6.07227 11.4277 4.5 9.5 4.5L2.71875 4.5L5.85938 1.35937L5.14062 0.640625Z" fill="#00E6CA"/>
            </svg> REPLY
        </div>',
        'add_below' => 'comment',
        'before' => '',
        'after' => '',
    ]);

    echo "<{$tag} id='comment-{$comment->comment_ID}' class='bg-white px-4 lg:px-[30px] py-[15px] mb-6 flex flex-col gap-[20px] shadow-[0px_0px_1px_rgba(40,41,61,0.08),_0px_0.5px_2px_rgba(96,97,112,0.16)]'>";

    echo "<div class='flex flex-col gap-4'>";
    echo "<div class='flex items-center gap-3'>";
    echo $avatar;
    echo "<div>";
    echo "<p class='text-[#161B3D] font-bold text-xl lg:text-2xl'>$author</p>";
    echo "<p class='text-sm text-[#7B7485]'>$date</p>";
    echo "</div>";
    echo "</div>";
    echo "<div class='text-[#161B3D] text-sm leading-[22px]'>$text</div>";
    echo "</div>";

    echo "<div class='flex flex-row gap-[35px] self-end text-sm'>";
    echo "<span class='text-[#00E6CA]'>$reply</span>";
    echo "<span class='text-[#7B7485]'>Replies ($reply_count)</span>";
    echo "</div>";

    if ($reply_count > 0 && !empty($replies)) {
        echo "<div class='lg:p-4 space-y-4 flex flex-col gap-5'>";
        foreach ($replies as $reply_comment) {
            $reply_author = get_comment_author($reply_comment);
            $reply_avatar = get_avatar($reply_comment, 40, '', '', ['class' => 'rounded-full w-14 h-14']);
            $reply_date = get_comment_date('F j, Y \a\t g:i a', $reply_comment);
            $reply_text = get_comment_text($reply_comment);
            $reply_link = get_comment_reply_link([
                'depth'     => $depth + 1,
                'max_depth' => $args['max_depth'],
                'reply_text' => '<div class="flex flex-row gap-1.5 items-center">
                    <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M5.14062 0.640625L1.14063 4.64062L0.796875 5L1.14063 5.35938L5.14063 9.35938L5.85938 8.64062L2.71875 5.5L9.5 5.5C10.8867 5.5 12 6.61328 12 8C12 9.38672 10.8867 10.5 9.5 10.5V11.5C11.4277 11.5 13 9.92773 13 8C13 6.07227 11.4277 4.5 9.5 4.5L2.71875 4.5L5.85938 1.35937L5.14062 0.640625Z" fill="#00E6CA"/>
                    </svg> REPLY
                </div>',
                'add_below' => 'comment',
                'before' => '',
                'after' => '',
                'respond_id' => 'respond',
            ], $reply_comment);

            echo "<div class='flex flex-col gap-4 bg-[#F7F7F7] px-[30px] py-[15px]'>";
            echo "<div class='flex items-center gap-3'>";
            echo $reply_avatar;
            echo "<div>";
            echo "<p class='text-[#161B3D] font-bold text-xl lg:text-2xl'>$reply_author</p>";
            echo "<p class='text-sm text-[#7B7485]'>$reply_date</p>";
            echo "</div>";
            echo "</div>";
            echo "<div class='text-[#161B3D] text-sm leading-[22px]'>$reply_text</div>";
            echo "<div class='flex justify-end text-sm text-[#00E6CA]'>$reply_link</div>";
            echo "</div>";
        }
        echo "</div>";
    }

    echo "</{$tag}>";
}


function get_comment_reply_count($comment_id)
{
    $replies = get_comments([
        'parent' => $comment_id,
        'status' => 'approve',
        'count'  => true,
    ]);

    return $replies;
}
