### 非常之快的MVC，暂无手册。内部使用
```
加密解密
$s = \Crypt::encode('aa');
echo \Crypt::decode($s);
缓存
\Cache::set('a','123');
echo \Cache::get('a');
```