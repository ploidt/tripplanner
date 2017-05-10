@extends('layouts.app')
@section('content')

<section class="block">
  <div class="container">
    <div class="section-title">
        <div>
            <h2>Trips</h2>
            <h3 class="subtitle">Fusce eu mollis dui, varius convallis mauris. Nam dictum id</h3>
        </div>
    </div>
    <!--end section-title-->
    <div class="row">
    <a style="float: right;" class="btn btn-primary" href="{{ url('preplanner') }}">Plan New Trip</a>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No.</th>
            <th>Location</th>
            <th>Arrival Date</th>
            <th>Return Date</th>
            <th>Length of Stay</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        @foreach( $planners as $planner )
          <tr>
            <td>{{ $i++ }}</td>
            <td>Bangkok</td>
            <td>{{ $planner->arrivalDate }}</td>
            <td>{{ $planner->returnDate }}</td>
            <td class="center">{{ $planner->lengthOfStay }}</td>
            <td><a href="{{ url('edit/planner/'.$planner->id) }}" class="btn btn-warning">EDIT</a></td>
            <!-- <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">DELETE</a></td> -->
            <td><a href="{{ url('delete/planner/'.$planner->id) }}" class="btn btn-danger">DELETE</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection