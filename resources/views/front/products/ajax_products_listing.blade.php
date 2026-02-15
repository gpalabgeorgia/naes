<?php 
use App\Models\Product;
?>
<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
        @foreach($categoryProducts as $product)
            <li class="span3">
                <div class="thumbnail">
                    <a href="{{ url('product/'.$product['id']) }}">
                        @if(isset($product['main_image']))
                                <?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
                        @else
                                <?php $product_image_path = ''; ?>
                        @endif
                            <?php $product_image_path = 'images/product_images/small/'.$product['main_image']; ?>
                        @if(!empty($product['main_image']) && file_exists($product_image_path))
                            <img style="width: 160px;" src="{{ asset( $product_image_path) }}" alt="Product Image">
                        @else
                            <img style="width: 160px;" src="{{ asset('images/product_images/small/noimage.png') }}" alt="No Image">
                        @endif
                    </a>
                    <div class="caption">
                        <h5>{{ $product['product_name'] }} {{ $product['id'] }}</h5>
                        <p>
                            {{ $product['brand']['name'] }}
                        </p>
                        <?php $discounted_price = Product::getDiscountedPrice($product['id']); ?>
                        <h4 style="text-align:center">
                            {{-- <a class="btn" href="#"> <i class="icon-zoom-in"></i></a>  --}}
                            <a class="btn" href="{{ url('product/' .$product['id']) }}">დამატება <i class="icon-shopping-cart"></i></a><a class="btn btn-primary" href="#">
                            @if($discounted_price>0)
                                <del>{{ $product['product_price'] }}</del>₾.
                                {{ $discounted_price }} ₾.
                            @else
                                {{ $product['product_price'] }} ₾.
                            @endif
                        </a></h4>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <hr class="soft"/>
</div>
