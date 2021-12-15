<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h5>TOKO BUNGA & HADIAH ONLINE INDONESIA</h5>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <?php 
                        $categories = App\Models\Category::selectRaw('*')
                           ->orderBy('seq')
                           ->get();

                            ?>
                            @foreach ($categories as $category)
                                    <li data-filter=".{{$category->parse}}">{{$category->cat_name}}</li>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <?php
            $products = App\Models\Product::selectRaw('*')
                
                ->whereNull('deleted_at')
                ->get(); 

        ?>
        <div class="row featured__filter">
            @foreach ($products as $product)
                
            <?php
                $prodcats = App\Models\ProductCategory::selectRaw('category.parse')
                    ->leftJoin('category','product_category.cat_id','=','category.id')
                    ->where('product_category.prod_id',$product->id)
                    ->get();
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix @foreach($prodcats as $prodcat) {{$prodcat->parse}} @endforeach">
                <div class="featured__item">
                    
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('assets/image/product/'.$product->prod_pic)}}">
                        @if($product->discount>0)<span class="float-right badge badge-danger">- {{$product->discount}} %</span>@endif
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#" onClick="addCart('{{$product->token}}');return false;"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        


                    </div>
                    <div class="featured__item__text">
                       
                        <h6><a href="#">{{$product->prod_name}}</a></h6>
                        <h5 @if($product->discount>0) style="color:#f00" @endif>IDR {{App\Helpers\GFunc::numFormat($product->eprice,2)}}</h5>
                        @if($product->discount>0) <h6 style="font-size:12px;text-decoration: line-through;">IDR {{App\Helpers\GFunc::numFormat($product->price,2)}}</h6>@endif
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</section>
<!-- Featured Section End -->


<!-- Banner Begin -->
<!--<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="assets/image/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="assets/image/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- Banner End -->