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

    <title>{{ $vcard->name }} | {{ getAppName() }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    {{--css link--}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard4.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">



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
    <div class="main-content vcard w-100 mx-auto content-blur collapse show allSection">

        <div class="vcard__banner w-100 position-relative">
            <img src="{{ $vcard->cover_url }}" class="img-fluid banner-image" alt="banner"/>
            <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3">
                @if($vcard->language_enable == \App\Models\Vcard::LANGUAGE_ENABLE)
                    <div class="language pt-4 me-2">
                        <ul class="text-decoration-none">
                            <li class="dropdown1 dropdown lang-list">
                                <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-language me-2"></i>{{ getLanguage($vcard->default_language)}}
                                </a>
                                <ul class="dropdown-menu  start-0 lang-hover-list top-dropdown top-100">
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
        {{--profile details--}}
        <div class="vcard__profile d-flex align-items-center px-4 flex-sm-row flex-column">
            <div class="vcard__avatar">
                <img src="{{ $vcard->profile_url }}" class="rounded-circle"/>
            </div>
            <div class="vcard__position d-flex flex-column mx-sm-4 mt-sm-5 mt-2">
                <div class="d-flex flex-column vcard_details">
                    <h4 class="avatar-name text-sm-start text-center">{{ ucwords($vcard->first_name.' '.$vcard->last_name) }}</h4>
                    <span class="avatar-designation text-sm-start text-center">{{ ucwords($vcard->occupation) }}</span>
                </div>
                @if(checkFeature('social_links') && getSocialLink($vcard))
                    <div class="social-icons d-flex flex-wrap justify-content-center pt-4 vcard__social">
                        @foreach(getSocialLink($vcard) as $value)
                            <span class="icons rounded-circle d-flex justify-content-center align-items-center">
                            {!! $value !!}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex align-items-center">
            <span class="pt-2 px-2 profile-description"> {{$vcard->description}}</span>
        </div>
        {{--details--}}
        <div class="px-4 my-3">
            <div class="vcard__event">
                <div class="row py-4 g-3">
                    @if($vcard->email)
                        <div class="col-sm-6 col-12">
                            <div class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                            <span class="event-icon">
                                <img src="{{ asset('assets/img/vcard4/email.png') }}" class="img-fluid">
                            </span>
                                <a href="mailto:{{ $vcard->email }}"
                                   class="event-name text-center mb-0 pt-2 text-decoration-none">{{ $vcard->email }}</a>
                            </div>
                        </div>
                    @endif
                        @if($vcard->alternative_email)
                            <div class="col-sm-6 col-12">
                                <div class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                            <span class="event-icon">
                                <img src="{{ asset('assets/img/vcard4/alter-image.png') }}" class="img-fluid" height="22" width="30" alt>
                            </span>
                                    <a href="mailto:{{ $vcard->alternative_email }}"
                                       class="event-name text-center mb-0 pt-2 text-decoration-none">{{ $vcard->alternative_email }}</a>
                                </div>
                            </div>
                        @endif
                    @if($vcard->dob)
                        <div class="col-sm-6 col-12">
                            <div class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                            <span class="event-icon">
                                <img src="{{ asset('assets/img/vcard4/birthday.png') }}" class="img-fluid">
                            </span>
                                <span class="event-name pt-2">{{ $vcard->dob }}</span>
                            </div>
                        </div>
                    @endif
                    @if($vcard->phone)
                        <div class="col-sm-6 col-12">
                            <div class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                            <span class="event-icon">
                                <img src="{{ asset('assets/img/vcard4/mobile.png') }}" class="img-fluid">
                            </span>
                                <a href="tel:+{{ $vcard->region_code }}{{ $vcard->phone }}"
                                   class="event-name text-center mb-0 pt-2 text-decoration-none">+{{ $vcard->region_code }} {{ $vcard->phone }}</a>
                            </div>
                        </div>
                    @endif
                        @if($vcard->alternative_phone)
                            <div class="col-sm-6 col-12">
                                <div class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                            <span class="event-icon">
                                <img src="{{ asset('assets/img/vcard4/alter-phone.png') }}" class="img-fluid">
                            </span>
                                    <a href="tel:{{ $vcard->alternative_phone }}"
                                       class="event-name text-center mb-0 pt-2 text-decoration-none">+{{ $vcard->region_code }} {{ $vcard->alternative_phone }}</a>
                                </div>
                            </div>
                        @endif
                    @if($vcard->location)
                        <div class="col-sm-6 col-12">
                            <div class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                            <span class="event-icon">
                                <img src="{{ asset('assets/img/vcard4/location.png') }}" class="img-fluid">
                            </span>
                                <span class="event-name pt-2">{{$vcard->location}}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{--our services--}}
       @if(checkFeature('services') && $vcard->services->count())
            <div class="my-4 px-4 pb-2 position-relative overflow-hidden">
                <div class="line-shape position-absolute">
                    <span class="inner-circle position-absolute rounded-circle"></span>
                </div>
                <div class="vcard__service">
                    <h4 class="vcard__heading text-center pb-3">{{ __('messages.vcard.our_service') }}</h4>
                    <div class="container mt-4">
                        <div class="row g-4 justify-content-center">
                            @foreach($vcard->services as $service)
                                <div class="col-sm-6 service-container">
                                    <div class="card service-card h-100 border-0">
                                        <div
                                                class="service-image rounded-circle d-flex justify-content-center align-items-center mx-auto">
                                            <img src="{{ $service->service_icon }}" class="rounded-circle"/>
                                        </div>
                                        <div class="service-details d-flex flex-column">
                                            <h4 class="mt-3 text-center">{{ ucwords($service->name) }}</h4>
                                            <p class="mb-0 text-center">
                                                {!! $service->description !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{--gallery--}}
        @if(checkFeature('gallery') && $vcard->gallery->count())
        <div class="pt-4 px-4">
            <div class="vcard__gallery">
                <h4 class="vcard__heading text-center pb-2">{{ __('messages.plan.gallery') }}</h4>
                <div class="container mt-4 py-3">
                    <div class="row g-4 justify-content-center gallery-slider">
                        @foreach($vcard->gallery as $file)
                            @php
                                $infoPath = pathinfo(public_path($file->gallery_image));
                              $extension = $infoPath['extension'];
                            @endphp
                        <div class="col-6">
                            <div class="card gallery-card h-100 border-0 w-100">
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
        {{--Product--}}
        @if(checkFeature('products') && $vcard->products->count())
            <div class="pt-4 px-4 position-relative">
                <div class="vcard__product">
                    <h4 class="vcard__heading text-center pb-2">{{ __('messages.plan.products') }}</h4>
                    <div class="container mt-4 py-3">
                        <div class="row g-4 justify-content-center product-slider">
                            @foreach($vcard->products as $product)
                                <div class="col-6">
                                    <a @if($product->product_url) href="{{ $product->product_url }}" @endif
                                    target="_blank" class="text-decoration-none fs-6">
                                        <div class="card product-card h-100 border-0 w-100">
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
            </div>
        @endif
        {{--Testimonial--}}
        @if(checkFeature('testimonials') && $vcard->testimonials->count())
            <div class="pt-4 px-4">
                <div class="vcard__testimonial">
                    <h4 class="vcard__heading text-center pb-2">{{ __('messages.plan.testimonials') }}</h4>
                    <div class="container mt-4 py-3">
                        <div class="row g-4 justify-content-center testimonial-slider">
                            @foreach($vcard->testimonials as $testimonial)
                                <div class="col-6">
                                    <div class="card testimonial-card h-100 border-0 w-100">
                                        <img src="{{ $testimonial->image_url }}"
                                             class="testimonial-image d-block mx-auto"/>
                                        <div class="testimonial-details d-flex flex-column">
                                            <p class="mb-0 text-center pt-3">
                                                {{ $testimonial->description }}
                                            </p>
                                        </div>
                                        <div class="testimonial-user d-flex justify-content-center flex-column align-center mt-3">
                                            <h5 class="user-name text-center position-relative mt-2">{{ ucwords($testimonial->name) }}</h5>
                                            <span class="user-designation text-center"></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- blog--}}
        @if(checkFeature('blog') && $vcard->blogs->count())
            <div class="vcard__blog py-3">
                <h4 class="vcard__heading heading-line position-relative text-center pb-4">{{ __('messages.feature.blog') }}</h4>
                <div class="container">
                    <div class="row g-4 blog-slider overflow-hidden">
                        @foreach($vcard->blogs as $blog)
                            <div class="col-6 mb-2">
                                <div class="card blog-card p-2 border-0 w-100 h-100">
                                    <div class="blog-image w-100">
                                        <a href="{{route('vcard.show-blog',[$vcard->url_alias,$blog->id])}}">
                                            <img src="{{ $blog->blog_icon }}" alt="profile" class="w-100"/>
                                        </a>
                                    </div>
                                    <div class="blog-details">
                                        <a href="{{route('vcard.show-blog',[$vcard->url_alias,$blog->id])}}" class="text-decoration-none">
                                            <h4 class="text-sm-start text-center title-color text-black p-3 mb-0">{{ $blog->title }}</h4></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        {{--QR code--}}
        <div class="vcard__qr-code">
            <div class="px-4 pt-5 pb-4">
                <h4 class="vcard__heading text-center pb-10">{{ __('messages.vcard.qr_code') }}</h4>
                <div class="qr-code d-block mx-auto position-relative px-5 pt-5 pb-3">
                    <img src="{{$vcard->profile_url}}"
                         class="qr-code-profile d-block mx-auto position-absolute top-0 start-50 translate-middle"/>
                    <div class="qr-code-image d-flex justify-content-center pt-7">
                        {!! QrCode::size(130)->format('svg')->generate(Request::url()); !!}
                    </div>
                </div>
                    <a class="qr-code-btn text-white mt-4 d-block mx-auto text-decoration-none" id="qr-code-btn"
                       download="qr_code.png">{{ __('messages.vcard.download_my_qr_code') }}</a>
            </div>
        </div>
        {{--Business hour--}}
        @if($vcard->businessHours->count())

            <div class="vcard__timing pt-5 pb-4">
                <div class="px-4">
                    <h4 class="vcard__heading text-center pb-4">{{ __('messages.vcard.buisness_hours') }}</h4>
                    <div class="row">
                        @foreach($vcard->businessHours as $day)
                            <div class="col-sm-6 col-12 week-time mb-2 text-center">
                                <div class="card business-card flex-row justify-content-center">
                                    <span class="me-2">{{ strtoupper(__('messages.business.'.\App\Models\BusinessHour::DAY_OF_WEEK[$day->day_of_week]))}}:</span>
                                    <span>{{ $day->start_time.' - '.$day->end_time }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{--Appointment--}}
        @if(checkFeature('appointments') && $vcard->appointmentHours->count())
            <div class="vcard__appointment py-3">
                <h4 class="vcard__heading heading-line text-center pb-4 position-relative">{{__('messages.make_appointments')}}</h4>
                <div class="container">
                    <div class="appointment">
                        <div class="row d-flex align-items-center justify-content-center mb-3">
                            <div class="col-md-2">
                                <label for="date" class="appoint-date mb-2">{{__('messages.date')}}</label>
                            </div>
                            <div class="col-md-10">
                                {{ Form::text('date', null, ['class' => 'date appoint-input', 'placeholder' =>__('messages.form.pick_date'),'id'=>'pickUpDate']) }}
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
                        @include('vcardTemplates.appointment')
                    </div>
            </div>
        </div>
        @endif

        {{--contact us--}}
        @php $currentSubs = $vcard->subscriptions()->where('status', \App\Models\Subscription::ACTIVE)->latest()->first() @endphp
        <div class="vcard__contact-us pb-5 pt-4">
            @if($currentSubs && $currentSubs->plan->planFeature->enquiry_form)
                <div class="px-4">
                    <h4 class="vcard__heading text-center pb-4">{{ __('messages.contact_us.contact_us') }}</h4>
                    <form id="enquiryForm">
                        @csrf
                        <div class="contact-form px-sm-5">
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
                                <input type="tel" name="phone" class="form-control" id="phone"
                                       placeholder="{{__('messages.form.enter_phone')}}">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="{{__('messages.form.type_message')}}"
                                          name="message" id="message"
                                          rows="5"></textarea>
                            </div>
                            <button type="submit"
                                    class="contact-btn text-white mt-4 d-block mx-auto">{{ __('messages.contact_us.send_message') }}
                            </button>
                        </div>
                    </form>
                </div>
            @endif
            <div class="d-sm-flex justify-content-center mt-5 pb-5">
                <button type="button" class="vcard-four-btn text-white mt-4 d-block me-2"
                        onclick="downloadVcard('{{ $vcard->name }}.vcf',{{ $vcard->id }})"><i
                            class="fas fa-download me-2"></i>{{ __('messages.vcard.download_vcard') }}</button>
                {{--share btn--}}
                <button type="button" class="vcard4-share share-btn text-white d-block btn mt-4">
                    <a class="text-white text-decoration-none">
                        <i class="text-white fas fa-share-alt me-2"></i>{{ __('messages.vcard.share') }}</a>
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
    <div id="vcard4-shareModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.vcard.share_my_vcard') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                @php
                    $shareUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
                @endphp
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 justify-content-between social-link-modal">
                            <a href="http://www.facebook.com/sharer.php?u={{$shareUrl}}"
                               target="_blank" class="mx-2 share4" title="Facebook">
                                <i class="fab fa-facebook fa-3x" style="color: #1B95E0"></i>
                            </a>
                            <a href="http://twitter.com/share?url={{$shareUrl}}&text={{$vcard->name}}&hashtags=sharebuttons"
                               target="_blank" class="mx-2 share4" title="Twitter">
                                <i class="fab fa-twitter fa-3x" style="color: #1DA1F3"></i>
                            </a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{$shareUrl}}"
                               target="_blank" class="mx-2 share4" title="Linkedin">
                                <i class="fab fa-linkedin fa-3x" style="color: #1B95E0"></i>
                            </a>
                            <a href="mailto:?Subject=&Body={{$shareUrl}}" target="_blank"
                               target="_blank" class="mx-2 share4" title="Email">
                                <i class="fas fa-envelope fa-3x" style="color: #191a19  "></i>
                            </a>
                            <a href="http://pinterest.com/pin/create/link/?url={{$shareUrl}}"
                               class="mx-2 share4">
                                <i class="fab fa-pinterest fa-3x" style="color: #bd081c" title="Pinterest"></i>
                            </a>
                            <a href="http://reddit.com/submit?url={{$shareUrl}}&title={{$vcard->name}}"
                               target="_blank" class="mx-2 share4" title="Reddit">
                                <i class="fab fa-reddit fa-3x" style="color: #ff4500"></i>
                            </a>
                            <a href="https://wa.me/?text={{$shareUrl}}" target="_blank" class="mx-2 share4" title="Whatsapp">
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
        speed: 300,
        arrows: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
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
    let enquiryUrl = "{{ route('enquiry.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
    let appointmentUrl = "{{ route('appointment.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
    let paypalUrl = "{{ route('paypal.init') }}"
    let slotUrl = "{{route('appointment-session-time',$vcard->url_alias)}}";
    let appUrl = "{{ config('app.url') }}";
    let vcardId = {{$vcard->id}};
    let vcardAlias = "{{$vcard->url_alias}}"
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
