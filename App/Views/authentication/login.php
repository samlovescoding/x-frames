<?php layout("authentication/layout"); ?>

<form action="/login" method="post">
    <div class="row">
        <div class="col-6 offset-3">
            <h3 class="pb-5">Login Form</h3>
            <?php import("authentication/messages"); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control">
            </div>
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="/register" class="btn btn-link">Register</a>
            </div>
        </div>
    </div>
</form>