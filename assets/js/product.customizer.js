import * as cartService from '@ibexa-cart/src/bundle/Resources/public/js/service/cart';

(function (global, doc) {
    const img = doc.querySelector('.ibexa-store-product__slider-wrapper img');
    const colorInput = doc.querySelector('[name="add_to_cart[color]"]');
    const captionInput = doc.querySelector('[name="add_to_cart[img_caption]"]');
    const shapeInput = doc.querySelector('[name="add_to_cart[shape]"]');
    const borderCheckbox = doc.querySelector('[name="add_to_cart[img_border]"]');

    colorInput.addEventListener('change', (event) => {
        doc.querySelector('.customized-image').style.background = event.target.value;
    });

    captionInput.addEventListener('keyup', (event) => {
        doc.querySelector('.caption').innerHTML = event.target.value;
    });

    shapeInput.addEventListener('change', (event) => {
        clearAllShapeClasses();

        img.classList.add(getSelectedShape(event.target));
    });

    borderCheckbox.addEventListener('click', (event) => {
        img.classList.toggle('border');
    });

    document.body.addEventListener(
        'ibexa-cart:cart-data-changed',
        (event) => {
            populateEntryContext(event.detail.cart.cartData);
        },
        false,
    );

    function getSelectedShape(select) {
        const selectedOption = select.options[select.selectedIndex];

        return selectedOption.innerHTML;
    }

    function clearAllShapeClasses() {
        img.classList.remove('rounded', 'squared');
    }

    function populateEntryContext(cartData) {
        const entriesCount = cartData.entries.length;
        const index = cartData.entries.length > 0 ? entriesCount -1 : 0;
        const lastEntry = cartData.entries.at(index);

        if (lastEntry) {
            cartService.updateProductQuantity(
                cartData.identifier,
                lastEntry.identifier,
                lastEntry.quantity,
                {
                    'color': colorInput.value,
                    'caption': captionInput.value,
                    'shape': getSelectedShape(shapeInput),
                    'hasBorder': borderCheckbox.checked,
                }
            );
        }
    }
})(window, document);
