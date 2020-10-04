# laravel-template
Laravel開発環境をサクッと構築できます！


# 始め方
1.このリポジトリをクローンもしくはダウンロードしてください。

2.`php-sandbox`ディレクトリで以下のコマンドを入力してください。
  ```
$ docker-compose up -d
  ```
  
3.以下のコマンドでphpコンテナに入ります。
```
$ docker-compose exec php bash
```

4.laravelのプロジェクトを立ち上げましょう！
```
# バージョンを指定しない場合
$ composer create-project --prefer-dist laravel/laravel ./
# バージョンを指定する場合
$ composer create-project --prefer-dist laravel/laravel=5.8 ./
```

5.`http://localhost/`でLaravelのウェルカムページが表示されたら成功です!

止めたい時は以下のコマンドを入力してください。
```
$  docker stop $(docker ps -q) 
```
---

もし、`composer-setup.php`で失敗したら以下のURLページを参照し、
`Dockerfile`中の`composer-setup.php`のハッシュ値を差し替えてください。
https://getcomposer.org/download/

---
