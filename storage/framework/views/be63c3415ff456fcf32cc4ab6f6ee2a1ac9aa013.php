<div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items">
        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($list['childs']): ?>
                <li class="<?php echo e($loop->iteration == 1 ? 'm-t-20' : ''); ?>">
                    <a href="javascript:;"><span class="title"><?php echo e($list['name']); ?></span>
                        <span class=" arrow"></span></a>
                    <span class="icon-thumbnail"><i class="pg-icon"><?php echo e($list['icon']); ?></i></span>
                    <ul class="sub-menu">
                        <?php $__currentLoopData = $list['childs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="">
                                <a href="/<?php echo e($child['url']); ?>"><?php echo e($child['name']); ?></a>
                                <span class="icon-thumbnail"><i class="pg-icon"><?php echo e($child['icon']); ?></i></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php else: ?>
                <li class="<?php echo e($loop->iteration == 1 ? 'm-t-20' : ''); ?>">
                    <a href="/<?php echo e($list['url']); ?>">
                        <span class="title"><?php echo e($list['name']); ?></span>
                    </a>
                    <span class="icon-thumbnail"><i class="pg-icon"><?php echo e($list['icon']); ?></i></span>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <div class="clearfix"></div>
</div><?php /**PATH D:\College\SKRIPSI\App\human-resource-management-system-fe\resources\views/components/sidebar-layout.blade.php ENDPATH**/ ?>