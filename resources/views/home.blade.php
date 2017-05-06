@extends('layouts.app')
<?php use Carbon\Carbon; ?>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <?php $user = Auth::user();
                    echo $user->id; 
                    echo "<br>";
                    echo "cluster: ".$user->cluster;
                     ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
