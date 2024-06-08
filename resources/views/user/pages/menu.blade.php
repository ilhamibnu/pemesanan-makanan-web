@extends('user.layout.main')
@section('title' , ' - Menu')
@section('content')
<section class="banner" style="background-image:url({{ asset('user/assets/img/background.png') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="title-area-data">
                    <h2>Table Menu</h2>
                    <p>A magical combination that sent aromas to the taste buds</p>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Menus</li>
                    <li class="breadcrumb-item active" aria-current="page">Menus 1</li>
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
<section class="gap no-bottom">
    <div class="container">
        <div class="row align-items-center discover-menu">
            <div class="col-xl-6">
                <div class="discover-img">
                    <img alt="discover" src="{{ asset('user/assets/img/discover-3.png') }}">
                </div>
            </div>
            <div class="col-xl-5">
                <div class="discover">
                    <h4>Coffee Menu</h4>
                    <ul>
                        <li>
                            <div>
                                <h6>Espresso Macchiato</h6>
                                <p>Chicken / Apple / Tomatos</p>
                            </div>
                            <span>$9.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Mocha Whipped Cream</h6>
                                <p>Bacon / Shrimp / Garlic</p>
                            </div>
                            <span>$16.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Cold Coffee</h6>
                                <p>Pork / Tomatoes / Veggies</p>
                            </div>
                            <span>$34.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Caramel Macchiato</h6>
                                <p>Prawn / Sausage / Totatos</p>
                            </div>
                            <span>$40.00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row align-items-center discover-menu mt-5">
            <div class="col-xl-6">
                <div class="discover-img">
                    <img alt="discover" src="{{ asset('user/assets/img/discover-1.png') }}">
                </div>
            </div>
            <div class="col-xl-5">
                <div class="discover">
                    <h4>Steak </h4>
                    <ul>
                        <li>
                            <div>
                                <h6>Four Chease Garlic Bread</h6>
                                <p>Toested french bread topped with romano</p>
                            </div>
                            <span>$9.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Rastrami Roll</h6>
                                <p>Spreadable cream cheese, blue cheese</p>
                            </div>
                            <span>$16.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Caprese Salad Kabobs</h6>
                                <p>Cherry-size fresh mozzarella cheese balls</p>
                            </div>
                            <span>$34.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Peachy Jalepeno Guacomole</h6>
                                <p>Ground cumin, avocados, peeled and cubed</p>
                            </div>
                            <span>$40.00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row align-items-center discover-menu mt-5">
            <div class="col-xl-6">
                <div class="discover-img">
                    <img alt="discover" src="{{ asset('user/assets/img/discover-4.png') }}">
                </div>
            </div>
            <div class="col-xl-5">
                <div class="discover">
                    <h4>BBQ</h4>
                    <ul>
                        <li>
                            <div>
                                <h6>Sake BBQ sauce</h6>
                                <p>radish, black sesame seeds, coriander</p>
                            </div>
                            <span>$9.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>BBQ baby back ribs</h6>
                                <p>sticky Asian glaze, charred lime, chilli cashews</p>
                            </div>
                            <span>$16.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Half smoked chicken</h6>
                                <p>miso butter glaze, charred lime wedge, sake bbq</p>
                            </div>
                            <span>$34.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Dusted chicken wings</h6>
                                <p>tossed in Korean hot sauce, pickled radish</p>
                            </div>
                            <span>$40.00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row align-items-center discover-menu mt-5">
            <div class="col-xl-6">
                <div class="discover-img">
                    <img alt="discover" src="{{ asset('user/assets/img/discover-5.png') }}">
                </div>
            </div>
            <div class="col-xl-5">
                <div class="discover">
                    <h4>Grill Food</h4>
                    <ul>
                        <li>
                            <div>
                                <h6>Four Chease Garlic Bread</h6>
                                <p>Toested french bread topped with romano</p>
                            </div>
                            <span>$9.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Rastrami Roll</h6>
                                <p>Spreadable cream cheese, blue cheese</p>
                            </div>
                            <span>$16.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Caprese Salad Kabobs</h6>
                                <p>Cherry-size fresh mozzarella cheese balls</p>
                            </div>
                            <span>$34.00</span>
                        </li>
                        <li>
                            <div>
                                <h6>Peachy Jalepeno Guacomole</h6>
                                <p>Ground cumin, avocados, peeled and cubed</p>
                            </div>
                            <span>$40.00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap">
    <div class="container private">
        <div class="row align-items-center">
            <div class="col-xl-7">
                <div class="private-dining">
                    <img alt="private-dining" src="{{ asset('user/assets/img/private-dining-1.jpg') }}">
                    <img alt="private-dining" src="{{ asset('user/assets/img/private-dining-2.jpg') }}">
                    <img alt="private-dining" src="{{ asset('user/assets/img/private-dining-3.jpg') }}">
                    <img alt="private-dining" src="{{ asset('user/assets/img/private-dining-4.jpg') }}">
                </div>
            </div>
            <div class="col-xl-5">
                <div class="private-dining-text">
                    <h2>Private Dining and Events</h2>
                    <p>With many private dining spaces, M is the perfect place to host your event or gathering</p>
                    <a href="#" class="button">Enquire Now</a>
                    <h5>Booking:<a href="callto:+441298123987" class="ms-3">+44 1298 123 987</a></h5>
                </div>
            </div>
        </div>
    </div>
</section @endsection
