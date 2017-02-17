### 0.准备工作
npm install
art make:auth 
配置邮箱

### 1.创建channel
composer dump-autoload 
art make:model Http/Models/Channel -m 
```
public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_fielname')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
```
art migrate 
```
// User.php
    public function channel(){
        return $this->hasMany(Channel::class);
    }
    
// Channel.php
class Channel extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_filename',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}

// RegisterController
class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'channel_name'=>'required|max:255|unique:channels,name',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->channel()->create([
            'name'=>$data['channel_name'],
            'slug'=>uniqid(true),
        ]);
        return $user;
    }
}
```

### 2.queues
art queue:table
art queue:failed-table
art migrate 

```
// .env
QUEUE_DRIVER=database 

```

### 3.Navigation 
- 1.将navigation提取出来，放到layouts.partials._navigation中
- 2.新建serviceprovider实现变量全局可用 art make:provider ComposerServiceProvider 
```
// App/Provider/ComposerServiceProvider 
class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('layouts.partials._navigation',NavigationComposer::class);
    }
    public function register()
    {
    }
}

// 在app.php中注册
        App\Providers\ComposerServiceProvider::class,
```
- 3.新建ViewComposer
```
// app/Http/ViewComposer/NavigationComposer.php
class NavigationComposer{
    public function compose(View $view){
        if(!Auth::check()){
            return;
        }
        $view->with('channel',Auth::user()->channel->first());
    }
}
```
- 4.在_navigation中消费该变量即可。

### 4.channel settings 
art make:controller ChannelSettingsController --resource 

```
在view中消费了$channel这个变量，从route中获取到参数，再通过controller传递给view

// web.php
Route::group(['middleware'=>['auth']],function(){
   Route::get('/channel/{channel}/edit','ChannelSettingsController@edit');
   Route::put('/channel/{channel}/edit','ChannelSettingsController@update');
});

// Channel.php
    public function getRouteKeyName()
    {
        return 'slug';
    }

// ChannelSettingsController
    public function edit(Channel $channel)
    {
        return view('channel.edit',compact('channel'));
    }
```

- 修改.env参数配置
```
// .env 
在其中将APP_URL参数修改为http://localhost:8000/
在view中消费
```

