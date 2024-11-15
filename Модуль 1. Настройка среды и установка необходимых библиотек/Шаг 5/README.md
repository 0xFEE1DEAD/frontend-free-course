# Что такое docker и podman.

## Сначала начнем с docker.

Docker - представляет собой программное обеспечение для автоматизации развертывания и управления приложениями, которое использует технологию контейнеризации. При разработке этого программного обеспечения была создана целая экосистема и стандарты технологий контейнеризации. Проект для стандартизации назван **Open Container Initiative**. На данный момент, docker состоит из 2 программ docker-client и docker-daemon. Docker client связывается с Docker daemon через сокет и работает с API по протоколу gRPC. В свою очередь docker daemon уже запускает контейнер.

## Зачем нужен Podman. И что такое Podman.

### Недостатки использования docker:
Дело в том что Docker разделен на 2 продукта Docker CE и Docker EE. Где Docker CE является fork moby-project (https://github.com/moby/moby), а Docker EE fork Docker CE. Это накладывает определенные ограничения на использование продукта которые опубликованы https://www.docker.com/pricing/, также они могут измениться что не очень удобно.

Помимо этого docker daemon - запущен от пользователя root, а rootless mode нужно настраивать. Чтобы запустить контейнер необходимо состоять в группе docker. Грубо говоря, любой пользователь который состоит в группе docker имеет root права в системе т. к он может запустить процесс из-под root пользователя используя docker.

### Podman
Podman (https://github.com/containers/podman) - это полностью Open Source решение и отличная альтернатива Docker CE. В отличии от Docker, он не имеет daemon, а сразу запускает контейнер. Также Podman использует user namespaces что позволяет запускать процессы от имени любого пользователя, но внутри контейнера все будет выглядеть так, будто процесс запущен от root, а тесная интеграция с другими решениями компании Red Hat, упрощает работу с продуктом и делает ее безопаснее. Например Podman отлично взаимодействует с selinux и поставляется в дистрибутивах Fedora.

Опыт работы с Podman практически не отличается от опыта взаимодействия с Docker CE, за исключением отсутствия некоторого функционала, вроде Docker Swarm mode. Но на мой взгляд, если данный функционал вам будет необходим, то стоит рассмотреть использование k8s (Например его дистрибутив k3s).

Далее мы будем все проделывать используя Podman в дистрибутиве Fedora.