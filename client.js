/**
 * AJAX long-polling
 *
 * 1. sends a request to the server (without a timestamp parameter)
 * 2. waits for an answer from server.php (which can take forever)
 * 3. if server.php responds (whenever), put data_from_file into #response
 * 4. and call the function again
 *
 * @param timestamp
 */
function getContent(timestamp)
{
    var pid = <?php echo "$id_number.$pid"; ?>;
    $('#response').html(pid);

    var queryString = {'file_id' : file_id, 'timestamp' : timestamp};

    $.ajax(
        {
            type: 'GET',
            url: 'http://localhost/ca/mobileid-CA/tanyaidentitas/poll-server.php',
            data: queryString,
            success: function(data){
                // put result data into "obj"
                var obj = jQuery.parseJSON(data);
                // put the data_from_file into #response
                $('#response').html(obj.data_from_file);
                // call the function again, this time with the timestamp we just got from server.php
                getContent(obj.file_id, obj.timestamp);
            }
        }
    );
}

// initialize jQuery
$(document).ready(function() {
    getContent();
});
