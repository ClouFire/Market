<div class="row">
    <div class="col-md-6 offset-md-3">
        <form action="<?= baseUrl('/login') ?>" method="post">

            <?= getCsrfField(); ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control <?= getValidationClass('email'); ?>" id="email" placeholder="name@example.com" value="<?= old('email'); ?>">
                <?= get_errors('email');?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control  <?= getValidationClass('password'); ?>" id="password" placeholder="*  *  *  *  *  *  *  *">
                <?= get_errors('password');?>
            </div>

            <button type="submit" class="btn btn-warning">Login</button>

        </form>

        <?php
        session()->remove('form_errors');
        session()->remove('form_data');
        ?>

    </div>
</div>
</div>