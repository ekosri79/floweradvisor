@extends('layouts.app2')


@section('main-content')

    @include('layouts.partials.categories')
    @include('layouts.partials.featured')
    @include('layouts.partials.latest')

@endsection

@push('scripts')
<script>
     $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            },

           
        }
    });

</script>
@endpush