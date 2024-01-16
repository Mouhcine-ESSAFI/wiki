<header class="masthead">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1><?= htmlspecialchars($wiki['title']) ?></h1>
                </div>
            </div>
        </div>
    </div>
</header>

<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h3><?= nl2br(htmlspecialchars($wiki['category_name'])) ?></h3>
                <p><?= nl2br(htmlspecialchars($wiki['content'])) ?></p>
                <p class="post-meta">
                    Posted by <?= htmlspecialchars($wiki['author_name']) ?>
                    on <?= date('F j, Y', strtotime($wiki['date_created'])) ?>
                </p>
                <p>Tags: 
        <?php
            $tags = explode(', ', $wiki['tags']);
            foreach ($tags as $tag): ?>
                <span class="tag-badge"><?= htmlspecialchars($tag) ?></span>
        <?php endforeach; ?>
    </p>
            </div>
        </div>
    </div>
</article>