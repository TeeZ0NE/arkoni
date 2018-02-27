# Tinker
$admin = new App\Models\Admin
=> App\Models\Admin {#746}
>>> $admin->name = "Vadim"
=> "Vadim"
>>> $admin->email = "vadim@hyperdomen.com.ua"
=> "vadim@hyperdomen.com.ua"
$admin->password = Hash::make(111111)
=> "$2y$10$j/rBONl3DioegXzAJozML.66b0YwZxHaLBriaiXyXqlpGn3dSjgu6"
>>> $admin->job_title = "Administer"
=> "Administer"
>>> $admin->save()
=> true
>>> $admin->all()

# in model if hasnt timestamps
protected $fillable = array(
        'name',
        'url_slug'
    );
  public $timestamps  = false;


# filter where
$brand::all()->where('name','brand7') "filter"
     
$this->middleware('auth:admin');
# save request to use in old 
$request->flash();
    return view('admin.pages.brands')->with(
      ['brands'=>
      $this->brand::where('name','LIKE','%'.$request->q.'%')
      ->get(['name','id']),
      'count'=>$this->brand::count()]);

# add to url
@php $sort or 'acs'; $brands->appends(['sort'=>$sort])->render(); @endphp       

# paginate
->paginate($this->pag_count,['name','id']);
{{ $brands->links() }}

# parent categori and sub category from the same class
public function sub_cat()
  {
    return $this->belongsTo(Category::class,'parent_id','id');
  }

  public function parent_cat()
  {
    return $this->hasMany(Category::class,'id','parent_id');
  }

# delete destroy method
<form method="post" action="{{ route('items.destroy',$item->id) }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Ви впевнені?')" >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>

# confirmation                     
  onclick="return confirm('Ви впевнені?')" 
