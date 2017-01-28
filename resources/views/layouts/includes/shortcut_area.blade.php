<div id="shortcut">
    <ul>
        @php
            $user = Auth::user();
            $b_role = (!empty($user->masterfile_id)) ? \App\Masterfile::find($user->masterfile_id)->b_role : '';
        @endphp
        <li>
            <a href="{{ url('mf-profile/'.$user->id) }}" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
        </li>
        @php
            if($b_role == 'Client'){
                $wallet_balance = \Illuminate\Support\Facades\DB::table('wallets_view')->where('masterfile_id', $user->masterfile_id)->first()->wallet_balance;
        @endphp
        <li>
            <a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Bills <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
        </li>
        <li>
            <a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Transactions </span> </span> </a>
        </li>
        <li>
            <a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Items </span> </span> </a>
        </li>
        <li>
            <a href="{{ url('/my-wallet') }}" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-money fa-4x"></i> <span>Wallet <span class="label pull-right bg-color-darken">Ksh. {{ number_format(round($wallet_balance,2),2) }}</span></span> </span> </a>
        </li>
        <li>
            <a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Statement <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
        </li>
        {{--<li>--}}
            {{--<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>--}}
        {{--</li>--}}
        @php } @endphp
    </ul>
</div>