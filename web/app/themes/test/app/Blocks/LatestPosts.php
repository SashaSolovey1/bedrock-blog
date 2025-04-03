<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class LatestPosts extends Block
{
    public $name = 'Latest Posts';
    public $description = 'A beautiful Latest Posts block.';
    public $category = 'text';
    public $icon = 'editor-ul';
    public $keywords = [];
    public $post_types = [];
    public $parent = [];
    public $ancestor = [];
    public $mode = 'preview';
    public $align = '';
    public $align_text = '';
    public $align_content = '';

    public $spacing = [
        'padding' => null,
        'margin' => null,
    ];

    public $supports = [
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
        'color' => [
            'background' => false,
            'text' => false,
            'gradients' => false,
        ],
        'spacing' => [
            'padding' => false,
            'margin' => false,
        ],
    ];

    public $styles = ['light', 'dark'];

    public $template = [
        'core/heading' => ['placeholder' => 'Latest Articles'],
        'core/paragraph' => ['placeholder' => 'This section shows the most recent blog posts.'],
    ];

    public function with(): array
    {
        return [
            'heading' => get_field('heading'),
            'button_label' => get_field('button_label'),
            'posts_per_page' => get_field('posts_per_page'),
            'posts' => $this->posts(),
        ];
    }

    public function fields(): array
    {
        $fields = Builder::make('latest_posts');

        $fields
            ->addText('heading', [
                'label' => 'Section Heading'
            ])
            ->addText('button_label', [
                'label' => 'Button Label'
            ])
            ->addNumber('posts_per_page', [
                'label' => 'Number of Posts',
                'default_value' => 4,
                'min' => 1,
                'max' => 20,
            ]);

        return $fields->build();
    }

    public function posts()
    {
        return get_posts([
            'numberposts' => get_field('posts_per_page') ?: 4,
            'post_status' => 'publish',
        ]);
    }

    public function assets(array $block): void
    {
        //
    }
}
