    <?php

use App\Models\ClassroomType;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    // dump('route test');
    return view('page.original_welcome');
    // return view('page.original_email');
    // return response()->json(["erer"=>"erere"]);
})->name('home');



Route::view('/page-2','page.modified_welcome')->name('page2');
Route::view('/page-3','page.original_email')->name('page3');

Route::get('/page-4',function(){
$var1=2;
$var2=3;
$total=$var1+$var2;

return view('page.modified_welcome',["totalSum"=>$total]);

});

Route::get('/page-5',function(\Illuminate\Http\Request $meow){
    $data=$meow->all();
// get input from request, convert to array
    $var3=$data['var1']?? 0;
    $var4=$data['var2']?? 0;
    // $var1=$var3;
    // $var2=$var4;
    // dd($var3,$var4);    
    return view('page.modified_welcome',["totalSum"=>$var3*$var4]);
    
    })->name('page5');

Route::get('/student-list', function () {
    $data =DB::select('SELECT * FROM student');
    // dump('route test');
    // return view('welcome');
    return response()->json($data);
});

Route::get ('/classroom-type',function (){
    //getting all data,object
    $data=ClassroomType::all();

    // OR
    // $data=ClassroomType::get();

    //get first row,object
    // $data=ClassroomType::first();

    // get based on id ,object 
    // $data=ClassroomType::find(4);

    // get based on id,,fail return none
    // $data=ClassroomType::findOrFail(5);

    // to get sql query excecuted 
    // $data=ClassroomType::first()->toSql();

    // db query aka query builder 
    // $data=DB::table('classroom_types')->first();

    //  searh using something
    // $data=ClassroomType::where('type','recorded')->get();

    // search by half value
    // $data=ClassroomType::where('type', 'like', '%l%')->get();

    // get all row between range of column id , eg:get all the rwo with i more than 1 
    // $data=ClassroomType::where('id','>',1)->get();

    // sample chaining query,
    // $data=DB::table('countries')
    // ->where([
    //     ['id','>',40],
    //     ['name','like', '%us%']
    // ])
    // ->where('id','>',40)
    // ->where('name','like', '%us%')
    // ->orWHERE()
    // ->get();
    return response()->json($data);

    User::created([
        'name'=>'adasasa',
        'email'=>'asdasda@asas',
        'password'=> '1242435346467'
    ]);
    
});




