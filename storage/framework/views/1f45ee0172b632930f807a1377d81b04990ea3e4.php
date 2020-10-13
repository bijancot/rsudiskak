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
                            <label for="KodeDokter" class="col-md-4 col-form-label text-md-right">Kode Dokter</label>

                            <div class="col-md-6">
                                <input id="KodeDokter" type="text" class="form-control<?php echo e($errors->has('KodeDokter') ? ' is-invalid' : ''); ?>" name="KodeDokter" value="<?php echo e(old('KodeDokter')); ?>" required autofocus>

                                <?php if($errors->has('KodeDokter')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('KodeDokter')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NamaDokter" class="col-md-4 col-form-label text-md-right">Nama Dokter</label>

                            <div class="col-md-6">
                                <input id="NamaDokter" type="text" class="form-control<?php echo e($errors->has('NamaDokter') ? ' is-invalid' : ''); ?>" name="NamaDokter" value="<?php echo e(old('NamaDokter')); ?>" required autofocus>

                                <?php if($errors->has('NamaDokter')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('NamaDokter')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="JK" class="col-md-4 col-form-label text-md-right">JK</label>

                            <div class="col-md-6">
                                <input id="JK" type="text" class="form-control<?php echo e($errors->has('JK') ? ' is-invalid' : ''); ?>" name="JK" value="<?php echo e(old('JK')); ?>" required autofocus>

                                <?php if($errors->has('JK')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('JK')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Jabatan" class="col-md-4 col-form-label text-md-right">Jabatan</label>

                            <div class="col-md-6">
                                <input id="Jabatan" type="text" class="form-control<?php echo e($errors->has('Jabatan') ? ' is-invalid' : ''); ?>" name="Jabatan" value="<?php echo e(old('Jabatan')); ?>" required autofocus>

                                <?php if($errors->has('Jabatan')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('Jabatan')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="KdStatus" class="col-md-4 col-form-label text-md-right">KdStatus</label>

                            <div class="col-md-6">
                                <input id="KdStatus" type="text" class="form-control<?php echo e($errors->has('KdStatus') ? ' is-invalid' : ''); ?>" name="KdStatus" value="<?php echo e(old('KdStatus')); ?>" required autofocus>

                                <?php if($errors->has('KdStatus')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('KdStatus')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="KdJenisPegawai" class="col-md-4 col-form-label text-md-right">KdJenisPegawai</label>

                            <div class="col-md-6">
                                <input id="KdJenisPegawai" type="text" class="form-control<?php echo e($errors->has('KdJenisPegawai') ? ' is-invalid' : ''); ?>" name="KdJenisPegawai" value="<?php echo e(old('KdJenisPegawai')); ?>" required autofocus>

                                <?php if($errors->has('KdJenisPegawai')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('KdJenisPegawai')); ?></strong>
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