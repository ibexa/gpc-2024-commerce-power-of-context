(function (global, doc) {
    const fireworkButton = doc.querySelector('[name=fireworks]');
    const fireworks = doc.querySelector('.fireworks');
    const fireworksHiddenInput = doc.querySelector('[name="form[last_touches][has_fireworks]"]');

    fireworkButton.addEventListener('click', () => {
        fireworks.classList.add('pyro');
        fireworksHiddenInput.value = true;
    });
})(window, document);
