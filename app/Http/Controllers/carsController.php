<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\ModelFolder\cars;
use App\ModelFolder\CarModel;


class carsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //retrievin data
        //SELECT * FROM Cars
       /* $cars = cars::all();
        dd($cars);
        //dd means 'die down'*/

        
        
        //......for all cars. that is all values 
                    //--$cars = cars::all();
        //......for a specific car

        //$cars = cars::where('name', '=', 'BMW') ->firstOrFail();
                //->get();
      // print_r($cars = cars::sum('id'));
               
        //----breaking your request into smaller pieces

        /*$cars = cars::chunk(2, function ($cars) {
            foreach($cars as $car){
                print_r($car);
            }
        });*/
        $cars = cars::all()->toJson();//this can also be used here:$cars = cars::all()->toArray(); but var_dump($cars); will be used instead of the json_decode method below.
        $cars = json_decode($cars) ; 
        
            //var_dump($cars);
          //to loop over in a UI; we pass our eloquent as an ass. array
         return view('cars.index',[
            'cars'=> $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //insert data
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //to chick if the form will be stored. if "Ok" is printed out
                //--dd('ok');
        //inserting into the database
            // $car = new cars;
            // $car->name=$request->input('name');
            // $car->founded=$request->input('founded');
            // $car->description=$request->input('description');
            // $car->save();
            //passing and array to a model
           
            $car = cars::create([//u can also use 'make' in place of create. but in that case, you use '$car->save' method at the end to save.
                'name'=>$request->input('name'),
                'founded'=>$request->input('founded'),
                'description'=>$request->input('description')
            ]);
        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        
      $car = cars::find($id);
        //$car = cars::find($id);
          //  var_dump($car);
          dd($car->engines);
       //echo $car;
     //   $car['mode_name'];

       return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        //dd($id);
        $car = cars::find($id);

        //dd($car);
        return view('cars.edit')->with('car', $car);
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
        $car = cars::where('id',$id)->update([
            'name'=>$request->input('name'),
            'founded'=>$request->input('founded'),
            'description'=>$request->input('description')
        ]);
    return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(cars $car)//passing the model inside the method
    {
        //dd($id);

           //$car = cars::where('id',$id)->first();

           $car->delete();

           return redirect('/cars');
    }
}