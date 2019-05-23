<?php
namespace App\Traits;

use App\Models\Route;
use App\Models\Vehicle;

trait TransportScope{

    public function getRouteNameById($id)
    {
        $route = Route::find($id);
        if ($route) {
            return $route->title;
        }else{
            return "Unknown";
        }
    }


    public function getVehicleById($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            return $vehicle->number;
        }else{
            return "Unknown";
        }
    }
}