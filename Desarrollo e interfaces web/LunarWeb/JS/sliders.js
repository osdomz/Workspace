
// main.js

function loadSliders() {
    // Use the Fetch API to get the content of sliders.html
    fetch('./CONTENTS/tools/sliders.html')
      .then(response => response.text())
      .then(data => {
        // Inject the retrieved HTML into the sliders-container div
        document.getElementById('sliders-container').innerHTML = data;
      })
      .catch(error => console.error('Error fetching sliders.html:', error));
  }
  
  // Call the function immediately (without waiting for DOMContentLoaded)
  loadSliders();
  

  