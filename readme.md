# SampleAdmin

# ミドルウェア・フレームワーク

- PHP 7.2.9
- Laravel Framework 5.7.2
- MySQL 5.7.23

# Homestead 環境構築手順

## システム要件

Vagrant と VirtualBox が必要です。

- Vagrant 2.1.1
- VirtualBox 5.2.12

## git clone

```
$ git clone https://github.com/HoriTaichi/SampleAdmin.git
```

## composer install

```
$ composer install --dev
```

## Homestead の設定ファイル生成

### Mac / Linux:

```
$ php vendor/bin/homestead make
```

## .env作成

`.env.example`を`.env`にコピーした後、`APP_KEY`を生成します。

```
$ cp .env.example .env
$ php artisan key:generate
```

## vagrant up

```
$ vagrant up
```

## データベースマイグレーション

VagrantインスタンスにSSHでログインして、データベースマイグレーションを行います。

```
$ vagrant ssh
$ cd code
$ php artisan migrate
```


## 画面アクセス

http://homestead.test/



