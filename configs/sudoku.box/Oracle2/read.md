Установка php на сервер
dnf module enable php:8.2
dnf install @php:8.2

//стандартные библиотеки, кроме apcu, redis
dnf install php php-common php-mysqlnd php-pecl-zip php-gd     php-mbstring php-xml php-soap


nano /etc/php-fpm.d/www.conf - установить ip:port прослушки ,установить разрешенных клиентов
listen = 10.0.0.171:9000
;listen.allowed_clients = any // - любые, ткт слушаем на внутреннем ip (any не работает)

  108  service php-fpm restart
  109  service php-fpm status


dnf install php-pecl-apcu.aarch64 - apcu, вроде включился сам - проверить

C редисом ебля..
dnf install php-pear php-devel
dnf install pecl
pecl
pecl install redis
nano /etc/php.ini
вставить после [PHP] "extension=redis.so"

Разрешить коннекты из php-fpm к mysql на другом хосте
sudo setsebool httpd_can_network_connect_db 1

Разрешить ЛЮБЫЕ коннекты по сети для php-fpm для REDIS
sudo setsebool httpd_can_network_connect 1
todo ПРОВЕРИТЬ, что эти настройки сохраняются после перезагрузки!!!





