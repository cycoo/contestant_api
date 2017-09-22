<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= (!empty($title))?$title:'Contestant'?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url()?>themes/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>themes/css/jquery-ui.css">
  <link rel="stylesheet" href="<?= base_url()?>themes/css/gallery.css">

  <script src="<?= base_url()?>themes/js/jquery.min.js"></script>
  <script src="<?= base_url()?>themes/js/bootstrap.min.js"></script>
  <script src="<?= base_url()?>themes/js/jquery-ui.js"></script>
  <script src="<?= base_url()?>themes/js/gallery.js"></script>
  <script src="<?= base_url()?>themes/js/jquery.form-validator.min.js"></script>


</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?= base_url()?>">Contestant</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="<?= ($active=='contestant')?'active':''?>"><a href="<?= base_url()?>">Contestant</a></li>
      <li class="<?= ($active=='rating')?'active':''?>"><a href="<?= site_url('Rating')?>">Contestant Rating</a></li>
      <li class="<?= ($active=='gallery')?'active':''?>"><a href="<?= site_url('Gallery')?>">Photo Gallery</a></li>
      <li class="<?= ($active=='graph')?'active':''?>"><a href="<?= site_url('Rating/graph')?>">Graph</a></li>
    </ul>
  </div>
</nav>
  

