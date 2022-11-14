<?php

namespace WPPerfomance\SnippetVariation;

/**
 * Plugin Name:       Snippet Variation
 * Description:       Snippet Variation for use related snippets block
 * Update URI:        wp-performance-snippet-variation
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Version:           0.0.1
 * Author:            Faramaz Patrick <infos@goodmotion.fr>
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-performance-snippet-variation
 *
 * @package           wp-performance
 */


function editor_assets()
{
    wp_enqueue_script(
        'wp-performance-snippet-variation',
        plugin_dir_url(__FILE__) . '/assets/admin/block-variations.js',
        array('wp-blocks')
    );
}

add_action('enqueue_block_editor_assets', __NAMESPACE__ . '\editor_assets');



/**
 * query for snippet block
 */
add_filter(
    'pre_render_block',
    function ($prerender, $block) {
        // if good namespace
        if (array_key_exists('namespace', $block['attrs']) && 'wp-performance/related-snippets' === $block['attrs']['namespace']) {
            add_filter(
                'query_loop_block_query_vars',
                function ($query) {
                    global $post;
                    // remove current post from results
                    array_push($query['post__not_in'], $post->ID);
                    // get taxonomies name for this post type
                    $tax = get_post_taxonomies($post);
                    $cats = [];
                    foreach ($tax as $key => $value) {
                        // get terms for the current post
                        $terms = get_the_terms($post->ID, $value);
                        if ($terms) {
                            foreach ($terms as $key => $value) {
                                array_push($cats, $value);
                            }
                        }
                    }
                    $tax_query = null;
                    if (count($cats)) {
                        $tax_query = [];
                        // add taxonomies related to query
                        foreach ($cats as $key => $value) {
                            array_push($tax_query, [
                                'taxonomy' => $value->taxonomy,
                                'field'    => 'slug',
                                'terms'    => $value->slug
                            ]);
                        }
                    }
                    if ($tax_query) {
                        $tax_query['relation'] = 'OR';
                        $query['tax_query'] = $tax_query;
                    }
                    return $query;
                }
            );
        }
    },
    1,
    2
);
