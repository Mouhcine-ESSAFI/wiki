<style>
    .dashboard-padding {
        padding-top: 4.5rem
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light d-md-none">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse"
        aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<section class="dashboard-padding bg-dark">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-secondary d-none d-md-block min-vh-100">
                <h4 class="text-white p-3"><a class="text-white" href="index.php?page=dashboard">Dashboard</a></h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?page=categories">Manage Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?page=tags">Manage Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php?page=archive">Archive Wikis</a>
                    </li>
                </ul>
            </div>

            <div class="collapse d-md-none" id="sidebarCollapse">
                <div class="bg-secondary p-3">
                    <h4 class="text-white">Dashboard</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?page=categories">Manage Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?page=tags">Manage Tags</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?page=archive">Archive Wikis</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-white text-center mt-5 mb-4">Archiving Wiki's</h3>
                    </div>
                    <h4 class="text-white">Not archived wiki's :</h4>
                    <div class="table-responsive mt-4">
                        <table class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>wiki Name</th>
                                    <th>wiki auteur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($wikis as $wiki): ?>
                                    <tr>
                                        <td>
                                            <?= htmlspecialchars($wiki['title']) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($wiki['author_name']) ?>
                                        </td>
                                        <td>
                                            <form method="post" action="index.php?page=archive">
                                                <input type="hidden" name="wiki_id" value="<?= $wiki['id'] ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_wiki">
                                                    <i class="material-icons" data-toggle="tooltip"
                                                        title="Delete">&#xE872;</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="text-white">archived wiki's :</h4>
                    <div class="table-responsive mt-4">
                        <table class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>wiki Name</th>
                                    <th>wiki auteur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($wikiDs as $wiki): ?>
                                    <tr>
                                        <td>
                                            <?= htmlspecialchars($wiki['title']) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($wiki['author_name']) ?>
                                        </td>
                                        <td>
                                            <form method="post" action="index.php?page=archive">
                                                <input type="hidden" name="wiki_id" value="<?= $wiki['id'] ?>">
                                                <button type="submit" class="btn btn-success" name="recover_wiki">
                                                    <i class="material-icons" data-toggle="tooltip"
                                                        title="Recover">restore</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------------------- end   data table----------------------------------------------->
    </div>
    </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        // Activate Bootstrap tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>