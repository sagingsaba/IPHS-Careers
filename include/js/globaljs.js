// JavaScript code to display the current date with month name
 // Get the current date
 var currentDate = new Date();
    
 // Extract date components
 var day = currentDate.getDate();
 var month = currentDate.getMonth() + 1; // Months are zero indexed, so we add 1
 var year = currentDate.getFullYear();
 
 // Format the date
 var formattedDate = day + '/' + month + '/' + year;
 
 // Display the formatted date in the paragraph element
 document.getElementById('date').textContent = formattedDate;