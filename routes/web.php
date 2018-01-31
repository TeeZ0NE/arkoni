<?php
use Illuminate\Http\Request;
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
  // return session('mykey');
  return View::make('welcome');
});
Route::get('some{id?}{ram?}', function(Request $request){
  echo 'request '.$request->input('id');
  // echo '<br>'.$request->input('ram','default');
  // print_r($request->all());
  // echo "/n/r\n\r\t".$request->query('ram','defA').PHP_EOL.'<br>';
  if($request->exists('ram')) 
    {echo "<br>_ram=".$request->ram.'<br>';
if(isset(json_decode($request->ram)->k2)){echo "<p>".json_decode($request->ram)->k2."</p>";}else{echo '<p>not set k2</p>';};
} 
foreach ($request->all() as $key => $value) {
  echo $key.'=='.$value;
}
Cookie::queue('nameKey', 'Myvalue2', 2);
echo ($request->session()->exists('mykey'))?'key is '.session('mykey'):'hasnt key';
echo '<br>name='.$request->cookie('name');
$request->flash();
echo '<br> old name is='.$request->old('name').'<br>';
  //return response('Hello World', 200)->header('Content-Type', 'text/plain');
session(['mykey'=>'som V2']);
// print_r($request->session()->all());
echo ($request->session()->has('mykey'))?'key is '.session('mykey'):'hasnt key';
// Log::info('some info appear here',["messag"=>"ohoho"]);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
