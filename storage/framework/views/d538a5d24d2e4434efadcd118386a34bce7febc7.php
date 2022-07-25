


<?php $__env->startSection('title', 'Set New Password'); ?>
<?php $__env->startSection('page-title', 'Set New Password'); ?>
<?php $__env->startSection('description', "Set a new password for your account."); ?>

<?php $__env->startSection('form'); ?>
    <form method="POST" action="<?php echo e(route('auth.set-new-password')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <input type="hidden" name="token" value="<?php echo e($checkToken->data->token); ?>">
                <div class="form-group form-group-default is-invalid">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Type your new password"
                        class="form-control" required>
                </div>
                <div class="form-group form-group-default">
                    <label>Confirm your new password</label>
                    <input type="password" name="password_confirmation" placeholder="Type your new password"
                        class="form-control" required>
                </div>
            </div>
        </div>
        <button aria-label="" class="btn btn-primary btn-cons m-t-10" type="submit">
            Set Password
        </button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.partials.app-2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\IDS\human-resource-management-system-fe\resources\views/auth/forgot-password/form.blade.php ENDPATH**/ ?>