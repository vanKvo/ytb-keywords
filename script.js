function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    console.log('city name: ' + cityName);
    tabcontent = document.getElementsByClassName("tabcontent");
    // Hide the content of each tab 
    for (i = 0; i < tabcontent.length; i++) { 
      console.log('tab content display');
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    // Deactivate each tab
    for (i = 0; i < tablinks.length; i++) {
      console.log('tablinks className:' + tablinks[i].className)  
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Display the contant of active tab
    document.getElementById(cityName).style.display = "block";
    // Activate the current clicked tab
    evt.currentTarget.className += " active";
  }