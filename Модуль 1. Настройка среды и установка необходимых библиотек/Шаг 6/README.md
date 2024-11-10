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

Если не указывать флаг `-rm`, то мы можем убедиться что контейнер был остановлен, но не удален набрав команду `podman container ls -a`
```bash
podman run quay.io/podman/hello:latest
```
```bash
podman container ls -a
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

Чтобы вывести скаченные образы можно использовать команду `podman image ls`
```bash
podman image ls
```
```
REPOSITORY              TAG       IMAGE ID        CREATED         SIZE
quay.io/podman/hello    latest    5dd467fce50b    5 months ago    787 kB
```

Чтобы не запускать контейнер, а только скачать образ, можно использовать `podman pull <образ>`. Например:
```bash
podman pull quay.io/podman/hello:latest
```

Итого мы имеет 2 сущности: образ и контейнер. Образ - неизменяемый шаблон, который включает в себя все необходимые файлы и зависимости для работы приложения, а контейнер - запущенный экземпляр образа. Когда мы вводим команду `podman run quay.io/podman/hello:latest`, podman сначала проверяет не загружен ли образ контейнера. Далее образ либо скачивается, либо происходит запуск контейнера.

`podman pull <образ>` - загрузить образ
`podman run quay.io/podman/hello:latest` - запустить образ
`podman container ls -a` - просмотреть список образов
`podman container rm <ид контейнера>` - удалить контейнер
`podman image ls` - вывести список загруженных образов
`podman image rm <образ>` - удалить загруженный образ

Чтобы разобраться что происходит с файлами при запуске контейнеров, можно прочитать статью:
https://habr.com/ru/companies/slurm/articles/701950/

Если кратко и упрощенно, то docker использует специальную файловую систему в которой все изменения находятся на верхнем слое, а на более нижних хранится та неизменяемая часть что хранит образ. Если запустить несколько контейнеров, то они будут использовать одну неизменяемую часть (которая будет взята из образа), а все изменения будут помещены в специальный слой контейнера.