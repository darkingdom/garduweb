<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if ($data->page == 'home') :
        echo "<title>Algania Store</title>";
    elseif ($data->page == 'item') :
        echo "<title>{$data->item->title_post}</title>";
        // SEO ONPAGE
        if ($data->item->seo_keyword != '') echo "<meta name='keywords' content='{$data->item->seo_keyword}'>";
        if ($data->item->seo_description != '') echo "<meta name='description' content='{$data->item->seo_description}'>";
        if ($data->item->seo_title != '') echo "<meta name='title' content='{$data->item->seo_title}'>";

        // SEO SOCIAL MEDIA
        if ($data->item->seo_title != '') echo "<meta name='og:title' content='{$data->item->seo_title}'>";
        if ($data->item->seo_description != '') echo "<meta name='og:description' content='{$data->item->seo_description}'>";

        echo "<meta name='og:type' content='product'>";
        echo "<meta name='og:site_name' content='Alganiastore'>";
        echo "<meta name='og:image' content='https://" . BASEURL . "/garduweb/storage/upload/thumb/" . $data->item->thumbnail . "'>";
        echo "<meta name='og:url' content='https://" . BASEURL . "/item/" . $data->item->slug . "'>";

        // SEO TWITTER
        echo "<meta name='twitter:card' content='summary_large_image'/>";
        if ($data->item->seo_title != '') echo "<meta name='twitter:title' content='{$data->item->seo_title}'>";
        if ($data->item->seo_description != '') echo "<meta name='twitter:description' content='{$data->item->seo_description}'>";
        echo "<meta name='twitter:image' content='https://" . BASEURL . "/garduweb/storage/upload/thumb/" . $data->item->thumbnail . "'>";

        // ROBOT FOLLOW
        echo "<meta name='robots' content='index,follow'>";

    endif;
    ?>

    <link rel="shortcut icon" href="<?= BASEURL ?>/garduweb/storage/images/icon-algania-green.ico">
    <link href="<?= BASEURL ?>/garduweb/resources/home/default/asset/css/main.css" type="text/css" rel="stylesheet" />
    <script>
        var baseurl = "<?= BASEURL ?>";
    </script>
</head>

<body>
    <div id="outer-wrapper">
        <!-- <nav id="top-nav"></nav> -->
        <header id="header">
            <section class="container header-wrap">
                <div id="logo-wrap">
                    <a href="<?= BASEURL ?>" title="algania store">
                        <img src="<?= BASEURL ?>/garduweb/storage/images/logo-algania.png" id="logo" alt="logo algania store" title="logo algania store" />
                    </a>
                </div>
                <div>
                    <div id="search-wrap">
                        <input id="txtSearch" />
                        <button id="btn-search" type="submit">Search</button>
                    </div>
                </div>
            </section>
        </header>