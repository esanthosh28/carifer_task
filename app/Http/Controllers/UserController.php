<?php

namespace App\Http\Controllers;

use App\UsedCars;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getUsers(Request $request)
    {
        try {

            if ($request->ajax()) {

                $data = UsedCars::where('created_by', auth()->user()->id)->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="' . route("user.show", $row->id) . '" class="edit btn btn-success btn-sm"><i class="fa-solid fa-eye"></i></a>'
                            . '<a href="' . route("user.edit", $row->id) . '" class="edit btn btn-primary btn-sm customTableAction"><i class="fa-solid fa-pen-to-square"></i></a>'
                            . '<form class="customTableAction" action="' . route("user.destroy", $row->id) . '" method="post">'
                            . csrf_field()
                            . method_field("DELETE")
                            . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure to delete this car entry?\')"><i class="fa-solid fa-trash"></i></button>'
                            . '</form>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $params = $request->all();

            $imageName = null;

            if ($request->file('file')) {

                $validatedData = $request->validate([
                    'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);

                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();

                $request->file->move(public_path('uploads'), $imageName);
            }

            UsedCars::insert([
                'year' => $params['year'],
                'model' => $params['model'],
                'color' => $params['color'],
                'mileage' => $params['mileage'],
                'image' => $imageName,
                'created_by' => auth()->user()->id
            ]);

            $msg = "Car Entry Created successfully! ";

            return redirect('user')->with('msg', $msg);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $car = UsedCars::find($id);

        return view('user.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $car = UsedCars::find($id);

        $currentYear = Carbon::now()->format('Y');

        $yearArray = [];

        $years = range(1980, $currentYear);
        foreach ($years as $year) {
            array_push($yearArray,$year);
        }

        return view('user.edit', compact('car','yearArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imageName = null;

        if ($request->file('file')) {

            $validator = Validator::make($request->all(), [
                'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

//            if($validator->fails()) {
//                return view('user.edit',$id)->withErrors($validator);
//            }

            $imagePath = $request->file('file');
            $imageName = time().$imagePath->getClientOriginalName();

            $request->file->move(public_path('uploads'), $imageName);
        }

        $update = array_filter([
            "year"=>$request->year,
            "model"=>$request->model,
            "color"=>$request->color,
            "mileage"=>$request->mileage,
            "image"=>$imageName,
        ]);

        UsedCars::where('id', $id)->update($update);

        $msg = "Car entry Updated successfully! ";

        return redirect('user')->with('msg', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UsedCars::destroy($id);

        $msg = "Car entry Deleted successfully! ";

        return redirect('user')->with('msg', $msg);
    }
}
