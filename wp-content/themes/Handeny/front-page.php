<?php get_header(); ?>

<main class="page">
    <section class="heading">
        <div class="heading__container">
            <div class="heading__text-block">
                <h3 class="heading__sub-title">
                    <?php echo the_field('heading_sub_title') ?>
                </h3>
                <h1 class="heading__title"><?php echo the_field('blog_title') ?></h1>
                <div class="heading__description">
                    <?php echo the_field('heading_description') ?>
                </div>
                <div class="heading__buttons">
                    <?php
                        $heading_first_button  = get_field('heading_first_button');
                        $button_text = $heading_first_button['button_text'];
                        $button_url = $heading_first_button['button_url'];

                        if ($button_text && $button_url):
                    ?>
                        <a href="<?php echo esc_url($button_url); ?>" class="heading__button button button_white">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    <?php endif ?>
                    <?php
                        $heading_second_button = get_field('heading_second_button');
                        $button_text = $heading_second_button['button_text'];
                        $button_url = $heading_second_button['button_url'];
                        
                        if ($button_text && $button_url):
                    ?>
                        <a href="<?php echo esc_url($button_url); ?>" class="heading__button button">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <div class="heading__image-block">
                <div class="heading__image-ibg">
                    <picture><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="  data-src="<?php echo esc_url( get_field('heading_image') );?>" alt="Background Image" /></picture>
                </div>
            </div>
        </div>
    </section>
    <section class="featured">
        <div class="featured__container">
            <div class="featured__heading section-heading">
                <h5 class="section-heading__sub-title">
                    <?php echo the_field('featured_sub_title') ?>
                </h5>
                <h3 class="section-heading__title">
                    <?php echo the_field('featured_title') ?>
                </h3>
                <div class="section-heading__description">
                    <?php echo the_field('featured_description') ?>
                </div>
            </div>
            <div class="featured__products">
                <div class="featured__featured-product featured-product">
                    <?php
                        $featured_offer_product = get_field('featured_offer_product');
                        $featured_offer_post_id = $featured_offer_product->ID;
                        $featured_offer_post_title = get_the_title($featured_offer_post_id);
                        $featured_offer_post_permalink = get_permalink($featured_offer_post_id);
                    ?>
                    <div class="featured-product__text-block">
                        <h3 class="featured-product__title">
                            <a href="<?php echo $featured_offer_post_permalink ?>"><?php echo $featured_offer_post_title ?></a>
                        </h3>
                        <div class="featured-product__description">
                            <?php echo the_field('featured_banner_description') ?>
                        </div>
                        <a href="<?php echo $featured_offer_post_permalink ?>"" class="featured-product__button button"><span>shop now</span></a>
                    </div>
                    <div class="featured-product__image-ibg">
                        <picture><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="  data-src="<?php echo get_field('featured_offer_banner_image')?>" alt="" /></picture>
                    </div>
                </div>
                <div class="featured__swiper-wrapper">
                <?php
                    $category_id = get_field('featured_product_category');
                    $amount = get_field('featured_product_amount');

                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $amount,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'term_id',
                                'terms'    => $category_id,
                            ),
                        ),
                    );

                    $featured_products = new WP_Query($args);

                    if ($featured_products->have_posts()) : ?>
                    <div class="featured__swiper">
                        <div class="featured__wrapper swiper-wrapper">
                            <?php while ($featured_products->have_posts()) : $featured_products->the_post(); global $product; ?>
                            <div class="featured__slide featured-slide swiper-slide">
                                <div class="featured-slide__text-block">
                                    <h4 class="featured-slide__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <a href="<?php echo get_term_link($category_id); ?>" class="featured-slide__categoty">
                                        <?php echo get_term($category_id)->name; ?>
                                    </a>
                                    <div class="featured-slide__price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                                <div class="featured-slide__image-block">
                                    <a href="<?php the_permalink(); ?>" class="featured-slide__image-ibg">
                                        <picture>
                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'full'); ?>" alt="<?php the_title(); ?>">
                                        </picture>
                                    </a>
                                    <div class="featured-slide__tools">
                                        <button type='button' class="featured-slide__tool icon-button">
                                            <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.0869 8.61436L15.9905 3.65906C16.0062 3.57396 16.0024 3.48638 15.9793 3.40296C15.9562 3.31955 15.9144 3.24248 15.8571 3.17761C15.8024 3.11063 15.7335 3.05663 15.6554 3.01949C15.5772 2.98234 15.4919 2.96298 15.4054 2.96281H3.4588L3.09588 0.970319C3.04575 0.698292 2.90206 0.452371 2.68969 0.275159C2.47732 0.0979457 2.20966 0.000605077 1.93308 0H0.592514C0.435369 0 0.284661 0.0624303 0.173543 0.173557C0.0624253 0.284684 0 0.435404 0 0.592561C0 0.749718 0.0624253 0.900438 0.173543 1.01157C0.284661 1.12269 0.435369 1.18512 0.592514 1.18512H1.93308L3.96243 12.3697C3.6731 12.6246 3.46054 12.9551 3.34863 13.3241C3.23672 13.6931 3.22989 14.086 3.32891 14.4587C3.42794 14.8313 3.62889 15.169 3.90919 15.4338C4.1895 15.6986 4.53807 15.8799 4.91576 15.9576C5.29344 16.0352 5.68528 16.0059 6.04727 15.8732C6.40926 15.7404 6.72707 15.5093 6.96501 15.2059C7.20294 14.9024 7.35158 14.5387 7.39423 14.1554C7.43688 13.7722 7.37185 13.3847 7.20645 13.0363H11.1615C10.9689 13.4424 10.9134 13.9 11.0033 14.3403C11.0933 14.7805 11.3237 15.1797 11.6601 15.4777C11.9965 15.7757 12.4205 15.9563 12.8684 15.9924C13.3163 16.0286 13.7638 15.9182 14.1436 15.678C14.5234 15.4378 14.8149 15.0808 14.9742 14.6606C15.1335 14.2404 15.1521 13.7798 15.0271 13.3482C14.9021 12.9166 14.6403 12.5372 14.281 12.2672C13.9218 11.9972 13.4846 11.8512 13.0353 11.8512H5.0734L4.74751 10.0735H13.339C13.755 10.0733 14.1578 9.92719 14.4772 9.66056C14.7966 9.39393 15.0123 9.0237 15.0869 8.61436ZM6.22139 13.9252C6.22139 14.101 6.16927 14.2728 6.07161 14.419C5.97395 14.5652 5.83514 14.6791 5.67274 14.7464C5.51034 14.8136 5.33164 14.8312 5.15923 14.7969C4.98683 14.7627 4.82846 14.678 4.70417 14.5537C4.57987 14.4294 4.49522 14.271 4.46093 14.0986C4.42664 13.9262 4.44424 13.7475 4.5115 13.585C4.57877 13.4226 4.69269 13.2838 4.83885 13.1861C4.985 13.0885 5.15684 13.0363 5.33262 13.0363C5.56834 13.0363 5.7944 13.13 5.96108 13.2967C6.12775 13.4634 6.22139 13.6894 6.22139 13.9252ZM13.9241 13.9252C13.9241 14.101 13.8719 14.2728 13.7743 14.419C13.6766 14.5652 13.5378 14.6791 13.3754 14.7464C13.213 14.8136 13.0343 14.8312 12.8619 14.7969C12.6895 14.7627 12.5311 14.678 12.4068 14.5537C12.2825 14.4294 12.1979 14.271 12.1636 14.0986C12.1293 13.9262 12.1469 13.7475 12.2142 13.585C12.2814 13.4226 12.3954 13.2838 12.5415 13.1861C12.6877 13.0885 12.8595 13.0363 13.0353 13.0363C13.271 13.0363 13.4971 13.13 13.6638 13.2967C13.8304 13.4634 13.9241 13.6894 13.9241 13.9252ZM3.67358 4.14793H14.6943L13.9241 8.39955C13.8997 8.53687 13.8276 8.66118 13.7206 8.7506C13.6136 8.84002 13.4784 8.88882 13.339 8.88842H4.53273L3.67358 4.14793Z" fill="#777777" />
                                            </svg>
                                        </button>
                                        <a href="#" class="featured-slide__tool icon-button">
                                            <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.08871 0C11.0017 0 14.1774 3.17574 14.1774 7.08871C14.1774 11.0017 11.0017 14.1774 7.08871 14.1774C3.17574 14.1774 0 11.0017 0 7.08871C0 3.17574 3.17574 0 7.08871 0ZM7.08871 12.6021C10.1345 12.6021 12.6021 10.1345 12.6021 7.08871C12.6021 4.04214 10.1345 1.57527 7.08871 1.57527C4.04214 1.57527 1.57527 4.04214 1.57527 7.08871C1.57527 10.1345 4.04214 12.6021 7.08871 12.6021ZM13.7718 12.6581L16 14.8855L14.8855 16L12.6581 13.7718L13.7718 12.6581Z" fill="#777777" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="featured__left-arrow swiper-arrow">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.725 20.7375L16.4625 15L10.725 9.2625L12.5 7.5L20 15L12.5 22.5L10.725 20.7375Z" fill="#777777" />
                        </svg>
                    </div>
                    <div class="featured__right-arrow swiper-arrow">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.725 20.7375L16.4625 15L10.725 9.2625L12.5 7.5L20 15L12.5 22.5L10.725 20.7375Z" fill="#777777" />
                        </svg>
                    </div>
                <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="special">
        <div class="special__container">
            <div class="special__offer">
                <div class="special__text-block">
                    <?php
                        $special_offer_product = get_field('special_offer_product');
                        $special_offer_post_id = $special_offer_product->ID;
                        $special_offer_post_title = get_the_title($special_offer_post_id);
                        $special_offer_post_permalink = get_permalink($special_offer_post_id);
                        $special_offer_post_content = get_the_excerpt($special_offer_post_id);
                    ?>
                    <h5 class="special__sub-title">
                        Special offer
                    </h5>
                    <h2 class="special__title"><a href="<?php echo $special_offer_post_permalink ?>"><?php echo $special_offer_post_title ?></a></h2>
                    <div class="special__description">
                        <?php echo $special_offer_post_content ?>
                    </div>
                    <?php
                        $special_offer_button  = get_field('special_offer_button');
                        $button_text = $special_offer_button['button_text'];
                        $button_url = $special_offer_button['button_url'];

                        if ($button_text && $button_url):
                    ?>
                        <a href="<?php echo esc_url($button_url); ?>" class="special__button button button_grey">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    <?php endif ?>
                </div>
                <div class="special__image-ibg">
                    <picture><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="  data-src="<?php echo get_field('special_offer_banner_image')?>" alt="" /></picture>
                </div>
            </div>
            <div class="special__products">
                <?php
                    $featured_product_amount = get_field('special_offer_featured_product_amount');

                    $featured_product_amount = !empty($featured_product_amount) ? intval($featured_product_amount) : 5;

                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $featured_product_amount,
                        'meta_query' => array(
                            array(
                                // 'key'     => '_featured'
                            )
                        )
                    );

                    $featured_products = new WP_Query($args);

                    if ($featured_products->have_posts()) : ?>
                    <ul class="special__column">
                        <h6 class="special__column-title">
                            FEATURED PRODUCTS
                        </h6>
                        <?php while ($featured_products->have_posts()) : $featured_products->the_post(); global $product; ?>
                            <li class="special__item item-special">
                                <div class="item-special__text-block">
                                    <h4 class="item-special__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <div class="item-special__price">
                                    <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="item-special__image">
                                    <picture>
                                        <img src="<?php echo get_the_post_thumbnail_url(null, 'thumbnail'); ?>" alt="<?php the_title(); ?>" />
                                    </picture>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; wp_reset_postdata(); ?>
                <?php
                    $featured_product_amount = get_field('special_offer_featured_product_amount');

                    $featured_product_amount = !empty($featured_product_amount) ? intval($featured_product_amount) : 5;

                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $featured_product_amount,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    );

                    $featured_products = new WP_Query($args);

                    if ($featured_products->have_posts()) : ?>
                    <ul class="special__column">
                        <h6 class="special__column-title">
                            NEW PRODUCTS
                        </h6>
                        <?php while ($featured_products->have_posts()) : $featured_products->the_post(); global $product; ?>
                            <li class="special__item item-special">
                                <div class="item-special__text-block">
                                    <h4 class="item-special__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <div class="item-special__price">
                                    <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="item-special__image">
                                    <picture>
                                        <img src="<?php echo get_the_post_thumbnail_url(null, 'thumbnail'); ?>" alt="<?php the_title(); ?>" />
                                    </picture>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <section class="blog">
        <div class="blog__container">
            <div class="blog__heading section-heading">
                <h5 class="section-heading__sub-title">
                    <?php echo the_field('blog_sub_title') ?>
                </h5>
                <h3 class="section-heading__title">
                    <?php echo the_field('blog_title') ?>
                </h3>
                <div class="section-heading__description">
                    <?php echo the_field('blog_description') ?>
                </div>
            </div>
            <div class="blog__swiper-wrapper">
                <?php
                $selected_blog_posts = get_field('blog_items');

                if ($selected_blog_posts) :
                ?>
                <div class="blog__slider blog-swiper">
                    <div class="blog__wrapper swiper-wrapper">
                        <?php foreach ($selected_blog_posts as $post) : ?>
                            <div class="blog__slide swiper-slide">
                                <div class="blog__text-block">
                                    <h3 class="blog__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="blog__author">
                                        <span>Posted by</span>
                                        <picture>
                                            <?php echo get_avatar(get_the_author_meta('ID')); ?>
                                        </picture>
                                        <span><?php the_author(); ?></span>
                                    </div>
                                    <div class="blog__description">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="blog__button">Continue reading</a>
                                </div>
                                <div class="blog__image-block">
                                    <h5 class="blog__category">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo esc_html($categories[0]->name);
                                        }
                                        ?>
                                    </h5>
                                    <div class="blog__date">
                                        <span><?php echo get_the_date('d'); ?></span><span class="month"><?php echo get_the_date('M'); ?></span>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="blog__image-ibg">
                                        <picture>
                                            <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="">
                                            <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/other/blog.jpg" alt="">
                                            <?php endif; ?>
                                        </picture>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php endif; ?>
                <div class="blog__right-arrow swiper-arrow">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.725 20.7375L16.4625 15L10.725 9.2625L12.5 7.5L20 15L12.5 22.5L10.725 20.7375Z" fill="#777777" />
                    </svg>
                </div>
                <div class="blog__left-arrow swiper-arrow">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.725 20.7375L16.4625 15L10.725 9.2625L12.5 7.5L20 15L12.5 22.5L10.725 20.7375Z" fill="#777777" />
                    </svg>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>