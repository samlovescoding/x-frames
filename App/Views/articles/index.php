<?php layout("layouts/dashboard"); ?>

<div class="container pt-5">
    <h1 class="mb-5">My Blog <a href="/blog/create" class="btn btn-success float-right">Create</a></h1>

    <?php foreach ($articles as $article): ?>
    <div class="card mb-5">
      <div class="card-body">
        <h3 class="card-title"><?=$article->title?></h3>
        <p><?=$article->body?></p>
        <a class="btn btn-primary" href="/blog/<?=$article->slug?>">Read</a>
        <a class="btn btn-warning" href="/blog/<?=$article->slug?>/edit">Edit</a>
        <a class="btn btn-danger" href="/blog/<?=$article->slug?>/delete">Delete</a>
      </div>
    </div>
    <?php endforeach; ?>
</div>
