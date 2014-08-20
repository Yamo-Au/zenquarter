$(document).ready(function() {
   // Set color of all user input fields to gray
   $('input:text').css('color','lightgray');
   
   // Clear the field on focus
   $('input:text').focus(function() {
      if (this.value == this.defaultValue) {
         this.value = '';
         this.style.color = 'black';
         this.style.outline = 'none';
      }
         
   });
   
   // Repopulate when field loses focus
   $('input:text').blur(function() {
      if ($.trim(this.value) == ''){
         this.value = (this.defaultValue ? this.defaultValue : '');
         this.style.color = 'lightgray';
      }
   });
   
});

function checkForm() {
   var error = false;
   $('.required').each(function() {
      if (this.value === this.defaultValue) {
         this.style.outline = '3px solid red';
         error = true;
      }
      
   });
   if (error) {
      alert('Errors present in the form. Please try again.');
      return false;
   }
   else {
      $('#quote').css('display', 'block');
      $("#quote").show(1000, function() {
         return true;
      });
      
   }   
}