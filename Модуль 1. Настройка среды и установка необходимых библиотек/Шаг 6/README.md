# Запуск контейнера. Запуск групп контейнеров. Сети в Docker/Podman. Файловая система в Docker/Podman.

## Запуск контейнера
Чтобы запустить контейнер необходимо ввести следующую команду
```bash
podman run --rm quay.io/podman/hello:latest
```
1. Образ должен загрузиться с репозитория `quay.io/podman/hello`, где `quai.io` - это реестр, `podman` имя организации, `hello` - имя репозитория, `latest` - тэг образа. Тэг используют для обозначения версии образа. Можно провести аналогию с github.com где путь для репозитория выглядит как: `github.com/user/repo:tag`.
2. Podman сразу же запустит контейнер на основе этого образа (т. к мы попросили его это сделать командой `run`).
3. Программа исполнится и завершит свою работу, а вывод будет отображен в консоли.
4. Затем остановленный контейнер будет удален т. к мы указали флаг `--rm`.

Мы должны увидеть:
```bash
!... Hello Podman World ...!

         .--"--.           
       / -     - \         
      / (O)   (O) \        
   ~~~| -=(,Y,)=- |         
    .---. /`  \   |~~      
 ~/  o  o \~~~~.----. ~~   
  | =(X)= |~  / (O (O) \   
   ~~~~~~~  ~| =(Y_)=-  |   
  ~~~~    ~~~|   U      |~~ 

Project:   https://github.com/containers/podman
Website:   https://podman.io
Desktop:   https://podman-desktop.io
Documents: https://docs.podman.io
YouTube:   https://youtube.com/@Podman
X/Twitter: @Podman_io
Mastodon:  @Podman_io@fosstodon.org
```

Если не указывать флаг `-rm`, то мы можем убедиться что контейнер был остановлен, но не удален набрав команду `podman ps -a`
```bash
podman run quay.io/podman/hello:latest
```
```bash
podman ps -a
```
```
CONTAINER ID    IMAGE                       COMMAND                 CREATED          STATUS                      PORTS   NAMES
0689fb099aeb    quay.io/podman/hello:latest /usr/local/bin/po...    6 seconds ago    Exited (0) 6 seconds ago            interesting_hamilton
```
Эта команда по умолчанию выводит запущенные контейнеры, а с флагом `-a`, все контейнеры. Чтобы удалить контейнер, нужно вызвать команду.
```bash
podman container rm 0689fb099aeb
```
`0689fb099aeb` - это идентификатор контейнера.

Чтобы вывести скаченные образы можно использовать команду `docker image ls`
```bash
docker image ls
```
```
REPOSITORY              TAG       IMAGE ID        CREATED         SIZE
quay.io/podman/hello    latest    5dd467fce50b    5 months ago    787 kB
```
## Запуск групп контейнеров

Если нам необходимо запустить например базу данных и приложение, будет неудобно запускать каждое приложение по отдельности, для этого в Docker был придуман docker compose. Podman также реализует эту функциональность и умеет запускать несколько контейнеров.

Сначала необходимо определить файл `docker-compose.yaml`, это файл описывающий список сервисов которые необходимо запустить
```yaml
services:
  database:
    image: 
```

@TODO