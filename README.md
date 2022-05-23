#Установка и запуск приложения по изучению Английского языка.

---

###Для установки приложения необходимо выполнить следующие действия:
1. Скопировать все файлы из репозитория в папку локального хоста.
2. Экспортировать Базы данных из файла `DATABASE.sql` в phpMyAdmin
   1. Для этого необходимо авторизоваться в СУБД MySQL
   2. Далее создать новую БД, присвоить ей имя (запомнить его) и выбрать сопостовление `utf8_general_ci`
   3. После создания БД, переходим во вкладку Импорт, выбираем файл `DATABASE.sql` (который распологается в корневом каталоге) и нажимаем Вперед
3. Переходим по пути `./frontend/web/` в этом каталоге располагается файл **.env.example** создаем его копию в этом же каталоге и переименовываем его на **.env**
4. В файле **.env** необходимо заполнить данныен Базы Данных. В данном файле всего 4-ре строки.
   1. В строке `DB_NAME`, в ковычках указывается наименование Базы Данных которое вы придумали ранее в **пункте 2-ii** 
   2. В строке `DB_HOST`, указывается хост, но чаще всего он по умолчанию **localhost**
   3. В строке `DB_USERNAME`, указывается имя пользователя Базы Данных
   4. В строке `DB_USERNAME`, указывается пароль от БД для авторизации
5. Если все действия выше были произведены правильно, то приложение запуститься без проблем


---
#
#

#Руководство по эксплуатации приложения

---

###Добавление ного словаря
Для добавления словаря необходимо использовать таблицу из трех колонок **(пример таблицы располагается в корневом каталоге и называется `new_table.xlsx`)**, а имеено `ENG`, `RUS`, `IMAGE`.
В столбец `ENG` внести английские слова.
В столбец `RUS` внести русские слова.
В столбец `IMAGE` внести наименование **(наименование картинке обязательно должно быть на английском языке)** файла картинки с расширением. 
Все картинки должны быть помещены в архив `.zip`
Для добавления словаря в приложение необходимо произвести следующие действия:
1. В верхнем меню выбрать пункт **"Загрузить словарь"**.
2. В открывшемся окне в поле **"Наименование словаря"** ввести его наименование.
3. В поле **"Выбор файла"** необходимо выбрать файл с таблицей в формате `.csv`
4. Далее необходимо нажать на **"Загрузить файл"**
5. Далее необходимо загрузить архив `.zip` с картинками. Для этого необходимо в блоке 
**"Загрузка изображений"** в поле "Выбор файла" выбрать архив с изображениями.
6. Нажать на кнопку **"Загрузить файл"**

>ВНИМАНИЕ!
>Файл с таблицей необходи экспортитровать в формат `.csv`

После всех дейсвтий произведенных выше словарь можно открыть перейдя во вклаку **"Выбрать словарь"**

###Поиск по загруженным словам
Поиск располагается во вклаке **"Выбрать словарь"**, далее необходимо перейти по кнопке **"Все слова"**

