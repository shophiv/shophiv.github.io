

<?php if (isset($_SESSION['user'])): ?>
<form action="../controllers/Review/addReview.php" method="POST" class="mt-4">
    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
    <div class="mb-2">
        <label for="rating" class="form-label">Rating:</label>
        <select name="rating" id="rating" class="form-select" required>
            <option value="">Select</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="comments" class="form-label">Comments:</label>
        <textarea name="comments" id="comments" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Submit Review</button>
</form>
<?php else: ?>
<p class="text-muted">Please <a href="login.php">login</a> to leave a review.</p>
<?php endif; ?>
