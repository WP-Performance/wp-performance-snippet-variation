const VARIATION_NAME = 'wp-performance/related-snippets'

const addSnippetVariation = function () {
  // use window wp global function
  const { Icon } = wp.components
  const { createElement } = wp.element
  const getIcon = function () {
    return createElement(Icon, {
      icon: createElement(
        'svg',
        {
          width: '32',
          height: '32',
          viewBox: '0 0 24 24',
        },
        createElement('path', {
          fill: '#747280',
          d:
            'M22 13v6h-1l-2-2h-8V9H8v2H6V9H5v2H3V9H2V7h1V5h2v2h1V5h2v2h5v8h6l2-2Z',
        }),
      ),
    })
  }

  /** create variation block */
  wp.blocks.registerBlockVariation('core/query', {
    name: VARIATION_NAME,
    title: 'Related Snippets',
    description: 'Displays a list of related snippets',
    isActive: ({ namespace, query }) => {
      return namespace === VARIATION_NAME && query.postType === 'snippet'
    },
    icon: getIcon(),
    attributes: {
      className: 'wp-snippet-related',
      namespace: VARIATION_NAME,
      displayLayout: { type: 'flex', columns: 3 },
      query: {
        perPage: 6,
        pages: 0,
        offset: 0,
        postType: 'snippet',
        order: 'desc',
        orderBy: 'date',
        author: '',
        search: '',
        exclude: [],
        sticky: '',
        inherit: false,
      },
    },
    scope: ['inserter'],
    innerBlocks: [
      [
        'core/post-template',
        {},
        [
          [
            'core/post-title',
            {
              isLink: true,
              style: {
                spacing: {
                  margin: { top: '0', right: '0', bottom: '0', left: '0' },
                },
              },
              fontSize: '2xlarge',
            },
          ],
          ['core/post-excerpt'],
        ],
      ],
    ],
  })
}

document.addEventListener('DOMContentLoaded', () => {
  addSnippetVariation()
})
