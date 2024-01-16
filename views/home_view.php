<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Explore Our Blogs</h1>
                    <span class="subheading">the best blogs ever</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <!-- Search Form -->
        <form action="index.php?page=home" method="get" class="search-form">
            <div class="input-group mb-4">
                <input type="text" class="form-control" placeholder="Search wikis..." name="search" id="search-input"
                    aria-label="Search wikis">
                <select name="search_type" id="search-type" class="form-control">
                    <option value="title">Title</option>
                    <option value="tag">Tag</option>
                    <option value="category">Category</option>
                </select>
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </div>
        </form>
        <div class="col-md-10 col-lg-8 col-xl-7" id="search-results-container">
        <?php foreach ($wikis as $wiki): ?>
    <div class="post-preview">
        <p class="post-category">
            <strong><?= htmlspecialchars($wiki['category_name']) ?></strong>
        </p>

        <a href="index.php?page=wiki&id=<?= $wiki['id'] ?>">
            <h2 class="post-title"><?= htmlspecialchars($wiki['title']) ?></h2>
            <h3 class="post-subtitle"><?= htmlspecialchars(substr($wiki['content'], 0, 150)) ?>...</h3>
        </a>
        
        <p class="post-meta">
            Posted by <a href="#!"><?= htmlspecialchars($wiki['author_name']) ?></a>
            on <?= date('F j, Y', strtotime($wiki['date_created'])) ?>
            <br>
            <?php
                $tags = explode(', ', $wiki['tags']);
                foreach ($tags as $tag): ?>
                    <span class="tag-badge">#<?= htmlspecialchars($tag) ?></span>
            <?php endforeach; ?>
        </p>
    </div>
    <hr class="my-4" />
<?php endforeach; ?>
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="index.php?page=all_wiki">All Posts</a></div>
        </div>
        <!-- categories displaying -->
        <div class="col-md-3 ">
            <div class="category-menu">
                <h3>Categories :</h3>
                <ul class="category-list">
                    <?php foreach ($allCategories as $category): ?>
                        <li><a href="index.php?page=wiki_categ&id=<?= $category['id'] ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    const searchInput = document.getElementById("search-input");
    const resultsContainer = document.getElementById("search-results-container");
    const searchType = document.getElementById("search-type");



    searchInput.addEventListener("input", () => {
        console.log(searchType.value);
        if (searchInput.value !== "") {
            getSearchedResults();
        } else
            resultsContainer.innerHTML = "";
    })

    function getSearchedResults() {
        resultsContainer.innerHTML = "";
        $.get(
            "index.php?page=home&search_" + searchType.value + "=true&input_value=" + searchInput.value,
            (data) => {
                let searchedData = JSON.parse(data);
                if (searchedData.length === 0) {

                resultsContainer.innerHTML = '<p class="text-muted">No results found.</p>';
                return;
            }

                searchedData.forEach((item) => {
                    console.log(item);
                    resultsContainer.innerHTML += `<div class="post-preview">
                <a href="index.php?page=wiki&id=${item.id}">
                    <h2 class="post-title">${item.title}</h2>
                    <h3 class="post-subtitle">${item.content}...</h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#!">${item.author_name}</a>
                    on ${item.create_at}
                </p>
            </div>`;
                });
            }
        ).fail(function() {
            
        resultsContainer.innerHTML = '<p class="text-danger">An error occurred while searching. Please try again.</p>';
    });


    }
</script>