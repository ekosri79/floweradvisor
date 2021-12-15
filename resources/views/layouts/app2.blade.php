<!DOCTYPE html>
<html lang="en">
@section('htmlheader')
	@include('layouts.partials.htmlheader')
@show    


<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
    

    @section('mainheader')
	    @include('layouts.partials.mainheader')
    @show    

    @section('herosection')
	    @include('layouts.partials.hero')
    @show    


    @yield('main-content')

    @include('layouts.partials.footer')
    



    @section('scripts')
	    @include('layouts.partials.scripts')
	@show

</body>
</html>
