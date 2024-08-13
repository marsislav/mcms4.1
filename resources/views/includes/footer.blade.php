<footer class="footer pt-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-md-12">
                <div class="footer-widget mb-60 wow fadeInLeft" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <h4 class="logo mb-30">{{ $settings->site_name }}</h4>
                    <p class="mb-30 footer-desc">{{ $settings->site_info }}</p>
                </div>
            </div>

            <div class="col-xl-4 col-md-12">
                <div class="footer-widget mb-60 wow fadeInRight" data-wow-delay=".8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInRight;">
                    <h4>Contact</h4>
                    <ul class="footer-contact">
                        <li>
                            <a href="tel:{{ $settings->contact_number }}" class="title">{{ $settings->contact_number }}</a>
                            <p class="sub-title">{{ $settings->footer_text1 }}</p>
                        </li>
                        <li>
                            <a href="mailto:{{ $settings->contact_email }}" class="title">{{ $settings->contact_email }}</a>
                            <p class="sub-title">{{ $settings->footer_text2 }}</p>
                        </li>
                        <li>
                            <a href="#" class="title">{{ $settings->address }}</a>
                            <p class="sub-title">{{ $settings->footer_text3 }}</p>
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
                            @if (!empty($settings->facebook))
                                <li><a href="{{ $settings->facebook }}" target="_blank"><i class="lni lni-facebook-filled"></i></a></li>
                            @endif
                            @if (!empty($settings->instagram))
                                <li><a href="{{ $settings->instagram }}" target="_blank"><i class="lni lni-instagram-filled"></i></a></li>
                            @endif
                            @if (!empty($settings->twitter))
                                <li><a href="{{ $settings->twitter }}" target="_blank"><i class="lni lni-twitter-filled"></i></a></li>
                            @endif
                            @if (!empty($settings->tiktok))
                                <li><a href="{{ $settings->tiktok }}" target="_blank"><i class="lni lni-tiktok"></i></a></li>
                            @endif
                            @if (!empty($settings->linkedin))
                                <li><a href="{{ $settings->linkedin }}" target="_blank"><i class="lni lni-linkedin-filled"></i></a></li>
                            @endif
                            @if (!empty($settings->vkontakte))
                                <li><a href="{{ $settings->vkontakte }}" target="_blank"><i class="lni lni-vk"></i></a></li>
                            @endif
                            @if (!empty($settings->youtube))
                                <li><a href="{{ $settings->youtube }}" target="_blank"><i class="lni lni-youtube"></i></a></li>
                            @endif
                            @if (!empty($settings->skype))
                                <li><a href="{{ $settings->skype }}" target="_blank"><i class="lni lni-skype"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="wow fadeInUp" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">Разработчик: <a href="https://marsislav.net/" target="_blank">Marsislav</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
