@extends('layouts.app')
@section('content')

<?php
    use App\Country;
    $countries = Country::all();
?>
<!-- <div class="modal-dialog width-400px" role="document"> -->
<div class="register-form">
    @if (count($errors) > 0)
     <div class = "alert alert-danger">
        <ul>
           @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
           @endforeach
        </ul>
     </div>
    @endif
    <div >
        <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            <div class="section-title">
                <h2>Register</h2>
            </div>
        </div>
        <div class="modal-body">
<<<<<<< HEAD
            <?php echo Form::open(array('url' => '/register', 'action' => 'UserController@store',
=======
            <?php echo Form::open(array('url' => '/create-user', 'action' => 'UserController@store',
>>>>>>> master
            'class' => 'form inputs-underline')); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('firstname', 'First Name'); ?>
                            <?php echo Form::text('firstname', null, array('class' => 'form-control','placeholder' => 'First Name')); ?>
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-6-->
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('lastname', 'Last Name'); ?>
                            <?php echo Form::text('lastname', null, array('class' => 'form-control','placeholder' => 'Last Name')); ?>
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-6-->
                </div>
                <!--enr row-->
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <?php echo Form::label('birthdate', 'Birth Date'); ?>
                        <?php echo Form::date('birthdate', \Carbon\Carbon::now()); ?>
                    </div>
                    <!--end col-md-6-->
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('gender', 'Gender'); ?>
                            <div class="form-radio">
                                <label class="radio-inline"><?php echo Form::radio('gender', 'male'); ?>Male</label>
                                <label class="radio-inline"><?php echo Form::radio('gender', 'female'); ?>Female</label>
                            </div>
                        </div>
                        <!--end form-group-->
                    </div>
                    <!--end col-md-6-->
                </div>
                <!--enr row-->
                <div class="form-group">
                    <?php echo Form::label('country', 'Country'); ?>
                    <!-- <input type="text" class="form-control" name="country" id="country" placeholder="Country"> -->
                    <select id="country" name="country" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->abbr }}">{{ $country->value }}</option>
                    @endforeach
                    </select>
                </div>
                <!--end form-group-->
                <div class="form-group">
                    <?php echo Form::label('email', 'Email'); ?>
                    <?php echo Form::text('email', null, array('class' => 'form-control','placeholder' => 'Email')); ?>
                </div>
                <!--end form-group-->
                <div class="form-group">
                    <?php echo Form::label('username', 'Username'); ?>
                    <?php echo Form::text('username', null, array('class' => 'form-control','placeholder' => 'Username')); ?>
                </div>
                <!--end form-group-->
                <div class="form-group">
                    <?php echo Form::label('password', 'Password'); ?>
                    <?php echo Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password')); ?>
                </div>
                <!--end form-group-->
                <!-- <div class="form-group"> -->
                    <?php //echo Form::label('confirm_password', 'Confirm Password'); ?>
                    <?php //echo Form::password('confirm_password',array('class' => 'form-control', 'placeholder' => 'Confirm Password')); ?>
                <!-- </div> -->
                <!--end form-group-->
                <div class="form-group center">
                    <?php echo Form::submit('Register Now',array('class' => 'btn btn-primary width-100')); ?>
                </div>
                <!--end form-group-->
            <?php echo Form::close() ?>

            <hr>

            <p class="center note">By clicking on “Register Now” button you are accepting the <a href="terms-and-conditions.html" class="underline">Terms & Conditions</a></p>
            <!--end form-->
        </div>
        <!--end modal-body-->
    </div>
    <!--end modal-content-->
</div>
<!--end modal-dialog-->
@endsection