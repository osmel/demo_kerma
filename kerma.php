server {
    listen 80;
    server_name 162.243.164.64;
    access_log /var/log/nginx/example.com.access.log;
    root /var/www/html;
    index index.php index.html index.htm;

    if ($request_uri ~* ^(/kerma/index(.php)?)/?$) {
        rewrite ^(.*)$ / permanent;
    }


    if ($request_uri ~* /kerma/index/?$) {
        rewrite ^/kerma/(.*)/index/?$ /$1 permanent;
    }

    
    if ($request_uri ~* ^core) {
        rewrite ^/(.*)$ /kerma/index.php?/$1 last;
        break;
    }

    error_page 404 /index.php;
 
    
    location / {
        try_files $uri $uri/ /index.php?q=$uri&$args;
    }

    location /kerma/ {
       try_files $uri $uri/ /kerma/index.php?q=$uri&args;
    }    


   location /phpmyadmin/ {
        #intente servirnos la URL escrita, si no es posible que pruebe la misma$
        # y si tampoco encuentra nada que nos sirva el archivo de error 404.
        try_files $uri $uri/ /phpmyadmin/index.php;
    }

    location ~ \.php$ {
        #include fastcgi_params;
        include snippets/fastcgi-php.conf;

        fastcgi_param HASH_ENCRYPT gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5;
        fastcgi_param ENCRYPT_KEY eTkFHqausC34vmldkSrLkMwX13kqpDg1CYOd;

        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        if (!-f $document_root$fastcgi_script_name) {
                return 404;
        }

    
        fastcgi_pass unix:/run/php/php7.0-fpm.sock;
        #fastcgi_index index.php;
        fastcgi_buffer_size 128k;
        fastcgi_buffers 256 4k;
        fastcgi_busy_buffers_size 256k;
        fastcgi_temp_file_write_size 256k;

    }


        
        location ~ /\.ht {
                deny all;
        }
}
