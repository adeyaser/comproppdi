<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= $base_url ?></loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
    </url>

    <!-- Pages -->
    <?php foreach($pages as $p): ?>
    <url>
        <loc><?= $base_url . (in_array($p['type'], ['tentang', 'zakat', 'layanan']) ? $p['type'].'/' : '') . $p['slug'] ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($p['updated_at'] ?? 'now')) ?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>

    <!-- Programs -->
    <?php foreach($programs as $pr): ?>
    <url>
        <loc><?= $base_url . 'program/' . $pr['slug'] ?></loc>
        <priority>0.9</priority>
    </url>
    <?php endforeach; ?>

    <!-- Posts -->
    <?php foreach($posts as $post): ?>
    <url>
        <loc><?= $base_url . 'kabar/' . $post['slug'] ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($post['published_at'])) ?></lastmod>
        <priority>0.7</priority>
    </url>
    <?php endforeach; ?>

    <url>
        <loc><?= $base_url . 'kontak' ?></loc>
        <priority>0.5</priority>
    </url>
</urlset>
