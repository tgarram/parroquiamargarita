<?php
// JSON-LD structured data for the page.
// $schema: array — the schema.org object to serialize.
if (empty($schema)) {
    return;
}
?>
<script type="application/ld+json">
<?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
