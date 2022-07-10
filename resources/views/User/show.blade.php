@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-center p-2 m-2">

    <div class="card p-2 w-50">

        <div class="d-flex justify-content-between">

            <div class="">

                <h3>View Car</h3>

            </div>

            <div class="">
                <a href="{{ route('home') }}"><button class="btn btn-info"><i class="fa-solid fa-arrow-left"></i> Back</button></a>
                <a href="{{ route('user.edit',$car->id) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button></a>

            </div>

        </div>

        <hr class="my-1 mb-2">

        <div class="row">

            <div class="col-4">

                <div class="border p-1 text-center">

                    @if(isset($car->image))
                        <img src="{{ url('/uploads/'. $car->image) }}" alt="user image" width="120">
                    @else
                        <img src="{{ url('/uploads/'. 'dummy.png') }}" alt="user image" width="120">
                    @endif

                </div>

            </div>

            <div class="col-8">

                <h6>Provided Information</h6>

                <hr class="my-1">

                <div class="d-flex justify-content-between">

                    <label class="">Year :</label>

                    <span class="text-primary">{{ $car->year }}</span>

                </div>

                <div class="d-flex justify-content-between">

                    <label class="">Model :</label>

                    <span class="text-primary">{{ $car->model }}</span>

                </div>

                <div class="d-flex justify-content-between">

                    <label class="">Color :</label>

                    <span class="text-primary">{{ $car->color }}</span>

                </div>

                <div class="d-flex justify-content-between">

                    <label class="">Mileage :</label>

                    <span class="text-primary">{{ $car->mileage }}</span>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection