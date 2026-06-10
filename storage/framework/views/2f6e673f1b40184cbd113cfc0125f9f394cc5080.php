<div class="container">
    <div class="row">
        <div class="subscribe scrollme">

            <div class="col-sm-12 col-xs-12">
                <!-- Contact us -->
                <?php echo Form::open(['url' => 'contact/submit', 'method' => 'post']); ?>

                <?php echo e(csrf_field()); ?>

                
                <div>
                    <?php echo e(Form::text('name', old('name'), ['class' => 'form-control mb-3', 'placeholder' => 'Въведете Вашите имена'])); ?>

                </div>
                <div>
                    <?php echo e(Form::email('email', old('email'), ['class' => 'form-control mb-3', 'placeholder' => 'Въведете Вашият e-mail адрес'])); ?>

                </div>
                <div>
                    <?php echo e(Form::textarea('message', old('message'), ['class' => 'form-control mb-3', 'placeholder' => 'Въведете Вашето съобщение'])); ?>

                </div>
                <div>
                    <?php echo e(Form::submit('Изпращане', ['class' => 'theme-btn'])); ?>

                </div>
                
                <?php echo Form::close(); ?>

                <!-- /Contact us -->

            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/marsisla/public_html/resources/views/includes/form.blade.php ENDPATH**/ ?>