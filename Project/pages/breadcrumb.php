<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$breadcrumbItems = [];

// Define breadcrumb structure
$breadcrumbs = [
    'homepage.php' => [['label' => 'Beranda', 'link' => 'homepage.php']],
    'data.php' => [
        ['label' => 'Beranda', 'link' => 'homepage.php'],
        ['label' => 'Daftar Reservasi', 'link' => null]
    ],
    'form.php' => [
        ['label' => 'Beranda', 'link' => 'homepage.php'],
        ['label' => 'Reservasi Baru', 'link' => null]
    ],
    'edit.php' => [
        ['label' => 'Beranda', 'link' => 'homepage.php'],
        ['label' => 'Edit Reservasi', 'link' => null]
    ]
];

if (isset($breadcrumbs[$currentPage])) {
    $breadcrumbItems = $breadcrumbs[$currentPage];
}
?>

<?php if (!empty($breadcrumbItems)): ?>
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb spa-breadcrumb px-4 py-3 rounded-3" style="background-color: var(--spa-primary) !important; border-left: 4px solid var(--spa-accent) !important;">
        <?php foreach ($breadcrumbItems as $index => $item): ?>
            <?php if ($item['link']): ?>
                <li class="breadcrumb-item spa-breadcrumb-item"><a href="<?= $item['link'] ?>" class="spa-breadcrumb-link" style="color: var(--spa-accent) !important; text-decoration: none;"><?= $item['label'] ?></a></li>
            <?php else: ?>
                <li class="breadcrumb-item active spa-breadcrumb-active" style="color: var(--spa-text) !important; font-weight: 600;" aria-current="page"><?= $item['label'] ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>
