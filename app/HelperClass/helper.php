<?php

/*files add on composer .json*/
/* "files": [
            "app/HelperClass/helper.php"
        ]*/


//helperfunction


/*function envC($key, $default) {

    // check if .env exist with the key
    if (env($key))
        return env($key);
    elseif ($value = configExistInDb($key))
        return $value;

    return $default;
}

function configExistInDb($key) {

    $row = \App\Models\EmailSetting::first();
    if (!$row)
        return false;
    else {

        if (!$row->$key)
            return false;
        else
            return $row->$key;

    }
    return false;

    //App::artisan('confi:fasdj');

}*/


/*over rite env file*/
/*function changeEnv($data = array()){
    if(count($data) > 0){

        // Read .env-file
        $env = file_get_contents(base_path() . '/.env');

        // Split string on every " " and write into array
        $env = preg_split('/\s+/', $env);;

        // Loop through given data
        foreach((array)$data as $key => $value){

            // Loop through .env-data
            foreach($env as $env_key => $env_value){

                // Turn the value into an array and stop after the first split
                // So it's not possible to split e.g. the App-Key by accident
                $entry = explode("=", $env_value, 2);

                // Check, if new key fits the actual .env-key
                if($entry[0] == $key){
                    // If yes, overwrite it with the new one
                    $env[$env_key] = $key . "=" . $value;
                } else {
                    // If not, keep the old one
                    $env[$env_key] = $env_value;
                }
            }
        }

        // Turn the array back to an String
        $env = implode("\n", $env);

        // And overwrite the .env with the new data
        file_put_contents(base_path() . '/.env', $env);

        return true;
    } else {
        return false;
    }
}*/

function getTodo()
{
    $res = DB::table('todo')->where('user_id',Auth::user()->id)->get();
    if($res->count()>0)
    {
        return $res;
    }
    else 
        return 0;
}

function activeStudents()
{
    $res = DB::table('students')->where('status',1)->count();
    return $res;
}

function get_placement_test($val=0){
    $res = DB::table('placement_test')->get();
    $option = "<option value=''>select placement</option>";
    foreach ($res as $r) {
        $option .= "<option value='".$r->id."' ";
        if($val == $r->id)
            $option .= " selected ";
        $option .= ">".$r->title."</option>";
    }
    echo $option;
}

function get_placement_test_val($val=0){
    $res = DB::table('placement_test')->where('id',$val)->first();
    if($res)
    {
        return $res->title;
    }
}