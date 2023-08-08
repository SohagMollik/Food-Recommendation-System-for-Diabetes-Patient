<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function dashboard()
    {
        $data = DB::table('food')->select('food_name','food_id')->get();
        $u_id = Auth::user()->id;

    $foods1 = DB::table('food as f')
        ->leftJoin('breakfast as b', function ($join) use ($u_id) {
            $join->on('f.food_id', '=', 'b.food_id')
                ->where('b.u_id', '=', $u_id);
        })
        ->whereNull('b.food_id')
        ->select('f.food_name','f.food_id')
        ->get();

        $foods2 = DB::table('food as f')
        ->leftJoin('lunch as b', function ($join) use ($u_id) {
            $join->on('f.food_id', '=', 'b.food_id')
                ->where('b.u_id', '=', $u_id);
        })
        ->whereNull('b.food_id')
        ->select('f.food_name','f.food_id')
        ->get();

        $foods3 = DB::table('food as f')
        ->leftJoin('dinner as b', function ($join) use ($u_id) {
            $join->on('f.food_id', '=', 'b.food_id')
                ->where('b.u_id', '=', $u_id);
        })
        ->whereNull('b.food_id')
        ->select('f.food_name','f.food_id')
        ->get();

        return view('dashboard', ['foods1' => $foods1,'foods2' => $foods2,'foods3' => $foods3, 'data' => $data]);

    }
    public function store_items(Request $request)
{
    $u_id = Auth::user()->id;
    $breakfastItems = json_decode($request->input('breakfastItems')); // Retrieve selected breakfast items

    foreach ($breakfastItems as $foodId) {
        DB::table('breakfast')->insert([
            'food_id' => $foodId,
            'u_id' => $u_id
        ]);
    }

    return redirect()->route('lunch');
}
    public function lunch()
    {
        $data = DB::table('food')->select('food_name','food_id')->get();

        return view('lunch',['data'=>$data]);

    }

    public function store_items2(Request $request)
    {
        $u_id = Auth::user()->id;
    $lunchItems = json_decode($request->input('lunchItems')); // Retrieve selected lunchItems items

    foreach ($lunchItems as $foodId) {
        DB::table('lunch')->insert([
            'food_id' => $foodId,
            'u_id' => $u_id
        ]);
    }
    return redirect()->route('dinner');
    }


    public function dinner()
    {
        $data = DB::table('food')->select('food_name','food_id')->get();

        return view('dinner',['data'=>$data]);

    }

    public function store_items3(Request $request)
{
    $u_id = Auth::user()->id;
    $dinnerItems = json_decode($request->input('dinnerItems')); // Retrieve selected dinnerItems items

    foreach ($dinnerItems as $foodId) {
        DB::table('dinner')->insert([
            'food_id' => $foodId,
            'u_id' => $u_id
        ]);
    }

    $data = DB::table("users")->where('id', $u_id)->update(['status' => '1']);

    return redirect()->route('dashboard');
}

    public function updatefood(){

        $u_id = Auth::user()->id;
        $breakfast = DB::table('food')
    ->join('breakfast', 'food.food_id', '=', 'breakfast.food_id')
    ->where('breakfast.u_id', '=', $u_id)
    ->select('food.food_name')
    ->get();

    $lunch = DB::table('food')
    ->join('lunch', 'food.food_id', '=', 'lunch.food_id')
    ->where('lunch.u_id', '=', $u_id)
    ->select('food.food_name')
    ->get();

    $dinner = DB::table('food')
    ->join('dinner', 'food.food_id', '=', 'dinner.food_id')
    ->where('dinner.u_id', '=', $u_id)
    ->select('food.food_name')
    ->get();


    $foods1 = DB::table('food as f')
    ->leftJoin('breakfast as b', function ($join) use ($u_id) {
        $join->on('f.food_id', '=', 'b.food_id')
            ->where('b.u_id', '=', $u_id);
    })
    ->whereNull('b.food_id')
    ->select('f.food_name','f.food_id')
    ->get();

    $foods2 = DB::table('food as f')
        ->leftJoin('lunch as b', function ($join) use ($u_id) {
            $join->on('f.food_id', '=', 'b.food_id')
                ->where('b.u_id', '=', $u_id);
        })
        ->whereNull('b.food_id')
        ->select('f.food_name','f.food_id')
        ->get();

        $foods3 = DB::table('food as f')
        ->leftJoin('dinner as b', function ($join) use ($u_id) {
            $join->on('f.food_id', '=', 'b.food_id')
                ->where('b.u_id', '=', $u_id);
        })
        ->whereNull('b.food_id')
        ->select('f.food_name','f.food_id')
        ->get();
        return view('updatefood',['breakfast'=>$breakfast,'lunch'=>$lunch,'dinner'=>$dinner,'foods1'=>$foods1,'foods2' => $foods2,'foods3' => $foods3]);
    }
    public function update_breakfastitems(Request $request){
        $u_id = Auth::user()->id;
        $breakfastItems = json_decode($request->input('breakfastItems')); // Retrieve selected breakfast items

        DB::table('breakfast')
        ->where('u_id', $u_id)
        ->delete();
    
    foreach ($breakfastItems as $foodId) {
        DB::table('breakfast')->insert([
            'food_id' => $foodId,
            'u_id' => $u_id
        ]);
    }
    return redirect()->back();
}
    public function update_lunchitems(Request $request){
        $u_id = Auth::user()->id;
        $lunchItems = json_decode($request->input('lunchItems')); // Retrieve selected breakfast items

        DB::table('lunch')
        ->where('u_id', $u_id)
        ->delete();
    
    foreach ($lunchItems as $foodId) {
        DB::table('lunch')->insert([
            'food_id' => $foodId,
            'u_id' => $u_id
        ]);
    }
    return redirect()->back();
}

public function update_dinneritems(Request $request){
    $u_id = Auth::user()->id;
    $dinnerItems = json_decode($request->input('dinnerItems')); // Retrieve selected breakfast items

    DB::table('dinner')
    ->where('u_id', $u_id)
    ->delete();

foreach ($dinnerItems as $foodId) {
    DB::table('dinner')->insert([
        'food_id' => $foodId,
        'u_id' => $u_id
    ]);
}
return redirect()->back();
}

public function home(){

     return view('welcome');
}

}

