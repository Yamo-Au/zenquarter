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

// Determines if errors are present in form. Blocks form submit if necessary.
function checkForm() {

   clearErrors();
   var error = false;
   $('.required').each(function() {
      if (this.value === this.defaultValue || this.value == 'none') {
         this.style.outline = '3px solid red';
         error = true;
      }
   });
   
   if (error) {
      return false;
   }
   else {
      return true;
   }  
   
}

// Removes red outline from all fields.
function clearErrors() {

   $('.required').each(function() {
      this.style.outline = 'initial';
      error = true;
   });
   
}