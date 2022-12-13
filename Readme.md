
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
