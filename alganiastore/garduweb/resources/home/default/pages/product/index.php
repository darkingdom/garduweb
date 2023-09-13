<section class="container">
    <main id="main-container">
        <div id="content-wrap">
            <div id="content">
                <article>
                    <nav id="breadcrumb">
                        <a href="<?= BASEURL ?>" title="Algania Store">Home</a><span><ion-icon name="chevron-forward-outline"></ion-icon>
                            <?php if ($data->item->id_categories_1 != '0' and $data->item->id_categories_1 != '') : ?>
                                <a href="<?= BASEURL ?>/category/<?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_1)->slug ?>" title="<?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_1)->kategori ?>"><?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_1)->kategori ?></a> <ion-icon name="chevron-forward"></ion-icon>
                            <?php endif; ?>
                            <?php if ($data->item->id_categories_2 != '0' and $data->item->id_categories_2 != '') : ?>
                                <a href="<?= BASEURL ?>/category/<?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_2)->slug ?>" title="<?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_2)->kategori ?>"><?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_2)->kategori ?></a> <ion-icon name="chevron-forward"></ion-icon>
                            <?php endif; ?>
                            <?php if ($data->item->id_categories_3 != '0' and $data->item->id_categories_3 != '') : ?>
                                <a href="<?= BASEURL ?>/category/<?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_3)->slug ?>" title="<?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_3)->kategori ?>"><?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_3)->kategori ?></a> <ion-icon name="chevron-forward"></ion-icon>
                            <?php endif; ?>
                            <?php if ($data->item->id_categories_4 != '0' and $data->item->id_categories_4 != '') : ?>
                                <a href="<?= BASEURL ?>/category/<?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_4)->slug ?>" title="<?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_4)->kategori ?>"><?= HomeModel::AJAXgetKategoriByID($data->item->id_categories_4)->kategori ?></a> <ion-icon name="chevron-forward"></ion-icon>
                            <?php endif; ?>
                            <?= $data->item->title_post ?>
                    </nav>
                    <h1 class="entry-title"><?= $data->item->title_post ?></h1>
                    <div id="post-data">
                        <div class="post-times">Agustus 23, 2023</div>
                    </div>
                    <div class="post-body">
                        <?= $data->item->content ?>
                    </div>
                </article>
            </div>

            <div class="buy-card">
                <div class="buy-wrapper">
                    <div class="cart-image">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                    <div class="buy-info">
                        <div class="title-buy"><?= $data->item->title_post ?></div>
                        <div class="info-buy">
                            <div class="star-buy"><?php HomeController::star($data->item->star_rate) ?></div>
                            <div class="marketplace-buy"><?= $data->item->marketplace ?></div>
                        </div>
                        <div class="price-buy"><?= $data->item->price ?>$ <span>prices may not be the same</span></div>
                    </div>
                    <div class="button-buy-wrapper">
                        <div class="buy-button">
                            <a href="<?= $data->item->url_affiliate ?>" target="_blank">BUY</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <aside class="widget-sidebar">
            <div id="popular-posts">
                <div class="header-widget">Popular Posts</div>
                <div class="content-widget-wrapper">
                    <?php foreach ($data->popular as $popular) : ?>
                        <div class="item-list-widget">
                            <div class="item-thumb-widget">
                                <img src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $popular->thumbnail ?>" class="item-img-thumb-widget" alt="<?= $popular->title_post ?>" title="<?= $popular->title_post ?>" />
                            </div>
                            <div class="item-content-widget">
                                <div class="">
                                    <a href="<?= BASEURL ?>/category/<?= HomeModel::AJAXgetKategoriByID($popular->id_categories_1)->slug ?>">
                                        <span class="item-category-widget"><?= HomeModel::AJAXgetKategoriByID($popular->id_categories_1)->kategori ?></span>
                                    </a>
                                </div>
                                <div class="item-title-widget">
                                    <a href="<?= BASEURL ?>/item/<?= $popular->slug ?>" title="<?= $popular->title_post ?>">
                                        <?= $popular->title_post ?>
                                    </a>
                                </div>
                                <div class="item-price-widget"><?= $popular->price ?>$</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </aside>
    </main>
</section>

<style>
    .mytable {
        border-collapse: collapse;
        display: flex;
    }

    .mytable td {
        border: 1px solid #CCC;
        padding: 5px 20px;
    }

    .mytable tr td:nth-child(2n-1) {
        background: #F5F5F5;
    }
</style>