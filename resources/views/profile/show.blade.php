<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> --}}

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 d-flex align-items-center justify-content-center">
            <div class=" rounded bg-warning col-lg-8 d-flex flex-column align-items-center">
                <h4 class=" text-center mt-3">EDIT PROFILE</h3>
                    <hr/>
                    @livewire('profile.update-profile-information-form')
                    
                        @livewire('profile.update-password-form')
                    
                    {{-- <form action="" method="POST" class="text-center">
                        <h5>Change Photo Profile : </h5>
                        <br>
                        <div class="d-flex justify-content-center">
                            <div class="form-group ">
                                
                                <label for="exampleFormControlFile1">choose a photo</label>
                                <input type="file" class="ml-5 form-control-file" id="exampleFormControlFile1">
                            </div>
                        </div>

                        <hr class="mt-4">
                        <br>
                        <h5>Change Password:</h5>

                        <div class=" d-flex justify-content-center m-0">
                            <div class=" input-group input-group-sm mt-2 mb-1 col-xs-12 col-md-7 col-sm-9">
                                <div class=" input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"> old password</span>
                                </div>
                                <input type="password" class="form-control" autocomplete="off" aria-label="Small"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class=" d-flex justify-content-center m-0">
                            <div class=" input-group input-group-sm mt-2 mb-1 col-xs-12 col-md-7 col-sm-9">
                                <div class=" input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"> new password</span>
                                </div>
                                <input type="password" class="form-control" autocomplete="off" aria-label="Small"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class=" d-flex justify-content-center m-0">
                            <div class=" input-group input-group-sm mt-2 mb-1 col-xs-12 col-md-7 col-sm-9">
                                <div class=" input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"> repeat new password</span>
                                </div>
                                <input type="password" class="form-control" autocomplete="off" aria-label="Small"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>




                        <hr>
                        <div class="d-flex justify-content-center">

                            <a href="" class="btn btn-primary m-2">Kembali</a>
                            <button type="submit" class="btn btn-success m-2">Update!</button>
                        </div>



                    </form> --}}
            </div>
            {{-- @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif --}}

            {{-- <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div> --}}

            {{-- <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div> --}}
        </div>
    </div>
    @livewire('component.online-list',['showOnline'=>true])
</x-app-layout>
