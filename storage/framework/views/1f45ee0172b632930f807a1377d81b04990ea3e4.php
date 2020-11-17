<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Register')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="IdDokter" class="col-md-4 col-form-label text-md-right">IdDokter</label>

                            <div class="col-md-6">
                                <input id="IdDokter" type="text" class="form-control<?php echo e($errors->has('IdDokter') ? ' is-invalid' : ''); ?>" name="IdDokter" value="<?php echo e(old('IdDokter')); ?>" required autofocus>

                                <?php if($errors->has('IdDokter')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('IdDokter')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NamaLengkap" class="col-md-4 col-form-label text-md-right">NamaLengkap</label>

                            <div class="col-md-6">
                                <input id="NamaLengkap" type="text" class="form-control<?php echo e($errors->has('NamaLengkap') ? ' is-invalid' : ''); ?>" name="NamaLengkap" value="<?php echo e(old('NamaLengkap')); ?>" required autofocus>

                                <?php if($errors->has('NamaLengkap')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('NamaLengkap')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="KdRuangan" class="col-md-4 col-form-label text-md-right">KdRuangan</label>

                            <div class="col-md-6">
                                <input id="KdRuangan" type="text" class="form-control<?php echo e($errors->has('KdRuangan') ? ' is-invalid' : ''); ?>" name="KdRuangan" value="<?php echo e(old('KdRuangan')); ?>" required autofocus>

                                <?php if($errors->has('KdRuangan')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('KdRuangan')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NamaRuangan" class="col-md-4 col-form-label text-md-right">NamaRuangan</label>

                            <div class="col-md-6">
                                <input id="NamaRuangan" type="text" class="form-control<?php echo e($errors->has('NamaRuangan') ? ' is-invalid' : ''); ?>" name="NamaRuangan" value="<?php echo e(old('NamaRuangan')); ?>" required autofocus>

                                <?php if($errors->has('NamaRuangan')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('NamaRuangan')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="KdJabatan" class="col-md-4 col-form-label text-md-right">KdJabatan</label>

                            <div class="col-md-6">
                                <input id="KdJabatan" type="text" class="form-control<?php echo e($errors->has('KdJabatan') ? ' is-invalid' : ''); ?>" name="KdJabatan" value="<?php echo e(old('KdJabatan')); ?>" required autofocus>

                                <?php if($errors->has('KdJabatan')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('KdJabatan')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>