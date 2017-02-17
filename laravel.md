laravel可以视为是作者封装PHP社群现有工具(composer,symfony component)，将这些工具与Illuminate组装在一起的方法。
Symfony component是Laravel的骨干。

- index.php
```
require __DIR__.'/../bootstrap/autoload.php';   //自动载入需要的类
$app = require_once __DIR__.'/../bootstrap/app.php'; //自爱如框架本身
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class); //HTTP核心kernel
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send(); //接收并处理请求，然后返回响应
$kernel->terminate($request, $response); 
```

- artisan 
```
require __DIR__.'/bootstrap/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\ConsoleOutput
);
$kernel->terminate($input, $status);
exit($status);
```

#### bootstrap相关
- autoload.php
```
define('LARAVEL_START', microtime(true));  //定义一个常数，记录框架开始执行的时间，用于衡量框架的性能

require __DIR__.'/../vendor/autoload.php'; //composer工具管理
```

- app.php
```
$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;
```

#### Illuminate
- Application
```
// vendor/laravel/framework/src/Illuminate/Foundation/Application.php

class Application extends Container implements HttpKernelInterface, TerminableInterface, ResponsePreparerInterface 
```