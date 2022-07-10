@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-center p-2 m-2">

    <div class="card p-2 w-50">

        <div class="d-flex justify-content-between">

            <div class="">

                <h3>Edit Car Entry</h3>

            </div>

            <div class="">

                <a href="{{ route('home') }}"><button class="btn btn-primary"><i class="fa fa-list"></i> Car List</button></a>

            </div>

        </div>

        <hr class="my-1">

        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif

        <form action="{{ route('user.update' , $car->id) }}" method="post" enctype="multipart/form-data">

            @csrf

            @method('PUT')

            <div class="row">

                <div class="col">

                    <label for="sel1"><i class="fa-solid fa-calendar"></i> Select Year:</label>

                    <select class="form-control" id="years" name="year">
                        <option style="display: none;">Please select</option>
                        @foreach($yearArray as $year)
                            <option value="{{ $year }}" @if($car->year == $year) selected @endif>{{ $year }}</option>
                        @endforeach
                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col">

                    <label for=""><i class="fa-solid fa-car"></i> Model</label>

                    <input type="text" name="model" class="form-control" value="{{ $car->model }}" placeholder="Enter model here..">

                </div>

            </div>

            <div class="row">

                <div class="col">

                    <label for=""><i class="fa-solid fa-palette"></i> Color</label>

                    <input type="text" name="color" value="{{ $car->color }}" class="form-control" placeholder="Enter color here..">

                </div>

            </div>

            <div class="row">

                <div class="col">

                    <label for=""><i class="fa-thin fa-gauge"></i> Mileage</label>

                    <input type="number" step="any" name="mileage" class="form-control" value="{{ $car->mileage }}" placeholder="Enter mileage here..">

                </div>

            </div>

            @if(isset($car->image))

                <div class="row">

                    <div class="col">

                        <label for=""><i class="fa-thin fa-gauge"></i> Uploaded Image</label>

                        <div class="border p-1 text-center">

                            <img src="{{ url('/uploads/'.$car->image) }}" alt="user image" width="120">

                        </div>

                    </div>

                </div>
            @endif

            <div class="row">

                <div class="col">

                    <label for=""><i class="fa-solid fa-upload"></i> Update Image</label>

                    <input type="file" name="file" class="form-control">

                </div>

            </div>



            <div class="my-2">

                <button type="submit" class="btn btn-success w-100">Update</button>

            </div>

        </form>

    </div>

</div>

@endsection