<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rokon - Single Product eCommerce HTML Template</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('frontend.inc.style')
  
</head>
<body>
    @include('frontend.inc.preloader')
    @include('frontend.inc.header')
    <main class="main__content_wrapper">
        @include('frontend.inc.slider')
        @include('frontend.inc.image-text')
        @include('frontend.inc.service')
        @include('frontend.inc.about')
        @include('frontend.inc.product-details')
        @include('frontend.inc.banner')
        @include('frontend.inc.team-member')
        @include('frontend.inc.project')
        @include('frontend.inc.counterup')
        @include('frontend.inc.blog')
    </main>
    @include('frontend.inc.footer')
    @include('frontend.inc.newsletter')
    @include('frontend.inc.scroll')
    @include('frontend.inc.script')
</body>
</html>
