# invitation
A wedding invitation by ThinkPHP

# nginx configuration

```
server
{
        listen 80;
        server_name wedding.xxx.net;
        index index.html index.htm index.php default.html default.htm default.php;
        root  /home/wwwroot/wedding.xxx.net;

        include other.conf;
        location ~ [^/]\.php(/|$)
        {
                try_files $uri =404;
                fastcgi_pass  unix:/tmp/php-cgi.sock;
                fastcgi_index index.php;
                include fastcgi.conf;
        }
        location / {
                if (!-e $request_filename) {
                        rewrite  ^(.*)$  /index.php?s=$1  last;
                        break;
                }
        }

        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
        {
                expires      30d;
        }

        location ~ .*\.(js|css)?$
        {
                expires      12h;
        }

        access_log  /home/wwwlogs/wedding.zhuwenbo.net.log  access;
}
```