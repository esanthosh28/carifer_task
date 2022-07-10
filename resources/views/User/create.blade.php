@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-center p-2 m-2">

    <div class="card p-2 w-50">

        <div class="d-flex justify-content-between">

            <div class="">

                <h3>Create Car Entry</h3>

            </div>

            <div class="">

                <a href="{{ route('home') }}"><button class="btn btn-primary"><i class="fa fa-list"></i> Car List</button></a>

            </div>

        </div>

        <hr class="my-1">

        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col">

                    <label for="sel1"><i class="fa-solid fa-calendar"></i> Select Year:</label>
                    <select class="form-control" id="year" name="year">
                        <option style="display: none;">Please select</option>
                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col">

                    <label for=""><i class="fa-solid fa-car"></i> Model</label>

                    <input type="text" name="model" class="form-control" placeholder="Enter model here..">

                </div>

            </div>

            <div class="row">

                <div class="col">

                    <label for=""><i class="fa-solid fa-palette"></i> Color</label>

                    <input type="text" name="color" class="form-control" placeholder="Enter color here..">

                </div>

            </div>

            <div class="row">

                <div class="col">

                    <label for=""><i class="fa-solid fa-gauge"></i> Mileage</label>

                    <input type="number" step="any" name="mileage" class="form-control" placeholder="Enter mileage here..">

                </div>

            </div>

            <div class="row">

                <div class="col">

                    <label for=""><i class="fa-solid fa-upload"></i> Upload Image</label>

                    <input type="file" name="file" class="form-control">

                </div>

            </div>

            <div class="my-2">

                <button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-floppy-disk"></i> Submit</button>

            </div>

        </form>

    </div>

</div>

@endsection