jQuery(document).ready(function($){
    var form = $('#search_private_clouds');
    // initialize widgets
    $('#company_id',form).chosen({disable_search_threshold: 10});

    //search params
    var name = $.QueryString["name"];
    if(name!='undefined'){
        $('#name').val(name);
    }

    var company_id = $.QueryString["company_id"];
    if(company_id!='undefined'){
        $('#company_id').val(company_id);
        $("#company_id").trigger("chosen:updated");
    }

    $(".delete-private-cloud").click(function(event){
        event.preventDefault();
        event.stopPropagation();
        if(confirm("Are you sure to delete this?")){
            var id   = $(this).attr('data-id');
            var url  = 'api/v1/marketplace/private-clouds'
            url      = url+'/'+id;
            $.ajax({
                type: "DELETE",
                url: url,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (data,textStatus,jqXHR) {
                    window.location = listing_url;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    ajaxError(jqXHR, textStatus, errorThrown);
                }
            });
        }
        return false;
    });
});

