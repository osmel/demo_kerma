server {
    listen 80;
    #listen [::]:80 default_server ipv6only=on;
    server_name 162.243.164.64;
    access_log /var/log/nginx/example.com.access.log;
    root /var/www/html;
    index index.php index.html index.htm;

    # enforce NO www
    if ($host ~* ^www\.(.*))
    {
        set $host_without_www $1;
        rewrite ^/(.*)$ $scheme://$host_without_www/$1 permanent;
    }

    # canonicalize codeigniter url end points
    # if your default controller is something other than "welcome" you should change the following
    if ($request_uri ~* ^(/nosekerma(/index)?|/kerma/index(.php)?)/?$)
    {
        rewrite ^(.*)$ / permanent;
    }

    # removes trailing "index" from all controllers
    if ($request_uri ~* /kerma/index/?$)
    {
        rewrite ^/kerma/(.*)/index/?$ /$1 permanent;
    }


    # removes trailing slashes (prevents SEO duplicate content issues)
    if (!-d $request_filename)
    {
        #rewrite ^/(.+)/$ /$1 permanent;
    }

    # removes access to "system" folder, also allows a "System.php" controller
    if ($request_uri ~* ^core)
    {
        rewrite ^/(.*)$ /kerma/index.php?/$1 last;
        break;
    }

    # unless the request is for a valid file (image, js, css, etc.), send to bootstrap
    if (!-e $request_filename)
    {
       # rewrite ^/(.*)$ /kerma/index.php?/$1 last;
       # break;
    }

    # catch all
    error_page 404 /index.php;

      

    location / {
        #intente servirnos la URL escrita, si no es posible que pruebe la misma URL agregándole un slash ‘/’ 
        # y si tampoco encuentra nada que nos sirva el archivo de error 404.
        try_files $uri $uri/ =404;
    }

     
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
        fastcgi_param HASH_ENCRYPT gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5;
        fastcgi_param ENCRYPT_KEY eTkFHqausC34vmldkSrLkMwX13kqpDg1CYOd;

        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        if (!-f $document_root$fastcgi_script_name) {
                return 404;
        }

        #   # With php7-cgi alone:
        #   fastcgi_pass 127.0.0.1:9000;
        
        #   # With php7-fpm:
    
        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;

        fastcgi_buffer_size 128k;
        fastcgi_buffers 256 4k;
        fastcgi_busy_buffers_size 256k;
        fastcgi_temp_file_write_size 256k;

    }

    # deny access to .htaccess files, if Apache's document root
    # concurs with nginx's one
    #
    location ~ /\.ht {
        deny all;
    }
}