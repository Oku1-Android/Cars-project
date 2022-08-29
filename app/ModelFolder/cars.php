<?php

namespace App\ModelFolder;

//use Illimunate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
//use App\ModelFolder\HasFactory;

class cars extends Model
{
   // use HasFactory;  
    //below controls and make changes to the database
   protected $table = 'cars';

   protected $primaryKeys = 'id';

   //to protect items not to be mass assigned
   protected $fillable = ['name','founded','description'];
   
   //public $timestamps  = true;

   //protected $date = 'h:m:s';

   //to hide attributes that is not needed
   protected $hidden = ['updated_at'];
    
   //to show only the attributes that are needed from the database
   //protected $vissible = ['name', 'founded','description'];

   //methods that will create the right data base on the tables

   public function carModels()
   {
       //finding relationship method for the car model
      //   return $this->hasMany(CarModel::class);
      return $this->hasMany('App\ModelFolder\CarModel','car_id');
   }

   public function engines()
   {
      return $this->hasManyThrough(
         //Engine::class,
         'App\ModelFolder\Engine',
         //CarModel::class, 
         'App\ModelFolder\CarModel',
         'car_id',//foreign key on CarModel table
         'car_model'//foreign key on Engine Table
      );
   }
}