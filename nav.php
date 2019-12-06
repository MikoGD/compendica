<nav class="navigation">
    <h3 class="heading-tertiary">compendica</h3>
    <form method="POST" action="home.php" class="navigation__form">
        <input type="search" name="search" class="navigation__search" id="search" placeholder="Search for book or author">
        <button type="submit" name="btn_search" class="navigation__btn-search">Search</button>
    </form>
    <div class="navigation__icons">
        <a href="home.php" class="navigation__link">
            <svg class="navigation__icon <?php if ($active == 'home') echo 'active'?>">
                <use xlink:href="img/sprite.svg#icon-library"></use>
            </svg>
        </a>
        <a href="reservations.php" class="navigation__link">
            <svg class="navigation__icon <?php if ($active == 'reservations') echo 'active'?>">
                <use xlink:href="img/sprite.svg#icon-books"></use>
            </svg>
        </a>
        <a href="logout.php" class="navigation__link">
            <svg class="navigation__icon">
                <use xlink:href="img/sprite.svg#icon-exit"></use>
            </svg>
        </a>
    </div>
</nav>
