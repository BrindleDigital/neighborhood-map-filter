jQuery(document).ready(function($){
    var mediaUploader;

    // Open the media uploader on button click
    $('#upload_image_button').click(function(e) {



        e.preventDefault();
        // If the uploader already exists, open it
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Create a new media uploader
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image', // Title of the modal
            button: {
                text: 'Choose Image' // Text for the button
            },
            multiple: false // Single file selection
        });

        // When an image is selected, populate the field and preview
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#nmf_map_center_image_url').val(attachment.url); // Set the input value to image URL
            $('#image_preview').html('<img src="' + attachment.url + '" style="max-width: 200px;"/>'); // Show preview
        });

        // Open the uploader
        mediaUploader.open();
    });
});
