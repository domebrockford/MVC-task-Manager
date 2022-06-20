<div class="container">
    <div class="row text-center">
        <h1 class="h2">Редактирование задачи</h1>
        <div class="mx-auto" style="height: 10px;"></div>
        <hr />
        <div class="mx-auto" style="height: 10px;"></div>
        <div class="col-3 sticky-top" style="top: 1em">
            <div class="mb-3 border border-primary rounded">
                <div class="mx-auto" style="height: 10px;"></div>
                <p class="h6">Задача № <?php echo $id; ?></p>
                <hr />
                <div class="row" style="text-align:left !important; padding: 5px;">
                    <div class="col-6 h6 text-truncate">Пользователь:</div>
                    <div class="col-6 h6 text-truncate"><?php echo $login; ?></div>
                    <div class="col-12" style="height: 5px;"></div>
                    <div class="col-6 h6 text-truncate">Почта: </div>
                    <div class="col-6 h6 text-truncate"><a class="link-dark" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
                    <div class="col-12" style="height: 5px;"></div>
                    <div class="col-6 h6 text-truncate">Статус: </div>
                    <div class="col-6 h6 text-truncate"><?php echo $name; ?></div>
                </div>
            </div>
        </div>
        <div class="col-9 text-center">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="h1" style="color:dimgray">Задача № <?php echo $id; ?></h1>
                        <div class="mx-auto" style="height: 10px;"></div>
                        <hr />
                        <div class="d-flex justify-content-between align-items-center">
                            <form class="form-control" method="post" action="/task/edit">
                            <input value="<?php echo $id ?>" name="task_id" type="hidden" class="hidden">
                                <div class="mb-3">
                                    <label for="text" class="form-label">Текст задачи</label>
                                    <textarea name="text" class="form-control" id="text" rows="6"><?php echo $text; ?></textarea>
                                </div>
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="status" class="col-form-label">Статус задачи</label>
                                    </div>
                                    <div class="col-auto">
                                        <select name="status" class="form-control" id="status">
                                            <?php
                                            foreach ($statuses as $status_card) {
                                                if ($status_card[1] == $name) {
                                                    echo '<option selected value="' . $status_card[0] . '">' . $status_card[1] . '</option>';
                                                } else {
                                                    echo '<option value="' . $status_card[0] . '">' . $status_card[1] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm">
                                    <button type="submit" class="btn btn-primary" style="float: right;">Отправить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mx-auto" style="height: 15px;"></div>
            </div>
        </div>
    </div>
</div>