const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js').
//     postCss('resources/css/app.css', 'public/css', [
//         require('postcss-import'),
//         // require('tailwindcss'),
//         require('autoprefixer'),
//     ]);


mix.copyDirectory([
    'resources/assets/img',
    'node_modules/intl-tel-input/build/img',
], 'public/assets/img');
mix.copyDirectory('resources/theme/images', 'public/images');
mix.copyDirectory('public/web/plugins/global/fonts', 'public/assets/css/fonts')
mix.copyDirectory('resources/theme/webfonts', 'public/assets/webfonts')
mix.copyDirectory('resources/theme/fonts', 'public/assets/fonts')

mix.sass('resources/assets/scss/vcard1.scss', 'public/assets/css/vcard1.css').
    sass('resources/assets/scss/vcard2.scss', 'public/assets/css/vcard2.css').
    sass('resources/assets/scss/vcard3.scss', 'public/assets/css/vcard3.css').
    sass('resources/assets/scss/vcard4.scss', 'public/assets/css/vcard4.css').
    sass('resources/assets/scss/vcard5.scss', 'public/assets/css/vcard5.css').
    sass('resources/assets/scss/vcard6.scss', 'public/assets/css/vcard6.css').
    sass('resources/assets/scss/vcard7.scss', 'public/assets/css/vcard7.css').
    sass('resources/assets/scss/vcard8.scss', 'public/assets/css/vcard8.css').
    sass('resources/assets/scss/vcard9.scss', 'public/assets/css/vcard9.css').
    sass('resources/assets/scss/vcard10.scss', 'public/assets/css/vcard10.css').
    sass('resources/assets/scss/blog.scss', 'public/assets/css/blog.css').
    sass('resources/assets/scss/front/front-custom.scss', 'public/assets/css/front/front-custom.css').
    version()


mix.js('resources/assets/js/vcards/vcard-view.js',
    'public/assets/js/vcards/vcard-view.js').
    js('resources/assets/js/auth/auth.js','public/assets/js/auth/auth.js').version();


// // third-party js
mix.scripts([
    'resources/theme/js/vendor.js',
    'resources/theme/js/plugins.js',
    'node_modules/chart.js/dist/chart.js',
    'node_modules/intl-tel-input/build/js/intlTelInput.js',
    'node_modules/intl-tel-input/build/js/utils.js',
    'node_modules/quill/dist/quill.js',
], 'public/assets/js/third-party.js').version();

// mix.scripts('node_modules/intl-tel-input/build/js/utils.js', 'public/assets/js/inttel/js/utils.min.js')

// pages js
mix.js([
    'resources/assets/js/custom/turbo.js',
    'resources/assets/js/custom/helpers.js',
    'resources/assets/js/custom/custom.js',
    'resources/assets/js/roles/create-edit.js',
    'resources/assets/js/email_sub/email-sub.js',
    'resources/assets/js/settings/settings.js',
    'resources/assets/js/dashboard/dashboard.js',
    'resources/assets/js/users/users.js',
    'resources/assets/js/users/create-edit.js',
    'resources/assets/js/vcards/vcards.js',
    'resources/assets/js/vcards/template.js',
    'resources/assets/js/vcards/create-edit.js',
    'resources/assets/js/vcards/services/services.js',
    'resources/assets/js/vcards/blogs/blogs.js',
    'resources/assets/js/vcards/gallery/gallery.js',
    'resources/assets/js/vcards/products/products.js',
    'resources/assets/js/vcards/analytics/analytics.js',
    'resources/assets/js/vcards/testimonials/testimonials.js',
    'resources/assets/js/subscription/subscription.js',
    'resources/assets/js/subscription/upgrade.js',
    'resources/assets/js/sadmin/plans/plans.js',
    'resources/assets/js/sadmin/plans/create-edit.js',
    'resources/assets/js/enquiry/enquiry.js',
    'resources/assets/js/appointment/appointment.js',
    'resources/assets/js/home/contact.js',
    'resources/assets/js/sadmin/countries/countries.js',
    'resources/assets/js/sadmin/testimonial/frontTestimonial.js',
    'resources/assets/js/sadmin/states/states.js',
    'resources/assets/js/sadmin/cities/cities.js',
    'resources/assets/js/custom/phone-number-country-code.js',
    'resources/assets/js/users/user-profile.js',
    'resources/assets/js/languages/languages.js',
    'resources/assets/js/languages/language_translate.js',
    'resources/assets/js/sidebar_menu_search/sidebar_menu_search.js',
], 'public/assets/js/pages.js').version();

