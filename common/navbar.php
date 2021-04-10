

<nav class="navbar navbar-expand-lg navbar-dark  sticky-top stickyNav">
  <a class="navbar-brand" href="index.php">Shopping App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<!-- HEADER -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"> 
      <button type="button" class="btn btn-info"><a style="color:white;" class="nav-link" href="cart.php">Cart (<span id="cartCounter"><?= $cartCount?></span>)</a></button>

      </li>
    </ul>

  </div>
</nav>