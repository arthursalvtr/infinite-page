# PHP Infinite Page

## Installation

`git clone https://github.com/arthursalvtr/infinite-page.git`

after cloning this repo then run `composer install`

## Setting up your server

### NGINX

```nginx
server {
    listen       80;
    server_name infinite.test;
    root   "/path/to/your/infinite-page";
    location / {
        #autoindex  on;
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php(.*)$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        fastcgi_param  PATH_INFO  $fastcgi_path_info;
        fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
        include        fastcgi_params;
    }
}
```
