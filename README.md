## Variation block exemple

You can create variation for core block and modify the query arguments.

I use it on [wp-performance.com](https://wp-performance.com).
Exemple on this page end => [https://wp-performance.com/snippet/desactiver-php-dans-les-repertoires-plugins-uploads-et-themes/](https://wp-performance.com/snippet/desactiver-php-dans-les-repertoires-plugins-uploads-et-themes/)

## Method

1 - Create variation block with javascript file => ```assets/block-variations.js```
2 - Change query arguments with filter hook for this variation namespace => ```index.php```


## Links page WP developer resources

- [https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/extending-the-query-loop-block/](https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/extending-the-query-loop-block/)
