 <!-- Categories Section Begin -->
 <section class="categories"> 
    <div class="container">  
        <div class="row">
            <div class="col-sm-5 text-center">
                <hr noshade size=1>
            </div>  
            <div class="col-sm-2 text-center">
                <h5> SPECIAL MOMENT</h5>
            </div>   
            <div class="col-sm-5 text-center">
                <hr noshade size=1>
            </div>  
        </div>    
        <div class="row">
            <?php 
                $moments = App\Models\Moment::selectRaw('*')
                    ->orderBy('seq')
                    ->get();
            ?>
            <div class="categories__slider owl-carousel">
                @foreach ($moments as $moment)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('assets/image/moment/'.$moment->pic)}}">
                            <h5><a href="#">{{$moment->moment_name}}</a></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>