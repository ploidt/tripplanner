@extends('layouts.app')

@section('content')
<div class="signin-form">
    <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <div class="section-title">
            <h2>Login</h2>
        </div>
    </div>
    @if (count($errors) > 0)
    <div class = "alert alert-danger">
        <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
 @endif

 <div class="modal-body">
    <?php echo Form::open(array('url' => '/login','class' => 'form inputs-underline')); ?>
    {{ csrf_field() }}
    <div class="form-group">
        <?php echo Form::label('email', 'Email'); ?>
        <?php echo Form::text('email', null, array('class' => 'form-control','placeholder' => 'Email')); ?>
    </div>
    <!--end form-group-->
    
    <div class="form-group">
        <?php echo Form::label('password', 'Password'); ?>
        <?php echo Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password')); ?>
    </div>
    
    
    <!-- <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>
    </div> -->
    <div class="form-group center">
        <?php echo Form::submit('Sign In',array('class' => 'btn btn-primary width-100')); ?>
        <a class="btn btn-link" href="{{ route('password.request') }}">
            Forgot Your Password?
        </a>
    </div>
    <!--end form-group-->
    <?php echo Form::close() ?>

    
    
</div>
</div>
@endsection
