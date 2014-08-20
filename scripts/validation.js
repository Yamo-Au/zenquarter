$(document).ready(function() {
   $('input:text').css('color','lightgray');
   
   $('input:text').focus(function() {
      if (this.value == this.defaultValue) {
         this.value = '';
         this.style.color = 'black';
      }
         
   });
   
   $('input:text').blur(function() {
      if ($.trim(this.value) == ''){
         this.value = (this.defaultValue ? this.defaultValue : '');
         this.style.color = 'lightgray';
      }
   });
   
});