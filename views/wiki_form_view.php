<?php
if (!isset($_SESSION['id'])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<section class="min-vh-100 d-flex justify-content-center align-items-center bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h5 class="text-white text-center mt-5 mb-4">Create a New Wiki</h5>
                <form method="post" action="index.php?page=wiki_form" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <input class="form-control py-4 w-100" type="text" name="title"  placeholder="Wiki Title" required />
                    </div>
                    <div class="form-group mb-3">
                        <textarea class="form-control py-4 w-100" rows="8" name="content" placeholder="Full Article Content"
                            required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <select class="form-control py-2 w-100" name="category" required>
                            <option value="">Select a Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>">
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                    <label for="imageUpload" class="text-white-50">Select Tags:</label>
                        <select class="form-control py-2 w-100" name="tags[]" multiple="multiple" required>    
                        <?php foreach ($tags as $tag): ?>
                                <option value="<?= $tag['id'] ?>">
                                    <?= htmlspecialchars($tag['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <button class="btn btn-primary w-100" type="submit" name="wiki">Create Wiki</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('select[name="tags[]"]').select2();
    });
</script>