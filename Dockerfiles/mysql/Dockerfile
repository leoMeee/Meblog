FROM mysql:5.6

RUN { \
    echo '[mysqld]'; \
    echo 'character-set-server = utf8'; \
    echo 'collation-server = utf8_unicode_ci'; \
    echo '[client]'; \
    echo 'default-character-set=utf8'; \
    echo '[mysql]'; \
    echo 'default-character-set=utf8'; \
} > /etc/mysql/conf.d/charset.cnf

VOLUME /var/lib/mysql