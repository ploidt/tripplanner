@extends('layouts.app')
@section('content')
<?php
    use App\Country;
    $countries = Country::all();
?>

<!-- <div class="modal-dialog width-400px" role="document"> -->
<div class="preplanner-form" style="width: 800px;margin-left: auto;margin-right: auto;">
    <div class="modal-header">
        <div class="section-title">
            <h2>Plan your trip!</h2>
        </div>
    </div>
    <div class="modal-body">
    @if (count($errors) > 0)
     <div class = "alert alert-danger">
        <ul>
           @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
           @endforeach
        </ul>
     </div>
    @endif
    <?php echo Form::open(array('url' => '/preplanner','class' => 'form inputs-underline')); ?>
        <!-- <form class="form inputs-underline role="form" method="POST" action="{{ route('register') }}"> -->
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label('arrivalDate', 'Arrival Date'); ?>
                        <?php echo Form::date('arrivalDate', \Carbon\Carbon::now()); ?>
                    </div>
                    <!--end form-group-->
                </div>
                <!--end col-md-6-->
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label('returnDate', 'Return Date'); ?>
                        <?php echo Form::date('returnDate', \Carbon\Carbon::now()); ?>
                    </div>
                    <!--end form-group-->
                </div>
                <!--end col-md-6-->
            </div>
            <!--enr row-->

            <div class="row" style="font-size: 2em;margin-bottom: 30px;">
                <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <?php echo Form::label('travelWith', 'Who are you traveling with?'); ?>
                    <div class="form-radio center">
                        <label class="radio-inline"><?php echo Form::radio('travelWith', 'family'); ?>Family</label>
                        <label class="radio-inline"><?php echo Form::radio('travelWith', 'kids'); ?>Kids</label>
                        <label class="radio-inline"><?php echo Form::radio('travelWith', 'couples'); ?>Couples</label>
                        <label class="radio-inline"><?php echo Form::radio('travelWith', 'friends'); ?>Friends</label>
                        <label class="radio-inline"><?php echo Form::radio('travelWith', 'solo'); ?>Solo</label>
                    </div>
                </div>
                <!--end form-group-->
                </div>
                <!--end col-md-12-->
            </div>
            <!--enr row-->
                
            
            <div class="form-group center">
                <?php echo Form::submit('Submit',array('class' => 'btn btn-primary width-30')); ?>
            </div>
            <!--end form-group-->
        <?php echo Form::close() ?>
    </div>
</div>
@endsection

