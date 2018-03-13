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