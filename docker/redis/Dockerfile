FROM redis
RUN ln -sf /usr/share/zoneinfo/Europe/Moscow /etc/localtime
COPY redis.conf /usr/local/etc/redis/redis.conf
CMD [ "redis-server", "/usr/local/etc/redis/redis.conf" ]
