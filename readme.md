# 外部 -> FDS データ転送システム レシピ

## フロントエンドサーバ構成

### yum 追加レポジトリ

 - epel (for nginx)
 - remi (for php71, php-fpm)

### FTPサーバ

#### ミドルウェア

 - pure-ftpd

#### パッケージ

 - pure-ftpd.x84_64

#### 設定ファイル

 - /etc/pureftpd 以下

#### 機能

 - 実行ユーザとFTPユーザの分離
 - PostgreSQL との連携によるユーザー認証
 - ファイルアップロードのアトミック処理
 - ユーザー毎の制限(トラフィック制限, 接続元制限, ストレージ使用量制限)
 - ファイルアップロード後のフック処理
 
   /usr/local/bin/uploadscript.php を別途用意すること
 
### HTTPサーバ
 
#### ミドルウェア

 - nginx

#### パッケージ

 - nginx.x86_64 (@epel)

#### 設定ファイル

 - /etc/nginx 以下

#### 機能

 - HTTPサーバ
 - PHPサーバ実行環境
 
#### ドキュメントルート

 - /usr/share/nginx/html/

### スクリプトエンジン

#### ミドルウェア

 - php-cli (cli用)
 - php-fpm (HTTPサーバー連携用)

#### パッケージ

 - php71-php-cli.x86_64 (@remi-safe)
 - php71-php-fpm.x86_64 (@remi-safe)

#### 設定ファイル

 - /etc/opt/remi/php71/php.ini (php-cli)
 - /etc/opt/remi/php71/php-fpm.conf (php-fpm)

### DBMS

#### ミドルウェア
postgresql

#### パッケージ

 - postgresql.x86_64
 - postgresql-libs.x86_64
 - postgresql-server.x86_64

#### 設定ファイル

 - /var/lib/pgsql 以下

#### ユーザー

 - postgres

  スーパーユーザでのみ接続可能( ホスト認証 )
  
 - pure_ftpd

  pure_ftpd データベース管理用( 127.0.0.1/32 / md5パスワード認証 )
  
#### データベース

 - pure_ftpd

  pure_ftpd ユーザー管理用データベース
