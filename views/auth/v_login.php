<div class="wrap">
    <div class="modal">
        <div class="modal__header">
            <h1 class="title"><?= $title ?></h3>
        </div>
        <form class="modal__body" action="" method="POST">
            <div class="form__group">
                <label for="modal-login">Логин</label>
                <input class="caption" id="modal-login" type="text" name="login" value="<?= $login ?>">
            </div>
            <div class="form__group">
                <label for="modal-pass">Пароль</label>
                <input class="caption" id="modal-pass" type="password" name="password" value="<?= $password ?>">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="login-remember" name="remember">
                <label class="form-check-label" for="login-remember">Запомнить меня</label>
            </div>
            <div class="form__group"> <button type="submit" class="modal__button btn--red">«Отправить»</button></div>
            <?php if ($errors) : ?>
                <?php foreach ($errors as $error) : ?>
                    <div class="alert"><?= $error ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </form>
    </div>
</div>