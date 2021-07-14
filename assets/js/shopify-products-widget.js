/**
 * This file is part of Shopify Products Widget
 * (c) Nicolai Lebek <mail@nicolailebek.de>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

const spwidgetDefaultConfig = {
    classes: {
        gallery: 'shopify-products-widget__gallery',
        galleryItem: 'shopify-products-widget__gallery-item',
        galleryItemActive: 'shopify-products-widget__gallery-item--active',
        preloader: 'shopify-products-widget__preloader',
    },
    interval: 2000,
};

class SPWidget {
    constructor(el, config, products) {
        this.el = el;
        this.config = { ...spwidgetDefaultConfig, ...config };
        this.products = products;

        this.items;
        this.current = 0;
        this.timer = 0;

        this.render();
    }

    render() {
        let gallery = this.el.querySelector(`.${this.config.classes.gallery}`);
        let html = gallery.innerHTML;

        for (const product of this.products) {
            html += this.renderProductTemplate(product);
        }

        gallery.innerHTML = html;

        this.items = this.el.querySelectorAll(
            `.${this.config.classes.galleryItem}`
        );
    }

    renderProductTemplate(product) {
        return `
			<figure class="${this.config.classes.galleryItem}">
				<a href="${this.config.url}/products/${product.handle}" target="_blank">
					<img src="${product.images[0].src}" alt="">
				</a>
			</figure>
		`;
    }

    async preload() {
        const imageSrcs = this.products.map((product) => product.images[0].src);

        return Promise.all(imageSrcs.map(this.preloadImage));
    }

    preloadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();

            img.onload = resolve;
            img.onerror = reject;

            img.src = src;
        });
    }

    reveal() {
        document.querySelector(`.${this.config.classes.preloader}`).remove();
        this.showProduct();
    }

    showProduct() {
        this.items[this.current].classList.add(
            `${this.config.classes.galleryItemActive}`
        );
    }

    changeProduct() {
        this.items[this.current].classList.remove(
            `${this.config.classes.galleryItemActive}`
        );

        this.current =
            this.current < this.items.length - 1 ? this.current + 1 : 0;

        this.showProduct();
    }

    animate() {
        this.reveal();
        if (this.items.length > 1) {
            window.requestAnimationFrame((timestamp) => this.loop(timestamp));
        }
    }

    loop(timestamp) {
        if (this.timer == 0) {
            this.timer = timestamp;
        }

        if (timestamp - this.timer >= this.config.interval) {
            this.changeProduct();
            this.timer = timestamp;
        }

        window.requestAnimationFrame((timestamp) => this.loop(timestamp));
    }
}

const initSPWidgets = async () => {
    const elements = document.querySelectorAll('.shopify-products-widget');

    for (const el of elements) {
        const id = el.getAttribute('id');
        const config = window[id.split('-').join('_')];

        const response = await fetch(
            `${config.url}/products.json?limit=${config.limit}`
        );
        if (!response.ok) {
            return;
        }

        const data = await response.json();
        if (!data.products.length) {
            return;
        }

        const widget = new SPWidget(el, config, data.products);
        await widget.preload();
        widget.animate();
    }
};

// DOMContentLoaded may fire before the script has a chance to run,
// so we check before adding a listener.
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSPWidgets);
} else {
    initSPWidgets();
}
