(function($){
    $(document).on('click', '.showModalButton', function (e) {
        e.preventDefault();
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('href'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('href'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    }); 
    
 })(jQuery)
 
 jQuery('#modal').modal({"show":false,"backdrop":"static","keyboard":false});

