# 勤怠管理
## 環境構築
- Dockerビルド
  1. git clone git@github.com:nogi-megumi/attendance-management.git
  2. DockerDesktopアプリを立ち上げる
  3. docker compose up -d —build

- laravel環境構築  
  1. docker compose exec php bash
  2. composer install
  3. cp .env.example .env
  4. .envに以下の環境変数を変更

     - DB_CONNECTION=mysql
     - DB_HOST=mysql
     - DB_DATABASE=laravel_db
     - DB_USERNAME=laravel_user
     - DB_PASSWORD=laravel_pass

  5. php artisan key:generate
  6. php artisan migrate
  7. php artisan db:seed

## 使用技術
- php8.0.
- Laravel9.52.21
- nginx
- mysql

## ログイン情報
### 一般ユーザー
- 名前：西怜奈
- メールアドレス：reina-n@coachtech.com
- パスワード：testuser
### 管理者
- メールアドレス：testAdmin@coachtech.com
- パスワード：testadmin

## URL
- 開発環境：http://localhost/
- hphpMyAdmin：http://localhost:8080/


