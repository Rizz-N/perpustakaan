<?php if (isset($_SESSION['success'])): ?>
<div class="alert alert-success alert-dismissible fade show mx-5" role="alert" >
    <?= htmlspecialchars($_SESSION['success']) ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" >

    </button>
</div>
<?php unset($_SESSION['success']); ?>
<?php endif; ?>