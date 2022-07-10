

@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-center p-2 m-2">

    <div class="card p-2 w-50">

        <div class="d-flex justify-content-between">

            <div class="">

                <h3>Cars List</h3>

            </div>

            <div class="">

                <a href="{{ route('user.create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Create New Entry</button></a>

            </div>

        </div>

        <hr class="my-1">

        <div class="">

            @if (\Session::has('msg'))

                <div class="text-success  text-center ">

                    <h6 style=" text-align:center !important;"><b>Success! </b>{!! \Session::get('msg') !!}</h6>

                </div>

            @endif

                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <table class="table table-bordered" id="carsTable" >

                <thead>

                <tr>

                    <th>Year</th>

                    <th>Model</th>

                    <th>Color</th>

                    <th>Mileage</th>

                    <th>Action</th>

                </tr>

                </thead>

            </table>

        </div>

    </div>

</div>
<script type="application/javascript">

    $(function() {
        $('#carsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('getUsers') }}",
            columns: [
                { data: 'year', name: 'year' },
                { data: 'model', name: 'model' },
                { data: 'color', name: 'color' },
                { data: 'mileage', name: 'mileage' },
                { data: 'action', name: 'action' }
            ]
        });
    });

</script>

@endsection