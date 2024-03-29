<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    @if(checkFeature('seo'))
        @if($vcard->meta_description)
            <meta name="description" content="{{$vcard->meta_description}}">
        @endif
        @if($vcard->meta_keyword)
            <meta name="keywords" content="{{$vcard->meta_keyword}}">
        @endif
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(checkFeature('seo') && $vcard->site_title && $vcard->home_title)
        <title>{{ $vcard->home_title }} | {{ $vcard->site_title }}</title>
    @else
        <title>{{ $vcard->name }} | {{ getAppName() }}</title>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    {{--css link--}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard9.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">

    {{--google Font--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto&display=swap" rel="stylesheet">

    <title>{{ $vcard->name }} | {{ getAppName() }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">
    @if(checkFeature('custom-fonts') && $vcard->font_family)
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{$vcard->font_family}}">
    @endif

    @if($vcard->font_family || $vcard->font_size || $vcard->custom_css)
        <style>
            @if(checkFeature('custom-fonts'))
                @if($vcard->font_family)
                    body {
                        font-family: {{$vcard->font_family}};
                    }
                @endif
                @if($vcard->font_size)
                    div > h4 {
                        font-size: {{$vcard->font_size}}px !important;
                    }
                @endif
            @endif
            @if(isset(checkFeature('advanced')->custom_css))
                {!! $vcard->custom_css !!}
            @endif
        </style>
    @endif
</head>
<body>
<div class="container">
    @include('vcards.password')
    <div class="vcard-nine main-content w-100 mx-auto overflow-hidden content-blur collapse show allSection">
        {{--banner--}}
        <div class="vcard-nine__banner w-100 position-relative">
            <img src="{{ $vcard->cover_url }}" class="img-fluid banner-image" alt="banner"/>
            <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3">
                @if($vcard->language_enable == \App\Models\Vcard::LANGUAGE_ENABLE)
                    <div class="language pt-4 me-2">
                        <ul class="text-decoration-none">
                            <li class="dropdown1 dropdown lang-list">
                                <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-language me-2"></i>{{getLanguage($vcard->default_language)}}
                                </a>
                                <ul class="dropdown-menu start-0 top-dropdown lang-hover-list top-100">
                                    @foreach(getAllLanguage() as $key => $language)
                                        <li class="{{ getLanguageIsoCode($vcard->default_language) === $key ? 'active' : '' }}">
                                            <a href="javascript:void(0)" id="languageName"
                                               data-name="{{ $key }}">{{ $language }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>
        </div>
        {{--profile--}}
        <div class="vcard-nine__profile position-relative">
            <div class="avatar position-absolute top-0 start-50 translate-middle">
                <img src="{{ $vcard->profile_url }}" alt="profile-img" class="rounded-circle"/>
            </div>
        </div>
        {{--profile details--}}
        <div class="vcard-nine__profile-details py-3 px-sm-3 px-2">
            <h4 class="profile-name text-center mb-1">{{ ucwords($vcard->first_name.' '.$vcard->last_name) }}</h4>
            <span class="profile-designation text-center d-block">{{ ucwords($vcard->occupation) }}</span>
            <div class="d-flex align-items-center mb-5">
                <span class="pt-5 profile-description">{{$vcard->description}}</span>
            </div>
            @if(checkFeature('social_links') && getSocialLink($vcard))
                <div class="social-icons d-flex justify-content-center pt-sm-5 pt-4 flex-wrap mx-auto">
                    @foreach(getSocialLink($vcard) as $value)
                        <span class="rounded-circle d-flex justify-content-center align-items-center m-sm-3 m-1">
                   {!! $value !!}
                </span>
                    @endforeach
                </div>
            @endif
        </div>
        {{--event--}}
        <div class="vcard-nine__event py-3 px-3 mt-2 position-relative">
            <div class="container">
                <div class="row g-3">
                    @if($vcard->email)
                        <div class="col-sm-6 col-12">
                            <div class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('assets/img/vcard9/vcard9-email.png')}}" alt="email"/>
                            </span>
                                <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                    <h6 class="text-sm-start text-center">{{ __('messages.vcard.email_address') }}</h6>
                                    <h5><a href="mailto:{{ $vcard->email }}"
                                           class="event-name text-sm-start text-center mb-0 text-decoration-none">{{ $vcard->email }}</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endif
                        @if($vcard->alternative_email)
                            <div class="col-sm-6 col-12">
                                <div class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('assets/img/vcard9/vcard9-alternate-email.png')}}" alt="email" height="26" width="32"/>
                            </span>
                                    <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                        <h6 class="text-sm-start text-center">{{ __('messages.vcard.alter_email_address') }}</h6>
                                        <h5><a href="mailto:{{ $vcard->alternative_email }}"
                                               class="event-name text-sm-start text-center mb-0 text-decoration-none">{{ $vcard->alternative_email }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @if($vcard->phone)
                        <div class="col-sm-6 col-12">
                            <div class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('assets/img/vcard9/vcard9-phone.png')}}" alt="phone"/>
                            </span>
                                <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                    <h6 class="text-sm-start text-center">{{ __('messages.vcard.mobile_number') }}</h6>
                                    <h5><a href="tel:+{{ $vcard->region_code }}{{ $vcard->phone }}"
                                           class="event-name text-center mb-0 text-decoration-none">+{{ $vcard->region_code }} {{ $vcard->phone }}</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endif
                        @if($vcard->alternative_phone)
                            <div class="col-sm-6 col-12">
                                <div class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('assets/img/vcard9/alter-phone.png')}}" alt="phone"/>
                            </span>
                                    <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                        <h6 class="text-sm-start text-center">{{ __('messages.vcard.alter_mobile_number') }}</h6>
                                        <h5><a href="tel:+{{ $vcard->region_code }} {{ $vcard->alternative_phone }}"
                                               class="event-name text-center mb-0 text-decoration-none">+{{ $vcard->region_code }} {{ $vcard->alternative_phone }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @if($vcard->dob)
                        <div class="col-sm-6 col-12">
                            <div class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('assets/img/vcard9/vcard9-birthday.png')}}" alt="birthday"/>
                            </span>
                                <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                    <h6 class="text-sm-start text-center">{{ __('messages.vcard.dob') }}</h6>
                                    <h5 class="event-name text-center mb-0">{{ $vcard->dob }}</h5>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($vcard->location)
                        <div class="col-sm-6 col-12">
                            <div class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                            <span class="event-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('assets/img/vcard9/vcard9-location.png')}}" alt="location"/>
                            </span>
                                <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                    <h6 class="text-sm-start text-center">{{ __('messages.vcard.location') }}</h6>
                                    <h5 class="event-name text-center mb-0">{!! ucwords($vcard->location) !!}</h5>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
        </div>
        {{--our services--}}
       @if(checkFeature('services') && $vcard->services->count())
            <div class="vcard-nine__service py-4 px-3 position-relative px-sm-3">
                <h4 class="heading-right heading-line position-relative text-center">{{ __('messages.vcard.our_service') }}</h4>
                <div class="container mt-5">
                    <div class="row service-row g-4">
                        @foreach($vcard->services as $service)
                            <div class="col-12">
                                <div
                                    class="card service-card h-100 w-100 p-3 border-0 d-flex align-items-center flex-sm-row">
                                    <div
                                        class="service-image rounded-circle d-flex justify-content-center align-items-center justify-content-center">
                                        <img src="{{$service->service_icon}}" class="rounded-circle" alt="service"/>
                                    </div>
                                    <div class="service-details ms-sm-3 mt-sm-0 mt-3">
                                        <h5 class="service-title text-sm-start text-center">{{ ucwords($service->name) }}</h5>
                                        <p class="service-paragraph mb-0 text-sm-start text-center">
                                            {!! $service->description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{--gallery--}}
        @if(checkFeature('gallery') && $vcard->gallery->count())
        <div class="vcard-nine__gallery py-4 px-3 position-relative px-sm-3">
            <h4 class="heading-right heading-line position-relative text-center">{{ __('messages.plan.gallery') }}</h4>
            <div class="container">
                <div class="row g-3 gallery-slider mt-4">
                    @foreach($vcard->gallery as $file)
                        @php
                            $infoPath = pathinfo(public_path($file->gallery_image));
                          $extension = $infoPath['extension'];
                        @endphp
                    <div class="col-6">
                        <div class="card gallery-card p-3 border-0 w-100">
                            <div class="gallery-profile">
                                @if($file->type == App\Models\Gallery::TYPE_IMAGE)
                                    <img src="{{$file->gallery_image}}" alt="profile" class="w-100"/>
                                @elseif($file->type == App\Models\Gallery::TYPE_FILE)
                                    <a id="file_url" href="{{$file->gallery_image}}"
                                       class="gallery-link gallery-file-link" target="_blank">
                                        <div class="gallery-item"
                                             @if($extension=='pdf')
                                             style="background-image: url({{ asset('assets/images/vcard-file.png') }})">
                                            @endif
                                            @if($extension=='xls')
                                                style="background-image: url({{ asset('assets/images/xls.png') }})">
                                            @endif
                                            @if($extension=='csv')
                                                style="background-image: url({{ asset('assets/images/csv-file.png') }})">
                                            @endif
                                            @if($extension=='xlsx')
                                                style="background-image: url({{ asset('assets/images/xlsx.png') }})">
                                            @endif
                                        </div>
                                    </a>
                                @else
                                    <a id="video_url" data-id="https://www.youtube.com/embed/{{YoutubeID($file->link)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                       class="gallery-link">
                                        <div class="gallery-item"
                                             style="background-image: url(&quot;https://vcard.waptechy.com/assets/img/video-thumbnail.png&quot;)">
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <iframe id="video" src="//www.youtube.com/embed/Q1NKMPhP8PY"
                                    class="w-100" height="315">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{--products--}}
        @if(checkFeature('products') && $vcard->products->count())
            <div class="vcard-nine__product py-4 px-3 position-relative px-sm-3">
                <h4 class="heading-left heading-line position-relative text-center">{{ __('messages.plan.products') }}</h4>
                <div class="container">
                    <div class="row g-3 product-slider mt-4">
                        @foreach($vcard->products as $product)
                            <div class="col-6 h-100">
                                <a @if($product->product_url) href="{{ $product->product_url }}" @endif
                                target="_blank" class="text-decoration-none fs-6">
                                    <div class="card product-card p-3 border-0 w-100 product-block h-100">
                                        <div class="product-profile">
                                            <img src="{{ $product->product_icon }}" alt="profile" class="w-100"
                                                 height="208px"/>
                                        </div>
                                        <div class="product-details mt-3">
                                            <h4>{{$product->name}}</h4>
                                            <p class="mb-2">
                                                {{$product->description}}
                                            </p>
                                            @if($product->currency_id && $product->price)
                                                <span
                                                        class="text-black">{{$product->currency->currency_icon}}{{$product->price}}</span>
                                            @elseif($product->price)
                                                <span class="text-black">{{$product->price}}</span>
                                            @else
                                                <span class="text-black">N/A</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        {{--testimonial--}}
        @if(checkFeature('testimonials') && $vcard->testimonials->count())
            <div class="vcard-nine__testimonial py-4 px-3 position-relative px-sm-3">
                <h4 class="heading-right heading-line position-relative text-center">{{ __('messages.plan.testimonials') }}</h4>
                <div class="container">
                    <div class="row g-3 testimonial-slider mt-4">
                        @foreach($vcard->testimonials as $testimonial)
                            <div class="col-12 h-100">
                                <div class="card testimonial-card p-3 border-0 w-100 h-100">
                                    <div class="testimonial-user d-flex flex-sm-row flex-column align-items-center justify-content-sm-start justify-content-center">
                                        <img src="{{ $testimonial->image_url }}" alt="profile" class="rounded-circle"/>
                                        <div class="user-details d-flex flex-column ms-sm-3 mt-sm-0 mt-2">
                                            <span class="user-name text-sm-start text-center">{{ ucwords($testimonial->name) }}</span>
                                            <span class="user-designation text-sm-start text-center"></span>
                                        </div>
                                    </div>
                                    <p class="review-message mb-2 text-sm-start text-center mt-2 h-100">
                                        {{ $testimonial->description }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        {{-- blog--}}
        @if(checkFeature('blog') && $vcard->blogs->count())
            <div class="vcard-nine__blog position-relative py-3">
                <h4 class="heading-left heading-line position-relative text-center">{{ __('messages.feature.blog') }}</h4>
                <div class="container pt-4 px-4">
                    <div class="row g-4 blog-slider overflow-hidden">
                        @foreach($vcard->blogs as $blog)
                            <div class="col-6 mb-2">
                                <div class="card blog-card p-2 border-0 w-100 h-100">
                                    <div class="blog-image">
                                        <a href="{{route('vcard.show-blog',[$vcard->url_alias,$blog->id])}}">
                                            <img src="{{ $blog->blog_icon }}" alt="profile" class="w-100"/>
                                        </a>
                                    </div>
                                    <div class="blog-details p-3">
                                        <a href="{{route('vcard.show-blog',[$vcard->url_alias,$blog->id])}}" class="text-decoration-none">
                                            <h4 class="text-sm-start text-center title-color p-3 mb-0 text-black">{{ $blog->title }}</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        {{--qr code--}}
        <div class="vcard-nine__qr-code py-4 px-3 position-relative px-sm-3">
            <h4 class="heading-left position-relative text-center">{{ __('messages.vcard.qr_code') }}</h4>
            <div class="container mt-5">
                <div class="card qr-code-card flex-sm-row flex-column justify-content-center align-items-center mt-3 border-0">
                    <div class="mx-2">
                        <div class="qr-profile mb-3 d-flex justify-content-center">
                            <img src="{{$vcard->profile_url}}" alt="qr profile" class="mx-auto d-block rounded-circle"/>
                        </div>
                        <a class="qr-code-btn text-white mt-4 d-sm-block d-none mx-auto text-decoration-none" id="qr-code-btn"
                           download="qr_code.png">{{ __('messages.vcard.download_my_qr_code') }}</a>
                    </div>
                    <div class="qr-code-scanner mx-md-4 mx-2 p-4 bg-white">
                        {!! QrCode::size(130)->format('svg')->generate(Request::url()); !!}
                    </div>
                    <div class="qr-profile mt-3 d-flex justify-content-center d-sm-none d-block">
                        <a class="qr-code-btn text-white mt-4 d-block mx-auto text-decoration-none"
                           href="data:image/svg;base64,{{ base64_encode(QrCode::size(150)->format('svg')->generate(Request::url())) }}"
                           download="qr_code.svg">{{ __('messages.vcard.download_my_qr_code') }}</a>
                    </div>
                </div>
            </div>
        </div>
        {{--business hour--}}
        @if($vcard->businessHours->count())
            <div class="vcard-nine__timing py-4 px-3 position-relative px-sm-3">
                <h4 class="heading-right position-relative text-center">{{ __('messages.business.business_hours') }}</h4>
                <div class="container">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-8 col-12 time-section p-sm-3 p-2">
                            @foreach($vcard->businessHours as $day)
                                <div class="d-flex justify-content-center time-zone">
                                    <span class="me-2">{{ strtoupper(__('messages.business.'.\App\Models\BusinessHour::DAY_OF_WEEK[$day->day_of_week]))}} :</span>
                                    <span>{{ $day->start_time.' - '.$day->end_time }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{--Appointment--}}
        @if(checkFeature('appointments') && $vcard->appointmentHours->count())
            <div class="vcard-nine__appointment py-3 px-sm-4 px-3 mt-2 position-relative">
                <h4 class="heading-left heading-line position-relative text-center mb-5">{{__('messages.make_appointments')}}</h4>
                <div class="container">
                    <div class="appointment-card p-3">
                        <div class="row d-flex align-items-center justify-content-center mb-3">
                            <div class="col-md-2">
                                <label for="date" class="appoint-date mb-2">{{__('messages.date')}}</label>
                            </div>
                            <div class="col-md-10">
                                {{ Form::text('date', null, ['class' => 'date appoint-input', 'placeholder' => __('messages.form.pick_date'),'id'=>'pickUpDate']) }}
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-center mb-md-3">
                            <div class="col-md-2">
                                <label for="text" class="appoint-date mb-2">{{__('messages.hour')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div id="slotData" class="row">
                                </div>
                            </div>
                        </div>


                        <button type="button"
                                class="appointmentAdd appoint-btn text-white mt-4 d-block mx-auto ">{{__('messages.make_appointments')}}
                        </button>
                </div>
            </div>
        </div>
            @include('vcardTemplates.appointment')
        @endif


        <div class="vcard-nine__contact py-4 px-3 position-relative px-sm-3">
            {{--contact us--}}
            @php $currentSubs = $vcard->subscriptions()->where('status', \App\Models\Subscription::ACTIVE)->latest()->first() @endphp
            @if($currentSubs && $currentSubs->plan->planFeature->enquiry_form)
                <h4 class="heading-right position-relative text-center">{{ __('messages.contact_us.contact_us') }}</h4>
                <div class="container mt-5">
                    <div class="row mt-4">
                        <div class="col-12 px-0">
                            <form id="enquiryForm">
                                @csrf
                                <div class="contact-form px-sm-2">
                                    <div id="enquiryError" class="alert alert-danger d-none"></div>
                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control" id="name"
                                               placeholder="{{__('messages.form.your_name')}}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" id="email"
                                               placeholder="{{__('messages.form.your_email')}}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" name="phone" class="form-control" id="mobile"
                                               placeholder="{{__('messages.form.phone')}}">
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" name="message"
                                                  placeholder="{{__('messages.form.type_message')}}" id="message"
                                                  rows="5"></textarea>
                                    </div>
                                    <button type="submit"
                                            class="contact-btn text-white mt-4 d-block mx-auto">{{ __('messages.contact_us.send_message') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="d-sm-flex justify-content-center mt-5 pb-5">
                <button type="submit" class="vcard-nine-btn mt-4 d-block btn text-white "
                        onclick="downloadVcard('{{ $vcard->name }}.vcf',{{ $vcard->id }})"><i
                            class="fas fa-download me-2"></i>{{ __('messages.vcard.download_vcard') }}</button>
                {{--share btn--}}
                <button type="button" class="vcard9-share share-btn d-block btn mt-4 ms-sm-3">
                    <a class="text-decoration-none text-white">
                        <i class="fas fa-share-alt me-2"></i>{{ __('messages.vcard.share') }}</a>
                </button>
            </div>
        </div>
        @if($vcard->location_url && isset($url[5]))
            <div class="m-2 ">
                <iframe width="100%" height="300px" src='https://maps.google.de/maps?q={{$url[5]}}/&output=embed'
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        style="border-radius: 10px;"></iframe>
            </div>
        @endif
        <div class="d-flex justify-content-evenly">
            @if(checkFeature('advanced'))
                @if(checkFeature('advanced')->hide_branding && $vcard->branding == 0)
                @if($vcard->made_by)
                    <a @if(!is_null($vcard->made_by_url)) href="{{$vcard->made_by_url}}" @endif class="text-center text-decoration-none text-dark"  target="_blank"> <small>{{ __('messages.made_by') }} {{ $vcard->made_by }}</small></a>
                @endif
                @else
                    <div class="text-center">
                        <small>{{ __('messages.made_by') }} {{ $setting['app_name'] }}</small>
                    </div>
                @endif
            @endif
            @if(!empty($vcard->privacy_policy) || !empty($vcard->term_condition))
                <div>
                    <a class="text-decoration-none text-dark cursor-pointer terms-policies-btn" href="{{ route('vcard.show-privacy-policy',[$vcard->url_alias,$vcard->id]) }}"><small>{{__('messages.vcard.term_policy')}}</small></a>
                </div>
            @endif
        </div>
    </div>

    {{-- share modal code--}}
    <div id="vcard9-shareModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.vcard.share_my_vcard') }}</h5>
                    <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-danger"
                            data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                               fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1"/>
								<rect fill="#000000" opacity="0.5"
                                      transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                      x="0" y="7" width="16" height="2" rx="1"/>
							</g>
						</svg>
					</span>
                    </button>
                </div>
                @php
                    $shareUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
                @endphp
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 justify-content-between social-link-modal">
                            <a href="http://www.facebook.com/sharer.php?u={{$shareUrl}}"
                               target="_blank" class="mx-2 share9" title="Facebook">
                                <i class="fab fa-facebook fa-3x" style="color: #1B95E0"></i>
                            </a>
                            <a href="http://twitter.com/share?url={{$shareUrl}}&text={{$vcard->name}}&hashtags=sharebuttons"
                               target="_blank" class="mx-2 share9" title="Twitter">
                                <i class="fab fa-twitter fa-3x" style="color: #1DA1F3"></i>
                            </a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{$shareUrl}}"
                               target="_blank" class="mx-2 share9" title="Linkedin">
                                <i class="fab fa-linkedin fa-3x" style="color: #1B95E0"></i>
                            </a>
                            <a href="mailto:?Subject=&Body={{$shareUrl}}" target="_blank"
                               class="mx-2 share9" title="Email">
                                <i class="fas fa-envelope fa-3x" style="color: #191a19  "></i>
                            </a>
                            <a href="http://pinterest.com/pin/create/link/?url={{$shareUrl}}"
                               target="_blank" class="mx-2 share9">
                                <i class="fab fa-pinterest fa-3x" style="color: #bd081c" title="Pinterest"></i>
                            </a>
                            <a href="http://reddit.com/submit?url={{$shareUrl}}&title={{$vcard->name}}"
                               target="_blank" class="mx-2 share9" title="Reddit">
                                <i class="fab fa-reddit fa-3x" style="color: #ff4500"></i>
                            </a>
                            <a href="https://wa.me/?text={{$shareUrl}}" target="_blank" class="mx-2 share9" title="Whatsapp">
                                <i class="fab fa-whatsapp fa-3x" style="color: limegreen"></i>
                            </a>
                        </div>
                    </div>
                    <div class="text-center">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('vcardTemplates.template.templates')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>
<script>
@if(checkFeature('seo') && $vcard->google_analytics)
    {!! $vcard->google_analytics !!}
@endif
@if(isset(checkFeature('advanced')->custom_js) && $vcard->custom_js)
    {!! $vcard->custom_js !!}
@endif
</script>
@php
    $setting = \App\Models\UserSetting::where('user_id', $vcard->tenant->user->id)->where('key', 'stripe_key')->first();
@endphp
<script>
    let stripe = ''
    @if (!empty($setting) && !empty($setting->value))
        stripe = Stripe('{{ $setting->value }}');
    @endif
    $('.testimonial-slider').slick({
        dots: true,
        infinite: true,
        arrows: true,
        autoplay: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button class="slide-arrow prev-arrow"></button>',
        nextArrow: '<button class="slide-arrow next-arrow"></button>',
    })
</script>
<script>
    $('.product-slider').slick({
        dots: true,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 2,
        autoplay: true,
        slidesToScroll: 1,
        prevArrow: '<button class="slide-arrow prev-arrow"></button>',
        nextArrow: '<button class="slide-arrow next-arrow"></button>',
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }
        ]
    });
</script>
<script>
    $('.gallery-slider').slick({
        dots: true,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 2,
        autoplay: true,
        slidesToScroll: 1,
        prevArrow: '<button class="slide-arrow prev-arrow"></button>',
        nextArrow: '<button class="slide-arrow next-arrow"></button>',
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                },
            }
        ]
    });

    $('.blog-slider').slick({
        dots: true,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 1,
        autoplay: true,
        slidesToScroll: 1,
        prevArrow: '<button class="slide-arrow-blog prev-arrow"></button>',
        nextArrow: '<button class="slide-arrow-blog next-arrow"></button>',
    })
</script>
<script>
    let isEdit = false
    let password = "{{isset(checkFeature('advanced')->password) && !empty($vcard->password) }}"
    let passwordUrl = "{{ route('vcard.password', $vcard->id) }}";
    let enquiryUrl = "{{ route('enquiry.store',  ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
    let appointmentUrl = "{{ route('appointment.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
    let slotUrl = "{{route('appointment-session-time',$vcard->url_alias)}}";
    let appUrl = "{{ config('app.url') }}";
    let vcardId = {{$vcard->id}};
    let vcardAlias = "{{$vcard->url_alias}}";
    let paypalUrl = "{{ route('paypal.init') }}"
    let languageChange = "{{ url('language') }}";
    let lang = "{{checkLanguageSession($vcard->url_alias)}}";
</script>
<script>
    const svg = document.getElementsByTagName('svg')[0];
    const { x, y, width, height } = svg.viewBox.baseVal;
    const blob = new Blob([svg.outerHTML], { type: 'image/svg+xml' });
    const url = URL.createObjectURL(blob);
    const image = document.createElement('img');
    image.src = url;
    image.addEventListener('load', () => {
        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const context = canvas.getContext('2d');
        context.drawImage(image, x, y, width, height);
        const link = document.getElementById('qr-code-btn');
        link.href = canvas.toDataURL();
        URL.revokeObjectURL(url);
    });
</script>
@routes
<script src="{{ asset('assets/js/messages.js') }}"></script>
<script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ mix('assets/js/vcards/vcard-view.js') }}"></script>

</body>
</html>
