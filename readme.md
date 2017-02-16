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
```
