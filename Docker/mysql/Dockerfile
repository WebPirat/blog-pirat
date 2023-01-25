FROM mysql/mysql-server:latest
RUN mkdir -p /scripts && mkdir -p /scripts/config
ADD ./shell/config /scripts/config
COPY ./shell/getDump.sh /scripts
COPY ./shell/backupToLive.sh /scripts
COPY ./shell/livetotest.sh /scripts
COPY ./shell/getnewDump.sh /scripts
WORKDIR /scripts
RUN chmod +x getDump.sh
RUN chmod +x backupToLive.sh
RUN chmod +x livetotest.sh
RUN chmod +x getnewDump.sh
#RUN ./getDump.sh
#RUN mv dump.sql /docker-entrypoint-initdb.d/dump.sql
COPY setup.sql /docker-entrypoint-initdb.d/
COPY dumps/ /docker-entrypoint-initdb.d/
