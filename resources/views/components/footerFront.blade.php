<footer class="main-footer">
    <div class="container-fluid">
        <div class="footer-content">
            <div class="row justify-content-between">
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="logo-widget footer-widget">
                        <figure class="logo-box"><a href="#"><img src="{{ asset('images/logo.svg') }}"
                                    alt=""></a></figure>
                        <div class="text">
                            <p>Lorem ipsum dolor amet consectetur adi pisicing elit sed eiusm tempor incididunt ut
                                labore dolore magna aliqua enim ad minim veniam quis.nostrud exercita.laboris nisi ut
                                aliquip ea commodo conse quatuis aute irure.</p>
                        </div>
                        @if ($socials && count($socials) > 0)
                                <ul class="footer-social">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                        @endif

                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6 col-sm-12 offset-lg-2 footer-column">
                    <div class="service-widget footer-widget">
                        <div class="footer-title">Services</div>
                        <ul class="list">
                            <li><a href="#">Water Surve</a></li>
                            <li><a href="#">Education for all</a></li>
                            <li><a href="#">Food Serving</a></li>
                            <li><a href="#">Animal Saves</a></li>
                            <li><a href="#">Help Orphan</a></li>
                        </ul>
                    </div>
                </div> --}}
                <div class="col-lg-3 col-md-6 col-sm-12 footer-widget">
                    <div class="contact-widget footer-widget">
                        <div class="footer-title">Contacts</div>
                        <div class="text">
                            <p>Lorem Ipsum, simply dummy text, printing, Chandigarh</p>
                            <p>+2(784) 1223323</p>
                            <p>info@example.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ss-go-top">
        <a class="smoothscroll" title="Back to Top" href="#top">
            <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                <path
                    d="M7.5 1.5l.354-.354L7.5.793l-.354.353.354.354zm-.354.354l4 4 .708-.708-4-4-.708.708zm0-.708l-4 4 .708.708 4-4-.708-.708zM7 1.5V14h1V1.5H7z"
                    fill="currentColor"></path>
            </svg>
        </a>
    </div>
</footer>
<!-- main-footer end -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 column">
                <div class="copyright"><a href="#">Calvin</a> &copy; 2019 All Right Reserved</div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 column">
                <ul class="footer-nav">
                    <li><a href="{{route('contact-us.view')}}">Contact Us</a></li>
                    
                    <li><a href="{{route('privacy-policy.view')}}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
