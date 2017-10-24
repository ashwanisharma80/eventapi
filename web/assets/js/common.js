$(document).ready(function () {
   $('.anc_delete').on('click', function () {
      var confirmMessage = $(this).data('confirm');
      if (confirm(confirmMessage)) {
         var $form = $('<form/>').hide();
         //form options
         $form.attr({
            'action': $(this).attr('href'),
            'method': 'post'
         });
         //adding the _method hidden field
         $form.append($('<input/>', {
            type: 'hidden',
            name: '_method'
         }).val($(this).data('method')));
         //adding a CSRF if needs
         if ($(this).data('csrf'))
         {
            var csrf = $(this).data('csrf').split(':');
            $form.append($('<input/>', {
               type: 'hidden',
               name: "form[_token]"
            }).val(csrf[1]));
         }
         //add form to parent node
         $(this).parent().append($form);
         $form.submit();
         return false;
      }
      return false;
   });
})