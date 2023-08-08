<?php


namespace App\Http\Controllers\AdminAuth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function newusers(Request $request)
    {
        $search=$request['search']??"";
        if($search!==""){
            $users=DB::table('users')->where('phone','=',$search)->get();
        }else{
            $users=DB::table('users')->select('*')->get();
        }
        $users=compact('users','users');
        return view('admin.NewUsers.NewUsers')->with($users);
    
    } 

    public function deleteusers(Request $request)
{
    $delete = $request->delete;

    $users=DB::table("users")->whereIn('id',$delete)->delete();

    return redirect()->back();

}

public function foodlist()
{
    $foodlist = DB::table('food')->select('food_name','food_id')->get();

    return view('admin.foodlist.foodlist', ['foodlist' => $foodlist]);

}
   
}
