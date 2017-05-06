@extends('layouts.app')
@section('content')


<!-- <div class="modal-dialog width-400px" role="document"> -->
<div class="signin-form">
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
                <h2>Reset Password</h2>
            </div>
        </div>
        <div class="modal-body">
            <?php echo Form::open(array('url' => '/reset-password', 'action' => 'UserController@resetPassword',

            'class' => 'form inputs-underline')); ?>
                
                
                <div class="form-group">
                    <?php echo Form::label('email', 'Email'); ?>
                    <?php echo Form::text('email', null, array('class' => 'form-control','placeholder' => 'Email')); ?>
                </div>
                <!--end form-group-->

                <div class="form-group">
                    <?php echo Form::label('password', 'Password'); ?>
                    <?php echo Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password')); ?>
                </div>
                
                <div class="form-group center">
                    <?php echo Form::submit('Reset Password',array('class' => 'btn btn-primary width-100')); ?>
                </div>
                <!--end form-group-->
            <?php echo Form::close() ?>

            <hr>
            
            <!--end form-->
        </div>
        <!--end modal-body-->
    </div>
    <!--end modal-content-->
</div>
<!--end modal-dialog-->
@endsection