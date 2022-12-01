


<?php $__env->startSection('title', 'Forgot Password'); ?>
<?php $__env->startSection('page-title', 'Forgot your password?'); ?>
<?php $__env->startSection('description', "Type your email below, and we will send you an email to confirm that it's really you."); ?>

<?php $__env->startSection('form'); ?>
    <form method="POST" action="<?php echo e(route('auth.forgot-password-sent')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="example@ids.co.id"
                        class="form-control" required>
                </div>
            </div>
        </div>
        <button aria-label="" class="btn btn-primary btn-cons m-t-10" type="submit">
            Send me an email
        </button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.partials.app-2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\College\SKRIPSI\App\human-resource-management-system-fe\resources\views/auth/forgot-password/index.blade.php ENDPATH**/ ?>