<?php

namespace App\Helpers;

class LazyLoadHelper
{
    /**
     * Genera un tag <img> con lazy loading y placeholder.
     */
    public static function image(string $src, string $alt = '', string $class = '', array $attributes = []): string
    {
        $placeholder = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 1"%3E%3C/svg%3E';

        $attrs = array_merge([
            'src' => $placeholder,
            'data-src' => $src,
            'alt' => $alt,
            'class' => trim($class . ' lazy-image'),
            'loading' => 'lazy'
        ], $attributes);

        $attrString = '';
        foreach ($attrs as $key => $value) {
            $attrString .= sprintf('%s="%s" ', $key, htmlspecialchars($value));
        }

        return sprintf('<img %s>', trim($attrString));
    }

    /**
     * Imagen con skeleton loader.
     */
    public static function imageWithSkeleton(string $src, string $alt = '', string $class = '', string $height = '250px'): string
    {
        $imageTag = self::image($src, $alt, $class);

        return sprintf(
            '<div class="lazy-image-wrapper skeleton-loader" data-loaded="false" style="height:%s;overflow:hidden">%s</div>',
            $height,
            $imageTag
        );
    }

    /**
     * CSS del skeleton.
     */
    public static function skeletonStyles(): string
    {
        return <<<CSS
<style>
.lazy-image-wrapper {
    position: relative;
    background: #e3e3e3;
    background: linear-gradient(90deg, #e3e3e3 25%, #d6d6d6 50%, #e3e3e3 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s infinite;
}

@keyframes skeleton-loading {
    0% {background-position: 200% 0;}
    100% {background-position: -200% 0;}
}

.lazy-image-wrapper img.lazy-image {
    opacity: 0;
    transition: opacity 0.4s ease-in-out;
}

.lazy-image-wrapper[data-loaded="true"] {
    animation: none;
    background: none;
}

.lazy-image-wrapper[data-loaded="true"] img.lazy-image {
    opacity: 1;
}

.lazy-image-wrapper::before {
    content: "⏳";
    font-size: 2rem;
    opacity: 0.4;
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
}

.lazy-image-wrapper[data-loaded="true"]::before {
    display: none;
}
</style>
CSS;
    }

    /**
     * JavaScript para lazy loading.
     */
    public static function lazyLoadScript(): string
    {
        return <<<JS
<script>
document.addEventListener("DOMContentLoaded", () => {
    const lazyImages = document.querySelectorAll("img.lazy-image");

    console.log("🚀 Lazy Loading iniciado. Imágenes encontradas:", lazyImages.length);

    lazyImages.forEach(img => {
        const wrapper = img.closest(".lazy-image-wrapper");

        // Evento load (imagen cargada exitosamente)
        img.addEventListener("load", () => {
            if (wrapper) wrapper.dataset.loaded = "true";
            console.log("✅ Imagen cargada:", img.dataset.src);
        });

        // Evento error (imagen falló)
        img.addEventListener("error", () => {
            if (wrapper) wrapper.dataset.loaded = "true";
            img.src = "https://via.placeholder.com/600x400?text=Imagen+no+disponible";
            console.warn("⚠️ Error al cargar:", img.dataset.src);
        });

        // Forzar carga del data-src
        if (img.dataset.src) {
            img.src = img.dataset.src;
        }
    });
});
</script>
JS;
    }

    /**
     * Incluir todo
     */
    public static function renderAssets(): string
    {
        return self::skeletonStyles() . "\n" . self::lazyLoadScript();
    }
}
