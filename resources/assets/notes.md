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
