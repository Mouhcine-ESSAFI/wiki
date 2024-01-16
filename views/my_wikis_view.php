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
            <h4 class="text-white p-3"><a class="text-white" href="index.php?page=my_wikis">Author Dashboard</a></h4>
            </div>

            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-white text-center mt-5 mb-4">Managing My wiki's</h3>
                    </div>
                    <!------------------- start data table----------------------------------------------->

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
                                        <!-- Edit Button -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editCategoryModal-<?= $wiki['id'] ?>">
                                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                            </button>

                                            <!-- Delete Button -->
                                            <form method="post" action="index.php?page=my_wikis">
                                                <input type="hidden" name="wiki_id" value="<?= $wiki['id'] ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_mwiki">
                                                    <i class="material-icons" data-toggle="tooltip"
                                                        title="Delete">&#xE872;</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Edit Modal -->
                                    <div id="editCategoryModal-<?= $wiki['id'] ?>" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post" action="index.php?page=my_wikis">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit wiki</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" name="title"
                                                                value="<?= htmlspecialchars($wiki['title']) ?>"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Content</label>
                                                            <input type="text" name="content"
                                                                value="<?= htmlspecialchars($wiki['content']) ?>"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>categories</label>
                                                            <select class="form-control py-2 w-100" name="category"
                                                                required>
                                                                <option value="">Select a Category</option>
                                                                <?php foreach ($categories as $category): ?>
                                                                    <option value="<?= $category['id'] ?>">
                                                                        <?= htmlspecialchars($category['name']) ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>tags</label>
                                                            <select class="form-control py-2 w-100" name="tags[]"
                                                                multiple="multiple" required>
                                                                <?php foreach ($tags as $tag): ?>
                                                                    <option value="<?= $tag['id'] ?>">
                                                                        <?= htmlspecialchars($tag['name']) ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="category_id" value="<?= $wiki['id'] ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="button" class="btn btn-default" data-dismiss="modal"
                                                            value="Cancel">
                                                        <input type="submit" class="btn btn-info" value="Save Changes"
                                                            name="update_mwiki">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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