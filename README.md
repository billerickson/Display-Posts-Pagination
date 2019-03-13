# Display Posts - Pagination

**Contributors:** billerickson  
**Tags:** shortcode, pagination, paginated, pages, posts, page, query, display, list, date, month, year
**Requires at least:** 3.0  
**Tested up to:** 5.1  
**Stable tag:** 1.0.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html

## Description

[Display Posts](https://displayposts.com) is the simplest way to query and display content in WordPress.

This plugin extends Display Posts by letting you paginate the results. You can use all of the [Display Posts parameters](https://displayposts.com/docs/parameters/) to customize the query.

### Paginated Listing

`[display-posts pagination="true"]`

![screenshot](https://dvfr2lc5dhzsq.cloudfront.net/items/2J1N3u2t3v1l242w2p3t/Screen%20Shot%202019-03-13%20at%206.05.02%20PM.png)

### Multiple paginated listings

If you have more than one `[display-posts]` listing on a page, use increasing increments for the pagination parameter. Ex: `[display-posts pagination="2"]`. This will ensure going to page two of one listing doesn't alter the results of the other.

## Filters

If you're a developer, you can use the following filters to customize the markup:

* `display_posts_shortcode_paginate_links` - Customize the arguments passed to `paginate_links()`
