# Проект написан для дисциплины WEB-ДИЗАЙН

Для того чтобы загрузить проект на хостинг необходимо написать адрес хоста имя пользователя пароль пользователя примечание наименвоание БД и имя пользователя должны совпадать Структура БД представлена в отчете


Редактировать необходимо файл conndb.php 

$host = 'АДРЕС ХОСТА'; 

$user_db = 'ИМЯ ПОЛЬЗОВАТЕЛЯ И НАИМЕНОВАНИЕ БД';

$passworr = 'ПАРОЛЬ ПОЛЬЗОВАТЕЛЯ';

$link = mysqli_connect($host, $user_db, $passworr, $user_db);
