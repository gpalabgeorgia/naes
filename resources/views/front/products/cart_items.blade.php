<?php
    use App\Models\Product;
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>პროდუქტი</th>
            <th colspan="2">აღწერა</th>
            <th>რაოდენობა</th>
            <th>ფასი ც.</th>
            <th>კატეგორიის/პროდუქტის <br> ფასდაკლება</th>
            <th>ფასი</th>
        </tr>
    </thead>
    <tbody>
        <?php $total_price = 0; ?>
        @foreach($userCartItems as $item)
            <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>
        <tr>
            <td> <img width="60" src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt=""/></td>
            <td colspan="2">
                {{ $item['product']['product_name'] }} ({{ $item['product']['product_code'] }})<br/>
                ფერი: {{ $item['product']['product_color'] }} <br>
                ზომა: {{ $item['size'] }}
            </td>
            <td>
                <div class="input-append">
                    <input class="span1" style="max-width:34px" value="{{ $item['quantity'] }}" id="appendedInputButtons" size="16" type="text">
                    <button class="btn btnItemUpdate qtyMinus" type="button" data-cartid="{{ $item['id'] }}"><i class="icon-minus"></i></button>
                    <button class="btn btnItemUpdate qtyPlus" type="button" data-cartid="{{ $item['id'] }}"><i class="icon-plus"></i></button>
                    <button class="btn btn-danger btnItemDelete" type="button" data-cartid="{{ $item['id'] }}"><i class="icon-remove icon-white"></i></button>
                </div>
            </td>
            <td>{{ $attrPrice['product_price'] }} ₾.</td>
            <td>{{ $attrPrice['discount'] }} ₾.</td>
            <td>{{ $attrPrice['final_price'] * $item['quantity'] }} ₾.</td>
        </tr>
        <?php $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']); ?>
        @endforeach
        <tr>
            <td colspan="6" style="text-align:right">ფასი: </td>
            <td>{{ $total_price }} ₾.</td>
        </tr>
{{--        <tr>--}}
{{--            <td colspan="6" style="text-align:right">კუპონით ფასდაკლება: </td>--}}
{{--            <td class="couponAmount">--}}
{{--                @if(Session::has('CouponAmount'))--}}
{{--                    - {{ Sesion::get('CouponAmount') }} ₾.--}}
{{--                @else--}}
{{--                    0 ₾.--}}
{{--                @endif--}}
{{--            </td>--}}
{{--        </tr>--}}
        <tr>
            <td colspan="6" style="text-align:right"><strong>სულ ({{ $total_price }} ₾. - <strong class="couponAmount">0 ₾.</strong>) =</strong></td>
            <td class="label label-important" style="display:block"> <strong class="grand_total"> {{ $total_price }} ₾.</strong></td>
        </tr>
    </tbody>
</table>