// third-party css
mix.styles([
    'resources/theme/css/third-party.css',
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
    'node_modules/quill/dist/quill.snow.css',
    'node_modules/quill/dist/quill.bubble.css',
], 'public/assets/css/third-party.css')

// light theme css
mix.styles('resources/theme/css/style.css','public/assets/css/style.css');
mix.styles('resources/theme/css/plugins.css', 'public/css/plugins.css');

// dark theme css
mix.styles('resources/theme/css/style.dark.css','public/assets/css/style.dark.css');
mix.styles('resources/theme/css/plugins.dark.css', 'public/css/plugins.dark.css');

// page css
mix.sass('resources/assets/css/main.scss', 'public/assets/css/page.css').version()

// page dark-css
// mix.sass('resources/assets/css/main-dark-mode.scss','public/assets/css/page-dark.css').version()
mix.sass('resources/assets/scss/custom-vcard.scss','public/assets/css/custom-vcard.css').version()

// third-party dark css
// mix.styles([
//     'node_modules/intl-tel-input/build/css/intlTelInput.css',
//     'public/backend/css/vendor.css',
//     'public/backend/css/fonts.css',
//     'public/backend/css/3rd-party.css',
//     'public/backend/css/3rd-party-custom.css',
//     'public/backend/css/style.dark.bundle.css',
// ], 'public/assets/css/third-party-dark.css')


// front-third-party js
mix.scripts([
    'resources/theme/js/vendor.js',
    'resources/theme/js/plugins.js',
    'public/front/js/slick.min.js'
], 'public/assets/js/front-third-party.js').version();

mix.copy('node_modules/slick-slider/slick/slick-theme.css',
    'public/assets/css/slider/css/slick-theme.min.css')
mix.copy('node_modules/slick-slider/slick/ajax-loader.gif',
    'public/assets/css/slider/css/ajax-loader.gif')
mix.copy('node_modules/slick-slider/slick/slick.css',
    'public/assets/css/slider/css/slick.css')
mix.copy('node_modules/slick-slider/slick/slick.min.js',
    'public/assets/js/slider/js/slick.min.js')

mix.js('resources/assets/js/custom/helpers.js',
    'public/assets/js/custom/helpers.js').
    js('resources/assets/js/home/contact.js',
        'public/assets/js/home/contact.js').
    js('resources/assets/js/custom/custom.js',
        'public/assets/js/custom/custom.js').
    js('resources/assets/js/home_page/home_page.js',
        'public/assets/js/home_page/home_page.js').
    version()

mix.sass('resources/assets/css/front-main.scss',
    'public/assets/css/front-custom.css').version()

mix.styles([
    'public/front/css/slick.css',
    'public/assets/css/custom.css',
    'public/front/css/slick-theme.css',
    'public/front/scss/style.css',
], 'public/assets/css/public.css').version()

mix.js([
    'resources/assets/js/custom/turbo.js',
    'resources/assets/js/custom/helpers.js',
   'resources/assets/js/custom/custom.js',
    'resources/assets/js/home_page/home_page.js',
    'resources/assets/js/auth/auth.js',
    'resources/assets/js/home/contact.js'
],'public/assets/js/front-pages.js').version()
