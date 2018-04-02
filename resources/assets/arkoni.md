# 1. Category
categories>
  - category1: item1
  - category2: item2
               item1

# 2. Export/import to DB

# 3. .env
MAIL_DRIVER=smtp
MAIL_HOST=smtp.ukr.net
MAIL_PORT=2525
MAIL_USERNAME=endnet@ukr.net
MAIL_PASSWORD=653-&-GP-jcf-5ukr.net
MAIL_ENCRYPTION=SSL

# 4. Tinker
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
<form method="post" action="{{ route('subcategory.destroy',$subcat->id) }}"
                                  class="form-inline justify-content-end">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-secondary" type="submit" onclick="return confirm('Ви впевнені?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <a href="{{route('subcategory.edit',$subcat->id)}}"
                                   class="btn btn-warning change-category ml-1">
                                    <i class="fas fa-pencil-alt"></i></a>
                            </form>
                            
                            
         $i::with(['brand','getRuItem','getUkItem','getItemTag'])->whereHas('getRuItem',function($q){$q->where('ru_name','test1ru');})->get()
         
         $i::with(['brand'])->where('id',4)->orWhereHas('brand',function($q){$q->where('name','LIKE','%%');})->get()->sortBy('brand.name')
         
         $i::with(['brand'])->where('id',4)->orWhereHas('brand',function($q){$q->where('name','LIKE','%%');})->get()->sortBy('brand.name',0) 1-desc
         
         $i::with(['getRuItem'])->whereHas('getRuItem', function($f){$f->where('ru_name','LIKE','%rub%')->orWhere('desc','LIKE','%df%');})->get()
         
         $i::with(['brand','getRuItem','getItemShortCut','getItemTag','getItemRuTagName'])->whereHas('getRuItem', function($f){$f->where('ru_name','LIKE','%rub%')->orWhere('desc','LIKE','%df%');})->get()->pluck('id')

                    
