
 <!-- menu item todo-->
 @foreach ($items as $item)
 <li>
    <a href="{{route($item['route'])}}"><i class="{{$item['icon']}}"></i><span class="right-nav-text">
        {{$item['tltle']}}
            </span> </a>
</li>
 @endforeach
