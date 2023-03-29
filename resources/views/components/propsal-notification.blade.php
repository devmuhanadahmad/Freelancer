<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">{{$count}}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{$count}}</span>
            <a href="cart.html">View Notification</a>
        </div>
        <ul class="shopping-list">
           @foreach ($notification as $notification)
           <li>
            <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                    class="lni lni-close"></i></a>
            <div class="cart-img-head">
                <a class="cart-img" href=" {{$notification->data['route']}}"><img
                        src=" {{$notification->data['icon']}}" alt="#"></a>
            </div>

            <div class="content">
                <h4><a href=" {{$notification->data['route']}}">
                        {{$notification->data['title']}}</a></h4>
                <p class="quantity"> {{$notification->data['body']}}</p>
            </div>
        </li>
           @endforeach

        </ul>

    </div>
    <!--/ End Shopping Item -->
</div>
