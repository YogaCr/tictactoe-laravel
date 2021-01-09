<div>
    @livewire('component.online-list',['showOnline'=>true])
    <div class="container d-flex justify-content-center pb-5" style="color:black">
        <div class=" bg-warning col-lg-7 col-md-10 rounded">
            <div>
                <div class="card-body">
                    <div class="m-2">
                        <div class="container d-flex justify-content-center">
                            <img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" width="60%" alt="">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <h3 class="mt-3 font-weight-bold" style="font-size:1.5rem">{{Auth::user()->name}}</h3>
                        </div>
                        <div class="container d-flex justify-content-center ">
                            <a href="{{ route('profile.show')}}" class="mt-3 m-1 btn btn-info">Edit Profil</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="m-2">
                        <h5 class="text-center text-uppercase">Statistik permainan</h5>
                        <hr>
                        <div>
                            <?php $jumlah_main = Auth::user()->win+Auth::user()->draw+Auth::user()->lose ;?>
                            <div class="container d-flex justify-content-center">
                                <table class="table table-sm table-borderless col-lg-7 col-md-8 col-sm-9" style="color:black;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Jumlah Main</th>
                                            <td> : {{$jumlah_main}}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="">
                                            <th class="" scope="row">Jumlah Menang</th>
                                            <td> : {{Auth::user()->win}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Jumlah Kalah</th>
                                            <td> : {{Auth::user()->lose}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Jumlah Seri</th>
                                            <td> : {{Auth::user()->draw}}</td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Rasio menang:seri:kalah</th>
                                            <?php 
                                            $fpb=1;
                                            $i=1;
                                            while($i<=Auth::user()->win&&$i<=Auth::user()->draw&&$i<=Auth::user()->lose){
                                                if(Auth::user()->win%$i==0&&Auth::user()->draw%$i==0&&Auth::user()->lose%$i==0){
                                                    if($i>$fpb){
                                                        $fpb=$i;
                                                    }
                                                }
                                                $i++;
                                            }
                                            ?>
                                            <td> : {{Auth::user()->win/$fpb}}:{{Auth::user()->draw/$fpb}}:{{Auth::user()->lose/$fpb}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Rata - rata menang</th>
                                            <td> : {{round(Auth::user()->win/($jumlah_main==0?1:$jumlah_main),2)}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Rata - rata kalah</th>
                                            <td> : {{round(Auth::user()->lose/($jumlah_main==0?1:$jumlah_main),2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
