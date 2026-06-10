<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">

        
        <div class="panel panel-danger">
            <div class="panel-heading" style="font-size:16px;">
                <strong>
                    <?php if($code == 404): ?> 🔍
                    <?php elseif($code == 403): ?> 🔒
                    <?php elseif($code == 401): ?> 🔑
                    <?php elseif($code == 405): ?> ⚠️
                    <?php else: ?> 💥
                    <?php endif; ?>
                    HTTP <?php echo e($code); ?> — <?php echo e($title); ?>

                </strong>
            </div>

            <div class="panel-body">

                
                <div class="alert alert-warning" style="margin-bottom:16px;">
                    <p style="margin:0 0 8px 0; font-size:15px;"><?php echo $explanation; ?></p>
                    <p style="margin:0; color:#666;"><em>💡 <?php echo $tip; ?></em></p>
                </div>

                
                <div>
                    <p><strong>Техническа грешка:</strong></p>
                    <pre style="background:#f8f8f8; border:1px solid #ddd; padding:12px;
                                border-radius:4px; white-space:pre-wrap; word-break:break-word;
                                font-size:12px; color:#c7254e; max-height:200px; overflow-y:auto;"><?php echo e($technical); ?></pre>
                </div>

                
                <?php if($showTrace && $trace): ?>
                <div style="margin-top:12px;">
                    <a href="#" onclick="
                        var el = document.getElementById('err-trace');
                        el.style.display = el.style.display === 'none' ? 'block' : 'none';
                        this.textContent = el.style.display === 'none' ? '▶ Покажи stack trace' : '▼ Скрий stack trace';
                        return false;
                    " style="font-size:12px; color:#888;">▶ Покажи stack trace</a>
                    <pre id="err-trace"
                         style="display:none; margin-top:8px; background:#1e1e1e; color:#d4d4d4;
                                padding:12px; border-radius:4px; font-size:11px;
                                white-space:pre-wrap; word-break:break-word;
                                max-height:400px; overflow-y:auto;"><?php echo e($trace); ?></pre>
                </div>
                <?php endif; ?>

                
                <div style="margin-top:16px;">
                    <a href="javascript:history.back()" class="btn btn-default btn-sm">← Назад</a>
                    <a href="<?php echo e(url('/admin')); ?>" class="btn btn-default btn-sm">🏠 Dashboard</a>
                </div>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/marsisla/public_html/resources/views/errors/friendly.blade.php ENDPATH**/ ?>