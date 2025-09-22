"use strict";

///////////////////////////////////////
// SELECTORS

// Locate everything with the toggler class
const togglers = document.querySelectorAll('.toggler button');

///////////////////////////////////////
// CALLBACKS

/**
 * Shows or hides the content the toggler is linked to
 * @param {Event} e Event triggered by the listener
 */
const showContents = function(e) {
    // Locate targeted element
    const targetId = e.currentTarget.dataset.target;
    const targetEl = document.getElementById(targetId);
    // Get the height and pass it through to the CSS as a variable value before swapping classes
    // (This allows the animation to work)
    targetEl.style.setProperty('--openHeight', targetEl.scrollHeight + 'px');
    // Swap classses between hide and show
    targetEl.classList.toggle('hide');
    targetEl.classList.toggle('show');
    // Toggle the aria-hidden value
    targetEl.getAttribute('aria-hidden') === 'true' ? targetEl.setAttribute('aria-hidden', 'false') : targetEl.setAttribute('aria-hidden', 'true');
    // Toggle the expanded class on the parent nav
    const nav = targetEl.closest('nav');
    nav.classList.toggle('expanded');
    // Toggle screen reader info about whether this is expanded
    e.currentTarget.ariaExpanded = e.currentTarget.ariaExpanded !== 'true';
}

///////////////////////////////////////
// LISTENERS

// Attach a listener to each element with the toggler class
togglers.forEach(el => el.addEventListener('click', showContents));
