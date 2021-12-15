<!-- Header Section Begin -->
<header class="header">
    <div class="header__top ">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-md-5">
                    <div class="header__top__left m-0 p-1">
                        <ul>
                            <li><i class="fa fa-envelope"></i>Gratis Kirim Di Hari Yang Sama</li>
                            <li>Pengiriman Ke Lebih Dari 100 Negara</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-7">
                    <div class="header__top__right m-0 p-1">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="{{asset('assets/image/language.png')}}" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Indonesia</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <div  class="header__top__right__auth">
                            @auth
                                <span><a href="#"><i class="fa fa-user"></i> {{Auth::user()->name}}</a></span>
                            
                            @endauth

                            @guest
                                <a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a>
                            @endguest
                        </div>
                        @auth
                        <div class="float-right">
                             <span> | <a href="{{route('logout')}}" style="color:#f90" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i style="color:#fff" class="fas fa-sign-out"></i>Logout</a></span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                  </form>
                      
                        </div>   
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="header__logo py-0">
                    <a href="{{route('home')}}"><img src="{{asset('assets/image/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-sm-7">
                <nav class="header__menu">
                    <ul>
                        <?php 
                             $categories = App\Models\Category::selectRaw('*')
                                ->orderBy('seq')
                                ->get();

                        ?>
                        @foreach ($categories as $category)
                            <li><a href="#">{{$category->cat_name}}</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="#">Sub Category1</a></li>
                                    <li><a href="#">Sub Category2</a></li>
                                </ul>
                            </li>
                        @endforeach
                        
                       
                    </ul>
                </nav>
            </div>
            <div class="col-sm-3">
                <div class="header__cart">
                    @auth

                    <?php 
                        //GET COUNT OF CART & WISHLIST
                        $countcart = App\Models\CartItem::selectRaw('sum(qty) as sqty')
                            ->where('user_id',Auth::user()->id)
                            ->first();
                    ?>
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> </a></li>
                        <li><a href="{{route('cart.index')}}"><i class="fa fa-shopping-bag"></i> <span>{{$countcart->sqty}}</span></a></li>
                    </ul>
                    <div class="header__cart__price"><span>&nbsp;</span></div>
                    @endauth
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
    
</header>
<!-- Header Section End -->