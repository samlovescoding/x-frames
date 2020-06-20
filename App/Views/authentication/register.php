<?php layout("authentication/layout"); ?>

<form action="/register" method="post">
    <div class="row">
        <div class="col-6 offset-3">
            <h3 class="pb-5">Register Form</h3>
            <?php import("authentication/messages"); ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control">
            </div>
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="/login" class="btn btn-link">Login</a>
            </div>
        </div>
    </div>
</form>