
#### Laravel Sanctum Api Token Authentication ( not SPA Auth )

```php 
use HasApiTokens;

use Illuminate\Http\Request;
 
Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});

foreach ($user->tokens as $token) {
    //
}
```

#### api 에 ability 를 사용할수 있음. 
```php 
return $user->createToken('token-name', ['server:update'])->plainTextToken;

if ($user->tokenCan('server:update')) {
    //
}

// middleware  in app/Http/Kernel.php 
'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,


Route::get('/orders', function () {
    // Token 이 두 기능을 모두 가지고 있는지 확인
})->middleware(['auth:sanctum', 'abilities:check-status,place-orders']);


Route::get('/orders', function () {
    // Token 이 두 기능중 하나를 가지고 있는지 확인
})->middleware(['auth:sanctum', 'ability:check-status,place-orders']);


// if SPA Auth is used , 'tokenCan' return true ALWAYS
// SO 

return $request->user()->id === $server->user_id &&
       $request->user()->tokenCan('server:update')


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// --> 
// middleware('auth:sanctum') 은 
// 	1. 쿠키를 검사해서 이미 인증이 된 세션을 확인
// 	2. Authorization 페어를 검사해서 인증을 시도
```

#### 토큰 취소 / 만료 
```php

// Revoke all tokens...
$user->tokens()->delete();
 
// Revoke the token that was used to authenticate the current request...
$request->user()->currentAccessToken()->delete();
 
// Revoke a specific token...
$user->tokens()->where('id', $tokenId)->delete();

// 토큰 만료
// config/sanctum.php 
'expiration' => 525600, // 1 year in mins

$schedule->command('sanctum:prune-expired --hours=24')->daily();

```






http://127.0.0.1:8000/api/me

```conf
Authorization : Bearer 5|q45YpDtwI7yLOLHF1aeih9k56gxxxxs7kJz9xxx
Accept: application/json
```

```sh
curl https://url -H "Accept: application/json" -H "Authorization: Bearer {token}"
```

```php
   $response = Http::accept('application/json')
                  ->withToken('token')
                  ->acceptJson()
                  ->get('http://url');
```
