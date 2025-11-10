"use strict";

///////////////////////////////////////
// SELECTORS

// Locate everything with the toggler class
const togglers = document.querySelectorAll('.toggler button');
// Locate any empty links
const emptyNavLinks = document.querySelectorAll('nav a[href="#"]');

///////////////////////////////////////
// CALLBACKS

/**
 * Removes any noscript classes
 * @param {Event} e Event that fires when DOM content has been loaded
 */
const removeNoScript = function(e) {
    // Locate any elements with noscript classes
    const noScript = document.querySelectorAll('.noscript-show, .noscript-hide');
    // Update each element with a noscript class
    noScript.forEach(function(el) {
        // If an element was set to noscript-show, that means it's hidden by with scripts enabled,
        // so if this script is working, set the aria-hidden value to true
        if (el.classList.contains('noscript-show')) {
            el.setAttribute('aria-hidden', 'true');
        // If it was set to noscript-hide, that means it's shown by default, so set aria-hidden to false
        } else {
            el.setAttribute('aria-hidden', 'false');
        }
        // Remove the noscript classses
        el.classList.remove('noscript-show', 'noscript-hide');
    });
}

/**
 * Shows or hides the content the toggler is linked to
 * @param {Event} e Click event
 */
const showTogglerContent = function(e) {
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

/**
 * Prevents empty links (href="#") in navigation sections from being triggered
 * (since those are handled by JavaScript rather than as actual links)
 * @param {Event} e Click event
 */
const blockEmptyNavClick = function(e) {
    e.preventDefault();
}

/**
 * Triggered by a click on the search button
 * Either expands the search box if it isn't already expanded or allows the default search behavior if not
 * @param {Event} e Click event
 */
const toggleSearchControls = function(e) {

    const searchBox = document.getElementById('search-box');

    /**
     * Switches toggles show/hide classes and aria-hidden value
     * @param {Element} el Element to act on
     */
    const toggleClassesAttr = function (el) {
        // Toggle classes
        el.classList.toggle('hide');
        el.classList.toggle('show');
        // Toggle aria-hidden value
        if (el.getAttribute('aria-hidden') === 'false') {
            el.setAttribute('aria-hidden', 'true');
        } else {
            el.setAttribute('aria-hidden', 'false');
        }
    }

    // If the search box isn't currently expanded
    if (e.currentTarget.dataset.expanded === 'false') {
        // Prevent the default 'submit' behavior
        e.preventDefault();
        // Set search box classes and attributes
        toggleClassesAttr(searchBox);
        // Set the dataset to indicate the search box is now expanded
        e.currentTarget.dataset.expanded = true;
    } 
    // If expanded but value is empty, treat a click as a request to close the box
    else if (!searchBox.value) {
        // Prevent the default 'submit' behavior
        e.preventDefault();
        // Set search box classes and attributes
        toggleClassesAttr(searchBox);
        // Set the dataset to indicate the search box is not expanded
        e.currentTarget.dataset.expanded = false;
    }

}

/**
 * Sets up the search display controls, including giving them an initial expanded value
 * and setting up a click event listener
 * @param {*} e Event that fires when DOM content has been loaded
 */
const searchDisplaySetup = function(e) {
    // Get the search display toggle
    const searchDisplay = document.getElementById('search-display');
    // Add the data-exapnded property and set it to false (initial setting on page load)
    searchDisplay.dataset.expanded = 'false';
    // Add an onclick listener to the search display toggle
    searchDisplay.addEventListener('click', toggleSearchControls);
}

///////////////////////////////////////
// LISTENERS

// Attach a listener to remove noscript classes when DOM is loaded (only fires if JS is enabled)
addEventListener('DOMContentLoaded', removeNoScript);

// Set up search display toggler
addEventListener('DOMContentLoaded', searchDisplaySetup);

// Attach a listener to each element with the toggler class
togglers.forEach(el => el.addEventListener('click', showTogglerContent));

// Attach a listener to anchor tags with no destination in navigation bars
emptyNavLinks.forEach(el => el.addEventListener('click', blockEmptyNavClick));
