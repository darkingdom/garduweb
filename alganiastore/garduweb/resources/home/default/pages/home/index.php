<!-- <nav>nav</nav> -->
<section class="container">
    <main id="main-container">
        <div id="content-wrap">
            <div id="content">
                <div class="product-list">
                    <?php foreach ($data->post as $items) : ?>
                        <div class="product-item-wrapper">
                            <a title="<?= $items->title_post ?>" href="<?= BASEURL ?>/item/<?= $items->slug ?>/">
                                <div class="product-wrapper">
                                    <img src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $items->thumbnail ?>" class="product-image" alt="<?= $items->title_post ?>" title="<?= $items->title_post ?>" />
                                </div>
                                <div class="product-item-description">
                                    <div class="product-item-price-wrapper">
                                        <div><?= $items->price ?>$</div>
                                    </div>
                                    <div class="product-item-desc-wrapper">
                                        <?= $items->title_post ?>
                                    </div>
                                    <div class="product-item-star-wrapper">
                                        <?= HomeController::star(4); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <aside id="categories">
            <nav id="nav-sidebar">
                <div class="header-widget">Categories</div>
                <div class="widget-list-wrapper">
                    <?php foreach ($data->categories as $category) : ?>
                        <div></div>
                        <div class="widget-item-list"><a href="<?= BASEURL ?>/category/<?= $category->slug ?>" title="<?= $category->kategori ?>"><?= $category->kategori ?></a></div>
                    <?php endforeach; ?>
                </div>
            </nav>
        </aside>
    </main>
</section>