@extends('user.layout.main')
@section('title', ' - Contact Us')

@section('content')
<section class="banner" style="background-image:url({{ asset('user/assets/img/background.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="title-area-data">
                    <h2>Contact Us</h2>
                    {{-- <p>A magical combination that sent aromas to the taste buds</p> --}}
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-6">
                        <div class="title-area-img">
                            <img alt="title-area-img" src="{{ asset('user/assets/img/title-area-img-1.jpg') }}">
                            <img alt="pata" class="pata" src="{{ asset('user/assets/img/pata.png') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="title-area-img two">
                            <img alt="title-area-img" src="{{ asset('user/assets/img/title-area-img-2.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap">
    <div class="container">
        <div class="row">
            {{-- <div class="col-xl-6"> --}}
            <div class="get-in-touch">
                <h2>Get in Touch</h2>
                <ul class="booking">
                    <li class="contact">
                        <i>
                            <svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg">
                                <g id="_16-Smartphone" data-name="16-Smartphone">
                                    <path d="m23 2h-14a3 3 0 0 0 -3 3v22a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-22a3 3 0 0 0 -3-3zm-5.39 2-.33 1h-2.56l-.33-1zm6.39 23a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1-1v-22a1 1 0 0 1 1-1h3.28l.54 1.63a2 2 0 0 0 1.9 1.37h2.56a2 2 0 0 0 1.9-1.37l.54-1.63h3.28a1 1 0 0 1 1 1z" />
                                    <path d="m17 24h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2z" />
                                </g>
                            </svg>
                        </i>
                        <div>
                            <span>for Whatapp</span>
                            <a href="callto:01123456786"><span>087844018037</span></a>
                        </div>
                    </li>
                    <li class="contact">
                        <i>
                            <svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg">
                                <g id="_01-Email" data-name="01-Email">
                                    <path d="m29.61 12.21-13-10a1 1 0 0 0 -1.22 0l-13 10a1 1 0 0 0 -.39.79v14a3 3 0 0 0 3 3h22a3 3 0 0 0 3-3v-14a1 1 0 0 0 -.39-.79zm-13.61-7.95 11.36 8.74-11.36 8.74-11.36-8.74zm11 23.74h-22a1 1 0 0 1 -1-1v-12l11.39 8.76a1 1 0 0 0 1.22 0l11.39-8.76v12a1 1 0 0 1 -1 1z"></path>
                                </g>
                            </svg>
                        </i>
                        <div>
                            <span>for Email</span>
                            <a href="mailto:info@domain.com"><span>alacafe.jbr@gmail.com</span></a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mapouter"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.6036118390402!2d113.7295941811915!3d-8.141773040975453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695a7ba592045%3A0xf86103c96490ccf6!2sJl.%20Slamet%20Riyadi%20No.164%2C%20Baratan%20Wetan%2C%20Baratan%2C%20Kec.%20Patrang%2C%20Kabupaten%20Jember%2C%20Jawa%20Timur%2068112!5e0!3m2!1sid!2sid!4v1718197813163!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            <div class="align-items-center d-flex mt-3">
                <i class="fa-solid fa-location-dot me-3"></i>
                <p> Jl. Slamet Riyadi No.164, Kelurahan baratan, Kecamatan patrang, Kabupaten jember</p>
            </div>
            {{-- <div class="mt-2 d-flex align-items-center">
                    <i class="fa-solid fa-location-dot me-3"></i>
                    <p>Belfast BT4 3LP Sea Beach United State</p>
                </div> --}}
            {{-- </div> --}}
            {{-- <div class="col-xl-6">
                <div class="get-in-touch">
                    <h2>Have Question?</h2>
                    <p>For all enquires, please contact us and one of our delightful team will be be happy to help.</p>
                </div>

                <form role="form" id="contact-form" method="post" class="add-review leave-comment mt-4">
                    <input type="text" name="complete_name" id="Complete_Name" placeholder="Full Name" required>
                    <input type="text" name="email_address" placeholder="Email Address" id="email_address" required>
                    <input type="text" name="phone" placeholder="Phone No">
                    <textarea placeholder="Message" name="message"></textarea>
                    <button class="button" type="submit" value="submit">
                        <span>send Message</span>
                    </button>
                </form>
            </div> --}}
        </div>
    </div>
</section>
{{-- <div class="container">
    <div class="blog-img-video video mb-0">
        <img alt="video-img" src="{{ asset('user/assets/img/contact.jpg') }}">
<a data-fancybox="" href="https://www.youtube.com/watch?v=1La4QzGeaaQ"><i>
        <svg width="15" height="22" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 8.5L0.5 0.272758L0.5 16.7272L11 8.5Z" fill="#fff" />
        </svg>
    </i>
</a>
</div>
</div> --}}
<div class="container">
    <div class="opening-hours justify-content-center">
        <div class="text-center">
            <div class="day-time">
                <h6>Monday - Sunday</h6>
                <h4>08.00pm - 22.00</h4>
                <span>Open all day</span>
            </div>
        </div>
        {{-- <div class="boder-line"></div>
        <div class="day-time">
            <h6>Saturday</h6>
            <h4>11:30am - 11pm</h4>
            <span>Open all day</span>
        </div>
        <div class="boder-line"></div>
        <div class="day-time">
            <h6>Monday - Friday</h6>
            <h4>12pm - 11pm</h4>
            <span>Open all day</span>
        </div> --}}
    </div>
</div>
@endsection
