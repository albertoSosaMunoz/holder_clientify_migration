$(() => {
    console.log("funcionesClientify.js cargado");

    if ($('#formulario_clientify_mostrar').length)
        cargarClientesClientify(contactosClientify);

    $("#clientify_table tr").click((e) => {
        
        padreid=e.currentTarget.id;
        let contacto = $("#"+padreid+" #usuario_nombre").text();
        let id = $("#"+padreid+" #usuario_id").text();
        let email = $("#"+padreid+" #usuario_email").text();
        let holded_id = $("#"+padreid+" #usuario_holded_id").text();

        $("#formulario_clientify_mostrar #cliente_nombre").val(contacto);
        $("#formulario_clientify_mostrar #cliente_id").val(id);
        $("#formulario_clientify_mostrar #cliente_email").val(email);
        $("#formulario_clientify_mostrar #cliente_holded_id").val(holded_id);
        
        
    });
});

function cargarClientesClientify(contactosClientify) {

    console.log(contactosClientify);

    rownumber = 0;

    contactosClientify.results.forEach(element => {
        console.log(element);
        
        if(element.custom_fields.length>0) {       
            email = "";
            if (element.emails.length > 0)
                email = element.emails[0].email;
            let row = "<tr id='row_" + rownumber + "'>" +
                "<td id='usuario_nombre'>" + element.first_name + "</td>" +
                "<td id='usuario_id'>" + element.id + "</td>" +
                "<td id='usuario_email'>" + email + "</td>" +
                "<td id='usuario_holded_id'>" + element.custom_fields[0].value + "</td>" +
                "</tr>";
                "</tr>";

            $("#clientify_table tbody").append(row);
            rownumber++;
          }else{
            email = "";
            if (element.emails.length > 0)
                email = element.emails[0].email;
            let row = "<tr id='row_" + rownumber + "'>" +
                "<td id='usuario_nombre'>" + element.first_name + "</td>" +
                "<td id='usuario_id'>" + element.id + "</td>" +
                "<td id='usuario_email'>" + email + "</td>" +
                "<td id='usuario_holded_id'>no tiene</td>" +
                "</tr>";
                "</tr>";

            $("#clientify_table tbody").append(row);
            rownumber++;
          }
    });
}