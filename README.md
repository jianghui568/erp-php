
### 创建数据库
```
php artisan migrage
php artisan db:seed
```
### 生成种子文件
```
php artisan iseed <tablenames>
```


### 环境启动
```
1、启动docker
docker-compose up
2、进入php容器，执行一下命名
php artisan migrage
php artisan db:seed

3、访问
http://127.0.0.1:6111/admin
```
