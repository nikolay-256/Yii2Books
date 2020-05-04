
<h1>Task YII2 books and authors</h1>
<br>
<a target="_blank" href="https://docs.google.com/document/d/1fH8vISNtM1VhBorSJbro3wzpdXmNmCtJrkKzbMySv3I/edit?usp=sharing">LINK TO TASK DESCRIPTION</a>

install composer:
-------------------

      composer install

create mysql db:
-------------------

      yii2books
      
change mysql permissions in:
-------------------

      /config/db.php
      
run migrations:
-------------------

      php yii migrate
      
run in localhost:
-------------------

      php yii serve --port=8888
      

to edit data in the interface, you need to be logged in:
-------------------
      login: demo
      password: demo
      
rest api URIs:
-------------------

      - show all books
      - GET /api/v1/books/list 
      
      - show book with id=1
      - GET /api/v1/books/1
      
      - delete book with id=1
      - DELETE /api/v1/books/1
      
      - update book with id=1
      - POST /api/v1/books/update/1
      - example:
        curl -X POST -H "Accept:application/json" "http://localhost:8888/api/v1/books/update/1" -F 'title=New title' -F 'author_id=2'
