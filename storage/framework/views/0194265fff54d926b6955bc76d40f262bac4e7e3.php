<footer class="footer pt-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-md-12">
                <div class="footer-widget mb-60 wow fadeInLeft" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <h4 class="logo mb-30"><?php echo e($settings->site_name); ?></h4>
                    <p class="mb-30 footer-desc"><?php echo e($settings->site_info); ?></p>
                </div>
            </div>

            <div class="col-xl-4 col-md-12">
                <div class="footer-widget mb-60 wow fadeInRight" data-wow-delay=".8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInRight;">
                    <h4>Contact</h4>
                    <ul class="footer-contact">
                        <li>
                            <a href="tel:<?php echo e($settings->contact_number); ?>" class="title"><?php echo e($settings->contact_number); ?></a>
                            <p class="sub-title"><?php echo e($settings->footer_text1); ?></p>
                        </li>
                        <li>
                            <a href="mailto:<?php echo e($settings->contact_email); ?>" class="title"><?php echo e($settings->contact_email); ?></a>
                            <p class="sub-title"><?php echo e($settings->footer_text2); ?></p>
                        </li>
                        <li>
                            <a href="#" class="title"><?php echo e($settings->address); ?></a>
                            <p class="sub-title"><?php echo e($settings->footer_text3); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="footer-social-links">
                        <ul class="d-flex">
                            <?php if(!empty($settings->facebook)): ?>
                                <li><a href="<?php echo e($settings->facebook); ?>" target="_blank"><i class="lni lni-facebook-filled"></i></a></li>
                            <?php endif; ?>
                            <?php if(!empty($settings->instagram)): ?>
                                <li><a href="<?php echo e($settings->instagram); ?>" target="_blank"><i class="lni lni-instagram-filled"></i></a></li>
                            <?php endif; ?>
                            <?php if(!empty($settings->twitter)): ?>
                                <li><a href="<?php echo e($settings->twitter); ?>" target="_blank"><i class="lni lni-twitter-filled"></i></a></li>
                            <?php endif; ?>
                            <?php if(!empty($settings->tiktok)): ?>
                                <li><a href="<?php echo e($settings->tiktok); ?>" target="_blank"><i class="lni lni-tiktok"></i></a></li>
                            <?php endif; ?>
                            <?php if(!empty($settings->linkedin)): ?>
                                <li><a href="<?php echo e($settings->linkedin); ?>" target="_blank"><i class="lni lni-linkedin-filled"></i></a></li>
                            <?php endif; ?>
                            <?php if(!empty($settings->vkontakte)): ?>
                                <li><a href="<?php echo e($settings->vkontakte); ?>" target="_blank"><i class="lni lni-vk"></i></a></li>
                            <?php endif; ?>
                            <?php if(!empty($settings->youtube)): ?>
                                <li><a href="<?php echo e($settings->youtube); ?>" target="_blank"><i class="lni lni-youtube"></i></a></li>
                            <?php endif; ?>
                            <?php if(!empty($settings->skype)): ?>
                                <li><a href="<?php echo e($settings->skype); ?>" target="_blank"><i class="lni lni-skype"></i></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="wow fadeInUp" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">Разработчик: <a href="https://marsislav.net/" target="_blank">Marsislav</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Statcounter code for MarsNEW https://marsislav.net/ -->
<script type="text/javascript">
var sc_project=13271239; 
var sc_invisible=1; 
var sc_security="c1277711"; 
</script>
<script type="text/javascript"
src="https://www.statcounter.com/counter/counter.js" async></script>
<noscript><div class="statcounter"><a title="Web Analytics Made Easy -
Statcounter" href="https://statcounter.com/" target="_blank"><img
class="statcounter" src="https://c.statcounter.com/13271239/0/c1277711/1/"
alt="Web Analytics Made Easy - Statcounter"
referrerPolicy="no-referrer-when-downgrade"></a></div></noscript>
<!-- End of Statcounter Code -->
</footer>
<?php /**PATH /home/marsisla/public_html/resources/views/includes/footer.blade.php ENDPATH**/ ?>