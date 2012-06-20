counter = 2;

function createClientJSON(){
    var names = $(".client-name"),
        dates = $(".client-date"),
        clients = [];
    
    console.log(names,dates);
    
    for(var i = 0; i < names.length; i++){
        if(names[i].value != "" && dates[i].value != "") {
            clients.push({
               "name": names[i].value,
               "date": dates[i].value 
            });
        }
    }
    
    //console.log(JSON.stringify(clients));

    return JSON.stringify(clients);
}

$(".plus").click(function (e) {
    e.preventDefault();
    var newHTML = '<div class="double-wrap"><label for="clients_recieved"></label><div class="input-wrap"><input type="text" name="client'+ counter +'name" class="client-name" /></div></div><div class="double-wrap second"><label for="client_date">Date Sent</label><div class="input-wrap"><input class="popup client-date" type="text" name="client'+ counter +'date" /></div></div>';

    $(newHTML).insertBefore(".plus");

    $('.popup').datepick({dateFormat: 'yyyy-mm-dd'});

    counter++;
});

$('form.new-site').submit(function(e) {
	e.preventDefault();

	var $form = $(this),
      id = $form.find( 'input[name="id"]' ).val(),
      action = $form.find( 'input[name="action"]' ).val(),
      name = $form.find( 'input[name="site"]' ).val(),
      address = $form.find( 'input[name="address"]' ).val(),
      cross_street = $form.find( 'input[name="cross_street"]' ).val(),
      neighborhood = $form.find( 'input[name="neighborhood"]:checked' ).val(),
      size = $form.find( 'input[name="size"]' ).val(),
      frontage = $form.find( 'input[name="frontage"]' ).val(),
      asking_rent = $form.find( 'input[name="asking_rent"]' ).val(),
      asking_key = $form.find( 'input[name="asking_key"]' ).val(),
      contact_name = $form.find( 'input[name="contact_name"]' ).val(),
      contact_number = $form.find( 'input[name="contact_number"]' ).val(),
      contact_company = $form.find( 'input[name="contact_company"]' ).val(),
      previous_use = $form.find( 'input[name="previous_use"]' ).val(),
      venting = $form.find( 'select[name="venting"] option:selected' ).val(),
      venting_type = $form.find( 'input[name="venting_type"]' ).val(),
      additional_info = $form.find( 'input[name="additional_info"]' ).val(),
      delivery_date = $form.find( 'input[name="delivery_date"]' ).val(),
      clients_recieved = $form.find( 'input[name="clients_recieved"]' ).val(),
      clients_date = $form.find( 'input[name="clients_date"]' ).val(),
      bcd_broker = $form.find( 'input[name="bcd_broker"]' ).val(),
      bcd_broker_date = $form.find( 'input[name="bcd_broker_date"]' ).val(),
      url = $form.attr( 'action' ),
      site = {
        "id": id,
        "action": action,
        "site": name,
        "address": address,
        "cross_street": cross_street,
        "neighborhood": neighborhood,
        "size": size,
        "frontage": frontage,
        "asking_rent": asking_rent,
        "asking_key": asking_key,
        "contact_name": contact_name,
        "contact_number": contact_number,
        "contact_company": contact_company,
        "previous_use": previous_use,
        "venting": venting,
        "venting_type": venting_type,
        "additional_info": additional_info,
        "delivery_date": delivery_date,
        "clients": createClientJSON(),
        "bcd_broker": bcd_broker,
        "bcd_broker_date": bcd_broker_date
      };
    console.log(site);
    
    $.post( url, site ,
      function(resp) {
          if(resp == 'success'){
            window.location = "view-all.php"
          }
          else{
            console.log(resp);
          }
      }
    );
    
    
    
});

$('.popup').datepick({dateFormat: 'yyyy-mm-dd'});