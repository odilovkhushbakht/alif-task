
Запуск в докере:

sudo docker build -t phptask .
sudo docker run -it phptask /bin/bash



Примеры команд:

добавить
php start.php file.txt add apple 50.06

заменить
php start.php file.txt change apple 50.06 apple 50

удалить
php start.php file.txt del apple 50.06

получить обшую сумму
php start.php file.txt total

получить справочник
php start.php
