<div class="modal fade " id="editModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('dash.Edit City')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal"
                      enctype="multipart/form-data" id="demo-form-edit" data-parsley-validate="">
                    <?php echo e(method_field('patch')); ?>

                    <?php echo csrf_field(); ?>

                    <div class="box-body">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"><?php echo e(__('dash.title_ar')); ?></label>
                                <input type="text" name="title_ar" class="form-control"
                                       id="title_ar"
                                       placeholder="<?php echo e(__('dash.title_ar')); ?>"
                                >
                                <?php $__errorArgs = ['title_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4"><?php echo e(__('dash.title_en')); ?></label>
                                <input type="text" name="title_en" class="form-control"
                                       id="title_en"
                                       placeholder="<?php echo e(__('dash.title_en')); ?>"
                                >
                                <?php $__errorArgs = ['title_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>


                        </div>


                        <div class="form-group col-md-6">

                            <label for="inputEmail4"><?php echo e(__('dash.country')); ?></label>
                            <select id="inputState" class="select2 country_id form-control pt-1"
                                    name="country_id">
                                <option disabled><?php echo e(__('dash.choose')); ?></option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($country); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['country_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('dash.save')); ?></button>
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?php echo e(__('dash.close')); ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<?php /**PATH /home/974206.cloudwaysapps.com/xzgdmzdxcn/public_html/resources/views/dashboard/settings/cities/edit.blade.php ENDPATH**/ ?>