<?php
$navigation = [
    "About Us" => "javascript:document.querySelector('#beranda').scrollIntoView({behavior: 'smooth'})",
    "Services" => "javascript:document.querySelector('#main-co').scrollIntoView({behavior: 'smooth'})",
    "Contact" => "javascript:document.querySelector('').scrollIntoView({behavior: 'smooth'})",
    "Sign up" => "index.php"
];
?>

<header>
    <h1>Crimson Dawn</h1>
    <nav class="global-nav">
        <ul>
            <?php foreach ($navigation as $name => $link): ?>
                <li><a href="<?= $link ?>"><?= $name ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>