<footer class="footer">
			<div class="footer__container">
				<div class="footer__column">
					<div class="footer__logo">
						<a href="#">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/icons/logo-black.svg" alt="Logo" />
						</a>
					</div>
					<div class="footer__description">
						Condimentum adipiscing vel neque dis nam parturient orci at
						scelerisque neque dis nam parturient.
					</div>
					<div class="footer__contacts">
						<div class="footer__contact">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/icons/location.svg" alt="Icon of Location" />
							<span>451 Wall Street, UK, London</span>
						</div>
						<a href="tel:0643321233" class="footer__contact link">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/icons/phone.svg" alt="Icon of Phone" />
							<span>Phone: (064) 332-1233</span>
						</a>
						<a href="mailto:0994531357" class="footer__contact link">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/icons/mail.svg" alt="Icon of Mail" />
							<span>Fax: (099) 453-1357</span>
						</a>
					</div>
				</div>
				<div class="footer__column">
					<div class="footer__title">RECENT POSTS</div>

                    <?php
                    $args = array(
                        'post_type' => 'blog',
                        'posts_per_page' => 2,
						'orderby'        => 'date',
                        'order'          => 'DESC'
                    );

                    $blog_posts = new WP_Query($args);

                    if ($blog_posts->have_posts()) : ?>

					<div class="footer__posts">
                    <?php while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
                        <article class="footer__post">
                            <div class="footer__text-block">
                                <h6 class="footer__post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h6>
                                <div class="footer__date"><?php echo get_the_date(); ?></div>
                            </div>
                            <div class="footer__image-block">
                                <a href="<?php the_permalink(); ?>" class="footer__image-ibg">
                                    <picture>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'footer__post-image']); ?>
                                        <?php endif; ?>
                                    </picture>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
					</div>
                    <?php endif; ?>
				</div>
				<div class="footer__column">
					<div class="footer__title">OUR STORES</div>
					<ul class="footer__links">
						<li class="footer__link"><a href="#">New York</a></li>
						<li class="footer__link"><a href="#">London SF</a></li>
						<li class="footer__link"><a href="#">Cockfosters BP</a></li>
						<li class="footer__link"><a href="#">Los Angeles</a></li>
						<li class="footer__link"><a href="#">Chicago</a></li>
					</ul>
				</div>
				<div class="footer__column">
					<div class="footer__title">USEFUL LINKS</div>
					<ul class="footer__links">
						<li class="footer__link"><a href="#">Privacy Policy</a></li>
						<li class="footer__link"><a href="#">Returns</a></li>
						<li class="footer__link"><a href="#">Terms & Conditions</a></li>
						<li class="footer__link"><a href="#">Contact Us</a></li>
						<li class="footer__link"><a href="#">Latest News</a></li>
					</ul>
				</div>
			</div>
		</footer>

	</div>
    
    <?php wp_footer();?>
</body>
</html>