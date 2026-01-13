<?php

namespace App\Http\Controllers;

use App\Models\Drinks;
use App\Models\Foods;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
class DrinksFoodsController extends Controller
{
public function sendMail(Request $request)
{
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'message' => 'required|string',
    ]);

    $to = 'ibrahimparlak282@gmail.com';

    try {
        Mail::to($to)->send(new ContactMail($data));
    } catch (\Exception $e) {
        dd($e->getMessage()); // Hata mesajını direkt gösterir
    }

    return back()->with('success', 'Your message has been sent successfully!');
}

public function drinks(Request $request)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|url',
    ]);

    $drink = new Drinks();
    $drink->name  = $validated['name'];
    $drink->price = $validated['price'];
    $drink->image = $validated['image'] ?? null;

    $drink->save();

    return redirect()
        ->route('drinks')
        ->with('success', 'Your Post Has Been Created!');
}

public function about(Request $request){
$validated = $request->validate([
    'title' => 'required|string|max:255',
'description' => 'required|string',
'second_paragraph' => 'nullable|string',
'last_paragraph' => 'nullable|string',
'image' => 'nullable|url',
'phone' => 'nullable|string|max:20',
'email' => 'nullable|email',
'instagram_url' => 'nullable|url',
'twitter_url' => 'nullable|url',
'linkedin_url' => 'nullable|url',
'github_url' => 'nullable|url', 
]);
$about=new About();
$about->title=$validated['title'] ??null;
$about->description=$validated['description']??null;
$about->second_paragraph=$validated['second_paragraph']??null;
$about->last_paragraph=$validated['last_paragraph']??null;
$about->image=$validated['image']??null;
$about->phone = $validated['phone'] ?? null;
$about->email = $validated['email'] ?? null;
$about->instagram_url = $validated['instagram_url'] ?? null;
$about->twitter_url = $validated['twitter_url'] ?? null;
$about->github_url = $validated['github_url'] ?? null;
$about->linkedin_url = $validated['linkedin_url'] ?? null;

$about->save();
return redirect()
->route('about')
->with('success', 'About Page Has Been Created!');

}
public function aboutPage(){
    $about = About::first(); // 👈 all() About sayfası tek tane olacaksa DEĞİL
    return view('about', compact('about'));
}
public function updateAbout($id,Request $request){
    $validated=$request->validate
    ([
 'title' => 'required|string|max:255',
'description' => 'required|string',
'second_paragraph' => 'nullable|string',
'last_paragraph' => 'nullable|string',
'image' => 'nullable|url',
'phone' => 'nullable|string|max:20',
'email' => 'nullable|email',
'instagram_url' => 'nullable|url',
'twitter_url' => 'nullable|url',
'github_url' => 'nullable|url',
'linkedin_url' => 'nullable|url',
    ]);
    $about =About::findOrFail($id);
    $about->title=$validated['title']??null;
    $about->description=$validated['description'];
    $about->second_paragraph=$validated['second_paragraph']??null;
    $about->last_paragraph=$validated['last_paragraph']??null;
    $about->image=$validated['image']??null;
   $about->phone = $validated['phone'] ?? null;
$about->email = $validated['email'] ?? null;
$about->instagram_url = $validated['instagram_url'] ?? null;
$about->twitter_url = $validated['twitter_url'] ?? null;
$about->github_url = $validated['github_url'] ?? null;
$about->linkedin_url = $validated['linkedin_url'] ?? null;

    $about->save();
    return redirect()
    ->route('about')
    ->with('success','About Page Has Been Updated!');
}
public function editAbout($id){
$about=About::findOrFail($id); 
    return view('editAbout',['ourPost'=>$about]);
}
public function updateData($id,Request $request){

    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|url',
    ]);

     $drink = Drinks::findOrFail($id);// // Var olan kaydı bul
    $drink->name  = $validated['name'];
    $drink->price = $validated['price'];
    $drink->image = $validated['image'] ?? null;

    $drink->save();

    return redirect()
        ->route('drinks')
        ->with('success', 'Post updated successfully!');
}
public function foods(Request $request)
{
   
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|url',
    ]);

    $food = new Foods();
    $food->name  = $validated['name'];
    $food->price = $validated['price'];
    $food->image = $validated['image'] ?? null;

    $food->save();

    return redirect()
        ->route('foods')
        ->with('success', 'Your Post Has Been Created!');
}
public function home()
{
    $drinks = Drinks::paginate(4, ['*'], 'drinks_page');
    $foods  = Foods::paginate(4, ['*'], 'foods_page');

    return view('home', compact('drinks', 'foods'));
}
public function dashboard()
{
    $drinks = Drinks::paginate(4, ['*'], 'drinks_page');
    $foods  = Foods::paginate(4, ['*'], 'foods_page');

    return view('dashboard', compact('drinks', 'foods'));
}
public function drinkss()
{
    $drinks = Drinks::all(); // ✅
    return view('drinks', compact('drinks'));
}


public function foodss()
{
    $foods = Foods::all();
    return view('foods', compact('foods'));
}
public function editData($id){
$drink=Drinks::findOrFail($id); 
    return view('EditDrinks',['ourPost'=>$drink]);
}
public function deleteData($id){
    $drink=Drinks::findOrFail($id);
    $drink->delete();
     return redirect()->route('drinks')->with('success','Your Post Has Been Deleted!');
}
public function editFoods($id){
$food=Foods::findOrFail($id); 
    return view('EditFoods',['ourPost'=>$food]);
}
public function deleteFoods($id){
    $food=Foods::findOrFail($id);
    $food->delete();
     return redirect()->route('foods')->with('success','Your Post Has Been Deleted!');
}
public function deleteKullanici($id)
{
    $user = User::findOrFail($id);

    // Eğer kendi hesabını siliyorsa logout yap
   if (Auth::id() == $user->id) {
    Auth::logout(); 
    $user->delete();
    return redirect()->route('login')->with('success', 'Your account has been deleted!');
}

    $user->delete();
    return redirect()
    ->route('kullanicilar')
    ->with('success', 'User account has been deleted!');
}

public function updateFoods($id,Request $request){

    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|url',
    ]);

    $food = Foods::findOrFail($id);// // Var olan kaydı bul
    $food->name  = $validated['name'];
    $food->price = $validated['price'];
    $food->image = $validated['image'] ?? null;

    $food->save();

    return redirect()
        ->route('foods')
        ->with('success', 'Your Post Has Been Created!');
}
public function kullanicilar(){
    $users = User::paginate(10);
    return view('kullanicilar', compact('users'));
}
public function editPassword(User $user)
{
  return view('profile.partials.edit-password', compact('user'));

}

public function updatePassword(Request $request, User $user)
{
    $request->validate([
        'password' => 'nullable|confirmed|min:8',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

return redirect()->route('kullanicilar')
    ->with('success', 'User updated successfully.');

}

public function homeDrinks()
{
     
    $drinks = Drinks::all();//veri tabanından 4 tane ceker!!!
    return view('drinksfoodsaboutmail.homeDrinks', compact('drinks'));
   
}
public function homeFoods()
{
    $foods = Foods::all();
    return view('drinksfoodsaboutmail.homeFoods', compact('foods'));

}
public function homeAbout(){
    $about = About::first();
    return view('drinksfoodsaboutmail.homeAbout', compact('about'));
}

}