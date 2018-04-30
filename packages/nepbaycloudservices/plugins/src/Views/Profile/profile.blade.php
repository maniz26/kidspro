<div class="EditprofileSumotAir">
    <div class="container">
        <div class="Edit_profileTitle"><h1><span></span>Edit Profile</h1></div>
        <div class="row">
            
            <div class="col-md-9">
                <div class="DashInformation">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                    @endif

                    <!-- Edit Profile -->
                    <div id="edit-profile" class="tab-content">
                        <form class="EditProfile" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Full Name</label>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="Full Name" name="name" value="{{$user->name}}" type="text">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Email Address</label>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="Email Address" name="email" value="{{$user->email}}" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Phone Number</label>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="Phone Number" name="contact_number" @if( isset($profile)) value="{{$profile->contact_number}}" @endif type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="Area Location" name="address" @if( isset($profile)) value="{{$profile->address}}" @endif type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nationality</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="country_id">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $code=>$country)
                                        <option value="{{$code}}" @if( isset($profile) && $profile->country_id == $code) selected @endif>{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="Cityholder">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">City Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="city_id" placeholder="City" @if( isset($profile)) value="{{$profile->city_id}}" @endif class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Profile Picture</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="  avatar" type="file">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary">Update Information</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>