<div class='container-sponsor'>
    <div id="generic_price_table">
        <!--BLOCK ROW START-->
        <div class="row row-cols-1 row-cols-lg-3">
            @foreach ($sponsors as $sponsor)
                @php
                    $priceArray = explode('.', $sponsor->price);
                    $priceInt = $priceArray[0];
                    $priceDecimal = $priceArray[1];
                @endphp
                <div class="col">

                    <!--PRICE CONTENT START-->
                    <div class="generic_content {{$sponsor->id === 2 ? 'active' : ''}} clearfix">

                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">

                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">

                                <!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>{{ $sponsor->name }}</span>
                                </div>
                                <!--//HEAD END-->

                            </div>
                            <!--//HEAD CONTENT END-->

                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">
                                <span class="price">
                                    <span class="sign">&euro;</span>
                                    <span class="currency">{{ $priceInt }}</span>
                                    <span class="cent">.{{ $priceDecimal }}</span>
                                </span>
                            </div>
                            <!--//PRICE END-->

                        </div>
                        <!--//HEAD PRICE DETAIL END-->

                        <!--FEATURE LIST START-->
                        <div class="generic_feature_list">
                            <ul>
                                <li><span>{{ $sponsor->duration }}</span> ore di sponsorizzazione</li>
                            </ul>
                        </div>
                        <!--//FEATURE LIST END-->

                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                            <input
                                class="d-none"
                                @if ($sponsor->id === 2) checked @endif
                                type='radio'
                                name='radio-sponsor'
                                id='radio-sponsor-{{ $sponsor->id }}'
                                value='{{ $sponsor->price }}'>

                            <label class="radio-label" for='radio-sponsor-{{ $sponsor->id }}'>Seleziona</label>
                        </div>
                        <!--//BUTTON END-->

                    </div>
                    <!--//PRICE CONTENT END-->

                </div>
            @endforeach
        </div>
        <!--//BLOCK ROW END-->
    </div>
</div>
<div id='dropin-container'></div>


