<?php
/**
 * Title: Latest News
 * Slug: cyber-security-blocks/latest-news
 * Categories: cyber-security-blocks, latest-news
 */
?>

<!-- wp:group {"className":"blog-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group blog-section"><!-- wp:group {"className":"blog-small-heading","layout":{"type":"constrained","contentSize":"15%","justifyContent":"center"}} -->
<div class="wp-block-group blog-small-heading"><!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"backgroundColor":"primary","textColor":"white","fontSize":"small","fontFamily":"jost"} -->
<h3 class="wp-block-heading has-text-align-center has-white-color has-primary-background-color has-text-color has-background has-link-color has-jost-font-family has-small-font-size" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--30);font-style:normal;font-weight:600;text-transform:uppercase"><?php esc_html_e('Latest News','cyber-security-blocks'); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e('Latest From The News','cyber-security-blocks'); ?></h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"18px"} -->
<div style="height:18px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query {"queryId":36,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"style":{"border":{"radius":"10px"},"elements":{"link":{"color":{"text":"var:preset|color|body-text"}}},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"textColor":"body-text","className":"blog-box wow swing","layout":{"type":"constrained"}} -->
<div class="wp-block-group blog-box wow swing has-body-text-color has-text-color has-link-color" style="border-radius:10px;padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"className":"blog-image-box","layout":{"type":"constrained"}} -->
<div class="wp-block-group blog-image-box"><!-- wp:post-featured-image {"isLink":true,"align":"center","style":{"border":{"radius":{"topLeft":"10px","topRight":"10px","bottomLeft":"10px","bottomRight":"10px"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:post-author-name {"textAlign":"center","className":"post-author"} /-->

<!-- wp:post-date /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"textAlign":"left","level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"700","textTransform":"capitalize"},"spacing":{"padding":{"right":"0","left":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|heading"}}}},"textColor":"heading","fontSize":"small"} /-->

<!-- wp:post-excerpt {"excerptLength":20,"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"className":"blog-excerpt","fontSize":"small"} /-->

<!-- wp:group {"className":"readmore-group","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group readmore-group"><!-- wp:read-more {"style":{"typography":{"textDecoration":"none","fontStyle":"normal","fontWeight":"700","textTransform":"capitalize"},"elements":{"link":{"color":{"text":"var:preset|color|heading"}}}},"textColor":"heading","className":"service-readmore"} /-->

<!-- wp:image {"id":483,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/icon2.png'); ?>" alt="" class="wp-image-483"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p class="has-text-align-center"><?php esc_html_e('There is no post found','cyber-security-blocks'); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->

<!-- wp:spacer {"height":"29px"} -->
<div style="height:29px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->