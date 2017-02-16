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
