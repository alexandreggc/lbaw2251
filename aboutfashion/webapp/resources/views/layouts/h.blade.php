<li class="nav-item dropdown " id="notificationsTog">
    <a class="nav-link mx-2 " href="#" id="navbarDropdownMenuLink3" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <ion-icon name="cart-outline" style="font-size:28px;"></ion-icon>
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink3"
        id="dropdownN" style="width:27rem;">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 mb-2 text-end  checkout">
                <button type="button" id="dismissDN" class="btn-close me-2"
                    data-bs-dismiss="dropdownSC" aria-label="Close"
                    style="color:#000;background-color:#000;-webkit-tap-highlight-color:#000;"></button>

            </div>
        </div>
        <table id="notifation" class="table table-condensed mb-4 table-responsive">
            <tbody id="shop-pop">

                @if (is_null($usernotifications))
                    <tr>
                        <td>
                            <div
                                class="col-lg-12 col-sm-12 col-12 mb-2 text-center checkout">
                                <p class="font-weight-light" style="font-size:0.8rem;">
                                    You don't have notifications!</p>
                            </div>
                        </td>

                    </tr>
                @else
                    @php
                        $notification = $notifications[count($notifications) - 1];
                    @endphp
                    <tr>
                        <td class=" align-middle justify-content-center"style="width:8rem;"
                            data-th="Notification">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <img src="{{ $detail->product->images[0]['file'] }}"
                                        alt=""
                                        class="img-fluid d-none d-md-block rounded mt-3 shadow ">
                                </div>
                                <div
                                    class="col-md-6  align-middle text-left mt-sm-2 mx-auto">
                                    <h6 style="font-size:0.8em;">
                                        {{ $notification['title'] }}</h6>
                                    <p class="font-weight-light"
                                        style="font-size:0.5rem;">{{ $notification['description'] } </p>
                                </div>
                            </div>
                        </td>
                        <td class=" align-middle justify-content-center"
                            style="width:2rem;" data-th="Date">
                            <div class=" mt-sm-2">{{ $notification['date'] }</div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="row">
        <div class="col-lg-12 col-sm-12 col-12 mb-2 text-center checkout">
            <a href="{{ route('notifications') }}">
                <button class="btn btn-primary btn-block"
                    style="background-color:rgba(0,0,0,.9);border-color:rgba(0,0,0,.9);">View
                    notifications</button>
            </a>
        </div>
        </div>
    </div>
</li>