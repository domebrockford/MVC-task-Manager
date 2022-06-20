<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        Cart-Power task
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 link-dark">Главная</a></li>
        <li><a href="/tasks" class="nav-link px-2 link-dark">Задачи</a></li>
      </ul>

      <div class="col-md-3 text-end">
        
        <?php
          if ($_SESSION['session']){
            echo '<a class="btn btn-outline-primary me-2 logout" onmouseenter="logouthover(event)" onmouseleave="logouthover(event)" href="/logout">' . $_SESSION['user'] . '</a>';
          }
          else{
            echo '<a class="btn btn-outline-primary me-2" href="/login">Авторизация</a>';
          }
        ?>
      </div>
    </header>
</div>