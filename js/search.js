// Get the search box elements
var searchBox = document.querySelector('.search');
var searchIcon = document.getElementById('searchIcon'); // Use the id to select the element
var searchInput = document.querySelector('.searchBox');

// Expand the search box when the icon is clicked
searchIcon.addEventListener('click', function(event) {
    searchBox.classList.add('expanded'); // Add the 'expanded' class
    searchInput.focus(); // Optional: focus the input
    event.stopPropagation(); // Prevent this event from triggering the document's click event
});

// Collapse the search box when clicking anywhere outside it
document.addEventListener('click', function(event) {
    if (event.target !== searchBox && event.target !== searchIcon && event.target !== searchInput) {
        searchBox.classList.remove('expanded'); // Remove the 'expanded' class
    }
});
