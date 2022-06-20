<div class="container">
    <div class="row text-center">
        <h1 class="h2">Список задач</h1>
        <div class="mx-auto" style="height: 10px;"></div>
        <hr />
        <div class="mx-auto" style="height: 10px;"></div>
        <div class="col-3 text-center sticky-top" style="top: 1em">
            <form method="get" class="form-control text-center form-check-inline sticky-top" style="top: 1em">
                <template id="resultstemplate">
                    <?php
                    foreach ($users as $user) {
                        echo "<option>" . $user[1] . "</option>";
                        echo "<option>" . $user[3] . "</option>";
                    }
                    ?>
                </template>
                <div class="mb-3">
                    <h1 class="h3">Фильтр</h1>
                    <div class="mx-auto" style="height: 5px;"></div>
                    <hr />
                    <div class="mx-auto" style="height: 10px;"></div>
                    <?php
                    if ($permissions['user_filter'] == false) {
                        echo '<input disabled value="' . $_SESSION['user'] . '" class="form-control" type="text" name="user" id="search" placeholder="Почта/Логин" list="searchresults" autocomplete="off" />';
                    } else {
                        if ($filters['user_filter']) {
                            echo '<input value="' . $filters['user_filter'] . '" class="form-control" type="text" name="user" id="search" placeholder="Почта/Логин" list="searchresults" autocomplete="off" />';
                        } else {
                            echo '<input class="form-control" type="text" name="user" id="search" placeholder="Почта/Логин" list="searchresults" autocomplete="off" />';
                        }
                    }
                    ?>
                    <datalist id="searchresults"></datalist>
                </div>
                <div class="mb-3">
                    <?php
                    if ($permissions['status_filter'] == false) {
                        echo '<select disabled class="form-select" name="status">';
                    } else {
                        echo '<select class="form-select" name="status">';
                    }
                    echo '<option value="0">Статус</option>';
                    foreach ($status_names as $status) {
                        if ($status[0] == $filters['status_filter']) {
                            echo '<option selected value="' . $status[0] . '">' . $status[1] . '</option>';
                        } else {
                            echo '<option value="' . $status[0] . '">' . $status[1] . '</option>';
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <h1 class="h3">Сортировка</h1>
                    <div class="mx-auto" style="height: 5px;"></div>
                    <hr />
                    <?php
                     if ($permissions['status_filter'] == false) {
                        echo '<select disabled class="form-select" name="sortby">';
                    } else {
                        echo '<select class="form-select" name="sortby">';
                    }
                    ?>
                    <option <?php if ($_GET["sortby"] == "0" or !isset($_GET["sortby"])) {
                                echo "selected ";
                            } ?>value="0">Выбрать</option>
                    <option <?php if ($_GET["sortby"] == "1") {
                                echo "selected ";
                            } ?>value="1">Имя пользователя (А-Я)</option>
                    <option <?php if ($_GET["sortby"] == "2") {
                                echo "selected ";
                            } ?>value="2">Имя пользователя (Я-А)</option>
                    <option <?php if ($_GET["sortby"] == "3") {
                                echo "selected ";
                            } ?>value="3">Почта (А-Я)</option>
                    <option <?php if ($_GET["sortby"] == "4") {
                                echo "selected ";
                            } ?>value="4">Почта (Я-А)</option>
                    </select>
                </div>
                <button class="btn btn-outline-primary me-2" type="submit">Применить</button>
            </form>
        </div>
        <div class="col-9 text-center">
            <?php
            if ($loggined) {
                if (isset($tasks)) {
                    foreach ($tasks as $task) {
            ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h1 class="h1" style="color:dimgray">Задача №<?php echo $task[0] ?></h1>
                                    <div class="mx-auto" style="height: 10px;"></div>
                                    <hr />
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small>
                                            Cтатус: <?php echo $status_names[$task[3] - 1][1]; ?>
                                        </small>
                                    </div>
                                    <div class="mx-auto" style="height: 10px;"></div>
                                    <p class="card-text"><?php echo $task[2] ?></p>
                                    <?php
                                    if ($permissions['edit'] == false) {
                                        
                                    } else {
                                        echo '<div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary" href="/task?task_id=' . $task[0] . '">Редактировать</a>
                                    </div>';
                                    }
                                    ?>
                                    <!--<div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary" href='/task?task_id=<?php echo $task[0] ?>'>Редактировать</a>
                                    </div>-->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <?php
                                            foreach ($users as $user) {
                                                if ($user[0] == $task[1]) {
                                                    echo $user[1];
                                                    break;
                                                }
                                            }
                                            ?>
                                        </small>
                                        <?php
                                        if ($task[4]) {
                                            echo '<small class="text-muted">edited by '.$task[4].'</small>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto" style="height: 15px;"></div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="mx-auto" style="height: 30px;"></div>
                    <div class="row" style="float:right;">
                        <nav class="text-center">
                            <ul class="pagination">
                                <?php
                                $pag_uri = "/tasks?";
                                foreach ($_GET as $key => $value) {
                                    if ($key != 'page') {
                                        $pag_uri = $pag_uri . $key . "=" . $value . "&";
                                    } else {
                                        continue;
                                    }
                                }
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                } else {
                                    $page = 1;
                                }
                                if ($page == 1) {
                                    echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="' .
                                        $pag_uri . "page=" . ($page - 1) . '">Previous</a></li>';
                                }
                                for ($i = 1; $i <= $pages; $i++) {
                                    if ($page == $i) {
                                        echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                                    } else {
                                        echo '<li class="page-item"><a class="page-link" href="' .
                                            $pag_uri . "page=" . $i . '">' . $i . '</a></li>';
                                    }
                                }
                                if ($page == $pages) {
                                    echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="' .
                                        $pag_uri . "page=" . ($page + 1) . '">Next</a></li>';
                                }

                                ?>

                            </ul>
                        </nav>
                    </div>
            <?php
                } else {
                    echo "Здесь будут отображены ваши задачи.";
                    echo '<div class="mx-auto" style="height: 20px;"></div>';
                    echo '<a class="btn btn-outline-primary me-2" href="/logout">Выйти</a>';
                }
            } else {
                echo "Авторизуйтесь для просмотра задач.";
                echo '<div class="mx-auto" style="height: 20px;"></div>';
                echo '<a class="btn btn-outline-primary me-2" href="/login">Авторизация</a>';
            }
            ?>
        </div>
    </div>
</div>